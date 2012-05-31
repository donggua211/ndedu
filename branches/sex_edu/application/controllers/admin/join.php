<?php
/* 
  测评管理
  admin权限.
 */
class join extends Controller {

	function join()
	{
		parent::Controller();
		$this->load->library('session');
		
		$this->load->model('join_model');
		
		$this->load->helper('admin');
			
		//如果没有经登录, 就跳转到admin/login登陆页
		if (!has_login())
		{
			goto_login();
		}
		
		$this->staff_info = get_staff_info();
		//检查权限.
		if(!check_role(array(GROUP_ADMIN), $this->staff_info['group_id']))
		{
			show_access_deny_page();
		}
	}
	
	function index($filter_string = '')
	{
		//默认值
		$filter['page'] = 1;
		$filter['status'] = JOIN_STATUS_FINISHED;
		$filter['add_time_a'] = $this->input->post('add_time_a');
		$filter['add_time_b'] = $this->input->post('add_time_b');
		
		$filter = $this->_parse_filter($filter_string, $filter);
		
		//Page Nav
		$total = $this->join_model->getAll_count($filter);
		$page_nav = page_nav($total, JOIN_PER_PAGE, $filter['page']);
		$page_nav['base_url'] = 'admin/join/index';
		$page_nav['filter'] = $filter;
		$data['main']['page_nav'] = $this->load->view('admin/common_page_nav', $page_nav, true);
		
		$lists = $this->join_model->getAll($filter, $page_nav['start'], JOIN_PER_PAGE, 'nd_join.add_time', 'DESC');
		
		$data['header']['meta_title'] = '加入尼德列表';
		$data['main']['filter'] = $filter;
		$data['main']['lists'] = $lists;
		_load_viewer($this->staff_info['group_id'], 'join_all', $data);
	}
	
	function one($join_id)
	{
		//判断cart_id是否合法. card_id 需要转换成浮点数
		$join_id = intval($join_id);
		if($join_id <= 0)
		{
			show_error_page('您输入的ID不合法, 请返回重试.', 'admin/join');
			return false;
		}
		
		//获取 card 信息.
		$join_info = $this->join_model->get_one_join_detailed($join_id);
		
		//检查权限
		if(empty($join_info))
		{
			show_error_page('您所查询的ID不存在!', 'admin/join');
			return false;
		}
		
		$this->config->load('join/survey.php');
		
		$data['header']['meta_title'] = $join_info['info']['name'] . ' - 加入尼德列表';
		$data['main']['join_info'] = $join_info;
		$data['main']['survey_info'] = $this->config->config['survey_info'];
		_load_viewer($this->staff_info['group_id'], 'join_one', $data);
	}
	
	function clear()
	{
		$join_id = $this->join_model->get_all_unfinish();
		
		if(empty($join_id))
			echo '无需清理';
		else
		{
			$this->join_model->delete_join($join_id);
			echo '清理完成, 清理了如下ID: <br/>';
			print_r($join_id);
		}
	
	}
	function _parse_filter($filter_string, $filter)
	{
		$input_filter = parse_filter($filter_string);
		foreach($filter as $key => $value)
		{
			if(!isset($input_filter[$key]))
				continue;
			
			switch($key)
			{
				case 'add_time_a':
				case 'add_time_b':
					if(!check_valid_date($input_filter[$key]))
						continue;
					$filter[$key] = $input_filter[$key];
					break;
				case 'page':
				case 'cat_id':
				case 'level':
				case 'status':
					$input_filter[$key] = intval($input_filter[$key]);
					break;
				default:
					break;
			}
			
			if(empty($input_filter[$key]) && $input_filter[$key] !== 0)
				continue;
			
			$filter[$key] = $input_filter[$key];
		}
		return $filter;
	}
}

/* End of file admin.php */
/* Location: ./system/application/controllers/admin.php */
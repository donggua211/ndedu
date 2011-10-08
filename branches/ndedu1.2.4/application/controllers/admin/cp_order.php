<?php
/* 
  测评管理
  admin权限.
 */
class cp_order extends Controller {

	function cp_order()
	{
		parent::Controller();
		$this->load->library('session');
		
		$this->load->model('CP_order_model');
		$this->load->model('CP_category_model');
		
		$this->load->helper('admin');
		$this->load->helper('cp');
			
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
		
		//$this->output->enable_profiler(TRUE);
	}
	
	function index($filter_string = '')
	{
		//默认值
		$filter['page'] = 1;
		$filter['status'] = $this->input->post('status');
		$filter['add_time_a'] = $this->input->post('add_time_a');
		$filter['add_time_b'] = $this->input->post('add_time_b');
			
		$filter = $this->_parse_filter($filter_string, $filter);
				
		//Page Nav
		$total = $this->CP_order_model->getAll_count($filter);
		$page_nav = page_nav($total, CP_CARD_PER_PAGE, $filter['page']);
		$page_nav['base_url'] = 'admin/cp_order/index';
		$page_nav['filter'] = $filter;
		$data['main']['page_nav'] = $this->load->view('admin/common_page_nav', $page_nav, true);
		
		$orders = $this->CP_order_model->getAll($filter, $page_nav['start'], CP_CARD_PER_PAGE, 'cporder.status');
		
		$data['header']['meta_title'] = '查看订单 - 测评系统管理';
		$data['header']['css_file'] = '../calendar.css';
		$data['footer']['js_file'][] = '../calendar.js';
		$data['main']['filter'] = $filter;
		$data['main']['orders'] = $orders;
		_load_viewer($this->staff_info['group_id'], 'cp_order_all', $data);
	}
	
	function one($order_id)
	{
		//判断 order_id 是否合法.
		$order_id = intval($order_id);
		if($order_id <= 0)
		{
			show_error_page('您输入的订单ID不合法, 请返回重试.', 'admin/cp_order');
			return false;
		}
		
		//获取 card 信息.
		$order_info = $this->CP_order_model->get_one($order_id);
		
		//检查权限
		if(empty($order_info))
		{
			show_error_page('您所查询的订单不存在!', 'admin/cp_order');
			return false;
		}
		
		$data['header']['meta_title'] = $order_id . ' - 测评订单 - 测评系统管理';
		$data['main']['order_info'] = $order_info;
		_load_viewer($this->staff_info['group_id'], 'cp_order_one', $data);
	}
	
	function change_status()
	{
		if(isset($_POST['submit']) && !empty($_POST['submit']))
		{
			$order_id = $this->input->post("order_id");
			$status = $this->input->post("status");
			$from_status = $this->input->post("from_status");
			$action_notes = trim($this->input->post("action_notes"));
			
			if(empty($order_id) || empty($status))
			{
				show_error_page('该订单状态没有任何变化', 'admin/cp_order/one/'.$order_id);
				return false;
			}
			elseif($status == $from_status)
			{
				show_error_page('该订单状态没有任何变化', 'admin/cp_order/one/'.$order_id);
				return false;
			}
			else
			{
				$update_field['status'] = $status;
				if($this->CP_order_model->update($order_id, $update_field))
				{
					//插入student_status_history一条记录
					$this->CP_order_model->order_action_history($order_id, $from_status, $status, $action_notes);
					
					show_result_page('该订单状态已经改变', 'admin/cp_order/one/'.$order_id);
				}
				else
				{
					show_error_page('该订单状态修改失败', 'admin/cp_order/one/'.$order_id);
				}
			}
		}
		else
		{
			show_error_page('您无权访问该页面', '');
		}
	}
	
	function delete_action()
	{
		if(isset($_POST['submit']) && !empty($_POST['submit']))
		{
			$order_action_id = $this->input->post('order_action_id');
			
			$action_info = $this->CP_order_model->get_order_action($order_action_id);
			
			if(empty($action_info))
			{
				show_error_page('您所删除的记录不存在!', '');
				return false;
			}
						
			if($this->CP_order_model->delete_action($order_action_id))
			{
				$notify = '记录已经成功删除!';
				
				//将student表的status回复
				$update_field['status'] = $action_info['from_status'];
				if($this->CP_order_model->update($action_info['order_id'], $update_field))
				{
					$notify .= '订单的状态已经恢复!';
				}
				else
				{
					$notify .= '但是订单的状态没有恢复, 请联系管理员, 手动恢复!';
				}
				show_result_page($notify, 'admin/cp_order/one/'.$action_info['order_id']);
			}
			else
			{
				$notify = '记录已经成功删除, 请重试.';
				show_error_page($notify, 'admin/cp_order/one/'.$action_info['order_id']);
			}
		}
		else
		{
			show_error_page('您无权访问该页面', '');
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
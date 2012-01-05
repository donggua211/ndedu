<?php
/* 
  测评管理
  admin权限.
 */
class hr extends Controller {

	function hr()
	{
		parent::Controller();
		$this->load->library('session');
		$this->load->model('Hr_model');
		$this->load->model('Hr_position_model');
		$this->load->helper('admin');
		$this->load->helper('calendar');
		
		//如果没有经登录, 就跳转到admin/login登陆页
		if (!has_login())
		{
			goto_login();
		}
		
		$this->staff_info = get_staff_info();
		
		$this->load->library('admin_ac/Admin_Ac_hr', array('group_id' => $this->staff_info['group_id'], 'staff_id' => $this->staff_info['staff_id']));
	}
	
	function index($filter_string = '')
	{
		//默认值
		$filter['page'] = 1;
		$filter['add_time_a'] = $this->input->post('add_time_a');
		$filter['add_time_b'] = $this->input->post('add_time_b');
		
		$filter = $this->_parse_filter($filter_string, $filter);
		
		//access control
		$filter = $this->admin_ac_hr->hr_index_ac($filter);
		
		//Page Nav
		$total = $this->Hr_model->getAll_count($filter);
		$page_nav = page_nav($total, HR_PER_PAGE, $filter['page']);
		$page_nav['base_url'] = 'admin/join/index';
		$page_nav['filter'] = $filter;
		$data['main']['page_nav'] = $this->load->view('admin/common_page_nav', $page_nav, true);
		
		$lists = $this->Hr_model->getAll($filter, $page_nav['start'], HR_PER_PAGE);
		
		$data['header']['meta_title'] = '面试列表';
		$data['main']['filter'] = $filter;
		$data['main']['lists'] = $lists;
		_load_viewer($this->staff_info['group_id'], 'hr_all', $data);
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
	
	
	function edit($interviewer_id = 0)
	{
		//判断staff_id是否合法.
		$interviewer_id = (empty($interviewer_id))? $this->input->post('interviewer_id') : intval($interviewer_id);
		if($interviewer_id <= 0)
		{
			show_error_page('您输入的参数不合法, 请返回重试.', 'admin/hr');
			return false;
		}
		
		//获取 interviewer 信息.
		$interviewer_info = $this->Hr_model->get_one($interviewer_id);
		
		if(isset($_POST['submit']) && !empty($_POST['submit']))
		{
			//必填信息.
			$edit_interviewer['name'] = $this->input->post('name');
			$edit_interviewer['mobile'] = $this->input->post('mobile');
			$edit_interviewer['email'] = $this->input->post('email');
			$edit_interviewer['status'] = $this->input->post('status');
			$edit_interviewer['remark'] = $this->input->post('remark');
			$edit_interviewer['position_id'] = $this->input->post('position_id');
			
			//检查修改项
			$update_field = array();
			foreach($edit_interviewer as $key => $val)
			{
				if(!empty($val) && ($val != $interviewer_info[$key]))
					$update_field[$key] = $val;
			}
			
			if($this->Hr_model->update($interviewer_id, $update_field))
			{
				show_result_page('面试人员已经更新成功! ', 'admin/hr');
			}
			else
			{
				$notify = '更新失败, 请重试.';
				$this->_load_interviewer_edit_view($notify, $interviewer_info);
			}
		}
		else
		{
			$this->_load_interviewer_edit_view('', $interviewer_info);
		}
	}
		
	/* 
	 * 访问权限: 超级管理员, 校区管理员, 咨询师
	*/
	function add()
	{
		if(isset($_POST['submit']) && !empty($_POST['submit']))
		{
			//必填信息.
			$interviewer['name'] = $this->input->post('name');
			$interviewer['mobile'] = $this->input->post('mobile');
			$interviewer['email'] = $this->input->post('email');
			$interviewer['remark'] = $this->input->post('remark');
			$interviewer['position_id'] = $this->input->post('position_id');
			
			if(empty($interviewer['name']) || empty($interviewer['mobile']) || empty($interviewer['email']) || empty($interviewer['position_id']))
			{
				$notify = '请填写完整的面试人员信息';
				$this->_load_hr_add_view($notify, $interviewer);
			}
			else
			{
				//add into DB
				if($this->Hr_model->add($interviewer))
				{
					show_result_page('新面试者已经添加成功! ', 'admin/hr');
				}
				else
				{
					$notify = '评论添加失败, 请重试.';
					$this->_load_hr_add_view($notify, $interviewer);
				}
			}
		}
		else
		{
			$this->_load_hr_add_view();
		}
	}
	
	function delete($interviewer_id)
	{
		//判断staff_id是否合法.
		$interviewer_id = intval($interviewer_id);
		if($interviewer_id <= 0)
		{
			show_error_page('您输入的参数不合法, 请返回重试.', 'admin/hr');
			return false;
		}
		
		
		if($this->Hr_model->delete($interviewer_id))
		{
			show_result_page('面试人员已经删除! ', 'admin/hr');
		}
		else
		{
			show_error_page('删除失败, 请重试.', 'admin/hr');
		}
	}
	
	/* 
	 * 访问权限: 超级管理员, 校区管理员, 咨询师
	*/
	function add_interview_time()
	{
		if(isset($_POST['submit']) && !empty($_POST['submit']))
		{
			//必填信息.
			$interviewer['interviewer_id'] = $this->input->post('interviewer_id');
			$interviewer['interviewer_date'] = $this->input->post('interviewer_date');
			$interviewer['hour'] = $this->input->post('hour');
			$interviewer['mins'] = $this->input->post('mins');
			$interviewer['notice_method'] = $this->input->post('notice_method');
			
			if(empty($interviewer['interviewer_date']) || empty($interviewer['notice_method']))
			{
				$notify = '请填写完整的面试人员信息';
				show_error_page($notify, 'admin/hr');
			}
			else
			{
				$interviewer['interviewer_time'] = $interviewer['interviewer_date'].' '.$interviewer['hour'].':'.$interviewer['mins'].':00';
				//add into DB
				if($this->Hr_model->add_interview_time($interviewer))
				{
					//更新通知次数。
					$update_field['status'] = HR_STATUS_APPOINTMENT;
					$update_field['contact_num'] = "`contact_num`+1";
					$this->Hr_model->update($interviewer['interviewer_id'], $update_field);
					
					show_result_page('新面面试时间已经添加成功! ', 'admin/hr');
				}
				else
				{
					$notify = '添加失败, 请重试.';
					show_error_page($notify, 'admin/hr');
				}
			}
		}
		else
		{
			$notify = '您无权访问当前页面';
			show_error_page($notify, 'admin/hr');
		}
	}
	
	function _load_hr_add_view($notify = '', $interviewer = array())
	{
		$data['header']['meta_title'] = '添加新面试 - HR系统';
		$data['main']['notification'] = $notify;
		$data['main']['interviewer'] = $interviewer;
		$data['main']['positions'] = $this->_get_positions();
		_load_viewer($this->staff_info['group_id'], 'hr_add', $data);
	}
	
	function _load_interviewer_edit_view($notify = '', $interviewer = array())
	{
		$data['header']['meta_title'] = '编辑面试 - HR系统';
		$data['main']['notification'] = $notify;
		$data['main']['positions'] = $this->_get_positions();
		$data['main']['interviewer'] = $interviewer;
		_load_viewer($this->staff_info['group_id'], 'hr_edit', $data);
	}
	
	function _get_positions()
	{
		return $this->Hr_position_model->get_all();
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
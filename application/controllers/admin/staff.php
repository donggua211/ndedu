<?php
/* 
  班主任管理模块
  admin权限.
 */
class Staff extends Controller {

	function Staff()
	{
		parent::Controller();
		$this->load->library('session');
		
		$this->load->model('CRM_Grade_model');
		$this->load->model('CRM_Branch_model');
		$this->load->model('CRM_Group_model');
		$this->load->model('CRM_Staff_model');
		
		$this->load->helper('admin');
			
		//如果没有经登录, 就跳转到admin/login登陆页
		if (!has_login())
		{
			goto_login();
		}
		
		$this->staff_info = get_staff_info();
		//检查权限.
		if(!check_role(array(GROUP_ADMIN, GROUP_SCHOOLADMIN), $this->staff_info['group_id']))
		{
			//show_access_deny_page();
		}
		
		//$this->output->enable_profiler(TRUE);
	}
	
	function index($filter_string = '')
	{
		//默认值
		$filter['page'] = 1;
		$filter['start_time'] = $this->input->post('start_time');
		$filter['end_time'] = $this->input->post('end_time');
		$filter['branch_id'] = $this->input->post('branch_id');
		$filter['grade_id'] = $this->input->post('grade_id');
		$filter['group_id'] = $this->input->post('group_id');
		$filter['name'] = $this->input->post('name');
		$filter['is_active'] = 1;
		$filter['is_delete'] = 0;
		$filter['in_trial'] = 0;
	
		$filter = $this->_parse_filter($filter_string, $filter);
		
		switch($this->staff_info['group_id'])
		{
			case GROUP_ADMIN: //admin管理有权限
				break;
			case GROUP_SCHOOLADMIN: //shooladmin只有查看本校区员工的权限
				$filter['branch_id'] = $this->staff_info['branch_id'];
				break;
			default:
				show_error_page('您没有权限查看员工列表: 请重新登录或者联系管理员!', 'admin');
				return false;
		}
		
		//Page Nav
		$total = $this->CRM_Staff_model->getAll_count($filter);
		$page_nav = page_nav($total, STAFF_PER_PAGE, $filter['page']);
		$page_nav['base_url'] = 'admin/staff/index';
		$page_nav['filter'] = $filter;
		$data['main']['page_nav'] = $this->load->view('admin/common_page_nav', $page_nav, true);
		
		$staffs = $this->CRM_Staff_model->getAll($filter, $page_nav['start'], STAFF_PER_PAGE);
		
		$data['header']['css_file'] = '../calendar.css';
		$data['header']['meta_title'] = '查看员工 - 管理员工';
		$data['footer']['js_file'] = '../calendar.js';
		$data['main']['staffs'] = $staffs;
		$data['main']['branches'] = $this->_get_branch();
		$data['main']['grades'] = $this->_get_grade();
		$data['main']['groups'] = $this->_get_groups();
		$data['main']['filter'] = $filter;
		_load_viewer($this->staff_info['group_id'], 'staff_all', $data);
	}
	
	function one($staff_id)
	{
		//判断student_id是否合法.
		$staff_id = intval($staff_id);
		if($staff_id <= 0)
		{
			show_error_page('您输入的员工ID不合法, 请返回重试.', 'admin/staff');
			return false;
		}
		
		//获取 staff 信息.
		$staff_info = $this->CRM_Staff_model->getOne($staff_id);
		
		//检查权限
		if(empty($staff_info))
		{
			show_error_page('您所查询的员工不存在!', 'admin/student');
			return false;
		}
		
		$data['header']['meta_title'] = $staff_info['name'].' -查看员工 - 管理员工';
		$data['main']['staff'] = $staff_info;
		
		_load_viewer($this->staff_info['group_id'], 'staff_one', $data);
	}
	
	function inactive_staff()
	{
		$this->index('page=1&is_active=0');
	}
	
	function delete_staff()
	{
		$this->index('page=1&is_delete=1');
	}
	
	function trial_staff()
	{
		$this->index('page=1&is_active=1&is_delete=0&in_trial=1');
	}
	
	function performance($filter_string = '')
	{
		//默认值
		$filter['page'] = 1;
		$filter['perf_start_time'] = $this->input->post('start_time');
		$filter['perf_end_time'] = $this->input->post('end_time');
		$filter['branch_id'] = $this->input->post('branch_id');
		$filter['grade_id'] = $this->input->post('grade_id');
		$filter['group_id'] = $this->input->post('group_id');
		$filter['name'] = $this->input->post('name');
		$filter['start_time'] = FALSE;
		$filter['end_time'] = FALSE;
		$filter['is_active'] = 1;
		$filter['is_delete'] = 0;
		
		$filter = $this->_parse_filter($filter_string, $filter);
	
		switch($this->staff_info['group_id'])
		{
			case GROUP_ADMIN: //admin管理有权限
				break;
			case GROUP_SCHOOLADMIN: //shooladmin只有查看本校区员工的权限
				$filter['branch_id'] = $this->staff_info['branch_id'];
				break;
			default:
				show_error_page('您没有权限查看员工列表: 请重新登录或者联系管理员!', 'admin');
				return false;
		}
		
		//Page Nav
		$total = $this->CRM_Staff_model->getAll_count($filter);
		$page_nav = page_nav($total, STAFF_PER_PAGE, $filter['page']);
		$page_nav['base_url'] = 'admin/staff/index';
		$page_nav['filter'] = $filter;
		$data['main']['page_nav'] = $this->load->view('admin/common_page_nav', $page_nav, true);
		
		$staffs = $this->CRM_Staff_model->get_all_performance($filter, $page_nav['start'], STAFF_PER_PAGE);
		
		$data['header']['css_file'] = '../calendar.css';
		$data['header']['meta_title'] = '员工绩效 - 查看员工 - 管理员工';
		$data['footer']['js_file'] = '../calendar.js';
		$data['main']['staffs'] = $staffs;
		$data['main']['branches'] = $this->_get_branch();
		$data['main']['grades'] = $this->_get_grade();
		$data['main']['groups'] = $this->_get_groups();
		_load_viewer($this->staff_info['group_id'], 'staff_performance', $data);
	}
	
	/* 
	 * 访问权限: 全部角色
	*/
	function edit($staff_id = 0)
	{
		//判断staff_id是否合法.
		$staff_id = (empty($staff_id))? $this->input->post('staff_id') : intval($staff_id);
		if($staff_id <= 0)
		{
			show_error_page('您输入的员工ID不合法, 请返回重试.', 'admin/staff');
			return false;
		}
		
		//获取staff 信息.
		$staff_info = $this->CRM_Staff_model->getOne($staff_id);
		
		//检查权限
		if(empty($staff_info))
		{
			show_error_page('您所查询的员工不存在!', 'admin/staff');
			return false;
		}
		else
		{
			switch($this->staff_info['group_id'])
			{
				case GROUP_ADMIN: //admin管理有权限
					break;
				case GROUP_SCHOOLADMIN: //shooladmin只有查看本校区员工的权限
					if($staff_info['branch_id'] != $this->staff_info['branch_id'])
					{
						show_error_page('您没有权限查看该员工: 他/她不在您所在的校区!', 'admin/staff');
						return false;
					}
					break;
				default:
					show_error_page('您没有权限查看该员工: 请重新登录或者联系管理员!', 'admin');
					return false;
			}
		}
		
		if(isset($_POST['submit']) && !empty($_POST['submit']))
		{
			//必填信息.
			$edit_staff['password'] = $this->input->post('password');
			$edit_staff['password_c'] = $this->input->post('password_c');
			$edit_staff['name'] = $this->input->post('name');
			$edit_staff['phone'] = $this->input->post('phone');
			$edit_staff['qq'] = $this->input->post('qq');
			$edit_staff['email'] = $this->input->post('email');
			$edit_staff['group_id'] = $this->input->post('group_id');
			$edit_staff['branch_id'] = $this->input->post('branch_id');
			$edit_staff['grade_id'] = $this->input->post('grade_id');
			$edit_staff['title'] = $this->input->post('title');
			$edit_staff['address'] = $this->input->post('address');
			$edit_staff['remark'] = $this->input->post('remark');
			
			if($edit_staff['password'] != $edit_staff['password_c'])
			{
				$notify = '两次输入密码不一致, 请重新输入.';
				$this->_load_staff_edit_view($notify, $staff_info);
				return false;
			}
			
			//检查修改项
			$update_field = array();
			foreach($edit_staff as $key => $val)
			{
				if($key == 'password_c')
					continue;
				
				if($key == 'password')
					$val = md5($val);
				
				if(!empty($val) && ($val != $staff_info[$key]))
					$update_field[$key] = $val;
			}
			
			if($this->CRM_Staff_model->update($staff_id, $update_field))
			{
				show_result_page('员工已经更新成功! ', 'admin/staff');
			}
			else
			{
				$notify = '更新失败, 请重试.';
				$this->_load_staff_edit_view($notify, $staff_info);
			}
		}
		else
		{
			$this->_load_staff_edit_view('', $staff_info);
		}
	}
		
	/* 
	 * 访问权限: 超级管理员, 校区管理员, 咨询师
	*/
	function add()
	{
		//检查权限. 已经在constructor中检查过.
		
		if(isset($_POST['submit']) && !empty($_POST['submit']))
		{
			//必填信息.
			$new_staff['username'] = $this->input->post('username');
			$new_staff['password'] = $this->input->post('password');
			$new_staff['password_c'] = $this->input->post('password_c');
			$new_staff['name'] = $this->input->post('name');
			$new_staff['phone'] = $this->input->post('phone');
			$new_staff['qq'] = $this->input->post('qq');
			$new_staff['email'] = $this->input->post('email');
			
			//数字的必填信息
			$new_staff['group_id'] = $this->input->post('group_id');
			$new_staff['branch_id'] = $this->input->post('branch_id');
			$new_staff['grade_id'] = $this->input->post('grade_id');
			
			//选填信息.
			$new_staff['title'] = $this->input->post('title');
			$new_staff['address'] = $this->input->post('address');
			$new_staff['remark'] = $this->input->post('remark');
			
			//ndedu1.2.2 新加： 性别，生日，星级，是否是试用期
			$new_staff['dob'] = $this->input->post('dob');
			$new_staff['gender'] = $this->input->post('gender');
			$new_staff['level'] = $this->input->post('level');
			$new_staff['in_trial'] = $this->input->post('trial') ?  1 : 0;
			
			if(empty($new_staff['username']) || empty($new_staff['password']) || empty($new_staff['password_c']) || empty($new_staff['name']) || empty($new_staff['phone']) || empty($new_staff['qq']) || empty($new_staff['email']) || empty($new_staff['group_id']) || empty($new_staff['branch_id']) || empty($new_staff['grade_id']) || empty($new_staff['dob']) || empty($new_staff['gender']) || empty($new_staff['level']))
			{
				$notify = '请填写完整的员工信息';
				$this->_load_staff_add_view($notify, $new_staff);
			}
			elseif(!$this->_check_username($new_staff['username']))
			{
				$notify = '只能由3-16位字母、数字、下划线(_)或者点(.)构成, 请重新输入.';
				$this->_load_staff_add_view($notify, $new_staff);
			}
			elseif($new_staff['password'] != $new_staff['password_c'])
			{
				$notify = '两次输入密码不一致, 请重新输入.';
				$this->_load_staff_add_view($notify, $new_staff);
			}
			elseif($this->CRM_Staff_model->username_has_exist($new_staff['username'])) //检查重名.
			{
				$notify = '员工名已经存在, 请重新输入.';
				$this->_load_staff_add_view($notify, $new_staff);
			}
			else
			{
				//add into DB
				if($this->CRM_Staff_model->add($new_staff))
				{
					show_result_page('员工已经添加成功! ', 'admin/staff');
				}
				else
				{
					$notify = '员工添加失败, 请重试.';
					$this->_load_staff_add_view($notify, $new_staff);
				}
			}
		}
		else
		{
			$this->_load_staff_add_view();
		}
	}
	
	function delete($staff_id, $is_delete = 1)
	{
		//判断staff_id是否合法.
		$staff_id = intval($staff_id);
		if($staff_id <= 0)
		{
			show_error_page('您输入的员工ID不合法, 请返回重试.', 'admin/staff');
			return false;
		}
		
		$staff_info = $this->CRM_Staff_model->getOne($staff_id);
		
		//检查权限.
		switch($this->staff_info['group_id'])
		{
			case GROUP_ADMIN: //admin管理有权限
				break;
			case GROUP_SCHOOLADMIN: //shooladmin只有查看本校区员工的权限
				if($staff_info['branch_id'] != $this->staff_info['branch_id'])
				{
					show_error_page('您没有权限删除该员工: 他/她不在您所在的校区!', 'admin/staff');
					return false;
				}
				break;
			default:
				show_error_page('您没有权限删除该员工: 请重新登录或者联系管理员!', 'admin/staff');
				return false;
		}
		
		
		$update_field['is_delete'] = $is_delete;
		if($this->CRM_Staff_model->update($staff_id, $update_field))
		{
			if($is_delete == 1)
				$notify = '员工已经成功被删除!';
			else
				$notify = '员工已经成功被取消删除!';
			
			show_result_page($notify, 'admin/staff');
		}
		else
		{
			if($is_delete == 1)
				$notify = '删除失败, 请重试.';
			else
				$notify = '取消删除失败, 请重试.';
			
			show_error_page($notify, 'admin/staff');
		}	
	}
	
	function inactive($staff_id, $is_active = 0)
	{
		//判断staff_id是否合法.
		$staff_id = intval($staff_id);
		if($staff_id <= 0)
		{
			show_error_page('您输入的员工ID不合法, 请返回重试.', 'admin/staff');
			return false;
		}
		
		$staff_info = $this->CRM_Staff_model->getOne($staff_id);
		
		//检查权限.
		switch($this->staff_info['group_id'])
		{
			case GROUP_ADMIN: //admin管理有权限
				break;
			case GROUP_SCHOOLADMIN: //shooladmin只有查看本校区员工的权限
				if($staff_info['branch_id'] != $this->staff_info['branch_id'])
				{
					show_error_page('您没有权限注销该员工: 他/她不在您所在的校区!', 'admin/staff');
					return false;
				}
				break;
			default:
				show_error_page('您没有权限注销该员工: 请重新登录或者联系管理员!', 'admin/staff');
				return false;
		}
		
		$update_field['is_active'] = $is_active;
		if($this->CRM_Staff_model->update($staff_id, $update_field))
		{
			if($is_active == 0)
				$notify = '员工已经成功被注销!';
			else
				$notify = '员工已经成功被取消注销!';
			
			show_result_page($notify, 'admin/staff');
		}
		else
		{
			if($is_active == 0)
				$notify = '注销失败, 请重试.';
			else
				$notify = '取消注销失败, 请重试.';
			
			show_error_page($notify, 'admin/staff');
		}	
	}
	
	
	function become_full($staff_id, $in_trial = 0)
	{
		//判断staff_id是否合法.
		$staff_id = intval($staff_id);
		if($staff_id <= 0)
		{
			show_error_page('您输入的员工ID不合法, 请返回重试.', 'admin/staff');
			return false;
		}
		
		$staff_info = $this->CRM_Staff_model->getOne($staff_id);
		
		//检查权限.
		switch($this->staff_info['group_id'])
		{
			case GROUP_ADMIN: //admin管理有权限
				break;
			case GROUP_SCHOOLADMIN: //shooladmin只有查看本校区员工的权限
				if($staff_info['branch_id'] != $this->staff_info['branch_id'])
				{
					show_error_page('您没有权限注销该员工: 他/她不在您所在的校区!', 'admin/staff');
					return false;
				}
				break;
			default:
				show_error_page('您没有权限注销该员工: 请重新登录或者联系管理员!', 'admin/staff');
				return false;
		}
		
		$update_field['in_trial'] = $in_trial;
		if($this->CRM_Staff_model->update($staff_id, $update_field))
		{
			$notify = '员工已经成功转正!';
			show_result_page($notify, 'admin/staff/trial_staff');
		}
		else
		{
			$notify = '员工已经成功转正, 请重试.';
			show_error_page($notify, 'admin/staff/trial_staff');
		}	
	}
	
	
	function change_psd()
	{
		if(isset($_POST['submit']) && !empty($_POST['submit']))
		{
			$old_password = $this->input->post("old_password");
			$new_password = $this->input->post("new_password");
			$new_password_c = $this->input->post("new_password_c");
			
			if(empty($old_password) || empty($new_password) || empty($new_password_c))
			{
				$this->_load_staff_change_pwd_view('请填写完整密码信息!');
				return false;
			}
			elseif($new_password != $new_password_c)
			{
				$this->_load_staff_change_pwd_view('您两次密码输入不一致, 请重新输入!');
				return false;
			}
			else if (strpos($new_password, ' ') !== FALSE) 
			{
				$this->_load_staff_change_pwd_view('您的新密码不能包含空格, 请重新输入!');
				return false;
			
			}
			else if (strlen($new_password) < 4) 
			{
				$this->_load_staff_change_pwd_view('您的新密码至少要4位以上, 请重新输入!');
				return false;			
			}
			elseif(!$this->check_password($this->staff_info['staff_id'], $old_password))
			{
				$this->_load_staff_change_pwd_view('您的密码有误, 请重新输入!');
				return false;
			}
			else
			{
				$update_field['password'] = md5($new_password);
				if($this->CRM_Staff_model->update($this->staff_info['staff_id'], $update_field))
				{
					show_result_page('您的密码已经更新成功! ', 'admin/');
				}
				else
				{
					$this->_load_staff_change_pwd_view('您的密码已经更新失败, 请重试');
				}
			}
		}
		else
		{
			$this->_load_staff_change_pwd_view();
		}
	}
	
	function admin_gen_psw()
	{
		//检查权限.
		switch($this->staff_info['group_id'])
		{
			case GROUP_ADMIN: //admin管理有权限
				break;
			default:
				show_error_page('您没有权限访问该页面!', 'admin/staff');
				return false;
		}
		
		$new_password = substr(md5(microtime()), 0, 6);
		$update_field['password'] = md5($new_password);
		if($this->CRM_Staff_model->update($this->staff_info['staff_id'], $update_field))
		{
			show_result_page('您的密码已经更新成功! 请牢记您的新密码:'.$new_password, 'admin/');
		}
		else
		{
			$this->_load_staff_change_pwd_view('您的密码已经更新失败, 请重试');
		}
		
	
	}
	
	function _load_staff_change_pwd_view($notify = '')
	{
		$data['header']['meta_title'] = '修改密码';
		$data['main']['notification'] = $notify;
		_load_viewer($this->staff_info['group_id'], 'edit_password', $data);
	}
	
	function check_password($staff_id, $password)
	{
		$login_info = $this->CRM_Staff_model->check_password($staff_id, $password);
		return (empty($login_info)) ? FALSE : TRUE;
		
	}
	
	function _load_staff_add_view($notify = '', $staff = array())
	{
		$data['header']['meta_title'] = '添加员工 - 管理员工';
		$data['header']['css_file'] = '../calendar.css';
		$data['footer']['js_file'][] = '../calendar.js';
		$data['footer']['js_file'][] = '../ajax.js';
		$data['footer']['js_file'][] = 'staff.js';
		$data['main']['branches'] = $this->_get_branch();
		$data['main']['groups'] = $this->_get_groups();
		$data['main']['grades'] = $this->_get_grade();
		$data['main']['notification'] = $notify;
		$data['main']['staff'] = $staff;
		_load_viewer($this->staff_info['group_id'], 'staff_add', $data);
	}
	
	function _load_staff_edit_view($notify = '', $staff = array())
	{
		$data['header']['meta_title'] = '编辑员工 - 管理员工';
		$data['main']['branches'] = $this->_get_branch();
		$data['main']['groups'] = $this->_get_groups();
		$data['main']['grades'] = $this->_get_grade();
		$data['main']['notification'] = $notify;
		$data['main']['staff'] = $staff;
		_load_viewer($this->staff_info['group_id'], 'staff_edit', $data);
	}
	
	function _get_branch()
	{
		$result = array();
		if($this->staff_info['group_id'] == GROUP_ADMIN)
		{
			$result['show_branch_list'] = true;
			$result['branch'] = $this->CRM_Branch_model->get_branches();
		}
		else
		{
			$result['show_branch_list'] = false;
			$result['branch'] = $this->CRM_Branch_model->get_one_branch($this->staff_info['branch_id']);
		}
		return $result;		
	}
	
	function _get_groups()
	{
		switch($this->staff_info['group_id'])
		{
			case GROUP_ADMIN: //admin管理有权限
				$from_group = GROUP_ADMIN;
				break;
			case GROUP_SCHOOLADMIN: //shooladmin只有查看本校区员工的权限
				$from_group = GROUP_CONSULTANT;
				break;
			default:
				return array();
		}
		return $this->CRM_Group_model->get_groups($from_group);
	}
	
	function _get_grade()
	{
		return $this->CRM_Grade_model->get_grades(GRADE_PARENT);
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
				case 'perf_start_time':
				case 'perf_end_time':
				case 'start_time':
				case 'end_time':
					if(!check_valid_date($input_filter[$key]))
						continue;
					$filter[$key] = $input_filter[$key];
					break;
				case 'page':
				case 'branch_id':
				case 'grade_id':
				case 'group_id':
				case 'is_active':
				case 'is_delete':
				case 'in_trial':
					$input_filter[$key] = intval($input_filter[$key]);
					break;
				case 'name':
				default:
					break;
			}
			
			if(empty($input_filter[$key]) && $input_filter[$key] !== 0)
				continue;
			
			$filter[$key] = $input_filter[$key];
		}
		return $filter;
	}
	
	function _check_username($username)
	{
		return preg_match('/^[a-zA-Z][a-zA-Z0-9_.]{1,14}[a-zA-Z0-9]$/i', $username);
	}
}

/* End of file admin.php */
/* Location: ./system/application/controllers/admin.php */
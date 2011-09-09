<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	/*
	 *	判断员工是否已经登录后台.
	 */
	function has_login() 
	{
		$CI =& get_instance();
		return ($CI->session->userdata('staff_id'))? true : false;
	}
	
	/*
	 * 权限方法系列
	*/
	function is_admin()
	{
		$CI =& get_instance();
		$staff_group_if = $CI->session->userdata('group_id');
		return ($staff_group_if == GROUP_ADMIN) ? true : false;
	}
	function is_school_admin()
	{
		$CI =& get_instance();
		$staff_group_if = $CI->session->userdata('group_id');
		return ($staff_group_if == GROUP_SCHOOLADMIN) ? true : false;
	}
	function is_consultant()
	{
		$CI =& get_instance();
		$staff_group_if = $CI->session->userdata('group_id');
		return ($staff_group_if == GROUP_CONSULTANT) ? true : false;
	}
	function is_supervisor()
	{
		$CI =& get_instance();
		$staff_group_if = $CI->session->userdata('group_id');
		return ($staff_group_if == GROUP_SUPERVISOR) ? true : false;
	}
	function is_cs()
	{
		$CI =& get_instance();
		$staff_group_if = $CI->session->userdata('group_id');
		return ($staff_group_if == GROUP_CS) ? true : false;
	}
	/* 
		检查员工是否有权限查看该Controller.
	 */
	function check_role($allowed_group, $group_id)
	{
		if(empty($group_id))
			return false;
		
		if(!is_array($allowed_group))
			$allowed_group = explode(',', $allowed_group);
		
		//去除多余的空格
		foreach($allowed_group as $value)
			$result[] = trim($value);
		
		return (in_array($group_id, $allowed_group)) ? true : false;
	}
	
	function show_access_deny_page()
	{
		show_error_page('Access Deny for this User. Please contact admin donggua211@qq.com');
	}
	
	/* 
		获取该员工的信息
	 */
	function get_staff_info()
	{
		$CI =& get_instance();
		$staff_info = array();
		$staff_info['group_id'] = $CI->session->userdata('group_id');
		$staff_info['staff_id'] = $CI->session->userdata('staff_id');
		$staff_info['branch_id'] = $CI->session->userdata('branch_id');
		$staff_info['username'] = $CI->session->userdata('username');
		return $staff_info;
	}
	
	/* 
		跳转到登陆页
	*/
	function goto_login()
	{
		redirect("admin/admin/login");
		exit();
	}
	
	function show_error_page($notify, $back_url = '')
	{
		if(empty($back_url))
		{
			if(isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER']))
				$back_url = $_SERVER['HTTP_REFERER'];
			else
				$back_url = site_url('admin');
		}
		else
		{
			$back_url = site_url($back_url);
		}
		
		$CI =& get_instance();
		
		//加载header
		$data['header']['meta_title'] = '错误!';
		$CI->load->view('admin/header', $data['header']);
		
		//加载主页面
		$data['main']['notification'] = $notify;
		$data['main']['back_url'] = $back_url;
		$CI->load->view('admin/common_error', $data['main']);
		
		//加载footer
		$CI->load->view('admin/footer');
		
		echo $CI->output->get_output();
		exit();
	}
	
	function show_result_page($notify, $back_url = '')
	{
		if(empty($back_url))
		{
			if(isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER']))
				$back_url = $_SERVER['HTTP_REFERER'];
			else
				$back_url = site_url('admin');
		}
		else
		{
			$back_url = site_url($back_url);
		}
		
		$CI =& get_instance();
		
		//加载header
		$CI->load->view('admin/header');
		
		//加载主页面
		$data['main']['notification'] = $notify;
		$data['main']['back_url'] = $back_url;
		$CI->load->view('admin/common_result', $data['main']);
		
		//加载footer
		$CI->load->view('admin/footer');
	}
	
	function get_student_status_text($status = 1)
	{
		$status = intval($status);
		$status_text = array(
			STUDENT_STATUS_NOT_APPOINTMENT => '未约访',
			STUDENT_STATUS_HAS_APPOINTMENT => '已约访',
			STUDENT_STATUS_SIGNUP => '已报名',
			STUDENT_STATUS_LEARNING => '正在学',
			STUDENT_STATUS_FINISHED => '已学完',
			STUDENT_STATUS_INACTIVE => '已注销'
		);
		
		if(!array_key_exists($status, $status_text))
			return '';
		else
			return $status_text[$status];
	}

	function get_group_name($group_id = 1)
	{
		$group_id = intval($group_id);
		$groups_text = array(
			GROUP_ADMIN => '超级管理员',
			GROUP_SCHOOLADMIN => '校区管理员',
			GROUP_CONSULTANT => '咨询师',
			GROUP_SUPERVISOR => '班主任',
			GROUP_TEACHER_PARTTIME => '任课老师(兼职)',
			GROUP_TEACHER_FULL => '任课老师(全职)',
		);
		
		if(!array_key_exists($group_id, $groups_text))
			return '';
		else
			return $groups_text[$group_id];
	}
	
	function _load_viewer($group_id, $template, $data = array())
	{
		//处理 template EXT后缀.
		if(!strpos($template, '.php'))
			$template .= EXT;
		
		$CI =& get_instance();
		//加载header
		if( !isset($data['header']) )
			$data['header'] = array();
		$CI->load->view('admin/header', $data['header']);
		
		//加载主页面
		if( !isset($data['main']) )
			$data['main'] = array();
		
		//如果在views/admin/common存在的话, 就载入, 否则在权限的文件夹下超找.
		switch($group_id)
		{
			case GROUP_ADMIN: 
				$template_full = 'admin/admin/'.$template;
				break;
			case GROUP_SCHOOLADMIN:
				$template_full = 'admin/schooladmin/'.$template;
				break;
			case GROUP_CONSULTANT:
				$template_full = 'admin/consultant/'.$template;
				break;
			case GROUP_SUPERVISOR:
				$template_full = 'admin/supervisor/'.$template;
				break;
			case GROUP_CS:
				$template_full = 'admin/cs/'.$template;
				break;
		}
		
		if(!file_exists(APPPATH.'views/'.$template_full))
		{
			if(file_exists(APPPATH.'views/admin/common/'.$template))
			{
				$template_full = 'admin/common/'.$template;
			}
			else
			{
				show_error_page('您没有权限访问该页面!');
			}
		}
		
		
		$CI->load->view($template_full, $data['main']);
		
		//加载footer
		if( !isset($data['footer']) )
			$data['footer'] = array();
		$CI->load->view('admin/footer', $data['footer']);
	}
	
	function page_nav($total, $pagesize, $current_page)
	{
		$total_page = ceil( $total / $pagesize);
		if( $current_page > $total_page ) $current_page = $total_page;
		if( $current_page < 1 ) $current_page = 1;

		$page_nav = array();	
		$page_nav['total'] = $total;
		$page_nav['total_page'] = $total_page;
		$page_nav['last_page'] = ($total_page == 0) ? 1 : $total_page;
		$page_nav['start'] = ( $current_page - 1 ) * $pagesize;
		
		if( $current_page < $total_page ){
			$page_nav['next'] = $current_page + 1;
		}
		if( $current_page > 1 ){
			$page_nav['previous'] = $current_page - 1;
		}
		$page_nav['current_page'] = $current_page;
		$page_nav['pagesize'] = $pagesize;

		return $page_nav;	
	}
	
	//解析URL中的 filter
	function parse_filter($filter)
	{
		if(empty($filter))
			return array();
		$filter = html_entity_decode($filter);
		$temp = explode('&', $filter);
		$result = array();
		foreach($temp as $val)
		{
			list($key, $value) = explode('=', $val);
			$result[$key] = $value;
		}
		return $result;
	}
	
	//把 filter 封装成URL
	function pack_fileter_url($page, $base_url, $filter)
	{
		if(empty($filter))
			return '';
		
		$filter['page'] = $page;
		
		$temp = array();
		foreach($filter as $key => $val)
		{
			if(empty($val) && ($val === FALSE))
				continue;
			
			$temp[] = $key.'='.$val;
		}
		
		$filter_string = implode('&', $temp);
		return site_url($base_url.'/'.$filter_string);
	}
	
	function check_valid_date($date)
	{
		return true;
	}
	
	function get_calendar_url($url, $staff_id = '')
	{
		return site_url($url.'/'.$staff_id);
	
	}
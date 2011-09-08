<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	/* 
		判断员工是否已经登录后台.
	 */
	function has_login() 
	{
		$CI =& get_instance();
		return ($CI->session->userdata('name'))? true : false;
	}
	
	/* 
		检查员工是否有权限查看该Controller.
	 */
	function check_role($allowed_group)
	{
		if(!is_array($allowed_group))
			$allowed_group = explode(',', $allowed_group);
		
		//去除多余的空格
		foreach($allowed_group as $value)
			$result[] = trim($value);
		
		$group_id = get_group_id();
		return (in_array($group_id, $allowed_group)) ? true : false;
	}
	
	function show_access_deny_page()
	{
		echo 'Access Deny for this User. Please contact admin donggua211@qq.com';
		exit;
	}
	
	/* 
		获取该员工的group id.
	 */
	function get_group_id()
	{
		$CI =& get_instance();
		return $CI->session->userdata('group_id');
	}
	/* 
		获取该员工的employee id.
	 */
	function get_employee_id()
	{
		$CI =& get_instance();
		return $CI->session->userdata('employee_id');
	}
	
	/* 
		跳转到登陆页
	*/
	function goto_login()
	{
		redirect("admin/admin/login");
		exit();
	}
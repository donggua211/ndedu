<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * 权限控制基类。 根据员工group id来做权限控制
 */
class Admin_Ac_Base
{
	function Admin_Ac_Base($params = array())
	{
		if(empty($params) || !isset($params['group_id']))
		{
			show_error_page('权限控制初始化失败，请重新登录!', 'admin');
			die();
		}
		
		$this->group_id = $params['group_id'];
	}
	
	function set_group_id($group_id)
	{
		if(empty($group_id))
			return false;
		
		$this->group_id = $group_id;
		return true;
	}
	
	function get_group_id($group_id)
	{
		return $this->group_id;
	}
	
	function _check_role($allowed_group)
	{
		if(!is_array($allowed_group))
			$allowed_group = explode(',', $allowed_group);
		
		//去除多余的空格
		foreach($allowed_group as $value)
			$result[] = trim($value);
		
		return (in_array($this->group_id, $allowed_group)) ? true : false;
	
	}
}
<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once('admin_ac_base.php');

/*
 * admin/student controller 权限控制类
 */
class Admin_Ac_Timetable extends Admin_Ac_Base 
{
	function Admin_Ac_Timetable($params)
	{
		parent::Admin_Ac_Base($params);
	}
	
	function add_timetable()
	{
		$allowed_group_id = array(GROUP_ADMIN, GROUP_SCHOOLADMIN, GROUP_TEACHER_D, GROUP_CS_D, GROUP_SUYANG_D, GROUP_CONSULTANT_D);
		
		return $this->_check_role($allowed_group_id);	
	
	}
}
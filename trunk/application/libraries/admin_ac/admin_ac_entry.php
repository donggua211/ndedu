<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once('admin_ac_base.php');

/*
 * admin/entry controller 权限控制类
 */
class Admin_Ac_Entry extends Admin_Ac_Base 
{
	function Admin_Ac_Entry($params)
	{
		parent::Admin_Ac_Base($params);
	}
	
	function show_less_10_warn()
	{
		$allowed_group_id = array(GROUP_CS);
		return ($this->_check_role($allowed_group_id)) ? TRUE : FALSE;
	}

	function munu_show_add_student()
	{
		$allowed_group_id = array(GROUP_ADMIN, GROUP_SCHOOLADMIN, GROUP_CONSULTANT, GROUP_CONSULTANT_D, GROUP_CS);
		return ($this->_check_role($allowed_group_id)) ? TRUE : FALSE;
	}

	function munu_show_staff_list()
	{
		$allowed_group_id = array(GROUP_ADMIN, GROUP_SCHOOLADMIN, GROUP_CS, GROUP_TEACHER_D, GROUP_CONSULTANT_D);
		return ($this->_check_role($allowed_group_id)) ? TRUE : FALSE;
	}
}
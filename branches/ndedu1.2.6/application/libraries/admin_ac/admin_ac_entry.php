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
		$allowed_group_id = array(GROUP_CS, GROUP_CS_D);
		return ($this->_check_role($allowed_group_id)) ? TRUE : FALSE;
	}

	function munu_show_add_student()
	{
		$allowed_group_id = array(GROUP_ADMIN, GROUP_SCHOOLADMIN, GROUP_CONSULTANT, GROUP_CONSULTANT_D, GROUP_CS,  GROUP_CS_D);
		return ($this->_check_role($allowed_group_id)) ? TRUE : FALSE;
	}

	function munu_show_staff_list()
	{
		$allowed_group_id = array(GROUP_ADMIN, GROUP_SCHOOLADMIN, GROUP_CS, GROUP_CS_D, GROUP_TEACHER_D, GROUP_SUYANG_D, GROUP_CONSULTANT_D, GROUP_JIAOWU, GROUP_JIAOWU_D);
		return ($this->_check_role($allowed_group_id)) ? TRUE : FALSE;
	}
	
	function munu_show_add_staff()
	{
		$allowed_group_id = array(GROUP_ADMIN, GROUP_SCHOOLADMIN, GROUP_TEACHER_D);
		return ($this->_check_role($allowed_group_id)) ? TRUE : FALSE;
	}
	
	function munu_show_trial_staff()
	{
		$allowed_group_id = array(GROUP_ADMIN, GROUP_SCHOOLADMIN, GROUP_TEACHER_D, GROUP_SUYANG_D, GROUP_CONSULTANT_D);
		return ($this->_check_role($allowed_group_id)) ? TRUE : FALSE;
	}
	
	function munu_show_my_timetable()
	{
		$allowed_group_id = array(GROUP_TEACHER_D, GROUP_SUYANG_D, GROUP_CONSULTANT_D, GROUP_CONSULTANT, GROUP_SUPERVISOR, GROUP_TEACHER_PARTTIME, GROUP_TEACHER_FULL, GROUP_SUYANG);
		return ($this->_check_role($allowed_group_id)) ? TRUE : FALSE;
	}
	
	function munu_show_ticket_list()
	{
		$not_allowed_group_id = array(GROUP_TEACHER_PARTTIME, GROUP_TEACHER_FULL);
		return (!$this->_check_role($not_allowed_group_id)) ? TRUE : FALSE;
	}
}
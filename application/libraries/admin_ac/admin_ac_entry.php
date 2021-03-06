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
		$this->staff_id = $params['staff_id'];
	}
	
	function show_less_10_warn()
	{
		$allowed_group_id = array(GROUP_CS, GROUP_CS_D);
		return ($this->_check_role($allowed_group_id)) ? TRUE : FALSE;
	}
	
	function timetable_unsuspend_warn()
	{
		$allowed_group_id = array(GROUP_JIAOWU, GROUP_JIAOWU_D);
		return ($this->_check_role($allowed_group_id)) ? TRUE : FALSE;
	}

	function munu_show_add_student()
	{
		$allowed_group_id = array(GROUP_ADMIN, GROUP_SCHOOLADMIN, GROUP_CONSULTANT, GROUP_CONSULTANT_D, GROUP_CS,  GROUP_CS_D);
		return ($this->_check_role($allowed_group_id)) ? TRUE : FALSE;
	}

	function munu_show_classroom_list()
	{
		$allowed_group_id = array(GROUP_ADMIN, GROUP_SCHOOLADMIN, GROUP_CS_D, GROUP_TEACHER_D, GROUP_SUYANG_D, GROUP_CONSULTANT_D, GROUP_JIAOWU, GROUP_JIAOWU_D);
		return ($this->_check_role($allowed_group_id)) ? TRUE : FALSE;
	}

	function munu_show_staff_list()
	{
		$allowed_group_id = array(GROUP_ADMIN, GROUP_SCHOOLADMIN, GROUP_CS_D, GROUP_TEACHER_D, GROUP_SUYANG_D, GROUP_CONSULTANT_D, GROUP_JIAOWU, GROUP_JIAOWU_D);
		return ($this->_check_role($allowed_group_id)) ? TRUE : FALSE;
	}
	
	function munu_show_add_staff()
	{
		$allowed_group_id = array(GROUP_ADMIN, GROUP_SCHOOLADMIN, GROUP_TEACHER_D);
		return ($this->_check_role($allowed_group_id)) ? TRUE : FALSE;
	}
	
	function munu_show_my_timetable()
	{
		$allowed_group_id = array(GROUP_TEACHER_D, GROUP_SUYANG_D, GROUP_CONSULTANT_D, GROUP_CONSULTANT, GROUP_SUPERVISOR, GROUP_TEACHER_PARTTIME,  GROUP_CONSULTANT_PARTTIME, GROUP_TEACHER_FULL, GROUP_SUYANG);
		return ($this->_check_role($allowed_group_id)) ? TRUE : FALSE;
	}
	
	function munu_show_all_timetable()
	{
		$allowed_group_id = array(GROUP_ADMIN, GROUP_SCHOOLADMIN, GROUP_JIAOWU_D);
		return ($this->_check_role($allowed_group_id)) ? TRUE : FALSE;
	}
	
	function munu_show_ticket_list()
	{
		$not_allowed_group_id = array(GROUP_CONSULTANT_PARTTIME, GROUP_TEACHER_PARTTIME, GROUP_TEACHER_FULL);
		return (!$this->_check_role($not_allowed_group_id)) ? TRUE : FALSE;
	}
	
	function munu_show_hr_add()
	{
		$allowed_group_id = array(GROUP_ADMIN, GROUP_SCHOOLADMIN);
		return ($this->_check_role($allowed_group_id) || $this->staff_id == 35) ? TRUE : FALSE;
	}
	
	function munu_show_hr_position()
	{
		$allowed_group_id = array(GROUP_ADMIN, GROUP_SCHOOLADMIN);
		return ($this->_check_role($allowed_group_id) || $this->staff_id == 35) ? TRUE : FALSE;
	}
	
	function contract_finished_add()
	{
		$allowed_group_id = array(GROUP_ADMIN, GROUP_SCHOOLADMIN, GROUP_JIAOWU, GROUP_JIAOWU_D);
		
		return $this->_check_role($allowed_group_id);
	}
	
	function menu_show_pms_index()
	{
		$allowed_group_id = array(GROUP_ADMIN, GROUP_SCHOOLADMIN, GROUP_JIAOWU, GROUP_JIAOWU_D);
		
		return $this->_check_role($allowed_group_id);
	}
	
	function munu_show_article()
	{
		$allowed_group_id = array(GROUP_ADMIN, GROUP_SCHOOLADMIN);
		return ($this->_check_role($allowed_group_id) || $this->staff_id == 35) ? TRUE : FALSE;
	}
}
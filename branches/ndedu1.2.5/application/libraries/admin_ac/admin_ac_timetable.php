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
		$allowed_group_id = array(GROUP_ADMIN, GROUP_SCHOOLADMIN, GROUP_TEACHER_D, GROUP_SUYANG_D, GROUP_CONSULTANT_D);
		
		return $this->_check_role($allowed_group_id);	
	
	}
	
	function edit_timetable()
	{
		$allowed_group_id = array(GROUP_ADMIN, GROUP_SCHOOLADMIN, GROUP_TEACHER_D, GROUP_SUYANG_D, GROUP_CONSULTANT_D);
		
		return $this->_check_role($allowed_group_id);	
	
	}
	
	function view_student_timetable_opt($subject_id)
	{
		$allowed_group_id = array(GROUP_ADMIN, GROUP_SCHOOLADMIN);
		
		$subject_id = substr($subject_id, 0 , 1);
		
		switch ($subject_id)
		{
			case SUBJECT_XUEKE:
				$allowed_group_id[] = GROUP_TEACHER_D;
				break;
			case SUBJECT_SUYANG:
				$allowed_group_id[] = GROUP_SUYANG_D;
				break;
			case SUBJECT_ZIXUN:
				$allowed_group_id[] = GROUP_CONSULTANT_D;
				break;
		}
		
		return $this->_check_role($allowed_group_id);	
	}
	
	function show_mobile_sms_button()
	{
		$allowed_group_id = array(GROUP_ADMIN, GROUP_SCHOOLADMIN, GROUP_TEACHER_D);
		return $this->_check_role($allowed_group_id);	
	}
	
	function show_schedule_opts()
	{
		$allowed_group_id = array(GROUP_ADMIN, GROUP_SCHOOLADMIN, GROUP_TEACHER_D);
		return $this->_check_role($allowed_group_id);	
	}
}
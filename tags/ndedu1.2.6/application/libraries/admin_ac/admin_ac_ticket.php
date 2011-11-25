<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once('admin_ac_base.php');

/*
 * admin/entry controller 权限控制类
 */
class Admin_Ac_Ticket extends Admin_Ac_Base 
{
	function Admin_Ac_Ticket($params)
	{
		parent::Admin_Ac_Base($params);
	}
	
	function view_ticket()
	{
		$not_allowed_group_id = array(GROUP_TEACHER_PARTTIME, GROUP_TEACHER_FULL);
		return (!$this->_check_role($not_allowed_group_id)) ? TRUE : FALSE;
	}
}
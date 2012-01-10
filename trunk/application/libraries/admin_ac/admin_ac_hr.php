<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once('admin_ac_base.php');

/*
 * admin/entry controller 权限控制类
 */
class Admin_Ac_hr extends Admin_Ac_Base 
{
	function Admin_Ac_hr($params)
	{
		parent::Admin_Ac_Base($params);
		$this->staff_id = $params['staff_id'];
	}
	
	function hr_index_ac($filter)
	{
		if($this->staff_id == 35)
			return $filter;
		
		$CI = & get_instance();
		switch($this->group_id)
		{
			case GROUP_ADMIN: //admin管理有权限
			case GROUP_SCHOOLADMIN: //shooladmin只有查看本校区员工的权限
				break;
			case GROUP_CS_D:
				$filter['position_id'] = $CI->Hr_position_model->get_all_by_group(GROUP_CS_D);
				break;
			case GROUP_TEACHER_D:
				$filter['position_id'] = $CI->Hr_position_model->get_all_by_group(GROUP_TEACHER_D);
				break;
			case GROUP_CONSULTANT_D:
				$filter['position_id'] = $CI->Hr_position_model->get_all_by_group(GROUP_CONSULTANT_D);
				break;
			case GROUP_SUYANG_D:
				$filter['position_id'] = $CI->Hr_position_model->get_all_by_group(GROUP_SUYANG_D);
				break;
			case GROUP_JIAOWU_D:
				$filter['position_id'] = $CI->Hr_position_model->get_all_by_group(GROUP_JIAOWU_D);
				break;
			default:
				show_error_page('您没有权限查看员工列表: 请重新登录或者联系管理员!', 'admin');
				return false;
		}
		
		return $filter;
	}
	
	
	function hr_interviwe_time_ac()
	{
		$allowed_group_id = array(GROUP_ADMIN, GROUP_SCHOOLADMIN);
		return ($this->_check_role($allowed_group_id) || $this->staff_id == 35) ? TRUE : FALSE;
	}
}
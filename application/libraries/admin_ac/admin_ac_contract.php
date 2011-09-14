<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once('admin_ac_base.php');

/*
 * admin/contract controller 权限控制类
 */
class Admin_Ac_Contract extends Admin_Ac_Base 
{
	function Admin_Ac_Contract($params)
	{
		parent::Admin_Ac_Base($params);
	}
	
	/*
	 * 返回值：true：验证成功
	 *         -1: 不在一个校区
	 *         -2: 不是您的学员
	 *         -3: 不能查看该状态的学员
	 *         -4: group_id 不正确
	 *         -5: 您所查询的学员不存在
	*/
	function contract_one_ac($student_info, $staff_info)
	{
		switch($this->staff_info['group_id'])
		{
			case GROUP_ADMIN: //admin管理有权限
				break;
			case GROUP_CONSULTANT_D:
			case GROUP_TEACHER_D:
			case GROUP_SCHOOLADMIN: //shooladmin只有查看本校区学员的权限
				if($student_info['branch_id'] != $staff_info['branch_id'])
				{
					show_error_page('您没有权限查看该学员的合同: 他/她不在您所在的校区!', 'admin/student');
					return -1;
				}
				break;
			case GROUP_CS:
				if($student_info['cservice_id'] != $staff_info['staff_id'])
				{
					show_error_page('您没有权限查看该学员的合同: 他/她不是您所创建的!', 'admin/student');
					return -2;
				}
				break;
			default:
				show_error_page('您没有权限查看该合同: 请重新登录或者联系管理员!', 'admin/student');
				return -4;
		}
	}
	
}
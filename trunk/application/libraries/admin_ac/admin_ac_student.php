<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once('admin_ac_base.php');

/*
 * admin/student controller 权限控制类
 */
class Admin_Ac_Student extends Admin_Ac_Base 
{
	function Admin_Ac_Student($params)
	{
		parent::Admin_Ac_Base($params);
		
		$this->group_student_status = array(
			GROUP_ADMIN => '',			//管理员
			GROUP_SCHOOLADMIN => '',		//校区管理员
			GROUP_CS => array(STUDENT_STATUS_NOT_APPOINTMENT, STUDENT_STATUS_HAS_APPOINTMENT, STUDENT_STATUS_SIGNUP, STUDENT_STATUS_LEARNING, STUDENT_STATUS_FINISHED),			//客服老师
			GROUP_CONSULTANT => array(STUDENT_STATUS_HAS_APPOINTMENT, STUDENT_STATUS_LEARNING),	//咨询师
			GROUP_SUPERVISOR => array(),		//班主任
			GROUP_TEACHER_PARTTIME => array(STUDENT_STATUS_LEARNING),	//学科老师（兼职）
			GROUP_TEACHER_FULL => array(STUDENT_STATUS_LEARNING),		//学科老师（全职）
			GROUP_SUYANG => array(STUDENT_STATUS_LEARNING),		//素养课老师
		);
	}
	
	//权限控制： student/index 员工所能看到的学员.
	function index_ac($staff_info)
	{
		$filter = array();
		switch($this->group_id)
		{
			case GROUP_ADMIN: //admin管理有权限
				break;
			case GROUP_SCHOOLADMIN: //shooladmin只有查看本校区学员的权限
				$filter['branch_id'] = $staff_info['branch_id'];
				break;
			case GROUP_CONSULTANT: //shooladmin只有查看本校区的, 自己添加的, 状态为未报名的学员的权限
				$filter['branch_id'] = $staff_info['branch_id'];
				$filter['consultant_id'] = $staff_info['staff_id'];
				$filter['status'] = $this->group_student_status[$this->group_id];
				break;
			case GROUP_SUPERVISOR: //shooladmin只有查看本校区的, 自己分配的, 状态为正在学的学员的权限
				$filter['branch_id'] = $staff_info['branch_id'];
				$filter['supervisor_id'] = $staff_info['staff_id'];
				$filter['status'] = $this->group_student_status[$this->group_id];
				break;
			case GROUP_CS: //shooladmin只有查看本校区的, 自己分配的, 状态为正在学的学员的权限
				$filter['branch_id'] = $staff_info['branch_id'];
				$filter['cservice_id'] = $staff_info['staff_id'];
				$filter['status'] = $this->group_student_status[$this->group_id];
				break;
			default:
				show_error_page('您没有权限查看学员列表: 请重新登录或者联系管理员!', 'admin/student');
				return false;
		}
		
		return $filter;
	}
	
	/*
	 * 返回值：true：验证成功
	 *         -1: 不在一个校区
	 *         -2: 不是您的学员
	 *         -3: 不能查看该状态的学员
	 *         -4: group_id 不正确
	 *         -5: 您所查询的学员不存在
	*/
	function one_ac($student_info, $staff_info)
	{
		if(empty($student_info))
		{
			show_error_page('您所查询的学员不存在!', 'admin/student');
			return -5;
		}
		
		//管理员：无所不能
		if($this->group_id == GROUP_ADMIN)
			return true;
		
		//检查学员状态
		if(!in_array($student_info['status'], $this->group_student_status[$this->group_id]))
		{
			show_error_page('您没有权限该状态的学员!', 'admin/student');
			return -3;
		}
		
		switch($this->group_id)
		{
			case GROUP_SCHOOLADMIN: //shooladmin只有查看本校区学员的权限
				if($student_info['branch_id'] != $staff_info['branch_id'])
				{
					show_error_page('您没有权限查看该学员: 他/她不在您所在的校区!', 'admin/student');
					return -1;
				}
				break;
			case GROUP_CONSULTANT:
				if($student_info['consultant_id'] != $staff_info['staff_id'])
				{
					show_error_page('您没有权限查看该学员: 他/她不是您所创建的!', 'admin/student');
					return -2;
				}
				break;
			case GROUP_SUPERVISOR:
				if($student_info['supervisor_id'] != $staff_info['staff_id'])
				{
					show_error_page('您没有权限查看该学员: 他/她不是您所创建的!', 'admin/student');
					return -2;
				}
				break;
			case GROUP_CS:
				if($student_info['cservice_id'] != $staff_info['staff_id'])
				{
					show_error_page('您没有权限查看该学员: 他/她不是您所创建的!', 'admin/student');
					return -2;
				}
				break;
			default:
				show_error_page('您没有权限查看该学员: 他/请重新登录或者联系管理员!', 'admin/student');
				return -4;
		}
		
		return true;
	
	}

	function contract_add_ac()
	{
		$allowed_group_id = array(GROUP_ADMIN, GROUP_SCHOOLADMIN, GROUP_CS);
		
		if(!$this->_check_role($allowed_group_id))
		{
			show_access_deny_page();
		}
	}

	function add_ac()
	{
		$allowed_group_id = array(GROUP_ADMIN, GROUP_SCHOOLADMIN, GROUP_CS);
		
		if(!$this->_check_role($allowed_group_id))
		{
			show_access_deny_page();
		}
	}
	
	function delete_ac()
	{
		$allowed_group_id = array(GROUP_ADMIN, GROUP_SCHOOLADMIN);
		
		if(!$this->_check_role($allowed_group_id))
		{
			show_access_deny_page();
		}
	}
	
	function extra_not_signup_student_phone_ac()
	{
		$allowed_group_id = array(GROUP_ADMIN, GROUP_SCHOOLADMIN);
		
		if(!$this->_check_role($allowed_group_id))
		{
			show_access_deny_page();
		}
	}

	/*
	 * 判断历史的access control。 
	 * 不可读写： 0
	 * 可读，不可写： 1
	 * 可读写： 2
	 */
	function history_ac($status, $type)
	{
		$access_group_status = array(
			'contact' => array(
				STUDENT_STATUS_NOT_APPOINTMENT => array( GROUP_CS => 2 ),		//未约访
				STUDENT_STATUS_HAS_APPOINTMENT => array( GROUP_CS => 2, GROUP_CONSULTANT => 2 ),		//已约访
				STUDENT_STATUS_SIGNUP => array( GROUP_CS => 2 ),		//已报名
				STUDENT_STATUS_LEARNING => array( GROUP_CS => 2 ),		//正在学
				STUDENT_STATUS_FINISHED => array( GROUP_CS => 2 ),		//已学完
			),
			
			'learning' => array(
				STUDENT_STATUS_LEARNING => array( GROUP_CS => 2 ),		//正在学
				STUDENT_STATUS_FINISHED => array( GROUP_CS => 2 ),		//已学完
			),
			
		);
	}



}
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
			GROUP_ADMIN => array(STUDENT_STATUS_NOT_APPOINTMENT, STUDENT_STATUS_HAS_APPOINTMENT, STUDENT_STATUS_SIGNUP, STUDENT_STATUS_LEARNING, STUDENT_STATUS_FINISHED, STUDENT_STATUS_INACTIVE),			//管理员
			GROUP_SCHOOLADMIN => array(STUDENT_STATUS_NOT_APPOINTMENT, STUDENT_STATUS_HAS_APPOINTMENT, STUDENT_STATUS_SIGNUP, STUDENT_STATUS_LEARNING, STUDENT_STATUS_FINISHED, STUDENT_STATUS_INACTIVE),		//校区管理员
			GROUP_CS => array(STUDENT_STATUS_NOT_APPOINTMENT, STUDENT_STATUS_HAS_APPOINTMENT, STUDENT_STATUS_SIGNUP, STUDENT_STATUS_LEARNING, STUDENT_STATUS_FINISHED),			//客服老师
			GROUP_CS_D => array(STUDENT_STATUS_NOT_APPOINTMENT, STUDENT_STATUS_HAS_APPOINTMENT, STUDENT_STATUS_SIGNUP, STUDENT_STATUS_LEARNING, STUDENT_STATUS_FINISHED),			//客服老师
			GROUP_CONSULTANT => array(STUDENT_STATUS_NOT_APPOINTMENT, STUDENT_STATUS_HAS_APPOINTMENT, STUDENT_STATUS_LEARNING),	//咨询师
			GROUP_CONSULTANT_D => array(STUDENT_STATUS_NOT_APPOINTMENT, STUDENT_STATUS_HAS_APPOINTMENT, STUDENT_STATUS_LEARNING),	//咨询主管
			GROUP_SUPERVISOR => array(),		//班主任
			GROUP_TEACHER_PARTTIME => array(STUDENT_STATUS_LEARNING),	//学科老师（兼职）
			GROUP_TEACHER_FULL => array(STUDENT_STATUS_LEARNING),		//学科老师（全职）
			GROUP_SUYANG => array(STUDENT_STATUS_LEARNING),		//素养课老师
			GROUP_TEACHER_D => array(STUDENT_STATUS_LEARNING),	//学科主管
			GROUP_SUYANG_D => array(STUDENT_STATUS_LEARNING),	//素养课主管
		);
				
		/*
		 * 不可读写： 0
		 * 可读，不可写： HISTORY_R
		 * 可读写： HISTORY_WR
		 */
		$this->history_group_status = array(
			//联系历史
			'contact' => array(
				STUDENT_STATUS_NOT_APPOINTMENT => array( GROUP_CS => HISTORY_WR, GROUP_CS_D => HISTORY_WR, GROUP_CONSULTANT => HISTORY_WR, GROUP_CONSULTANT_D => HISTORY_WR ),		//未约访
				STUDENT_STATUS_HAS_APPOINTMENT => array( GROUP_CS => HISTORY_WR, GROUP_CS_D => HISTORY_WR, GROUP_CONSULTANT => HISTORY_WR, GROUP_CONSULTANT_D => HISTORY_WR ),		//已约访
				STUDENT_STATUS_SIGNUP => array( GROUP_CS => HISTORY_WR, GROUP_CS_D => HISTORY_WR ),		//已报名
				STUDENT_STATUS_LEARNING => array( GROUP_CS => HISTORY_WR, GROUP_CS_D => HISTORY_WR ),		//正在学
				STUDENT_STATUS_FINISHED => array( GROUP_CS => HISTORY_WR, GROUP_CS_D => HISTORY_WR ),		//已学完
			),
			//学习历史
			'learning' => array(
				STUDENT_STATUS_LEARNING => array(
					GROUP_TEACHER_D => HISTORY_WR,
					GROUP_CS => HISTORY_R,
					GROUP_CS_D => HISTORY_R,
					GROUP_CONSULTANT => HISTORY_R,
					GROUP_SUYANG => HISTORY_R,
					GROUP_CONSULTANT_D => HISTORY_R,
					GROUP_SUYANG_D => HISTORY_R,
					GROUP_TEACHER_PARTTIME => HISTORY_WR,
					GROUP_TEACHER_FULL => HISTORY_WR,
				),		//正在学
				STUDENT_STATUS_FINISHED => array( GROUP_CS => HISTORY_R, GROUP_CS_D => HISTORY_R ),		//已学完
			),
			//咨询历史
			'consult' => array(
				STUDENT_STATUS_LEARNING => array(
					GROUP_CONSULTANT => HISTORY_WR,
					GROUP_CONSULTANT_D => HISTORY_WR,
					GROUP_TEACHER_D => HISTORY_R,
					GROUP_CS => HISTORY_R,
					GROUP_CS_D => HISTORY_R,
					GROUP_SUYANG => HISTORY_R,
					GROUP_SUYANG_D => HISTORY_R,
				),		//正在学
				STUDENT_STATUS_FINISHED => array( GROUP_CS => HISTORY_R, GROUP_CS_D => HISTORY_R ),		//已学完
			),
			//素养历史
			'suyang' => array(
				STUDENT_STATUS_LEARNING => array(
					GROUP_SUYANG => HISTORY_WR,
					GROUP_SUYANG_D => HISTORY_WR,
					GROUP_CS => HISTORY_R,
					GROUP_CS_D => HISTORY_R,
					GROUP_CONSULTANT => HISTORY_R,
					GROUP_CONSULTANT_D => HISTORY_R,
					GROUP_TEACHER_D => HISTORY_R,
				),		//正在学
				STUDENT_STATUS_FINISHED => array( GROUP_CS => HISTORY_R, GROUP_CS_D => HISTORY_R ),		//已学完
			),
			//回访历史
			'callback' => array(
				STUDENT_STATUS_LEARNING => array( GROUP_CS => HISTORY_WR, GROUP_CS_D => HISTORY_WR ),		//正在学
				STUDENT_STATUS_FINISHED => array( GROUP_CS => HISTORY_WR, GROUP_CS_D => HISTORY_WR ),		//已学完
			),
			
		);
	}
	
	//权限控制： student/index 员工所能看到的学员.
	function index_ac($staff_info, $filter)
	{
		//主管理员权限
		if($this->group_id == GROUP_ADMIN)
			return $filter;
		
		//校区管理员的权限
		if($this->group_id == GROUP_SCHOOLADMIN)
		{
			$filter['branch_id'] = $staff_info['branch_id'];
			return $filter;
		}
		
		//其他角色权限：
		switch($this->group_id)
		{
			case GROUP_CONSULTANT: //shooladmin只有查看本校区的, 自己添加的, 状态为未报名的学员的权限
				$filter['consultant_id'] = $staff_info['staff_id'];
				break;
			case GROUP_SUPERVISOR: //shooladmin只有查看本校区的, 自己分配的, 状态为正在学的学员的权限
				$filter['supervisor_id'] = $staff_info['staff_id'];
				break;
			case GROUP_CS: //shooladmin只有查看本校区的, 自己分配的, 状态为正在学的学员的权限
				$filter['cservice_id'] = $staff_info['staff_id'];
				break;
			case GROUP_SUYANG: //shooladmin只有查看本校区的, 自己分配的, 状态为正在学的学员的权限
				$filter['suyang_id'] = $staff_info['staff_id'];
				break;
			case GROUP_CONSULTANT_D:
			case GROUP_TEACHER_D:
			case GROUP_SUYANG_D:
			case GROUP_CS_D:
				break;
			case GROUP_TEACHER_FULL:
			case GROUP_TEACHER_PARTTIME:
				$CI =& get_instance();
				$timetable = $CI->CRM_Timetable_model->get_staff_timetable($staff_info['staff_id']);
				
				$student_id = array();
				foreach($timetable as $day)
					foreach($day as $val)
						$student_id[] = $val['student_id'];
				
				$filter['student_id'] = $student_id;
				break;
			default:
				show_error_page('您没有权限查看学员列表: 请重新登录或者联系管理员!', 'admin/student');
				return false;
		}
		
		$filter['branch_id'] = $staff_info['branch_id'];
		if(empty($filter['status']))
			$filter['status'] = $this->group_student_status[$this->group_id];
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
			case GROUP_CONSULTANT_D:
			case GROUP_TEACHER_D:
			case GROUP_SUYANG_D:
			case GROUP_CS_D:
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
			case GROUP_SUYANG:
				if($student_info['suyang_id'] != $staff_info['staff_id'])
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
			case GROUP_TEACHER_FULL:
			case GROUP_TEACHER_PARTTIME:
				$CI =& get_instance();
				$timetable = $CI->CRM_Timetable_model->get_staff_timetable($staff_info['staff_id']);
				
				$student_id = array();
				foreach($timetable as $day)
					foreach($day as $val)
						$student_id[] = $val['student_id'];
				
				if(!in_array($student_info['student_id'], $student_id))
				{
					show_error_page('您没有权限查看该学员: 他/她不是您的学生!', 'admin/student');
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
		$allowed_group_id = array(GROUP_ADMIN, GROUP_SCHOOLADMIN, GROUP_CS, GROUP_CS_D);
		
		if(!$this->_check_role($allowed_group_id))
		{
			show_access_deny_page();
		}
	}

	function add_ac()
	{
		$allowed_group_id = array(GROUP_ADMIN, GROUP_SCHOOLADMIN, GROUP_CS, GROUP_CS_D, GROUP_CONSULTANT, GROUP_CONSULTANT_D);
		
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
	
	function add_finished_hour_ac()
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
	 * 可读，不可写： HISTORY_R
	 * 可读写： HISTORY_WR
	 */
	function history_ac($type, $status, $return = '')
	{
		//管理员，校区管理员：无所不能
		if($this->group_id == GROUP_ADMIN || $this->group_id == GROUP_SCHOOLADMIN)
			return HISTORY_WR;
		
		if(isset($this->history_group_status[$type][$status][$this->group_id]) && !empty($this->history_group_status[$type][$status][$this->group_id]))
		{
			//show_error_page('您没有权限查看该学员的历史记录！', 'admin/student');
			return $this->history_group_status[$type][$status][$this->group_id];
		}
		else
		{
			return HISTORY_DENY;
		}
	}

	/*
	 * viewer 权限分布
	 */
	function get_group_status()
	{
		return $this->group_student_status[$this->group_id];
	}
	
	function view_student_all_operation()
	{
		$allowed_group_id = array(GROUP_ADMIN, GROUP_SCHOOLADMIN);
		
		return $this->_check_role($allowed_group_id);
	}
	
	function view_student_edit_status()
	{
		$allowed_group_id = array(GROUP_ADMIN, GROUP_SCHOOLADMIN, GROUP_CS, GROUP_CS_D);
		
		if($this->_check_role($allowed_group_id))
			return array(STUDENT_STATUS_NOT_APPOINTMENT, STUDENT_STATUS_HAS_APPOINTMENT, STUDENT_STATUS_SIGNUP, STUDENT_STATUS_LEARNING, STUDENT_STATUS_FINISHED, STUDENT_STATUS_INACTIVE);
		else
			return false;
	}
	
	function view_student_edit_suyang($student_status)
	{
		if($this->group_id == GROUP_ADMIN || $this->group_id == GROUP_SCHOOLADMIN)
				return true;
		
		if(in_array($this->group_id, array(GROUP_CS, GROUP_CS_D)) && in_array($student_status, array(STUDENT_STATUS_SIGNUP, STUDENT_STATUS_LEARNING)))
			return true;
		
		if($this->group_id == GROUP_SUYANG_D && in_array($student_status, array(STUDENT_STATUS_LEARNING)))
			return true;
		
		return false;
	}
	
	function view_student_edit_consultant($student_status)
	{
		if($this->group_id == GROUP_ADMIN || $this->group_id == GROUP_SCHOOLADMIN)
				return true;
		
		if(in_array($this->group_id, array(GROUP_CS, GROUP_CS_D)) && $student_status == STUDENT_STATUS_NOT_APPOINTMENT)
			return true;
		
		if($this->group_id == GROUP_CONSULTANT_D && in_array($student_status, array(STUDENT_STATUS_HAS_APPOINTMENT, STUDENT_STATUS_LEARNING)))
			return true;
	
		return false;
	}
	
	function view_student_edit_supervisor()
	{
		$allowed_group_id = array(GROUP_ADMIN, GROUP_SCHOOLADMIN);
		
		return $this->_check_role($allowed_group_id);	
	}
	
	function view_student_one_contract()
	{
		$allowed_group_id = array(GROUP_ADMIN, GROUP_SCHOOLADMIN, GROUP_CS, GROUP_CS_D);
		
		return $this->_check_role($allowed_group_id);	
	}
	
	function view_student_one_sms()
	{
		$allowed_group_id = array(GROUP_ADMIN, GROUP_SCHOOLADMIN, GROUP_CS, GROUP_CS_D, GROUP_CONSULTANT, GROUP_CONSULTANT_D, GROUP_TEACHER_D);
		
		return $this->_check_role($allowed_group_id);	
	}
	
	
	function view_student_one_see_all_sms()
	{
		$allowed_group_id = array(GROUP_ADMIN, GROUP_SCHOOLADMIN, GROUP_CS_D, GROUP_CONSULTANT_D, GROUP_TEACHER_D);
		
		return $this->_check_role($allowed_group_id);	
	}
	
	function view_student_one_status_history()
	{
		$allowed_group_id = array(GROUP_ADMIN, GROUP_SCHOOLADMIN);
		
		return $this->_check_role($allowed_group_id);	
	}
	
	function view_student_one_contract_operation()
	{
		$allowed_group_id = array(GROUP_ADMIN, GROUP_SCHOOLADMIN);
		
		return $this->_check_role($allowed_group_id);	
	}
	
	function view_student_all_finished_hour_dob()
	{
		if(in_array($this->group_id, array(GROUP_CS, GROUP_CS_D)))
			return true;
	}
	
	function view_student_all_teaches()
	{
		$allowed_group_id = array(GROUP_ADMIN, GROUP_SCHOOLADMIN, GROUP_CS_D, GROUP_SUYANG_D, GROUP_CONSULTANT_D);
		
		return $this->_check_role($allowed_group_id);	
	}
	
	function view_student_all_contact_history($student_status)
	{
		if(in_array($this->group_id, array(GROUP_CONSULTANT_D, GROUP_CONSULTANT, GROUP_CS_D, GROUP_CS)) 
			&& in_array($student_status, array(STUDENT_STATUS_NOT_APPOINTMENT, STUDENT_STATUS_HAS_APPOINTMENT, STUDENT_STATUS_SIGNUP)))
			return true;
		
		return false;
	}
	
	function add_timetable()
	{
		$allowed_group_id = array(GROUP_ADMIN, GROUP_SCHOOLADMIN, GROUP_TEACHER_D, GROUP_CS_D, GROUP_SUYANG_D, GROUP_CONSULTANT_D);
		
		return $this->_check_role($allowed_group_id);	
	
	}
}
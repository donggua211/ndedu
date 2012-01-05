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
			//管理员
			GROUP_ADMIN => array(STUDENT_STATUS_NOT_APPOINTMENT, STUDENT_STATUS_HAS_APPOINTMENT, STUDENT_STATUS_SIGNUP, STUDENT_STATUS_LEARNING, STUDENT_STATUS_FINISHED, STUDENT_STATUS_INACTIVE),	
			//校区管理员
			GROUP_SCHOOLADMIN => array(STUDENT_STATUS_NOT_APPOINTMENT, STUDENT_STATUS_HAS_APPOINTMENT, STUDENT_STATUS_SIGNUP, STUDENT_STATUS_LEARNING, STUDENT_STATUS_FINISHED, STUDENT_STATUS_INACTIVE),
			//客服老师
			GROUP_CS => array(STUDENT_STATUS_NOT_APPOINTMENT, STUDENT_STATUS_HAS_APPOINTMENT, STUDENT_STATUS_SIGNUP, STUDENT_STATUS_FINISHED),
			//客服主管
			GROUP_CS_D => array(STUDENT_STATUS_NOT_APPOINTMENT, STUDENT_STATUS_HAS_APPOINTMENT, STUDENT_STATUS_SIGNUP, STUDENT_STATUS_FINISHED),
			//咨询师
			GROUP_CONSULTANT => array(STUDENT_STATUS_NOT_APPOINTMENT, STUDENT_STATUS_HAS_APPOINTMENT, STUDENT_STATUS_LEARNING),	
			//咨询主管
			GROUP_CONSULTANT_D => array(STUDENT_STATUS_NOT_APPOINTMENT, STUDENT_STATUS_HAS_APPOINTMENT, STUDENT_STATUS_SIGNUP, STUDENT_STATUS_LEARNING),
			//素养课老师
			GROUP_SUYANG => array(STUDENT_STATUS_LEARNING),
			//素养课主管
			GROUP_SUYANG_D => array(STUDENT_STATUS_SIGNUP, STUDENT_STATUS_LEARNING),
			//教务老师
			GROUP_JIAOWU => array(STUDENT_STATUS_SIGNUP, STUDENT_STATUS_LEARNING, STUDENT_STATUS_FINISHED),
			//教务主管
			GROUP_JIAOWU_D => array(STUDENT_STATUS_SIGNUP, STUDENT_STATUS_LEARNING, STUDENT_STATUS_FINISHED),
			//学科主管			
			GROUP_TEACHER_D => array(STUDENT_STATUS_SIGNUP, STUDENT_STATUS_LEARNING),
			//学科老师（兼职）
			GROUP_TEACHER_PARTTIME => array(STUDENT_STATUS_LEARNING),
			//学科老师（全职）
			GROUP_TEACHER_FULL => array(STUDENT_STATUS_LEARNING),
			//班主任
			GROUP_SUPERVISOR => array(),
		);
				
		/*
		 * 不可读写： 0
		 * 可读, 不可写： HISTORY_R
		 * 可读写： HISTORY_WR
		 */
		$this->history_group_status = array(
			//联系历史
			'contact' => array(
				'status' => array(
					STUDENT_STATUS_NOT_APPOINTMENT,
					STUDENT_STATUS_HAS_APPOINTMENT,
					STUDENT_STATUS_SIGNUP,
					STUDENT_STATUS_LEARNING,
					STUDENT_STATUS_FINISHED,
					STUDENT_STATUS_INACTIVE,
				),
				'group' => array(
					GROUP_CONSULTANT => HISTORY_WR,
					GROUP_CONSULTANT_D => HISTORY_WR,
					GROUP_SUYANG => HISTORY_WR,
					GROUP_SUYANG_D => HISTORY_WR,
					GROUP_TEACHER_D => HISTORY_WR,
					GROUP_CS => HISTORY_WR,
					GROUP_CS_D => HISTORY_WR,
					GROUP_JIAOWU => HISTORY_WR,
					GROUP_JIAOWU_D => HISTORY_WR,
				),
			),
			
			//学习历史
			'learning' => array(
				'status' => array(
					STUDENT_STATUS_LEARNING,
					STUDENT_STATUS_FINISHED,
				),
				'group' => array(
					GROUP_TEACHER_PARTTIME => HISTORY_WR,
					GROUP_TEACHER_FULL => HISTORY_WR,
					GROUP_TEACHER_D => HISTORY_WR,
					GROUP_CONSULTANT => HISTORY_R,
					GROUP_CONSULTANT_D => HISTORY_R,
					GROUP_SUYANG => HISTORY_R,
					GROUP_SUYANG_D => HISTORY_R,
				),
			),
			
			//咨询历史
			'consult' => array(
				'status' => array(
					STUDENT_STATUS_LEARNING,
					STUDENT_STATUS_FINISHED,
				),
				'group' => array(
					GROUP_CONSULTANT => HISTORY_WR,
					GROUP_CONSULTANT_D => HISTORY_WR,
					GROUP_TEACHER_PARTTIME => HISTORY_R,
					GROUP_TEACHER_FULL => HISTORY_R,
					GROUP_TEACHER_D => HISTORY_R,
					GROUP_SUYANG => HISTORY_R,
					GROUP_SUYANG_D => HISTORY_R,
				),
			),
			
			//素养历史
			'suyang' => array(
				'status' => array(
					STUDENT_STATUS_LEARNING,
					STUDENT_STATUS_FINISHED,
				),
				'group' => array(
					GROUP_SUYANG => HISTORY_WR,
					GROUP_SUYANG_D => HISTORY_WR,
					GROUP_CONSULTANT => HISTORY_WR,
					GROUP_CONSULTANT_D => HISTORY_WR,
					GROUP_TEACHER_PARTTIME => HISTORY_R,
					GROUP_TEACHER_FULL => HISTORY_R,
					GROUP_TEACHER_D => HISTORY_R,
				),
			),
			//回访历史
			'callback' => array(
				'status' => array(
					STUDENT_STATUS_LEARNING,
					STUDENT_STATUS_FINISHED,
				),
				'group' => array(
					GROUP_SUYANG => HISTORY_R,
					GROUP_SUYANG_D => HISTORY_R,
					GROUP_CONSULTANT => HISTORY_R,
					GROUP_CONSULTANT_D => HISTORY_R,
					GROUP_TEACHER_PARTTIME => HISTORY_R,
					GROUP_TEACHER_FULL => HISTORY_R,
					GROUP_TEACHER_D => HISTORY_R,
					GROUP_JIAOWU => HISTORY_WR,
					GROUP_JIAOWU_D => HISTORY_WR,
					GROUP_CS => HISTORY_R,
					GROUP_CS_D => HISTORY_R,
				),
			),
			
		);
		
		$this->history_callback_group = array(
			//联系历史
			'learning' => array(
				GROUP_TEACHER_PARTTIME => HISTORY_R,
				GROUP_TEACHER_FULL => HISTORY_R,
				GROUP_TEACHER_D => HISTORY_R,
				GROUP_JIAOWU => HISTORY_WR,
				GROUP_JIAOWU_D => HISTORY_WR,
				GROUP_CS => HISTORY_R,
				GROUP_CS_D => HISTORY_R,
				
			),
			'suyang' => array(
				GROUP_SUYANG => HISTORY_R,
				GROUP_SUYANG_D => HISTORY_R,
				GROUP_JIAOWU => HISTORY_WR,
				GROUP_JIAOWU_D => HISTORY_WR,
				GROUP_CS => HISTORY_R,
				GROUP_CS_D => HISTORY_R,
			),
			'consult' => array(
				GROUP_CONSULTANT => HISTORY_R,
				GROUP_CONSULTANT_D => HISTORY_R,
				GROUP_JIAOWU => HISTORY_WR,
				GROUP_JIAOWU_D => HISTORY_WR,
				GROUP_CS => HISTORY_R,
				GROUP_CS_D => HISTORY_R,
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
			case GROUP_JIAOWU: //shooladmin只有查看本校区的, 自己分配的, 状态为正在学的学员的权限
				$filter['jiaowu_id'] = $staff_info['staff_id'];
				break;
			case GROUP_CONSULTANT_D:
			case GROUP_TEACHER_D:
			case GROUP_SUYANG_D:
			case GROUP_CS_D:
			case GROUP_JIAOWU_D:
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
			case GROUP_JIAOWU_D:
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
			case GROUP_JIAOWU:
				if($student_info['jiaowu_id'] != $staff_info['staff_id'])
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

	//student contract 添加合同
	function contract_add_ac()
	{
		$allowed_group_id = array(GROUP_ADMIN, GROUP_SCHOOLADMIN, GROUP_CS, GROUP_CS_D);
		
		if(!$this->_check_role($allowed_group_id))
		{
			show_access_deny_page();
		}
	}

	//student add, 添加学员。
	function add_ac()
	{
		$allowed_group_id = array(GROUP_ADMIN, GROUP_SCHOOLADMIN, GROUP_CS, GROUP_CS_D, GROUP_CONSULTANT, GROUP_CONSULTANT_D);
		
		if(!$this->_check_role($allowed_group_id))
		{
			show_access_deny_page();
		}
	}
	
	//student delete 删除学员
	function delete_ac()
	{
		$allowed_group_id = array(GROUP_ADMIN, GROUP_SCHOOLADMIN);
		
		if(!$this->_check_role($allowed_group_id))
		{
			show_access_deny_page();
		}
	}
	
	//student add_finished_hour, 添加完成课时。
	function add_finished_hour_ac()
	{
		$allowed_group_id = array(GROUP_ADMIN, GROUP_SCHOOLADMIN);
		
		if(!$this->_check_role($allowed_group_id))
		{
			show_access_deny_page();
		}
	}
	
	//导出未报名的家长电话。
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
	 * 可读, 不可写： HISTORY_R
	 * 可读写： HISTORY_WR
	 */
	function history_ac($type, $status, $return = '')
	{
		//联系历史开放给所有状态，所有角色. 2011-12-29, zhaoyuan
		if($type == 'type')
			return HISTORY_WR;
		
		
		//管理员, 校区管理员：无所不能
		if($this->group_id == GROUP_ADMIN || $this->group_id == GROUP_SCHOOLADMIN)
			return HISTORY_WR;
		
		if(in_array($status, $this->history_group_status[$type]['status']))
		{
			//检查权限
			if(isset($this->history_group_status[$type]['group'][$this->group_id]) && !empty($this->history_group_status[$type]['group'][$this->group_id]))
			{
				//show_error_page('您没有权限查看该学员的历史记录！', 'admin/student');
				return $this->history_group_status[$type]['group'][$this->group_id];
			}
		}
		
		return HISTORY_DENY;
	}
	
	function history_callback_ac($callback_history_type)
	{
		//管理员, 校区管理员：无所不能
		if($this->group_id == GROUP_ADMIN || $this->group_id == GROUP_SCHOOLADMIN)
			return HISTORY_WR;
		
		//检查权限
		if(isset($this->history_callback_group[$callback_history_type][$this->group_id]) && !empty($this->history_callback_group[$callback_history_type][$this->group_id]))
		{
			//show_error_page('您没有权限查看该学员的历史记录！', 'admin/student');
			return $this->history_callback_group[$callback_history_type][$this->group_id];
		}
		
		return HISTORY_DENY;
	}

	/*
	 * viewer 权限分布
	 */
	 //student edit 页面, 按照状态的搜索下来菜单选项。
	function get_group_status()
	{
		return $this->group_student_status[$this->group_id];
	}
	
	//student all 页面, 学员列表页, 显示删除/取消删除链接。
	function view_student_all_operation()
	{
		$allowed_group_id = array(GROUP_ADMIN, GROUP_SCHOOLADMIN);
		
		return $this->_check_role($allowed_group_id);
	}
	
	//student one, 显示 编辑 链接。
	function view_student_one_edit_link()
	{
		$allowed_group_id = array(GROUP_ADMIN, GROUP_SCHOOLADMIN, GROUP_CONSULTANT_D, GROUP_TEACHER_D, GROUP_SUYANG_D, GROUP_CS_D, GROUP_JIAOWU_D, GROUP_CS, GROUP_JIAOWU);
		
		return $this->_check_role($allowed_group_id);
	}
	
	//student edit, 显示 状态的下来菜单。
	function view_student_edit_status()
	{
		$allowed_group_id = array(GROUP_ADMIN, GROUP_SCHOOLADMIN, GROUP_CS, GROUP_CS_D, GROUP_JIAOWU, GROUP_JIAOWU_D);
		
		if($this->_check_role($allowed_group_id))
			return array(STUDENT_STATUS_NOT_APPOINTMENT, STUDENT_STATUS_HAS_APPOINTMENT, STUDENT_STATUS_SIGNUP, STUDENT_STATUS_LEARNING, STUDENT_STATUS_FINISHED, STUDENT_STATUS_INACTIVE);
		else
			return false;
	}
	
	//student edit, 编辑素养课老师
	function view_student_edit_suyang($student_status)
	{
		if($this->group_id == GROUP_ADMIN || $this->group_id == GROUP_SCHOOLADMIN)
			return true;
		
		if(in_array($this->group_id, array(GROUP_CS, GROUP_CS_D)) && in_array($student_status, array(STUDENT_STATUS_SIGNUP, STUDENT_STATUS_LEARNING)))
			return true;
		
		if($this->group_id == GROUP_SUYANG_D)
			return true;
		
		return false;
	}
	
	//student edit, 编辑咨询师
	function view_student_edit_consultant($student_status)
	{
		if($this->group_id == GROUP_ADMIN || $this->group_id == GROUP_SCHOOLADMIN)
			return true;
		
		if(in_array($this->group_id, array(GROUP_CS, GROUP_CS_D)) && $student_status == STUDENT_STATUS_NOT_APPOINTMENT)
			return true;
		
		if($this->group_id == GROUP_CONSULTANT_D)
			return true;
	
		return false;
	}
	
	//student edit, 编辑班主任
	function view_student_edit_supervisor()
	{
		$allowed_group_id = array(GROUP_ADMIN, GROUP_SCHOOLADMIN);
		
		return $this->_check_role($allowed_group_id);	
	}
	
	//student edit, 编辑教务老师
	function view_student_edit_jiaowu($student_status)
	{
		if($this->group_id == GROUP_ADMIN || $this->group_id == GROUP_SCHOOLADMIN)
				return true;
		
		if($this->group_id == GROUP_JIAOWU_D)
			return true;
	
		return false;
	}
	
	//student edit, 编辑课程顾问
	function view_student_edit_cs($student_status)
	{
		if($this->group_id == GROUP_ADMIN || $this->group_id == GROUP_SCHOOLADMIN)
				return true;
		
		if($this->group_id == GROUP_CS_D)
			return true;
	
		return false;
	}
	
	//student one, 显示 合同信息 tab
	function view_student_one_contract()
	{
		$allowed_group_id = array(GROUP_ADMIN, GROUP_SCHOOLADMIN, GROUP_CS, GROUP_CS_D);
		
		return $this->_check_role($allowed_group_id);	
	}
	
	//student one, 显示 课程表 tab
	function view_student_one_timetable()
	{
		$not_allowed_group_id = array(GROUP_CS, GROUP_CS_D);
		
		return !$this->_check_role($not_allowed_group_id);	
	}
	
	//student one, 显示 短信记录 tab
	function view_student_one_sms()
	{
		$allowed_group_id = array(GROUP_ADMIN, GROUP_SCHOOLADMIN, GROUP_CS, GROUP_CS_D, GROUP_JIAOWU, GROUP_JIAOWU_D, GROUP_CONSULTANT, GROUP_CONSULTANT_D, GROUP_TEACHER_D);
		
		return $this->_check_role($allowed_group_id);	
	}
	
	//是否可看全部的短信记录。
	function view_student_one_see_all_sms()
	{
		$allowed_group_id = array(GROUP_ADMIN, GROUP_SCHOOLADMIN);
		
		return $this->_check_role($allowed_group_id);	
	}
	
	//student one, 查看学员的 status 历史记录
	function view_student_one_status_history()
	{
		$allowed_group_id = array(GROUP_ADMIN, GROUP_SCHOOLADMIN);
		
		return $this->_check_role($allowed_group_id);	
	}
	
	//student one contract, 可对合同进行编辑的链接：添加退费，添加完成课时。
	function view_student_one_contract_operation()
	{
		$allowed_group_id = array(GROUP_ADMIN, GROUP_SCHOOLADMIN);
		
		return $this->_check_role($allowed_group_id);	
	}
	
	//student all, 学员列表页，显示学员的已完成课时数和生日。
	function view_student_all_finished_hour_dob()
	{
		if(in_array($this->group_id, array(GROUP_JIAOWU, GROUP_JIAOWU_D)))
			return true;
	}
	
	//student all，学员列表页，显示学员的所有对应老师。
	function view_student_all_teaches()
	{
		$allowed_group_id = array(GROUP_ADMIN, GROUP_SCHOOLADMIN, GROUP_JIAOWU_D, GROUP_CONSULTANT_D);
		
		return $this->_check_role($allowed_group_id);	
	}
	
	//student all，学员列表页，显示 历史记录 的链接。
	function view_student_all_contact_history($student_status)
	{
		//联系历史开放给所有状态，所有角色. 2011-12-29, zhaoyuan
		if(!in_array($this->group_id, array(GROUP_TEACHER_PARTTIME, GROUP_TEACHER_FULL)))
			return true;
		
		return false;
	}
	
	//student all, student one ，学员列表和详情页，显示学员的详细情况。
	function view_student_all_student_detail()
	{
		$not_allowed_group_id = array(GROUP_TEACHER_PARTTIME, GROUP_TEACHER_FULL);
		
		return !$this->_check_role($not_allowed_group_id);	
	}
}
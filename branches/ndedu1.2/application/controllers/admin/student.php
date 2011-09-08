<?php
/* 
  班主任管理模块
  admin权限.
 */
class Student extends Controller {

	function Student()
	{
		parent::Controller();
		$this->load->library('session');
		
		$this->load->model('CRM_Student_model');
		$this->load->model('CRM_Region_model');
		$this->load->model('CRM_Grade_model');
		$this->load->model('CRM_Branch_model');
		$this->load->model('CRM_History_model');
		$this->load->model('CRM_Contract_model');
		$this->load->model('CRM_Staff_model');
		$this->load->model('CRM_Calendar_model');
		$this->load->model('CRM_Status_history_model');
		
		$this->load->helper('admin');
			
		//如果没有经登录, 就跳转到admin/login登陆页
		if (!has_login())
		{
			goto_login();
		}
		
		/* No need to check, becouse, all groups could access this class.
		$this->allowed_group = array(GROUP_ADMIN, GROUP_SCHOOLADMIN, GROUP_CONSULTANT);
		//检查权限.
		if(!check_role($this->allowed_group))
		{
			show_access_deny_page();
		}
		*/
		//$this->output->enable_profiler(TRUE);
		
		$this->staff_info = get_staff_info();
	}
	
	function index($filter_string = '')
	{
		//默认值
		$filter['page'] = 1;
		$filter['start_time'] = $this->input->post('start_time');
		$filter['end_time'] = $this->input->post('end_time');
		$filter['branch_id'] = $this->input->post('branch_id');
		$filter['grade_id'] = $this->input->post('grade_id');
		$filter['status'] = $this->input->post('status');
		$filter['name'] = $this->input->post('name');
		$filter['province_id'] = $this->input->post('province_id');
		$filter['city_id'] = $this->input->post('city_id');
		$filter['consultant_id'] = FALSE;
		$filter['supervisor_id'] = FALSE;
		$filter['is_delete'] = 0;
	
		$filter = $this->_parse_filter($filter_string, $filter);
		
		switch($this->staff_info['group_id'])
		{
			case GROUP_ADMIN: //admin管理有权限
				break;
			case GROUP_SCHOOLADMIN: //shooladmin只有查看本校区学员的权限
				$filter['branch_id'] = $this->staff_info['branch_id'];
				break;
			case GROUP_CONSULTANT: //shooladmin只有查看本校区的, 自己添加的, 状态为未报名的学员的权限
				$filter['branch_id'] = $this->staff_info['branch_id'];
				$filter['consultant_id'] = $this->staff_info['staff_id'];
				$filter['status'] = STUDENT_STATUS_NOT_SIGNUP;
				break;
			case GROUP_SUPERVISOR: //shooladmin只有查看本校区的, 自己分配的, 状态为正在学的学员的权限
				$filter['branch_id'] = $this->staff_info['branch_id'];
				$filter['supervisor_id'] = $this->staff_info['staff_id'];
				$filter['status'] = STUDENT_STATUS_LEARNING;
				break;
			default:
				show_error_page('您没有权限查看学员列表: 请重新登录或者联系管理员!', 'admin/student');
				return false;
		}
		
		//Page Nav
		$total = $this->CRM_Student_model->getAll_count($filter);
		$page_nav = page_nav($total, STUDENT_PER_PAGE, $filter['page']);
		$page_nav['base_url'] = 'admin/student/index';
		$page_nav['filter'] = $filter;
		$data['main']['page_nav'] = $this->load->view('admin/common_page_nav', $page_nav, true);
		
		$students = $this->CRM_Student_model->getAll($filter, $page_nav['start'], STUDENT_PER_PAGE);
		
		$data['header']['css_file'] = '../calendar.css';
		$data['header']['meta_title'] = '查看学员 - 管理学员';
		$data['footer']['js_file'][] = '../calendar.js';
		$data['footer']['js_file'][] = 'region.js';
		$data['main']['students'] = $students;
		$data['main']['branches'] = $this->_get_branch();
		$data['main']['provinces'] = $this->_get_province();
		$data['main']['grades'] = $this->_get_grade();
		$this->_load_view('student_all', $data);
	}
	
	//所有已报名的学生
	function signup()
	{
		$this->index('page=1&status='.STUDENT_STATUS_SIGNUP);
	}
	//所有已学完的学生
	function finished()
	{
		$this->index('page=1&status='.STUDENT_STATUS_FINISHED);
	}
	//所有已注销的学生
	function inactive()
	{
		$this->index('page=1&status='.STUDENT_STATUS_INACTIVE);
	}
	//所有已删除的学生
	function delete_student()
	{
		$this->index('page=1&is_delete=1');
	}
	/* 
	 * 访问权限: 全部角色
	*/
	function one($student_id = 0, $type = 'basic')
	{
		//判断student_id是否合法.
		$student_id = intval($student_id);
		if($student_id <= 0)
		{
			show_error_page('您输入的学员ID不合法, 请返回重试.', 'admin/student');
			return false;
		}
		
		//获取student 信息.
		$student_info = $this->CRM_Student_model->getOne($student_id);
		
		//检查权限
		if(empty($student_info))
		{
			show_error_page('您所查询的学员不存在!', 'admin/student');
			return false;
		}
		else
		{
			switch($this->staff_info['group_id'])
			{
				case GROUP_ADMIN: //admin管理有权限
					break;
				case GROUP_SCHOOLADMIN: //shooladmin只有查看本校区学员的权限
					if($student_info['branch_id'] != $this->staff_info['branch_id'])
					{
						show_error_page('您没有权限查看该学员: 他/她不在您所在的校区!', 'admin/student');
						return false;
					}
					break;
				case GROUP_CONSULTANT:
					if($student_info['consultant_id'] != $this->staff_info['staff_id'])
					{
						show_error_page('您没有权限查看该学员: 他/她不是您所创建的!', 'admin/student');
						return false;
					}
					elseif($student_info['status'] != STUDENT_STATUS_NOT_SIGNUP)
					{
						show_error_page('您没有权限查看该学员: 他/她正在学习中!', 'admin/student');
						return false;
					}
					break;
				case GROUP_SUPERVISOR:
					if($student_info['supervisor_id'] != $this->staff_info['staff_id'])
					{
						show_error_page('您没有权限查看该学员: 他/她不是您的学生!', 'admin/student');
						return false;
					}
					elseif($student_info['status'] != STUDENT_STATUS_LEARNING)
					{
						show_error_page('您没有权限查看该学员: 他/她已经学完!', 'admin/student');
						return false;
					}
					break;
				default:
					show_error_page('您没有权限查看该学员: 请重新登录或者联系管理员!', 'admin/student');
					return false;
			}
		}
		
		//开始展示
		switch($type)
		{
			case 'history':
				$student_extra_info = $this->CRM_History_model->get_histories($student_id);
				$template = 'student_one_history';
				break;
			case 'contract':
				$data['header']['css_file'] = '../calendar.css';
				$data['footer']['js_file'] = '../calendar.js';
				$student_extra_info['contract'] = $this->CRM_Contract_model->get_contracts($student_id);
				$template = 'student_one_contract';
				break;
			case 'basic':
			default:
				//获取student 信息.
				$student_extra_info['status_history'] = $this->CRM_Status_history_model->getall($student_id);
				$student_extra_info['user_student'] = $this->CRM_Student_model->getOne_vip_code($student_id);
				$student_extra_info['status_text'] = get_student_status_text($student_info['status']);
				$template = 'student_one_basic';
				break;
		}
				
		$data['header']['meta_title'] = $student_info['name'].' -查看学员 - 管理学员';
		$data['header']['css_file'] = '../calendar.css';
		$data['footer']['js_file'] = '../calendar.js';
		$data['main']['student'] = array_merge($student_info, $student_extra_info);
		$this->_load_view($template, $data);
	}
	
	/* 
	 * 访问权限: 全部角色
	*/
	function edit($student_id = 0)
	{
		//判断student_id是否合法.
		$student_id = (empty($student_id))? $this->input->post('student_id') : intval($student_id);
		if($student_id <= 0)
		{
			show_error_page('您输入的学员ID不合法, 请返回重试.', 'admin/student');
			return false;
		}
		
		//获取student 信息.
		$student_info = $this->CRM_Student_model->getOne($student_id);
		
		//检查权限
		if(empty($student_info))
		{
			show_error_page('您所编辑的学员不存在!', 'admin/student');
			return false;
		}
		else
		{
			switch($this->staff_info['group_id'])
			{
				case GROUP_ADMIN: //admin管理有权限
					break;
				case GROUP_SCHOOLADMIN: //shooladmin只有查看本校区学员的权限
					if($student_info['branch_id'] != $this->staff_info['branch_id'])
					{
						show_error_page('您没有权限编辑该学员: 他/她不在您所在的校区!', 'admin/student');
						return false;
					}
					break;
				case GROUP_CONSULTANT:
					if($student_info['consultant_id'] != $this->staff_info['staff_id'])
					{
						show_error_page('您没有权限编辑该学员: 他/她不是您所创建的!', 'admin/student');
						return false;
					}
					elseif($student_info['status'] != STUDENT_STATUS_NOT_SIGNUP)
					{
						show_error_page('您没有权限编辑该学员: 他/她正在学习中!', 'admin/student');
						return false;
					}
					break;
				case GROUP_SUPERVISOR:
					if($student_info['supervisor_id'] != $this->staff_info['staff_id'])
					{
						show_error_page('您没有权限编辑该学员: 他/她不是您的学生!', 'admin/student');
						return false;
					}
					elseif($student_info['status'] != STUDENT_STATUS_LEARNING)
					{
						show_error_page('您没有权限编辑该学员: 他/她已经学完!', 'admin/student');
						return false;
					}
					break;
				default:
					show_error_page('您没有权限编辑该学员: 请重新登录或者联系管理员!', 'admin/student');
					return false;
			}
		}
		
		if(isset($_POST['submit']) && !empty($_POST['submit']))
		{
			//必填信息.
			$edit_student['status'] = $this->input->post('status');
			$edit_student['supervisor_id'] = $this->input->post('supervisor_id');
			$edit_student['consultant_id'] = $this->input->post('consultant_id');
			$edit_student['name'] = $this->input->post('name');
			$edit_student['branch_id'] = $this->input->post('branch_id');
			$edit_student['grade_id'] = $this->input->post('grade_id');
			$edit_student['province_id'] = $this->input->post('province_id');
			$edit_student['city_id'] = $this->input->post('city_id');
			$edit_student['district_id'] = $this->input->post('district_id');
			$edit_student['father_phone'] = $this->input->post('father_phone');
			$edit_student['mother_phone'] = $this->input->post('mother_phone');
			$edit_student['qq'] = $this->input->post('qq');
			$edit_student['email'] = $this->input->post('email');
			$edit_student['address'] = $this->input->post('address');
			$edit_student['remark'] = $this->input->post('remark');
			
			//检查修改项
			$update_field = array();
			foreach($edit_student as $key => $val)
			{
				if(!empty($val) && ($val != $student_info[$key]))
					$update_field[$key] = $val;
			}
			
			//如果修改学员状态为: 正在学, 需要同时指定任课老师的为谁.
			if((isset($update_field['status']) && $update_field['status'] == STUDENT_STATUS_LEARNING) && 
				(empty($update_field['supervisor_id']) && empty($student_info['supervisor_id'])))
			{
				$notify = '把学生状态改为"正在学", 需要同时指定学员的班主任老师.';
				$this->_load_student_edit_view($notify, $student_info);
				return false;
			}
						
			if($this->CRM_Student_model->update($student_id, $update_field))
			{
				//如果更新status的话, 插入student_status_history记录
				if(array_key_exists('status', $update_field))
				{
					$consultant_id = $student_info['consultant_id'];
					$supervisor_id = $student_info['supervisor_id'];
					//如果是管理员给学生分配班主任, 咋consultant_id为新班主任的ID
					if($update_field['status'] == STUDENT_STATUS_LEARNING)
						$supervisor_id = (!empty($update_field['supervisor_id'])) ? $update_field['supervisor_id'] : $student_info['supervisor_id'];
					
					$this->CRM_Student_model->student_status_history($student_id, $student_info['status'], $update_field['status'], $consultant_id, $supervisor_id);
				}
				show_result_page('学员已经更新成功! ', 'admin/student/');
			}
			else
			{
				$notify = '更新失败, 请重试.';
				$this->_load_student_edit_view($notify, $student_info);
			}
		}
		else
		{
			$this->_load_student_edit_view('', $student_info);
		}
	}
	
	function history_add()
	{
		if(isset($_POST['submit']) && !empty($_POST['submit']))
		{
			//必填信息.
			$history['history'] = $this->input->post('history');
			$history['history_type'] = $this->input->post('history_type');
			$history['student_id'] = $this->input->post('student_id');
			$history['staff_id'] = $this->staff_info['staff_id'];
			
			//添加日程
			$calendar['add_calendar'] = $this->input->post('add_calendar');
			$calendar['start_time'] = $this->input->post('start_time');
			$calendar['end_time'] = $this->input->post('end_time');
			
			if(empty($history['history_type']) || empty($history['student_id']))
			{
				show_error_page('您提交的表单有误, 请返回重试.');
			}
			elseif(empty($history['history']))
			{
				switch($history['history_type'])
				{
					case 'contact':
						$notify = '联系历史内容不能为空';
						break;
					case 'learning':
						$notify = '学习历史内容不能为空';
						break;
					default:
						$notify = '历史内容不能为空';
						break;
				}
				
				$this->_load_history_view($notify, $history);
			}
			elseif($calendar['add_calendar'] == '1' && ( empty($calendar['start_time']) || empty($calendar['end_time']))) //添加到Calendar
			{
				$notify = '开始时间或结束时间不能为空!';
				$this->_load_history_view($notify, $history);
			}
			elseif($calendar['add_calendar'] == '1' && ( $calendar['end_time'] < $calendar['start_time'])) //添加到Calendar
			{
				$notify = '开始时间不能小于结束时间!';
				$this->_load_history_view($notify, $history);
			}
			else
			{
				//检查权限.
				$allowed_group = array(GROUP_ADMIN, GROUP_SCHOOLADMIN);
				switch($history['history_type'])
				{
					case 'contact':
						$allowed_group[] = GROUP_CONSULTANT;
						break;
					case 'learning':
						$allowed_group[] = GROUP_SUPERVISOR;
						break;
					default:
						break;
				}
				if(!check_role($allowed_group, $this->staff_info['group_id']))
				{
					show_access_deny_page();
				}
				
				//add into DB
				if($this->CRM_History_model->add_history($history, $history['history_type']))
				{
					$notify = '历史已经添加成功! ';
					if($calendar['add_calendar'] == '1') //添加到日程
					{
						$calendar['calendar_content'] = $history['history'];
						if($this->CRM_Calendar_model->add($calendar, $this->staff_info['staff_id']))
							$notify .= '日程添加成功!';
						else
							$notify .= '日程添加失败!';
					}
					show_result_page($notify, 'admin/student/one/'.$history['student_id'].'/history');
				}
				else
				{
					$notify = '添加失败, 请重试.';
					$this->_load_history_view($notify, $history);
				}
			}
		}
	}
	
	function contract_add()
	{
		//检查权限. 
		if(!check_role(array(GROUP_ADMIN, GROUP_SCHOOLADMIN, GROUP_CONSULTANT), $this->staff_info['group_id']))
		{
			show_access_deny_page();
		}
		
		if(isset($_POST['submit']) && !empty($_POST['submit']))
		{
			//必填信息.
			$contract['student_id'] = $this->input->post('student_id');
			$contract['start_time'] = $this->input->post('start_time');
			$contract['end_time'] = $this->input->post('end_time');
			$contract['total_hours'] = intval($this->input->post('total_hours'));
			$contract['contact_value'] = floatval($this->input->post('contact_value'));
			$contract['deposit'] = floatval($this->input->post('deposit'));
			$contract['staff_id'] = $this->staff_info['staff_id'];
			
			if(empty($contract['start_time']) || empty($contract['end_time']) || empty($contract['total_hours']) || empty($contract['contact_value']) || empty($contract['deposit']))
			{
				$notify = '请填写完整合同信息';
				$this->_load_contract_view($notify, $contract);
			}
			else
			{
				//add into DB
				if($this->CRM_Contract_model->add_contract($contract))
				{
					show_result_page('新合同已经添加成功! ', 'admin/student/one/'.$contract['student_id'].'/contract');
				}
				else
				{
					$notify = '新合同添加失败, 请重试.';
					$this->_load_contract_view($notify, $contract);
				}
			}
		}
	}
	
	/* 
	 * 访问权限: 超级管理员, 校区管理员, 咨询师
	*/
	function add()
	{
		//检查权限.
		if(!check_role(array(GROUP_ADMIN, GROUP_SCHOOLADMIN, GROUP_CONSULTANT), $this->staff_info['group_id']))
		{
			show_access_deny_page();
		}
		
		if(isset($_POST['submit']) && !empty($_POST['submit']))
		{
			//必填信息.
			$new_student['name'] = $this->input->post('name');
			
			//数字的必填信息
			$new_student['branch_id'] = $this->input->post('branch_id');
			$new_student['grade_id'] = $this->input->post('grade_id');
			$new_student['province_id'] = $this->input->post('province_id');
			$new_student['city_id'] = $this->input->post('city_id');
			$new_student['district_id'] = $this->input->post('district_id');
			
			//二选其一
			$new_student['father_phone'] = $this->input->post('father_phone');
			$new_student['mother_phone'] = $this->input->post('mother_phone');
			
			//选填信息.
			$new_student['qq'] = intval($this->input->post('qq'));
			$new_student['email'] = $this->input->post('email');
			$new_student['remark'] = $this->input->post('remark');
			$new_student['address'] = $this->input->post('address');
			
			if(empty($new_student['name']) || empty($new_student['branch_id']) || empty($new_student['grade_id']) || empty($new_student['province_id']) || empty($new_student['city_id']) || empty($new_student['district_id']))
			{
				$notify = '请填写完整的学生信息';
				$this->_load_student_add_view($notify, $new_student);
			}
			elseif( empty($new_student['father_phone']) && empty($new_student['mother_phone']) )
			{
				$notify = '请填写爸爸或者妈妈的电话';
				$this->_load_student_add_view($notify, $new_student);
			}
			else
			{
				//add into DB
				$student_id = $this->CRM_Student_model->add($new_student, $this->staff_info['staff_id']);
				if($student_id > 0)
				{
					//插入student_status_history一条记录
					$this->CRM_Student_model->student_status_history($student_id, 0, STUDENT_STATUS_NOT_SIGNUP, $this->staff_info['staff_id'], 0);

					show_result_page('学员已经添加成功! ', 'admin/student/one/'.$student_id);
				}
				else
				{
					$notify = '添加失败, 请重试.';
					$this->_load_student_add_view($notify, $new_student);
				}
			}
		}
		else
		{
			$this->_load_student_add_view();
		}
	}
	
	function delete($student_id, $is_delete = 1)
	{
		//检查权限.
		if(!check_role(array(GROUP_ADMIN, GROUP_SCHOOLADMIN), $this->staff_info['group_id']))
		{
			show_access_deny_page();
		}
		
		//判断student_id是否合法.
		$student_id = intval($student_id);
		if($student_id <= 0)
		{
			show_error_page('您输入的学员ID不合法, 请返回重试.', 'admin/delete_student');
			return false;
		}
		
		$update_field['is_delete'] = $is_delete;
		if($this->CRM_Student_model->update($student_id, $update_field))
		{
			if($is_delete == 1)
				$notify = '学员已经添加删除!';
			else
				$notify = '学员已经成功被取消删除!';
			
			show_result_page($notify, 'admin/delete_student');
		}
		else
		{
			if($is_delete == 1)
				$notify = '删除失败, 请重试.';
			else
				$notify = '取消删除失败, 请重试.';
			
			show_error_page($notify, 'admin/student');
		}
	
	}
	
	function _load_student_add_view($notify = '', $student = array())
	{
		$data['header']['meta_title'] = '添加学员 - 管理学员';
		$data['footer']['js_file'] = 'region.js';
		$data['main']['provinces'] = $this->_get_province();
		$data['main']['grades'] = $this->_get_grade();
		$data['main']['branches'] = $this->_get_branch();
		$data['main']['notification'] = $notify;
		$data['main']['student'] = $student;
		$this->_load_view('student_add', $data);
	}
	
	function _load_student_edit_view($notify = '', $student = array())
	{
		$data['header']['meta_title'] = '编辑学员 - 管理学员';
		$data['footer']['js_file'] = 'region.js';
		$data['main']['provinces'] = $this->_get_province();
		$data['main']['grades'] = $this->_get_grade();
		$data['main']['branches'] = $this->_get_branch();
		$data['main']['supervisors'] = $this->CRM_Staff_model->get_all_by_group(GROUP_SUPERVISOR);
		$data['main']['notification'] = $notify;
		$data['main']['student'] = $student;
		$this->_load_view('student_edit', $data);
	}
	
	function _load_history_view($notify='', $history)
	{
		$data['header']['meta_title'] = '添加历史 - 管理学员';
		$data['header']['css_file'] = '../calendar.css';
		$data['footer']['js_file'] = '../calendar.js';
		$student_extra_info = $this->CRM_History_model->get_histories($history['student_id']);
		$student_info = $this->CRM_Student_model->getOne($history['student_id']);
		$data['main']['student'] = array_merge($student_info, $student_extra_info);
		$data['main']['notification'] = $notify;
		$this->_load_view('student_one_history', $data);
	}
	
	function _load_contract_view($notify='', $contract)
	{
		$data['header']['meta_title'] = '添加新合同 - 管理学员';
		$data['header']['css_file'] = '../calendar.css';
		$data['footer']['js_file'] = '../calendar.js';
		$student_extra_info['contract'] = $this->CRM_Contract_model->get_contracts($contract['student_id']);
		$student_info = $this->CRM_Student_model->getOne($contract['student_id']);
		$data['main']['student'] = array_merge($student_info, $student_extra_info);
		$data['main']['new_contract'] = $contract;
		$data['main']['notification'] = $notify;
		$this->_load_view('student_one_contract', $data);
	}
	
	function _load_view($template, $data = array())
	{
		_load_viewer($this->staff_info['group_id'], $template, $data);
	}
	
	function _get_province()
	{
		return $this->CRM_Region_model->get_regions();
		
	}
	
	function _get_grade()
	{
		return $this->CRM_Grade_model->get_grades(GRADE_CHILDREN);
		
	}

	function _get_branch()
	{
		$result = array();
		if($this->staff_info['group_id'] == GROUP_ADMIN)
		{
			$result['show_branch_list'] = true;
			$result['branch'] = $this->CRM_Branch_model->get_branches();
		}
		else
		{
			$result['show_branch_list'] = false;
			$result['branch'] = $this->CRM_Branch_model->get_one_branch($this->staff_info['branch_id']);
		}
		return $result;		
	}
	
	function _parse_filter($filter_string, $filter)
	{
		$input_filter = parse_filter($filter_string);
		
		foreach($filter as $key => $value)
		{
			if(!isset($input_filter[$key]))
				continue;
			
			switch($key)
			{
				case 'start_time':
				case 'end_time':
					if(!check_valid_date($input_filter[$key]))
						continue;
					break;
				case 'page':
				case 'branch_id':
				case 'grade_id':
				case 'status':
				case 'province_id':
				case 'city_id':
				case 'consultant_id':
				case 'supervisor_id':
				case 'is_delete':
					$input_filter[$key] = intval($input_filter[$key]);
					break;
				case 'name':
				default:
					break;
			}
			
			if(empty($input_filter[$key]))
				continue;
			
			$filter[$key] = $input_filter[$key];
		}
		
		return $filter;
	}
}

/* End of file admin.php */
/* Location: ./system/application/controllers/admin.php */
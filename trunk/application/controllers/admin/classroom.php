<?php

//require_once(APPPATH.'libraries/admin/admin_ac_student.php');

/* 
  班主任管理模块
  admin权限.
 */
class Classroom extends Controller {

	function Classroom()
	{
		parent::Controller();
		$this->load->library('session');
		
		$this->load->model('CRM_Subject_model');
		$this->load->model('CRM_Classroom_model');
		
		
		$this->load->model('CRM_Student_model');
		$this->load->model('CRM_Region_model');
		$this->load->model('CRM_Grade_model');
		$this->load->model('CRM_Branch_model');
		$this->load->model('CRM_History_model');
		$this->load->model('CRM_Contract_model');
		$this->load->model('CRM_Staff_model');
		$this->load->model('CRM_Calendar_model');
		$this->load->model('CRM_Status_history_model');
		
		$this->load->model('CRM_Sms_history_model');
		$this->load->model('CRM_Student_from_model');
		$this->load->model('CRM_Timetable_model');
		
		$this->load->helper('admin');
		$this->load->helper('calendar');
			
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
		$filter['day'] = $this->input->post('day');
		$filter['classroom_name'] = $this->input->post('classroom_name');
		$filter['subject_id'] = $this->input->post('subject_id');
		
		$filter = $this->_parse_filter($filter_string, $filter);
		
		//Page Nav
		$total = $this->CRM_Classroom_model->getAll_count($filter);
		$page_nav = page_nav($total, CLASSROOM_PER_PAGE, $filter['page']);
		$page_nav['base_url'] = 'admin/classroom/index';
		$page_nav['filter'] = $filter;
		$data['main']['page_nav'] = $this->load->view('admin/common_page_nav', $page_nav, true);
		
		$classroom = $this->CRM_Classroom_model->getAll($filter, $page_nav['start'], CLASSROOM_PER_PAGE, 'add_time', 'DESC');
		
		$data['header']['meta_title'] = '查看班级 - 管理班级';
		$data['main']['subjects'] = $this->_get_subjects_parrent();
		$data['main']['classroom'] = $classroom;
		$data['main']['filter'] = $filter;
		$this->_load_view('classroom_all', $data);
	}
	
	function edit($classroom_id = 0)
	{
		//判断student_id是否合法.
		$classroom_id = (empty($classroom_id))? $this->input->post('classroom_id') : intval($classroom_id);
		if($classroom_id <= 0)
		{
			show_error_page('您输入的班级ID不合法, 请返回重试.', 'admin/classroom');
			return false;
		}
		
		//获取student 信息.
		$classroom_info = $this->CRM_Classroom_model->getOne($classroom_id);
		
		if(isset($_POST['submit']) && !empty($_POST['submit']))
		{
			//必填信息.
			$edit_class['classroom_name'] = $this->input->post('classroom_name');
			$edit_class['subject_id'] = $this->input->post('subject_id');
			$edit_class['staff_id'] = $this->input->post('staff_id');
			$edit_class['day'] = $this->input->post('day');
			$edit_class['start_date'] = $this->input->post('start_date');
			$edit_class['start_time'] = $this->input->post('start_hour').':'.$this->input->post('start_mins').':00';
			$edit_class['end_time'] = $this->input->post('end_hour').':'.$this->input->post('end_mins').':00';
			
			//检查修改项
			$update_field = array();
			foreach($edit_class as $key => $val)
			{
				if(!empty($val) && ($val != $classroom_info[$key]))
					$update_field[$key] = $val;
			}
			
			if($this->CRM_Classroom_model->update($classroom_id, $update_field))
			{
				show_result_page('班级已经更新成功! ', 'admin/classroom/');
			}
			else
			{
				$notify = '更新失败, 请重试.';
				$this->_load_classroom_edit_view($notify, $classroom_info);
			}
		}
		else
		{
			$this->_load_classroom_edit_view('', $classroom_info);
		}
	}
	
	/* 
	 * 访问权限: 超级管理员, 校区管理员, 咨询师
	*/
	function add()
	{
		if(isset($_POST['submit']) && !empty($_POST['submit']))
		{
			$new_class['classroom_name'] = $this->input->post('classroom_name');
			$new_class['subject_id'] = $this->input->post('subject_id');
			$new_class['staff_id'] = $this->input->post('staff_id');
			$new_class['day'] = $this->input->post('day');
			$new_class['start_date'] = $this->input->post('start_date');
			$new_class['start_time'] = $this->input->post('start_hour').':'.$this->input->post('start_mins').':00';
			$new_class['end_time'] = $this->input->post('end_hour').':'.$this->input->post('end_mins').':00';
			
			$new_class['student_id'] = $this->input->post('student_id');
			
			if(empty($new_class['classroom_name']) || empty($new_class['subject_id']) || empty($new_class['staff_id']))
			{
				$notify = '请填写完整的信息';
				$this->_load_classroom_add_view($notify, $new_class);
			}
			else
			{
				//add into DB
				$classroom_id = $this->CRM_Classroom_model->add($new_class);
				
				show_result_page('班级已经添加成功! ', 'admin/classroom/');
			}
		}
		else
		{
			$this->_load_classroom_add_view();
		}
	}
	
	function delete($classroom_id)
	{
		//判断student_id是否合法.
		$classroom_id = intval($classroom_id);
		if($classroom_id <= 0)
		{
			show_error_page('您输入的班级ID不合法, 请返回重试.', 'admin/classroom/');
			return false;
		}
		
		if($this->CRM_Classroom_model->delete($classroom_id))
		{
			show_result_page('班级已经成功删除', 'admin/classroom/');
		}
		else
		{
			$notify = '删除失败, 请重试.';
			show_error_page($notify, 'admin/classroom/');
		}
	
	}
	
	function _get_subjects_parrent($parrent_id = 0)
	{
		if($this->staff_info['group_id'] == GROUP_CONSULTANT_D)
			$parrent_id = SUBJECT_ZIXUN;
		elseif($this->staff_info['group_id'] == GROUP_SUYANG_D)
			$parrent_id = SUBJECT_SUYANG;
		elseif($this->staff_info['group_id'] == GROUP_TEACHER_D)
			$parrent_id = SUBJECT_XUEKE;
		
		return $this->CRM_Subject_model->getAll_parrent($parrent_id);
	}
	
	function _load_classroom_add_view($notify = '', $class = array())
	{
		$data['header']['meta_title'] = '添加班级 - 管理班级';
		$data['header']['css_file'] = '../calendar.css';
		$data['footer']['js_file'] = '../calendar.js';
		$data['main']['subjects'] = $this->_get_subjects_parrent();
		$data['main']['teachers'] = $this->CRM_Staff_model->get_all_by_subject(SUBJECT_SUYANG);
		$data['main']['student_signup'] = $this->CRM_Student_model->getAll(array('status' => STUDENT_STATUS_SIGNUP), 0, 0, 'name');
		$data['main']['student_learning'] = $this->CRM_Student_model->getAll(array('status' => STUDENT_STATUS_LEARNING), 0, 0, 'name');
		$data['main']['class'] = $class;
		$data['main']['notification'] = $notify;
		$this->_load_view('classroom_add', $data);
	}
	
	function _load_classroom_edit_view($notify = '', $class = array())
	{
		$data['header']['meta_title'] = '编辑班级 - 管理班级';
		$data['header']['css_file'] = '../calendar.css';
		$data['footer']['js_file'] = '../calendar.js';
		$data['main']['subjects'] = $this->_get_subjects_parrent();
		$data['main']['teachers'] = $this->CRM_Staff_model->get_all_by_subject($class['subject_id']);
		$data['main']['student'] = $this->CRM_Student_model->getAll(array('status' => array(STUDENT_STATUS_SIGNUP, STUDENT_STATUS_LEARNING)), 0, 0, 'name');
		$data['main']['class'] = $class;
		$data['main']['notification'] = $notify;
		$this->_load_view('classroom_edit', $data);
	}
	
	function _load_view($template, $data = array())
	{
		_load_viewer($this->staff_info['group_id'], $template, $data);
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
					$filter[$key] = $input_filter[$key];
					break;
				case 'page':
				case 'branch_id':
				case 'grade_id':
				case 'status':
				case 'province_id':
				case 'city_id':
				case 'consultant_id':
				case 'supervisor_id':
				case 'suyang_id':
				case 'jiaowu_id':
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
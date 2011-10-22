<?php
/* 
  合同模块. 查看单个合同.
  admin权限.
 */
class Timetable extends Controller {

	function Timetable()
	{
		parent::Controller();
		$this->load->library('session');
		
		$this->load->model('CRM_Timetable_model');
		
		$this->load->helper('admin');
			
		//如果没有经登录, 就跳转到admin/login登陆页
		if (!has_login())
		{
			goto_login();
		}
		
		//获取员工基本信息
		$this->staff_info = get_staff_info();
		
		/*检查权限.
		$this->allowed_group = array(GROUP_ADMIN, GROUP_SCHOOLADMIN);
		if(!check_role($this->allowed_group, $this->staff_info['group_id']))
		{
			//show_access_deny_page();
		}
		*/
		
		//加载权限控制类
		$this->load->library('admin_ac/Admin_Ac_Timetable', array('group_id' => $this->staff_info['group_id']));
	}
	
	function add()
	{
		//access_control
		if(!$this->admin_ac_timetable->add_timetable())
		{
			show_access_deny_page();
		}
		
		if(isset($_POST['submit']) && !empty($_POST['submit']))
		{
			//必填信息.
			$timetable['staff_id'] = $this->input->post('staff_id');
			$timetable['subject_id'] = $this->input->post('subject_id');
			$timetable['day'] = $this->input->post('day');
			$timetable['student_id'] = $this->input->post('student_id');
			
			$start_hour = $this->input->post('start_hour');
			$start_mins = $this->input->post('start_mins');
			$end_hour = $this->input->post('end_hour');
			$end_mins = $this->input->post('end_mins');
			
			$timetable['start_time'] = $start_hour.':'.$start_mins.':00';
			$timetable['end_time'] = $end_hour.':'.$end_mins.':00';			
			
			if(empty($timetable['subject_id']) || empty($timetable['staff_id']) || empty($timetable['day']) || empty($timetable['student_id']))
			{
				$notify = '您所填写的信息不完整，请返回重试！';
				show_error_page($notify, 'admin/student/one/'.$timetable['student_id'].'/timetable');
			}
			else
			{
				//add into DB
				if($this->CRM_Timetable_model->add($timetable))
				{
					show_result_page('新课程表已经添加成功! ', 'admin/student/one/'.$timetable['student_id'].'/timetable');
				}
				else
				{
					$notify = '添加失败, 请重试.';
					show_error_page($notify, 'admin/student/one/'.$timetable['student_id'].'/timetable');
				}
			}
		}
	}
	
	
	function edit($contract_id = 0)
	{
		//判断student_id是否合法.
		$contract_id = (empty($contract_id))? $this->input->post('contract_id') : intval($contract_id);
		if($contract_id <= 0)
		{
			show_error_page('您输入的合同ID不合法, 请返回重试.', '');
			return false;
		}
		
		//获取contract信息.
		$contract_info = $this->CRM_Contract_model->get_one_contract($contract_id);
		//获取student信息.
		$student_info = $this->CRM_Student_model->getOne($contract_info['student_id']);
		
		//检查权限
		if(empty($contract_info) || empty($student_info))
		{
			show_error_page('您所查询的合同不存在!', 'admin/student');
			return false;
		}
		
		//access_control
		$this->admin_ac_contract->contract_one_ac($student_info, $this->staff_info);
		
		if(isset($_POST['submit']) && !empty($_POST['submit']))
		{
			//必填信息.
			$contract['start_time'] = $this->input->post('start_time');
			$contract['end_time'] = $this->input->post('end_time');
			$contract['total_hours'] = intval($this->input->post('total_hours'));
			$contract['contact_value'] = floatval($this->input->post('contact_value'));
			$contract['deposit'] = floatval($this->input->post('deposit'));
			
			//检查修改项
			$update_field = array();
			foreach($contract as $key => $val)
			{
				if(!empty($val) && ($val != $contract_info[$key]))
					$update_field[$key] = $val;
			}
			
			if($this->CRM_Contract_model->update($contract_id, $update_field))
			{
				show_result_page('合同已经更新成功! ', 'admin/student/one/'.$contract_info['student_id'].'/contract');
			}
			else
			{
				$notify = '更新失败, 请重试.';
				$this->_load_student_edit_view($notify, $contract_info, $student_info);
			}
		}
		else
		{
			$this->_load_student_edit_view('', $contract_info, $student_info);
		}
	}
	
	function _load_student_edit_view($notify, $contract_info, $student_info)
	{
		$data['header']['meta_title'] = '编辑合同 - 管理学员';
		$data['header']['css_file'] = '../calendar.css';
		$data['footer']['js_file'] = '../calendar.js';
		$data['main']['contract_info'] = $contract_info;
		$data['main']['student'] = $student_info;
		$data['main']['notification'] = $notify;
		_load_viewer($this->staff_info['group_id'], 'contract_edit', $data);
	}
	
	function _load_contract_finished_view($notify='', $finished)
	{
		$data['header']['meta_title'] = '已学完课程 - 合同信息 - 管理学员';
		$data['main']['new_finished'] =$finished;
		//$data['main']['contract'] =$this->CRM_Contract_model->get_one_contract($finished['contract_id']);
		//$data['main']['contract']['finished'] = $this->CRM_Contract_model->get_one_all_finished($finished['contract_id']);
		//$data['main']['student'] = $this->CRM_Student_model->getOne($data['main']['contract']['student_id']);
		//$data['main']['staffs'] = $this->CRM_Staff_model->get_all_by_group();
		
		$data['header']['css_file'] = '../calendar.css';
		$data['footer']['js_file'] = '../calendar.js';
		$data['header']['meta_title'] = '添加已完成课时 - 管理学员';
		$data['main']['student'] = $this->CRM_Student_model->getAll(array('status' => STUDENT_STATUS_LEARNING));
		$data['main']['staffs'] = $this->CRM_Staff_model->get_all_by_group();
		$data['main']['subjects'] = $this->CRM_Subject_model->getAll();
		$data['main']['notification'] = $notify;
		_load_viewer($this->staff_info['group_id'], 'student_add_finished_hour', $data);
	}
	
	function _load_contract_refund_view($notify='', $refund)
	{
		$data['header']['meta_title'] = '退费信息 - 合同信息 - 管理学员';
		$data['main']['new_refund'] =$refund;
		$data['main']['contract'] =$this->CRM_Contract_model->get_one_contract($refund['contract_id']);
		$data['main']['contract']['refund'] = $this->CRM_Contract_model->get_one_all_refund($refund['contract_id']);
		$data['main']['student'] = $this->CRM_Student_model->getOne($data['main']['contract']['student_id']);
		$data['main']['teachers'] = $this->CRM_Staff_model->get_all_by_group(GROUP_TEACHER_PARTTIME);
		$data['main']['notification'] = $notify;
		_load_viewer($this->staff_info['group_id'], 'student_add_finished_hour', $data);
	}
	
}
/* End of file admin.php */
/* Location: ./system/application/controllers/admin.php */
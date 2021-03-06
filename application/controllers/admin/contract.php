<?php
/* 
  合同模块. 查看单个合同.
  admin权限.
 */
class Contract extends Controller {

	function Contract()
	{
		parent::Controller();
		$this->load->library('session');
		
		$this->load->model('CRM_Student_model');
		$this->load->model('CRM_Contract_model');
		$this->load->model('CRM_Staff_model');
		$this->load->model('CRM_Subject_model');
		
		$this->load->helper('admin');
		$this->load->helper('calendar');
			
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
		$this->load->library('admin_ac/Admin_Ac_Contract', array('group_id' => $this->staff_info['group_id']));
	}
	
	function refund_add()
	{
		if(isset($_POST['submit']) && !empty($_POST['submit']))
		{
			//必填信息.
			$refund['contract_id'] = $this->input->post('contract_id');
			$refund['contract_staff_id'] = $this->input->post('contract_staff_id');
			$refund['refund_value'] = floatval($this->input->post('refund_value'));
			$refund['refund_hours'] = intval($this->input->post('refund_hours'));
			$refund['refund_reason'] = $this->input->post('refund_reason');
			$refund['consultant_id'] = $this->input->post('consultant_id');
			$refund['supervisor_id'] = $this->input->post('supervisor_id');
			$refund['teacher_id'] = $this->input->post('teacher_id');
			//责任人
			$refund['consultant'] = $this->input->post('consultant');
			$refund['supervisor'] = $this->input->post('supervisor');
			$refund['teacher'] = $this->input->post('teacher');
			$refund['respons_cons_id'] = ($refund['consultant'] == '1') ? $refund['consultant_id'] : '';
			$refund['respons_supe_id'] = ($refund['supervisor'] == '1') ? $refund['supervisor_id'] : '';
			$refund['respons_teac_id'] = ($refund['teacher'] == '1') ? $refund['teacher_id'] : '';
			
			if(empty($refund['contract_id']) || empty($refund['contract_staff_id']) || empty($refund['refund_value']) || empty($refund['refund_hours']) || empty($refund['refund_reason']) || empty($refund['consultant_id']) || empty($refund['supervisor_id']) || empty($refund['teacher_id']))
			{
				$notify = '请填写完整退费信息';
				$this->_load_contract_refund_view($notify, $refund);
			}
			else
			{
				//add into DB
				if($this->CRM_Contract_model->add_refund($refund))
				{
					//@TODO: 单个学员页.
					show_result_page('新退费已经添加成功! ', 'admin/contract/one/'.$refund['contract_id'].'/refund');
				}
				else
				{
					$notify = '新退费添加失败, 请重试.';
					$this->_load_contract_refund_view($notify, $refund);
				}
			}
		}
	}
	
	function finished_add()
	{
		if(isset($_POST['submit']) && !empty($_POST['submit']))
		{
			//必填信息.
			$finished['contract_id'] = $this->input->post('contract_id');
			$finished['supervisor_id'] = $this->input->post('supervisor_id');
			$finished['teacher_id'] = $this->input->post('teacher_id');
			$finished['finished_hours'] = floatval($this->input->post('finished_hours'));
			
			//ndedu后台1.2.2新加信息
			$finished['start_time'] = $this->input->post('date').' '.$this->input->post('start_hour').':'.$this->input->post('start_mins').':00';
			$finished['end_time'] = $this->input->post('date').' '.$this->input->post('end_hour').':'.$this->input->post('end_mins').':00';
			$finished['subject_id'] = $this->input->post('subject_id');
			
			//ndedu1.2.3 取消班主任角色
			//if(empty($finished['contract_id']) || empty($finished['supervisor_id']) || empty($finished['teacher_id'])|| empty($finished['finished_hours']))
			
			if(empty($finished['contract_id']) || empty($finished['teacher_id'])|| empty($finished['finished_hours']))
			{
				$notify = '请填写完整完成课程信息';
				$this->_load_contract_finished_view($notify, $finished);
			}
			elseif(empty($finished['start_time']) || empty($finished['end_time']) || empty($finished['subject_id']))
			{
				$notify = '请填写完整完成课程信息';
				$this->_load_contract_finished_view($notify, $finished);
			}
			else
			{
				//获取contract信息.
				$contract_info = $this->CRM_Contract_model->get_one_contract($finished['contract_id']);
				
				if($finished['finished_hours'] > ($contract_info['total_hours'] - $contract_info['finished_hours']))
				{
					$notify = '您填写的剩余课时数大于总剩余课时数！';
					$this->_load_contract_finished_view($notify, $finished);
					return false;
				}
				
				
				//add into DB
				if($this->CRM_Contract_model->add_finished($finished))
				{
					//更新contract finished_hour 字段
					$this->CRM_Contract_model->update_finished_hour($finished['contract_id'], $finished['finished_hours']);
					
					//@TODO: 单个学员页.
					show_result_page('新完成课程已经添加成功! ', 'admin/contract/one/'.$finished['contract_id'].'/finished');
				}
				else
				{
					$notify = '新完成课程添加失败, 请重试.';
					$this->_load_contract_finished_view($notify, $finished);
				}
			}
		}
	}
	
	/* 
	 * 访问权限: 全部角色
	*/
	function one($contract_id = 0, $type = 'finished')
	{
		//判断contract_id是否合法.
		$contract_id = intval($contract_id);
		if($contract_id <= 0)
		{
			show_error_page('您输入的合同ID不合法, 请返回重试.', 'admin/student');
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
		
		//开始展示
		switch($type)
		{
			case 'refund':
				$contract_info['refund'] = $this->CRM_Contract_model->get_one_all_refund($contract_id);
				$data['main']['teachers'] = $this->CRM_Staff_model->get_all_by_group(GROUP_TEACHER_PARTTIME);
				$meta_title = '退费信息';
				$template = 'contract_one_refund';
				break;
			case 'finished':
			default:
				$contract_info['finished'] = $this->CRM_Contract_model->get_one_all_finished($contract_id);
				$data['main']['staffs'] = $this->CRM_Staff_model->get_all_by_group();
				$meta_title = '已学完课程';
				$template = 'contract_one_finished';
				break;
		}
		
		$data['header']['meta_title'] = $meta_title.' - 合同管理 - 管理学员';
		$data['main']['student'] = $student_info;
		$data['main']['contract'] = $contract_info;
		_load_viewer($this->staff_info['group_id'], $template, $data);
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
	
	function finished_edit($finished_id = 0, $student_id = 0)
	{
		//判断student_id是否合法.
		$finished_id = (empty($finished_id))? $this->input->post('finished_id') : intval($finished_id);
		$student_id = (empty($student_id))? $this->input->post('student_id') : intval($student_id);
		if($finished_id <= 0 || $student_id <= 0)
		{
			show_error_page('您输入的ID不合法, 请返回重试.', '');
			return false;
		}
		
		//获取contract信息.
		$finished_info = $this->CRM_Contract_model->get_one_finished($finished_id);
		//获取student信息.
		$student_info = $this->CRM_Student_model->getOne($student_id);
		
		//检查权限
		if(empty($finished_info) || empty($student_info))
		{
			show_error_page('您所查询的完成课时不存在不存在!', 'admin/student');
			return false;
		}
		
		//access_control
		$this->admin_ac_contract->contract_finished_manage();
		
		if(isset($_POST['submit']) && !empty($_POST['submit']))
		{
			//必填信息.
			$finished_edit['teacher_id'] = $this->input->post('teacher_id');
			$finished_edit['finished_hours'] = floatval($this->input->post('finished_hours'));
			
			//ndedu后台1.2.2新加信息
			$finished_edit['start_time'] = $this->input->post('date').' '.$this->input->post('start_hour').':'.$this->input->post('start_mins').':00';
			$finished_edit['end_time'] = $this->input->post('date').' '.$this->input->post('end_hour').':'.$this->input->post('end_mins').':00';
			$finished_edit['subject_id'] = $this->input->post('subject_id');
			
			//检查修改项
			$update_field = array();
			foreach($finished_edit as $key => $val)
			{
				if(!empty($val) && ($val != $finished_info[$key]))
					$update_field[$key] = $val;
			}
			
			if($this->CRM_Contract_model->finished_update($finished_id, $update_field))
			{
				//如果有更新完成时间，则更新contract表
				if(isset($update_field['finished_hours']))
					$this->CRM_Contract_model->update_finished_hour($finished_id, ($finished_edit['finished_hours'] - $finished_info['finished_hours']));
				
				show_result_page('完成课时已经更新成功! ', 'admin/contract/one/'.$finished_info['contract_id']);
			}
			else
			{
				$notify = '更新失败, 请重试.';
				$this->_load_finished_edit_view($notify, $contract_info, $student_info);
			}
		}
		else
		{
			$this->_load_finished_edit_view('', $finished_info, $student_info);
		}
	}
	
	function finished_del($finished_id = 0, $student_id = 0)
	{
		//判断student_id是否合法.
		$finished_id = (empty($finished_id))? $this->input->post('finished_id') : intval($finished_id);
		$student_id = (empty($student_id))? $this->input->post('student_id') : intval($student_id);
		if($finished_id <= 0 || $student_id <= 0)
		{
			show_error_page('您输入的ID不合法, 请返回重试.', '');
			return false;
		}
		
		//获取contract信息.
		$finished_info = $this->CRM_Contract_model->get_one_finished($finished_id);
		//获取student信息.
		$student_info = $this->CRM_Student_model->getOne($student_id);
		
		//检查权限
		if(empty($finished_info) || empty($student_info))
		{
			show_error_page('您所查询的完成课时不存在不存在!', 'admin/student');
			return false;
		}
		
		//access_control
		$this->admin_ac_contract->contract_finished_manage();
		
		//删除
		if($this->CRM_Contract_model->finished_delete($finished_id))
		{
			$this->CRM_Contract_model->update_finished_hour($finished_id, (-$finished_info['finished_hours']));
			show_result_page('完成课时已经删除! ', 'admin/contract/one/'.$finished_info['contract_id']);
		}
		else
		{
			show_error_page('完成课时删除失败, 请重试!', 'admin/contract/one/'.$finished_info['contract_id']);
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
	
	
	function _load_finished_edit_view($notify, $finished_info, $student_info)
	{
		$data['header']['meta_title'] = '编辑已完成课时 - 管理学员';
		$data['header']['css_file'] = '../calendar.css';
		$data['footer']['js_file'] = '../calendar.js';
		$data['main']['finished_info'] = $finished_info;
		$data['main']['student'] = $student_info;
		$data['main']['notification'] = $notify;
		$data['main']['staffs'] = $this->CRM_Staff_model->get_all_by_group(array(GROUP_CONSULTANT, GROUP_CONSULTANT_PARTTIME, GROUP_TEACHER_PARTTIME, GROUP_TEACHER_FULL, GROUP_SUYANG, GROUP_TEACHER_D, GROUP_CONSULTANT_D, GROUP_SUYANG_D));
		$data['main']['subjects'] = $this->CRM_Subject_model->getAll();
		_load_viewer($this->staff_info['group_id'], 'finished_edit', $data);
	}
}
/* End of file admin.php */
/* Location: ./system/application/controllers/admin.php */
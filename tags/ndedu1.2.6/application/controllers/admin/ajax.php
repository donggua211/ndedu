<?php
/* 
  用户登录, 退出等功能.
  公共权限
 */
class Ajax extends Controller {

	function Ajax()
	{
		parent::Controller();
		$this->load->model('CRM_contract_model');
		$this->load->model('CRM_Region_model');
		$this->load->model('CRM_Staff_model');
		$this->load->model('CRM_Student_model');
		$this->load->model('CP_card_model');
		$this->load->model('CP_quan_model');
		$this->load->model('guestbook_model');
		$this->load->model('CRM_History_model');
		$this->load->model('CRM_Timetable_model');
		$this->load->model('CRM_Staff_Schedule_model');
		
		$this->load->library('Services_JSON');
	}
	
	function region($parent, $type, $target)
	{
		$arr['regions'] = $this->CRM_Region_model->get_regions($type, $parent);
		$arr['type']    = $type;
		$arr['target']  = htmlspecialchars($target);
		echo $this->services_json->encode($arr);
		//print_r($this->services_json->decode($arr, 1));
	}
	
	function check_staff_username()
	{
		$username = $this->input->myPost('username');
		if($username == FAlSE)
		{
			echo 'warning: empty username';
		}
		else
		{
			if($this->CRM_Staff_model->username_has_exist($username))
			{
				echo 'yes';
			}
			else
			{
				echo 'no';
			}
		}
	}
	
	function gen_batch()
	{
		do
		{
			$batch = mt_rand(1000, 9999);
		}
		while($this->CP_card_model->check_batch_exist($batch));
		
		echo $batch;
	}
	
	function last_batch()
	{
		echo $this->CP_card_model->get_last_batch();
	}
	
	function last_quan_batch()
	{
		echo $this->CP_quan_model->get_last_batch();
	}
	
	function update_guestboot_status()
	{
		$status = $this->input->Post('status');
		$message_id = $this->input->Post('message_id');		
		$this->guestbook_model->updataMessage($message_id, array('status' => $status));
	}
	
	function student_mark_star()
	{
		$student_id = $this->input->Post('student_id');		
		$mark_star = $this->input->Post('val');
		$this->CRM_Student_model->update($student_id, array('mark_star' => $mark_star), false);
	}
	
	/*
	 * 根据staff_id，检查剩余课时小于10的学员数目。
	*/
	function count_less_10_hours()
	{
		//获取该员工名下的学生.
		$staff_id = $this->input->Post('staff_id');
		$filter['cservice_id'] = $staff_id;
		$students = $this->CRM_Student_model->getAll($filter);
		
		foreach($students as $val)
			$student_id[] = $val['student_id'];
		
		//获取学生的合同信息
		$contracts = $this->CRM_contract_model->get_active_contracts($student_id);
		
		$count = 0;
		foreach($contracts as $val)
		{
			if( ($val['total_hours'] - $val['finished_hours']) <= WARNING_REMAIN_HOURS)
				$count++;
		}
		echo $count;
	}
	
	/*
	 * 根据staff_id，检查是否有暂停课程要到期了。
	*/
	function timetable_unsuspend_warn()
	{
		$staff_id = $this->input->Post('staff_id');
		
		//获取该老师暂停的课程表
		$timetables = $this->CRM_Timetable_model->get_timetable_suspend_log($staff_id);
		
		$count = 0;
		foreach($timetables as $val)
		{
			if($val['unsuspend_date'] != '0000-00-00')
				continue;
			
			list($y, $m, $d) = explode('-', $val['suspend_date']);
			$should_unsuspend_t = mktime(0, 0, 0, $m, $d, $y) + 60 * 60 * 24 * $val['suspend_days'];
			if(date('Y-m-d', $should_unsuspend_t) == date('Y-m-d'))
				$count++;
		}
		echo $count;
	}
	
	function get_contracts()
	{
		$student_id = $this->input->Post('student_id');
		$contracts = $this->CRM_contract_model->get_contracts($student_id);
		
		foreach($contracts as $val)
		{
			//$arr[] = '{"contract_id":"'.$val['contract_id'].'",'.'"start_time":"'.$val['start_time'].'",'.'"end_time":"'.$val['end_time'].'"}';
			
			$arr[$val['contract_id']]['contract_id'] = $val['contract_id'];
			$arr[$val['contract_id']]['start_time'] = $val['start_time'];
			$arr[$val['contract_id']]['end_time'] = $val['end_time'];
		}
		
		echo $this->services_json->encode($arr);
	}
	
	function get_contact_history()
	{
		$student_id = $this->input->Post('student_id');
		$contact_history = $this->CRM_History_model->get_last3_contact_history($student_id);
		
		if(empty($contact_history))
		{
			echo '-1';
			return false;
		}
		
		foreach($contact_history as $val)
		{
			//$arr[] = '{"contract_id":"'.$val['contract_id'].'",'.'"start_time":"'.$val['start_time'].'",'.'"end_time":"'.$val['end_time'].'"}';
			
			$arr[$val['history_contact_id']]['history_contact'] = $val['history_contact'];
			$arr[$val['history_contact_id']]['add_time'] = $val['add_time'];
		}
		
		echo urldecode($this->services_json->encode($arr));
	}
	
	function count_staff_finished_hours()
	{
		$staff_id = $this->input->Post('staff_id');
		$result = $this->CRM_contract_model->get_classes_by_staff($staff_id);
		echo (!empty($result)) ? $result['sum'] : 0;
	}
	
	function check_timetable()
	{
		$subject_id = $this->input->Post('subject_id');
		$day = $this->input->Post('day');
		$student_id = $this->input->Post('student_id');
		$staff_id = $this->input->Post('staff_id');
		$s_t = $this->input->Post('s_t').':00';
		$e_t = $this->input->Post('e_t').':00';
		
		$timetable = $this->CRM_Timetable_model->check_timetable($student_id, $staff_id);
		
		if(!isset($timetable[$day]))
			echo 'OK';
		else
		{
			foreach($timetable[$day] as $val)
				if( $s_t >= $val['end_time'] || $e_t <= $val['start_time'] )
					continue;
				else
				{
					//素养课不对老师时间做判断。
					if($subject_id == 2 && ($val['staff_id'] == $staff_id && $val['student_id'] != $student_id))
						return true;
					
					if($val['staff_id'] == $staff_id)
					{
						echo '该老师的时间有冲突！该老师的上课时间为：星期'.$val['day'].'，'.$val['start_time'].'至'.$val['end_time'];
					}
					else
						echo '该学生的时间有冲突！该学生的上课时间为：星期'.$val['day'].'，'.$val['start_time'].'至'.$val['end_time'];
					return false;
				}
			
			echo 'OK';
		}
	}
	
	function update_schedule()
	{
		$staff_id = $this->input->Post('staff_id');
		$type = $this->input->Post('type');
		$schedule = $this->input->Post('schedule');
		$status = $this->input->Post('status');
		
		//获取时间表
		$result = $this->CRM_Staff_Schedule_model->get_staff_schedule($staff_id);
		if(empty($result))
			$my_schedule = array_fill(1, 7, array_fill(8, 15, SCHEDULE_UNAVAILABLE));
		else
			$my_schedule = unserialize($result['staff_schedule']);
		
		switch($type)
		{
			case 'day':
				$day = $schedule;
				$my_schedule[$day] = array_fill(8, 15, $status);
				break;
			case 'hour':
				$hour = $schedule;
				for($day = 1; $day <= 7; $day++)
					$my_schedule[$day][$hour] = $status;
				break;
			case 'day_hour':
				list($day, $hour) = explode('_', $schedule);
				$my_schedule[$day][$hour] = $status;
				break;
			default:
				echo urldecode($this->services_json->encode(array('result' => 'NG')));
				break;
		}
		
		
		
		//update schedule 表
		$update_field['staff_schedule'] = serialize($my_schedule);
		if(!$this->CRM_Staff_Schedule_model->update($staff_id, $update_field))
		{
			echo urldecode($this->services_json->encode(array('result' => 'NG')));
			return false;
		}
		
		//获取课程表
		$result = $this->CRM_Timetable_model->get_staff_timetable($staff_id);
		if(!empty($result))
		{
			foreach($result as $day => $val)
				foreach($val as $one)
				{
					list($s_h, ,) = explode(':', $one['start_time']);
					list($e_h, $e_m,) = explode(':', $one['end_time']);
					
					$s_h = (int)$s_h;
					$e_h = ($e_m == '00') ? (int)$e_h - 1 : $e_h;
					
					for(;$s_h <= $e_h; $s_h++ )
					{
						if($my_schedule[$day][$s_h] == SCHEDULE_AVAILABLE)
							$my_schedule[$day][$s_h] = 2;
					}
				}
		}
		
		echo urldecode($this->services_json->encode(array('result' => 'OK', 'schedule' => $my_schedule)));
	}
	
	function update_student_teacher()
	{
		$student_id = $this->input->Post('student_id');
		$staff_id = $this->input->Post('staff_id');
		$type = $this->input->Post('type');
		$action = $this->input->Post('action');
		
		if($action == 'del')
			$result = $this->CRM_Student_model->delete_student_teacher($student_id, $staff_id, $type);
		elseif($action == 'add')
			$result = $this->CRM_Student_model->insert_student_teacher($student_id, $staff_id, $type);
		else
			$result = false;
		
		if($result)
			echo 'OK';
		else
			echo 'NG';
	}
}

/* End of file admin.php */
/* Location: ./system/application/controllers/admin.php */
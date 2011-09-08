<?php
class CRM_Contract_model extends Model {

	function CRM_Contract_model()
	{
		parent::Model();
	}
	
	function add_contract($contract)
	{
		//必填项
		$data['student_id'] = $contract['student_id'];
		$data['staff_id'] = $contract['staff_id'];
		$data['start_time'] = $contract['start_time'];
		$data['end_time'] = $contract['end_time'];
		$data['total_hours'] = $contract['total_hours'];
		$data['contact_value'] = $contract['contact_value'];
		$data['deposit'] = $contract['deposit'];
		
		$data['status'] = CONTRACT_STATUS_AVAILABLE;
		
		$data['add_time'] = date('Y-m-d H:i:s');
		$data['update_time'] = date('Y-m-d H:i:s');
		if($this->db->insert('crm_contract', $data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function add_refund($refund)
	{
		//必填项
		$data['contract_id'] = $refund['contract_id'];
		$data['consultant_id'] = $refund['consultant_id'];
		$data['supervisor_id'] = $refund['supervisor_id'];
		$data['teacher_id'] = $refund['teacher_id'];
		$data['refund_value'] = $refund['refund_value'];
		$data['refund_hours'] = $refund['refund_hours'];
		$data['refund_reason'] = $refund['refund_reason'];
		
		$data['respons_cons_id'] = intval($refund['respons_cons_id']);
		$data['respons_supe_id'] = intval($refund['respons_supe_id']);
		$data['respons_teac_id'] = intval($refund['respons_teac_id']);
		
		$data['add_time'] = date('Y-m-d H:i:s');
		$data['update_time'] = date('Y-m-d H:i:s');
		if($this->db->insert('crm_contract_refund', $data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	function add_finished($finished)
	{
		//必填项
		$data['contract_id'] = $finished['contract_id'];
		$data['supervisor_id'] = $finished['supervisor_id'];
		$data['teacher_id'] = $finished['teacher_id'];
		$data['finished_hours'] = $finished['finished_hours'];
		
		//ndedu1.2.2 新加项
		$data['start_time'] = $finished['start_time'];
		$data['end_time'] = $finished['end_time'];
		$data['subject_id'] = $finished['subject_id'];
		
		$data['add_time'] = date('Y-m-d H:i:s');
		$data['update_time'] = date('Y-m-d H:i:s');
		if($this->db->insert('crm_contract_finished', $data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function get_contracts($student_id)
	{
		//获取合同列表信息
		$sql = "SELECT contract.*, staff.name FROM " . $this->db->dbprefix('crm_contract') . " as contract, " . $this->db->dbprefix('crm_staff') . " as staff
				WHERE student_id = $student_id
				AND contract.staff_id = staff.staff_id
				ORDER BY add_time DESC";
		
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
		{
			foreach ($query->result_array() as $row)
			{
				$contracts[$row['contract_id']] = $row;
				$contract_id[] = $row['contract_id'];
			}
		}
		else
		{
			return array();
		}
		
		$contract_string = implode(",", $contract_id);

		//获取退费的信息.
		$sql = "SELECT contract_id, sum(refund_hours) as refund_hours, sum(refund_value) as refund_value  FROM " . $this->db->dbprefix('crm_contract_refund') . "
				WHERE contract_id IN ( " . $contract_string . " )
				GROUP BY contract_id";
		
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
		{
			foreach ($query->result_array() as $row)
			{
				$contracts[$row['contract_id']]['refund_hours'] = $row['refund_hours'];
				$contracts[$row['contract_id']]['refund_value'] = $row['refund_value'];
			}
		}
		
		//获取已完成合同的信息.
		$sql = "SELECT contract_id, sum(finished_hours ) as finished_hours FROM " . $this->db->dbprefix('crm_contract_finished') . "
				WHERE contract_id IN ( " . $contract_string . " )
				GROUP BY contract_id";
		
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
		{
			foreach ($query->result_array() as $row)
			{
				$contracts[$row['contract_id']]['finished_hours'] = $row['finished_hours'];
			}
		}
		
		//处理空的: refund_hours, refund_value, finished_hours
		foreach($contracts as $contract_id => $value)
		{
			if(!isset($value['refund_hours']) || empty($value['refund_hours']))
				$contracts[$contract_id]['refund_hours'] = 0;
			if(!isset($value['refund_value']) || empty($value['refund_value']))
				$contracts[$contract_id]['refund_value'] = 0;
			if(!isset($value['finished_hours']) || empty($value['finished_hours']))
				$contracts[$contract_id]['finished_hours'] = 0;
		}
		
		return $contracts;
	}
	
	function get_one_contract($contract_id)
	{
		//获取合同列表信息
		$sql = "SELECT contract.*, staff.name FROM " . $this->db->dbprefix('crm_contract') . " as contract, " . $this->db->dbprefix('crm_staff') . " as staff
				WHERE contract.contract_id = $contract_id
				AND contract.staff_id = staff.staff_id
				LIMIT 1";
		
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
		{
			return $query->row_array();
		}
		else
		{
			return array();
		}
	}
	
	function get_one_all_finished($contract_id)
	{
		//获取合同列表信息
		$sql = "SELECT contract_finished.*, supervisor.name as supervisor_name, teacher.name as teacher_name, subject.subject_name FROM " . $this->db->dbprefix('crm_contract_finished') . " as contract_finished
				LEFT JOIN ".$this->db->dbprefix('crm_staff')." as supervisor ON supervisor.staff_id =  contract_finished.supervisor_id
				LEFT JOIN ".$this->db->dbprefix('crm_staff')." as teacher ON teacher.staff_id =  contract_finished.teacher_id
				LEFT JOIN ".$this->db->dbprefix('crm_subject')." as subject ON subject.subject_id =  contract_finished.subject_id
				WHERE contract_finished.contract_id = $contract_id
				ORDER BY start_time DESC";
		
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
	}
	
	function get_one_all_refund($contract_id)
	{
		//获取合同列表信息
		$sql = "SELECT contract_refund.*, consultant.name as consultant_name, supervisor.name as supervisor_name, teacher.name as teacher_name FROM " . $this->db->dbprefix('crm_contract_refund') . " as contract_refund
				LEFT JOIN ".$this->db->dbprefix('crm_staff')." as consultant ON consultant.staff_id =  contract_refund.respons_cons_id
				LEFT JOIN ".$this->db->dbprefix('crm_staff')." as supervisor ON supervisor.staff_id =  contract_refund.respons_supe_id
				LEFT JOIN ".$this->db->dbprefix('crm_staff')." as teacher ON teacher.staff_id =  contract_refund.respons_teac_id
				WHERE contract_refund.contract_id = $contract_id
				ORDER BY add_time DESC";
		
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
	}
	
	function update($contract_id, $update_field = array())
	{
		if(empty($update_field))
			return true;
		
		//更新student表
		foreach($update_field as $key => $val)
		{
			if($val != 'consultant' || $val != 'supervisor')
				$data[$key] = $val;
		}
		$data['update_time'] = date('Y-m-d H:i:s');
		
		$this->db->where('contract_id', $contract_id);
		if(!$this->db->update('crm_contract', $data))
		{
			return false;
		}
		
		return true;
	}
	
	//根据学员id，获取指定学员列表的最新合同信息。
	function get_active_contracts($student_ids)
	{
		if(!is_array($student_ids))
			$student_ids = array($student_ids);
		
		//获取合同列表信息
		$sql = "SELECT contract.* FROM " . $this->db->dbprefix('crm_contract') . " as contract
				WHERE contract.student_id in ( ".implode (',', $student_ids)." )
				AND contract.status = ".CONTRACT_STATUS_AVAILABLE;
		
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
	}
	
	function get_classes_by_staff($staff_id)
	{
		//获取合同列表信息
		$sql = "SELECT SUM(`finished_hours`) as sum
				FROM " . $this->db->dbprefix('crm_contract_finished') . "
				WHERE `teacher_id` = $staff_id
				GROUP BY `teacher_id`";
		
		$query = $this->db->query($sql);
		return $query->row_array();
	}
	
	function get_one_finished_class_detail($staff_id, $filter = array())
	{
		$where = '';
		//添加的时间段: 开始时间
        if (isset($filter['class_start_time']) && $filter['class_start_time'])
        {
            $where .= " AND start_time >= '{$filter['class_start_time']} 00:00:00' ";
        }
		//添加的时间段: 结束时间
		if (isset($filter['class_end_time']) && $filter['class_end_time'])
        {
            $where .= " AND start_time <= '{$filter['class_end_time']} 23:59:59' ";
        }
		
		//获取合同列表信息
		$sql = "SELECT * 
				FROM " . $this->db->dbprefix('crm_contract_finished') . "
				WHERE `teacher_id` = $staff_id ".$where;
		
		$query = $this->db->query($sql);
		
		if ($query->num_rows() > 0)
		{
			$result = array();
			
			foreach($query->result_array() as $key => $val)
			{
				$result[$key] = $val;
				$result[$key]['grade'] = $this->_get_student_grade($val['contract_id']);
			}
			
			return $result;
		}
		else
		{
			return array();
		}
	}
	
	function _get_student_grade($contract_id)
	{
		static $contract_grade;
		
		if(!isset($contract_grade[$contract_id]))
		{
			//获取合同id对应学院信息
			$sql = "SELECT student.grade_id 
			FROM " . $this->db->dbprefix('crm_contract') . " as contract
			LEFT JOIN " . $this->db->dbprefix('crm_student') . " as student on student.student_id = contract.student_id
			WHERE contract.`contract_id` = ".$contract_id;
			
			//$query = $this->db->query($sql)->row_array();
			$tmp = $this->db->query($sql)->row_array();
			$contract_grade[$contract_id] =  substr($tmp['grade_id'], 0, 1);
		}
		return $contract_grade[$contract_id];
	}
	
	function update_finished_hour($contract_id, $finished_hour)
	{
		//获取合同列表信息
		$sql = "UPDATE ". $this->db->dbprefix('crm_contract') . "
				SET finished_hours = (finished_hours + $finished_hour)
				WHERE `contract_id` = $contract_id
				LIMIT 1";
		
		$query = $this->db->query($sql);
		return ($this->db->affected_rows() > 0) ? true : false;
	}
}

/* End of file admin.php */
/* Location: ./system/application/controllers/admin.php */
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
		$sql = "SELECT contract_finished.*, supervisor.name as supervisor_name, teacher.name as teacher_name FROM " . $this->db->dbprefix('crm_contract_finished') . " as contract_finished
				LEFT JOIN ".$this->db->dbprefix('crm_staff')." as supervisor ON supervisor.staff_id =  contract_finished.supervisor_id
				LEFT JOIN ".$this->db->dbprefix('crm_staff')." as teacher ON teacher.staff_id =  contract_finished.teacher_id
				WHERE contract_finished.contract_id = $contract_id
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
}

/* End of file admin.php */
/* Location: ./system/application/controllers/admin.php */
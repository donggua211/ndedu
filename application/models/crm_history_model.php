<?php
class CRM_History_model extends Model {

	function CRM_History_model()
	{
		parent::Model();
		
		$this->types = array('learning', 'contact', 'callback', 'consult', 'suyang');
	}
	
	function _check_history_type($history_type)
	{
		//判断history type.
		return in_array($history_type, $this->types);
	}
	
	function add_history($history, $history_type)
	{
		if(!$this->_check_history_type($history_type))
			return false;
		
		$table = 'crm_history_'.$history_type;
		
		//必填项
		$data['student_id'] = $history['student_id'];
		$data['staff_id'] = $history['staff_id'];
		$data['history_'.$history_type] = $history['history'];
		
		$data['is_delete'] = 0;
		$data['add_time'] = date('Y-m-d H:i:s');
		$data['update_time'] = date('Y-m-d H:i:s');
		if($this->db->insert($table, $data))
		{
			//更新crm_student的update_time
			$this->_update_student_updatetime($history['student_id']);
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function get_histories($student_id)
	{
		foreach($this->types as $type)
			$result['history_'.$type] = $this->_get_history($student_id, $type);
		return $result;
	}
	
	function get_history_learning($student_id)
	{
		return $this->_get_history($student_id, 'learning');
	}
	
	function get_history_contact($student_id)
	{
		return $this->_get_history($student_id, 'contact');
	}
	
	function _get_history($student_id, $history_type)
	{
		if(!$this->_check_history_type($history_type))
			return false;
		
		$table = 'crm_history_'.$history_type;
		
		$sql = "SELECT history.*, staff.name FROM " . $this->db->dbprefix($table) . " as history, " . $this->db->dbprefix('crm_staff') . " as staff
				WHERE student_id = $student_id	
				AND history.is_delete = 0
				AND staff.staff_id = history.staff_id
				ORDER BY add_time";
		
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
	
	function get_one_history_learning($history_id)
	{
		return $this->_get_one_history($history_id, 'learning');
	}
	
	function get_one_history_contact($history_id)
	{
		return $this->_get_one_history($history_id, 'contact');
	}
	
	function _get_one_history($history_id, $history_type)
	{
		if(!$this->_check_history_type($history_type))
			return false;
		
		$primary_key = 'history_'.$history_type.'_id';
		$history_text = 'history_'.$history_type;
		$table = 'crm_history_'.$history_type;
		
		$sql = "SELECT $primary_key as history_id, student_id, staff_id, $history_text as history_text FROM " . $this->db->dbprefix($table) . " as history
				WHERE $primary_key = $history_id	
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
	
	function _update($history_id, $history_type, $update_field = array())
	{
		if(empty($update_field))
			return true;
		
		if(!$this->_check_history_type($history_type))
			return false;
		
		$primary_key = 'history_'.$history_type.'_id';
		$table = 'crm_history_'.$history_type;
		
		//更新student表
		foreach($update_field as $key => $val)
		{
			$data[$key] = $val;
		}
		$data['update_time'] = date('Y-m-d H:i:s');
		
		$this->db->where($primary_key, $history_id);
		if(!$this->db->update($table, $data))
		{
			return false;
		}
		return true;
	}
	
	function _update_student_updatetime($student_id)
	{
		$data['update_time'] = date('Y-m-d H:i:s');
		
		$this->db->where('student_id', $student_id);
		if(!$this->db->update('crm_student', $data))
		{
			return false;
		}
		
		return true;
	
	}
}

/* End of file admin.php */
/* Location: ./system/application/controllers/admin.php */
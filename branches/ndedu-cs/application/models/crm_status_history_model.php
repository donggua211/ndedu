<?php
class CRM_Status_history_model extends Model {

	function CRM_Status_history_model()
	{
		parent::Model();
	}
	
	function getOne($status_history_id)
	{
		$sql = "SELECT *
				FROM " . $this->db->dbprefix('crm_student_status_history') . "
				WHERE status_history_id = " . $status_history_id . "
				LIMIT 1";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
		{
			return $query->row_array();
		}
	}
	
	function getAll($student_id)
	{
		$sql = "SELECT *
				FROM " . $this->db->dbprefix('crm_student_status_history') . "
				WHERE student_id = " . $student_id . "
				ORDER BY add_time DESC ";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
	}
	
	function delete($status_history_id)
	{
		$this->db->where('status_history_id', $status_history_id);
		$this->db->delete('crm_student_status_history'); 
		return ($this->db->affected_rows() > 0 ) ? TRUE : FALSE;
	}
}
?>
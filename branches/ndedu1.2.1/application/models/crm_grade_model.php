<?php
class CRM_Grade_model extends Model {

	function CRM_Grade_model()
	{
		parent::Model();
	}
	
	function get_grades($type = 0, $parent_id = 0)
	{
		$sql = "SELECT grade_id, grade_name FROM " . $this->db->dbprefix('crm_grade') . "
				WHERE grade_type = $type ";
		if($parent_id > 0)
			$sql .= "AND parent_id = $parent ";
		$sql .= " ORDER BY grade_id";
		
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
}
?>
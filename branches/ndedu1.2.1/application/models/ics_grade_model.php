<?php
class ICS_Grade_model extends Model {

	function ICS_Grade_model()
	{
		parent::Model();
	}
	
	function get_all_grade()
	{
		$sql = "SELECT *
				FROM " . $this->db->dbprefix('ics_grade') . "
				WHERE parent_id = 0";
		
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

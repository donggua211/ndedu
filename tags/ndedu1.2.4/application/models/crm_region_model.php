<?php
class CRM_Region_model extends Model {

	function CRM_Region_model()
	{
		parent::Model();
	}
	
	function get_regions($type = 1, $parent = 0)
	{
		$sql = "SELECT region_id, region_name FROM " . $this->db->dbprefix('crm_region') . "
				WHERE region_type = $type
				AND parent_id = $parent
				ORDER BY region_id";
		
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
	
	function get_one_region($region_id)
	{
		$sql = "SELECT region_name FROM " . $this->db->dbprefix('crm_region') . "
				WHERE region_id = $region_id
				LIMIT 1";
		
		$query = $this->db->query($sql);
		
		if ($query->num_rows() > 0)
		{
			$result = $query->row_array();
			return $result['region_name'];
		}
		else
		{
			return array();
		}
	}
}
?>
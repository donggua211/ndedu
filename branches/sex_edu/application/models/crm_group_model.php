<?php
class CRM_Group_model extends Model {

	function CRM_Group_model()
	{
		parent::Model();
	}
	
	function get_groups($group_id = 0)
	{
		$sql = "SELECT group_id, group_name FROM " . $this->db->dbprefix('crm_group') ."
				WHERE group_id >= $group_id
				ORDER BY `order`";
		
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
	
	function get_all_department()
	{
		$sql = "SELECT group_id, group_name FROM " . $this->db->dbprefix('crm_group') ."
				WHERE group_name LIKE '%主管'";
		
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
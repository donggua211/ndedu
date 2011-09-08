<?php
class CRM_Branch_model extends Model {

	function CRM_Branch_model()
	{
		parent::Model();
	}
	
	function get_branches()
	{
		$sql = "SELECT branch_id, branch_name FROM " . $this->db->dbprefix('crm_branch') . " ORDER BY branch_id";
		
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
	
	function get_one_branch($branch_id)
	{
		$sql = "SELECT branch_id, branch_name FROM " . $this->db->dbprefix('crm_branch') . "
				WHERE branch_id = {$branch_id}";
		
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
}

/* End of file admin.php */
/* Location: ./system/application/controllers/admin.php */
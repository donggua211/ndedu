<?php
class CRM_Subject_model extends Model {

	function CRM_Subject_model()
	{
		parent::Model();
	}
	
	function getAll()
	{
		//student基本信息
		$sql = "SELECT * FROM ".$this->db->dbprefix('crm_subject')." as subject";
		
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
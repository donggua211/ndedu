<?php
class CRM_Subject_model extends Model {

	function CRM_Subject_model()
	{
		parent::Model();
	}
	
	function getAll($parrent_id = 0)
	{
		//student基本信息
		$sql = "SELECT * FROM ".$this->db->dbprefix('crm_subject')." as subject ";
		
		if(!empty($parrent_id))
			$sql .= ' WHERE ( subject_id = ' . $parrent_id .' OR parrent_id = ' . $parrent_id . ')';
		
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
	
	function getAll_parrent($parrent_id = 0)
	{
		//student基本信息
		$sql = "SELECT * FROM ".$this->db->dbprefix('crm_subject')." as subject WHERE parrent_id = 0 ";
		
		if(!empty($parrent_id))
			$sql .= ' AND subject_id = ' . $parrent_id ;
		
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
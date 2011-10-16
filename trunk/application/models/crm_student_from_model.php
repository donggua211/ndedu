<?php
class CRM_Student_from_model extends Model {

	function CRM_Student_from_model()
	{
		parent::Model();
	}
	
	function get_all()
	{
		//student基本信息
		$sql = "SELECT * FROM ".$this->db->dbprefix('crm_student_from') ." ORDER BY `order`";
		
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

/* End of file admin.php */
/* Location: ./system/application/controllers/admin.php */
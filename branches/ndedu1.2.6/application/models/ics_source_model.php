<?php
class ICS_Source_model extends Model {

	function ICS_Source_model()
	{
		parent::Model();
	}
	
	function get_all_source()
	{
		$sql = "SELECT *
				FROM " . $this->db->dbprefix('ics_source') . "
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
	
	function check_exists($source_name)
	{
		$sql = "SELECT source_id
				FROM " . $this->db->dbprefix('ics_source') . "
				WHERE source_desc = '$source_name'
				LIMIT 1";
		
		
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
		{
			$row = $query->row_array();
			return $row['source_id'];
		}
		else
		{
			return 0;
		}
	}
	
	function update($source_doc_id, $update_field = array())
	{
		if(empty($update_field))
			return true;
		
		//¸üÐÂstudent±í
		foreach($update_field as $key => $val)
		{
				$data[$key] = $val;
		}
		$data['update_time'] = date('Y-m-d H:i:s');
		
		$this->db->where('source_doc_id', $source_doc_id);
		return $this->db->update('ics_source_doc', $data);
	}
	
	function add($source_desc)
	{
		$data['source_desc'] = $source_desc;
		$data['add_time'] = date('Y-m-d H:i:s');
		$data['update_time'] = date('Y-m-d H:i:s');
		if($this->db->insert('ics_source', $data))
		{
			return $this->db->insert_id();
		}
		else
		{
			return false;
		}
	
	}
}
?>

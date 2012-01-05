<?php
class Hr_position_model extends Model {

	function Hr_position_model()
	{
		parent::Model();
	}
	
	function add($position)
	{
		/*
		 * 插入 join 表
		*/
		$data['position_name'] = $position['position_name'];
		$data['group_id'] = $position['group_id'];
		$data['add_time'] = date('Y-m-d H:i:s');
		if($this->db->insert('hr_position', $data))
		{
			return $this->db->insert_id();
		}
		else
		{
			return false;
		}
	}
	
	function get_all()
	{
		//card基本信息
		$sql = "SELECT position.*, crm_group.group_name FROM ".$this->db->dbprefix('hr_position')." as position 
				INNER JOIN ".$this->db->dbprefix('crm_group')." as crm_group ON crm_group.group_id = position.group_id ";
		
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
	
	function get_all_by_group($group_id)
	{
		//card基本信息
		$sql = "SELECT position_id FROM ".$this->db->dbprefix('hr_position')." as position 
				WHERE group_id = $group_id";
		
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
		{
			foreach($query->result_array() as $val)
				$result[] = $val['position_id'];
			return $result;
		}
		else
		{
			return array();
		}
	}
	
	function get_one($position_id)
	{
		$sql = "SELECT position.*
				FROM ".$this->db->dbprefix('hr_position')." as position
				WHERE position.position_id = $position_id
				LIMIT 1";
		
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
	
	function update($position_id, $update_field = array())
	{
		if(empty($update_field))
			return true;
		
		//更新student表
		foreach($update_field as $key => $val)
		{
			$data[$key] = $val;
		}
		
		$this->db->where('position_id', $position_id);
		if(!$this->db->update('hr_position', $data))
		{
			return false;
		}
		
		return true;
	}
	
	function delete($position_id)
	{
		$this->db->where('position_id', $position_id);
		$this->db->delete('hr_position'); 
		return ($this->db->affected_rows() > 0 ) ? TRUE : FALSE;
	}
	
}
?>

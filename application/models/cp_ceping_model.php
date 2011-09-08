<?php
class CP_ceping_model extends Model {

	function CP_ceping_model()
	{
		parent::Model();
	}
	
	function get_one($cp_id)
	{
		$sql = "SELECT *
				FROM " . $this->db->dbprefix('cp_ceping') . "
				WHERE cp_id = $cp_id
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
	
	function get_all_by_cat($cat_id)
	{
		$sql = "SELECT cp_id, cp_name, cp_des
				FROM " . $this->db->dbprefix('cp_ceping') . "
				WHERE cat_id = $cat_id ";
		
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
	
	function get_all()
	{
		$sql = "SELECT ceping.*, cat.cat_name
				FROM " . $this->db->dbprefix('cp_ceping') . " as ceping
				LEFT JOIN " . $this->db->dbprefix('cp_cat') . " as cat ON cat.cat_id = ceping.cat_id
				ORDER BY ceping.cat_id, ceping.cp_id";
		
		$query = $this->db->query($sql);
		
		if ($query->num_rows() > 0)
		{
			$result = array();
			foreach($query->result_array() as $row)
			{
				$result[$row['cat_id']][] = $row;
			}
			return $result;
		}
		else
		{
			return array();
		}
	}
	
	function add($ceping)
	{
		$data['cp_name'] = $ceping['cp_name'];
		$data['cat_id'] = $ceping['cat_id'];
		$data['cp_des'] = $ceping['cp_des'];

		$data['add_time'] = date('Y-m-d H:i:s');

		if($this->db->insert('cp_ceping', $data))
		{
			return $this->db->insert_id();
		}
		else
		{
			return false;
		}
	}
	
	function delete($category_id)
	{
		$this->db->where('category_id', $category_id);
		$this->db->delete('cp_ceping'); 
		return ($this->db->affected_rows() > 0 ) ? TRUE : FALSE;
	}
	
	function update($cp_id, $update_field = array())
	{
		if(empty($update_field))
			return true;
		
		//更新student表
		foreach($update_field as $key => $val)
		{
				$data[$key] = $val;
		}
		
		$this->db->where('cp_id', $cp_id);
		return $this->db->update('cp_ceping', $data);
	}
	
	function add_result($card_id, $result)
	{
		$sql = "INSERT INTO " . $this->db->dbprefix('cp_result') . " (card_id, result, add_time) 
				VALUES ($card_id, '$result', '".date('Y-m-d H:i:s')."')
				ON DUPLICATE KEY UPDATE add_time='".date('Y-m-d H:i:s')."'";
		
		$query = $this->db->query($sql);
		return ($this->db->affected_rows() > 0 ) ? TRUE : FALSE;
	}
	
	function get_result($card_id)
	{
		$sql = "SELECT *
				FROM " . $this->db->dbprefix('cp_result') . "
				WHERE card_id = $card_id
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
}
?>

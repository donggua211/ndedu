<?php
class CP_Category_model extends Model {

	function CP_Category_model()
	{
		parent::Model();
	}
	
	function get_one($category_id)
	{
		$sql = "SELECT *
				FROM " . $this->db->dbprefix('cp_cat') . "
				WHERE cat_id = $category_id
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
	
	function get_all_category($type=CP_CAT_TYPE_NORMAL)
	{
		$sql = "SELECT *
				FROM " . $this->db->dbprefix('cp_cat') . " as cat ";
		
		//promo cat 的话, 加载promo信息
		if($type == CP_CAT_TYPE_PROMO)
			$sql .= " LEFT JOIN " . $this->db->dbprefix('cp_cat_promo')." as promo ON promo.cat_id = cat.cat_id";
		
		if(!empty($type))
			$sql .= " WHERE cat.type = $type ";
		$sql .=	" ORDER BY cat.cat_id";
		
		$query = $this->db->query($sql);
		
		if ($query->num_rows() > 0)
		{
			$result = array();
			foreach($query->result_array() as $row)
				$result[$row['cat_id']] = $row;
			return $result;
		}
		else
		{
			return array();
		}
	}
	
	function add($category)
	{
		$data['cat_name'] = $category['cat_name'];
		$data['star'] = $category['star'];
		$data['price_advanced'] = $category['price_advanced'];
		$data['price_luxury'] = $category['price_luxury'];
		$data['des_advanced'] = $category['des_advanced'];
		$data['des_luxury'] = $category['des_luxury'];
		$data['type'] = CP_CAT_TYPE_NORMAL;
		
		$data['add_time'] = date('Y-m-d H:i:s');

		if($this->db->insert('cp_cat', $data))
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
		$this->db->delete('cp_cat'); 
		return ($this->db->affected_rows() > 0 ) ? TRUE : FALSE;
	}
	
	function update($category_id, $update_field = array())
	{
		if(empty($update_field))
			return true;
		
		//更新student表
		foreach($update_field as $key => $val)
		{
				$data[$key] = $val;
		}
		
		$this->db->where('cat_id', $category_id);
		return $this->db->update('cp_cat', $data);
	}
}
?>

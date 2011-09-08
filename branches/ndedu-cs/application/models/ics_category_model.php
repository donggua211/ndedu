<?php
class ICS_Category_model extends Model {

	function ICS_Category_model()
	{
		parent::Model();
	}
	
	function get_one($category_id)
	{
		$sql = "SELECT *
				FROM " . $this->db->dbprefix('ics_category') . "
				WHERE category_id = $category_id
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
	
	function get_all_category()
	{
		$categories = $this->_all_category_array();
		
		if (!empty($categories))
		{
			return $this->format_category($categories);
		}
		else
		{
			return array();
		}
	}
	
	function get_path_info($category_id)
	{
		$categories = $this->_all_category_array();
		$path_info = array();
		$this_category_id = $category_id;
		
		while($this_category_id > 0)
		{
			if(array_key_exists($this_category_id, $categories))
			{
				array_unshift($path_info, $categories[$this_category_id]);
				$this_category_id = $categories[$this_category_id]['parent_id'];
			}
			else
			{
				$this_category_id = 0;
			}
		}
		
		return $path_info;
	}
	
	function add($category)
	{
		$data['category_name'] = $category['name'];
		$data['parent_id'] = $category['parent'];
		$data['order'] = $category['order'];

		$data['add_time'] = date('Y-m-d H:i:s');
		$data['update_time'] = date('Y-m-d H:i:s');

		if($this->db->insert('ics_category', $data))
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
		$this->db->delete('ics_category'); 
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
		$data['update_time'] = date('Y-m-d H:i:s');
		
		$this->db->where('category_id', $category_id);
		return $this->db->update('ics_category', $data);
	}
	
	function _all_category_array()
	{
		$sql = "SELECT *
				FROM " . $this->db->dbprefix('ics_category') . "
				ORDER BY parent_id, `order` ASC";
		
		$query = $this->db->query($sql);
		
		if ($query->num_rows() > 0)
		{
			$categories = array();
			foreach ($query->result_array() as $row)
			{
				$categories[$row['category_id']] = $row;
			}
			return $categories;
		}
		else
		{
			return array();
		}
	}
	
	function format_category($category)
	{
		//过结果按照level进行分组处理.
		$level_index = 0;
		$levels = array();
		$last_level_cid_array = array(0);
		
		while (!empty($category))
		{
			$this_level_cid_array = array();
			foreach ($category AS $key => $value)
			{
				$cat_id = $value['category_id'];
				if (in_array($value['parent_id'], $last_level_cid_array))
				{
					$levels[$level_index][$cat_id] = $value;
					$levels[$level_index][$cat_id]['level'] = $level_index;
					$this_level_cid_array[] = $cat_id;
					unset($category[$key]);
				}
			}
			$last_level_cid_array = $this_level_cid_array;
			$level_index++;
		}
		
		//从level数组, 组成分类的结果.
		krsort($levels);
		
		foreach($levels as $level => &$value)
		{
			if($level == 0)
				break;
			
			foreach($value as $one)
			{
				if(!isset($levels[($level-1)][$one['parent_id']]))
					continue;
				
				$levels[($level-1)][$one['parent_id']]['sub_cat'][$one['category_id']] = $one;
			}
		}
		
		return end($levels);
	}
}
?>

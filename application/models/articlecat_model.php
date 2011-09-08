<?php
class ArticleCat_model extends Model {

	function ArticleCat_model()
	{
		parent::Model();
	}
	
	function get_all_category()
	{
		$sql = "SELECT *
				FROM " . $this->db->dbprefix('article_cat') . "
				WHERE is_deleted = 0
				ORDER BY parent_id ASC";
		
		$query = $this->db->query($sql);
		
		if ($query->num_rows() > 0)
		{
			$categories = array();
			foreach ($query->result_array() as $row)
			{
				$row['add_time'] = date('Y-m-d h:i', $row['add_time']);
				$row['modified_time'] = date('Y-m-d h:i', $row['modified_time']);
				$categories[$row['cat_id']] = $row;
			}
			return $this->array_sort($this->format_category($categories));
		}
		else
		{
			return array();
		}
	}
	
	function getCategoriesList()
	{
		$this->db->select('cat_id, cat_name, parent_id');
		$this->db->from('article_cat');
		$query = $this->db->get();

		if ($query->num_rows() > 0)
		{
			$temp_list['parrent_cat'] = $temp_list['sub_cat'] = $result = array();
			
			foreach ($query->result_array() as $row)
			{	
				if($row['parent_id'] == 0)
				{
					$temp_list['parrent_cat'][$row['cat_id']] = $row;
				}
				else
				{
					$temp_list['sub_cat'][$row['parent_id']][] = $row;
				}
			}
			
			foreach($temp_list['parrent_cat'] as $parrent_id => $parrent_info)
			{
				$result[] = $parrent_info;
				foreach($temp_list['sub_cat'][$parrent_id] as $sub_cat_id => $sub_cat_info)
				{
					$result[] = $sub_cat_info;
				}
			}
			return $result;
		}
		else
		{
			return array();
		}
	}
	
	function getOneCategory($cat_id)
	{
		$query = $this->db->get_where('article_cat', array('cat_id ' => $cat_id));
		if ($query->num_rows() > 0)
		{
			return $query->row_array();
		}
		else
		{
			return false;
		}
	}
	
	function getSubCategoris($cat_id)
	{
		$query = $this->db->get_where('article_cat', array('parent_id ' => $cat_id));
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}	
	}
	
	function addCategory($category)
	{
		$data['cat_name'] = $category['cat_name'];
		$data['cat_desc'] = $category['cat_desc'];
		
		$data['parent_id'] = $category['parent_id'];
		
		$data['add_time'] = $category['add_time'];
		$data['modified_time'] = $category['add_time'];
		$data['is_deleted'] = 0;
		
		if($this->db->insert('article_cat', $data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function updataCategory($category_id, $update_field = array())
	{
		if(empty($update_field))
			return true;
		
		//更新student表
		foreach($update_field as $key => $val)
		{
				$data[$key] = $val;
		}
		$data['modified_time'] = date('Y-m-d H:i:s');
		
		$this->db->where('cat_id', $category_id);
		return $this->db->update('article_cat', $data);
	}
	
	function format_category($category)
	{
		//过结果按照level进行分组处理.
		$level_index = 0;
		$levels = array();
		$last_level_cid_array = array(0);
		
		$break_point= 1000;
		$point = 0;
		while (!empty($category))
		{
			$this_level_cid_array = array();
			foreach ($category AS $key => $value)
			{
				$cat_id = $value['cat_id'];
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
			
			//@todo. 优化.
			$point++;
			if($point == $break_point)
				break;
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
				
				$levels[($level-1)][$one['parent_id']]['sub_cat'][$one['cat_id']] = $one;
			}
		}
		
		return end($levels);
	}
	
	function array_sort($array)
	{
		ksort($array);
		
		foreach($array as $key => $val)
		{
			if(isset($val['sub_cat']))
				$array[$key]['sub_cat'] = $this->array_sort($val['sub_cat']);
		}
		return $array;
	}
}
?>
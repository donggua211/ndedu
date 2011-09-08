<?php
class ArticleCat_model extends Model {

	function ArticleCat_model()
	{
		parent::Model();
	}
		
	function getAllCategories()
	{
		$query = $this->db->get('article_cat');
		if ($query->num_rows() > 0)
		{
			$result['parrent_cat'] = array();
			$result['sub_cat'] = array();
			
			foreach ($query->result_array() as $row)
			{
				
				$row['add_time'] = date('Y-m-d h:i:s', $row['add_time']);
				$row['modified_time'] = date('Y-m-d h:i:s', $row['modified_time']);
						
				if($row['parent_id'] == 0)
				{
					$result['parrent_cat'][$row['cat_id']] = $row;
				}
				else
				{
					$result['sub_cat'][$row['parent_id']][] = $row;
				}
			}
			return $result;
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
			$result = array();
			foreach ($query->result_array() as $row)
			{
				
				$result[] = $row['cat_id'];
			}
			return $result;
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

	function updataCategory($cat_id, $data)
	{
		if(!is_array($data)) 
			return false;

		if(!is_array($cat_id))
			$cat_ids[] = $cat_id;
		else
			$cat_ids = $cat_id;
		
		$this->db->where_in('cat_id', $cat_ids);
		$result = $this->db->update('article_cat', $data);

		return $result;
	}
	
	function deleteCategory($cat_id)
	{
		if(!is_array($cat_id))
			$cat_ids[] = $cat_id;
		else
			$cat_ids = $cat_id;
		
		$this->db->where_in('cat_id', $cat_ids);
		$result = $this->db->delete('article_cat');
		return $result;
	}
}
?>
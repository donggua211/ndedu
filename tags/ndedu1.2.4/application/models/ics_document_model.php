<?php
class ICS_Document_model extends Model {

	function ICS_Document_model()
	{
		parent::Model();
	}
	
	function getOne($document_id)
	{
		$sql = "SELECT document.*, sourse_doc.source_id, sourse_doc.source_doc_id FROM ".$this->db->dbprefix('ics_document')." as document
				LEFT JOIN ".$this->db->dbprefix('ics_source_doc')." as sourse_doc ON sourse_doc.document_id =  document.document_id
				WHERE document.document_id = $document_id 
				LIMIT 1";
		//LIMIT
		if (!empty($row_count))
        {
            $sql .= " LIMIT $offset, $row_count";
        }
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
	
	function search($keyword, $grade_id = 0, $category = array(), $offset = 0, $row_count = 0)
	{
		//student基本信息
		$sql = "SELECT document.*, provider.name, grade.grade_name, category.category_name FROM ".$this->db->dbprefix('ics_document')." as document
				LEFT JOIN ".$this->db->dbprefix('crm_staff')." as provider ON provider.staff_id =  document.provider_id
				LEFT JOIN ".$this->db->dbprefix('ics_grade')." as grade ON grade.grade_id =  document.grade_id
				LEFT JOIN ".$this->db->dbprefix('ics_category')." as category ON category.category_id =  document.category_id
				WHERE (document.document LIKE '%$keyword%' OR document.tags LIKE '%$keyword%') ";
		//LIMIT
		if (!empty($grade_id))
        {
            $sql .= " AND document.grade_id = $grade_id ";
        }
		//LIMIT
		if (!empty($category))
        {
            $sql .= " AND document.category_id IN (".implode(',',  $category).") ";
        }
		//LIMIT
		if (!empty($row_count))
        {
            $sql .= " LIMIT $offset, $row_count";
        }
		
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
	
	function getAllByCat($category_id, $offset = 0, $row_count = 0)
	{
		//student基本信息
		$sql = "SELECT document.*, provider.name, grade.grade_name, category.category_name FROM ".$this->db->dbprefix('ics_document')." as document
				LEFT JOIN ".$this->db->dbprefix('crm_staff')." as provider ON provider.staff_id =  document.provider_id
				LEFT JOIN ".$this->db->dbprefix('ics_grade')." as grade ON grade.grade_id =  document.grade_id
				LEFT JOIN ".$this->db->dbprefix('ics_category')." as category ON category.category_id =  document.category_id
				WHERE document.category_id = $category_id ";
		//LIMIT
		if (!empty($row_count))
        {
            $sql .= " LIMIT $offset, $row_count";
        }
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
	
	function getAll($is_delete = 0, $offset = 0, $row_count = 0)
	{
		//student基本信息
		$sql = "SELECT document.*, provider.name, grade.grade_name, category.category_name FROM ".$this->db->dbprefix('ics_document')." as document
				LEFT JOIN ".$this->db->dbprefix('crm_staff')." as provider ON provider.staff_id =  document.provider_id
				LEFT JOIN ".$this->db->dbprefix('ics_grade')." as grade ON grade.grade_id =  document.grade_id
				LEFT JOIN ".$this->db->dbprefix('ics_category')." as category ON category.category_id =  document.category_id
				WHERE document.is_delete = $is_delete ";
		//LIMIT
		if (!empty($row_count))
        {
            $sql .= " LIMIT $offset, $row_count";
        }
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
	
	function getAll_count($is_delete = 0)
	{
		//student基本信息
		$sql = "SELECT COUNT(*) as total FROM ".$this->db->dbprefix('ics_document')." as document
				WHERE document.is_delete = $is_delete ";
		$query = $this->db->query($sql);
		$row = $query->row_array();
		return $row['total'];
	}
	
	function add($category)
	{
		//开始事务.
		$this->db->trans_begin();
		
		/*
		 * 插入category表
		*/
		//必填项
		$data['document'] = $category['document'];
		$data['tags'] = $category['tags'];
		$data['category_id'] = $category['category_id'];
		$data['grade_id'] = $category['grade_id'];
		$data['provider_id'] = $category['staff_id'];
		
		//状态字段
		$data['is_delete'] = 0;
		$data['add_time'] = date('Y-m-d H:i:s');
		$data['update_time'] = date('Y-m-d H:i:s');
		if($this->db->insert('ics_document', $data))
		{
			$document_id = $this->db->insert_id();
		}
		else
		{
			$this->db->trans_rollback();
			return false;
		}
		
		/*
		 * 如果source_id为空, 则插入source表.
		 */
		if(empty($category['source_id']))
		{
			$data = array();
			$data['source_desc'] = $category['source'];
			$data['add_time'] = date('Y-m-d H:i:s');
			$data['update_time'] = date('Y-m-d H:i:s');
			if($this->db->insert('ics_source', $data))
			{
				$category['source_id'] = $this->db->insert_id();
			}
			else
			{
				$this->db->trans_rollback();
				return false;
			}
		}
		
		/*
		 * 插入source document关系表.
		 */
		$data = array();
		$data['document_id'] = $document_id;
		$data['source_id'] = $category['source_id'];
		$data['add_time'] = date('Y-m-d H:i:s');
		$data['update_time'] = date('Y-m-d H:i:s');
		if(!$this->db->insert('ics_source_doc', $data))
		{
			$this->db->trans_rollback();
			return false;
		}
		
		/*
		 * 提交事务
		*/
		if ($this->db->trans_status() !== FALSE)
		{
			$this->db->trans_commit();
			return $document_id;
		}
		else
		{
			return false;
		}
	}
	
	function update($document_id, $update_field = array())
	{
		if(empty($update_field))
			return true;
		
		//更新student表
		foreach($update_field as $key => $val)
		{
				$data[$key] = $val;
		}
		$data['update_time'] = date('Y-m-d H:i:s');
		
		$this->db->where('document_id', $document_id);
		return $this->db->update('ics_document', $data);
	}
}
?>

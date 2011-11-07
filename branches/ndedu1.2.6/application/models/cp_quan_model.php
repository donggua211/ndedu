<?php
class CP_quan_model extends Model {

	function CP_quan_model()
	{
		parent::Model();
	}
	
	function get_status($filter)
	{
		$where = '';
		//状态
		if (isset($filter['status']) && $filter['status'])
        {
            $where .= " AND quan.status = '{$filter['status']}' ";
        }
		//用于何处
		if (isset($filter['used_at']) && $filter['used_at'])
        {
            $where .= " AND quan.used_at = '{$filter['used_at']}' ";
        }
		//测评卡添加的开始时间
		if (isset($filter['add_time_a']) && $filter['add_time_a'])
        {
            $where .= " AND quan.add_time >= '{$filter['add_time_a']}' ";
        }
		//测评卡添加的结束时间
		if (isset($filter['add_time_b']) && $filter['add_time_b'])
        {
            $where .= " AND quan.add_time <= '{$filter['add_time_b']}' ";
        }
				
		//quan基本信息
		$sql = "SELECT quan.status COUNT(quan.quan_id) as num FROM ".$this->db->dbprefix('cp_quan')." as quan ";
					
		if(!empty($where))
			$sql .= substr_replace($where, ' WHERE ', 0, strpos($where, 'AND') + 3);
		
		$sql .= "GROUP quan.status";
		
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
	
	function getAll($filter, $offset = 0, $row_count = 0, $order_by = '', $order = 'ASC')
	{
		$where = '';
		//状态
		if (isset($filter['status']) && $filter['status'])
        {
            $where .= " AND quan.status = '{$filter['status']}' ";
        }
		//用于何处
		if (isset($filter['used_at']) && $filter['used_at'])
        {
            $where .= " AND quan.used_at = '{$filter['used_at']}' ";
        }
		//测评卡添加的开始时间
		if (isset($filter['add_time_a']) && $filter['add_time_a'])
        {
            $where .= " AND quan.add_time >= '{$filter['add_time_a']}' ";
        }
		//测评卡添加的结束时间
		if (isset($filter['add_time_b']) && $filter['add_time_b'])
        {
            $where .= " AND quan.add_time <= '{$filter['add_time_b']}' ";
        }
		
		//quan基本信息
		$sql = "SELECT quan.* FROM ".$this->db->dbprefix('cp_quan')." as quan ";
					
		if(!empty($where))
			$sql .= substr_replace($where, ' WHERE ', 0, strpos($where, 'AND') + 3);
		
		//ORDER BY
		if (!empty($order_by))
        {
            $sql .= " ORDER BY $order_by $order ";
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
	
	function getAll_count($filter)
	{
		$where = '';
		//测评分类
		if (isset($filter['cat_id']) && $filter['cat_id'])
        {
            $where .= " AND quan.cat_id = {$filter['cat_id']} ";
        }
		//测评的级别.
		if (isset($filter['level']) && $filter['level'])
        {
            $where .= " AND quan.level = {$filter['level']} ";
        }
		//状态
		if (isset($filter['status']) && $filter['status'])
        {
            $where .= " AND quan.status = {$filter['status']} ";
        }
		
		//quan基本信息
		$sql = "SELECT count(DISTINCT quan.quan_id) as total FROM ".$this->db->dbprefix('cp_quan')." as quan";
					
		if(!empty($where))
			$sql .= substr_replace($where, ' WHERE ', 0, strpos($where, 'AND') + 3);
		
		$query = $this->db->query($sql);
		$row = $query->row_array();
		return $row['total'];
	}
	
	function get_batch_info($batch_id)
	{
		$sql = "SELECT *
				FROM " . $this->db->dbprefix('cp_quan_batch') . "
				WHERE batch_id = $batch_id
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
	
	function check_quan_ids_exist($quan_ids)
	{
		foreach($quan_ids as $key => $id)
			$quan_ids[$key] = '"'.$id.'"';
		
		$quan_id_str = implode(',', $quan_ids);
		$sql = "SELECT quan_id
				FROM " . $this->db->dbprefix('cp_quan') . "
				WHERE quan_id IN ( $quan_id_str )";
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
	
	function add_quans($quans)
	{
		$insert = '';
		foreach($quans as $val)
		{
			$insert .= "('$val[quan_id]', '$val[value]','".date('Y-m-d H:i:s')."', '".CP_QUAN_STATUS_NEW."', '0000-00-00 00:00:00') , ";
		}
		
		$sql = "INSERT INTO " . $this->db->dbprefix('cp_quan') . " (quan_id, value, add_time, status, used_time) 
				VALUES ".trim($insert, ', ');
		
		$query = $this->db->query($sql);
		return ($this->db->affected_rows() > 0 ) ? TRUE : FALSE;
	}
	
	function update_batch($batch_info)
	{
		$sql = "INSERT INTO " . $this->db->dbprefix('cp_quan_batch') . " (batch_id, last_sn, add_time, update_time) 
				VALUES ($batch_info[batch_id], $batch_info[last_sn], '".date('Y-m-d H:i:s')."', '".date('Y-m-d H:i:s')."') 
				ON DUPLICATE KEY UPDATE last_sn=$batch_info[last_sn], update_time='".date('Y-m-d H:i:s')."'";
		
		$query = $this->db->query($sql);
		return ($this->db->affected_rows() > 0 ) ? TRUE : FALSE;
	}
	
	function check_batch_exist($batch_id)
	{
		$sql = "SELECT *
				FROM " . $this->db->dbprefix('cp_quan_batch') . "
				WHERE batch_id = $batch_id
				LIMIT 1";
		
		$query = $this->db->query($sql);
		
		if ($query->num_rows() > 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	function get_last_batch()
	{
		$sql = "SELECT *
				FROM " . $this->db->dbprefix('cp_quan_batch') . "
				ORDER BY update_time DESC
				LIMIT 1";
		
		$query = $this->db->query($sql);
		
		if ($query->num_rows() > 0)
		{
			$result = $query->row_array();
			return $result['batch_id'];
		}
		else
		{
			return FALSE;
		}
	}
	
	function get_one_quan($quan_id, $check_used = false)
	{
		$sql = "SELECT quan.*
				FROM " . $this->db->dbprefix('cp_quan') . " as quan
				WHERE quan.quan_id = '$quan_id' ";
		if($check_used)
			$sql .= " AND quan.status = ".CP_QUAN_STATUS_NEW." ";
		$sql .=	" LIMIT 1";
		
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
	
	function update($quan_id, $update_field = array())
	{
		if(empty($update_field))
			return true;
		
		//更新quan表
		foreach($update_field as $key => $val)
		{
				$data[$key] = $val;
		}
		
		$this->db->where('quan_id', $quan_id);
		return $this->db->update('cp_quan', $data);
	}
}
?>

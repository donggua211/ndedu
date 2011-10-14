<?php
class CRM_Sms_history_model extends Model {

	function CRM_Sms_history_model()
	{
		parent::Model();
	}
	
	function get_sms_history($filter = array(), $offset = 0, $row_count = 0, $order_by = '', $order = 'ASC')
	{
		$where = '';
		
        if (isset($filter['staff_id']) && $filter['staff_id'])
        {
            $where .= " AND sms_history.staff_id = '{$filter['staff_id']}' ";
        }
		//添加的时间段: 结束时间
		if (isset($filter['mobile']) && $filter['mobile'])
        {
			if(is_array($filter['mobile']))
			{
				foreach($filter['mobile'] as $val)
					$where_status[] = " sms_history.mobile = {$val} ";
				
				$where .= " AND ( ".implode(' OR ', $where_status)." )";
			}
			else
				$where .= " AND sms_history.mobile = {$filter['mobile']} ";
        }
		
		//student基本信息
		$sql = "SELECT sms_history.*, staff.name FROM ".$this->db->dbprefix('crm_sms_history')." as sms_history
				LEFT JOIN ".$this->db->dbprefix('crm_staff')." as staff ON staff.staff_id = sms_history.staff_id";
		
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
	
	function count_sms_history($filter = array())
	{
		$where = '';
		
        if (isset($filter['staff_id']) && $filter['staff_id'])
        {
            $where .= " AND sms_history.staff_id = '{$filter['staff_id']}' ";
        }
		//添加的时间段: 结束时间
		if (isset($filter['mobile']) && $filter['mobile'])
        {
			if(is_array($filter['mobile']))
			{
				foreach($filter['mobile'] as $val)
					$where_status[] = " sms_history.mobile = {$val} ";
				
				$where .= " AND ( ".implode(' OR ', $where_status)." )";
			}
			else
				$where .= " AND sms_history.mobile = {$filter['mobile']} ";
        }
		
		//student基本信息
		$sql = "SELECT COUNT(sms_history_id) as total FROM ".$this->db->dbprefix('crm_sms_history')." as sms_history";
		if(!empty($where))
			$sql .= substr_replace($where, ' WHERE ', 0, strpos($where, 'AND') + 3);
		
		$query = $this->db->query($sql);
		$row = $query->row_array();
		return $row['total'];
	}
	
	function add($sms_history)
	{
		//必填项
		$data['staff_id'] = $sms_history['staff_id'];
		$data['sms_text'] = $sms_history['sms_text'];
		$data['mobile'] = $sms_history['mobile'];
		$data['status'] = $sms_history['status'];
		
		$data['add_time'] = date('Y-m-d H:i:s');
		$data['update_time'] = date('Y-m-d H:i:s');
		
		if($this->db->insert('crm_sms_history', $data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function update($sms_history_id, $update_field)
	{
		if(empty($update_field))
			return true;
		
		//更新student表
		foreach($update_field as $key => $val)
		{
			$data[$key] = $val;
		}
		$data['update_time'] = date('Y-m-d H:i:s');
		
		$this->db->where('sms_history_id', $sms_history_id);
		if(!$this->db->update('crm_sms_history', $data))
		{
			return false;
		}
		return true;
	}
}

/* End of file admin.php */
/* Location: ./system/application/controllers/admin.php */
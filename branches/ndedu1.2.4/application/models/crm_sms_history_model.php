<?php
class CRM_Sms_history_model extends Model {

	function CRM_Sms_history_model()
	{
		parent::Model();
	}
	
	function get_sms_history($filter = array(), $order_by = 'update_time DESC', $row_count = 10)
	{
		$where = '';
		
        if (isset($filter['staff_id']) && $filter['staff_id'])
        {
            $where .= " AND staff_id = '{$filter['staff_id']}' ";
        }
		//添加的时间段: 结束时间
		if (isset($filter['mobile']) && $filter['mobile'])
        {
            $where .= " AND mobile <= '{$filter['mobile']}' ";
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
			foreach ($query->result_array() as $row)
			{
				$students[$row['student_id']] = $row;
				$student_ids[] = $row['student_id'];
			}
		}
		else
		{
			return array();
		}
	
	
	}
}

/* End of file admin.php */
/* Location: ./system/application/controllers/admin.php */
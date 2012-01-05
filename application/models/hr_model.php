<?php
class Hr_model extends Model {

	function Hr_model()
	{
		parent::Model();
	}
	
	function getAll($filter, $offset = 0, $row_count = 0)
	{
		$where = '';
		//订单添加的开始时间
		if (isset($filter['add_time_a']) && $filter['add_time_a'])
        {
            $where .= " AND interviewer.add_time >= '{$filter['add_time_a']}' ";
        }
		//订单添加的结束时间
		if (isset($filter['add_time_b']) && $filter['add_time_b'])
        {
            $where .= " AND interviewer.add_time <= '{$filter['add_time_b']}' ";
        }
		//订单添加的结束时间
		if (isset($filter['position_id']) && $filter['position_id'])
        {
            $where .= " AND interviewer.position_id IN (".implode(',', $filter['position_id']).") ";
        }
		//状态
		if (isset($filter['status']) && $filter['status'])
        {
            $where .= " AND interviewer.status = {$filter['status']} ";
        }
		
		//card基本信息
		$sql = "SELECT interviewer.*,position.position_name, crm_group.group_name
				FROM ".$this->db->dbprefix('hr_interviewer')." as interviewer
				LEFT JOIN ".$this->db->dbprefix('hr_position')." as position ON position.position_id = interviewer.position_id
				LEFT JOIN ".$this->db->dbprefix('crm_group')." as crm_group ON crm_group.group_id = position.group_id ";
		
		if(!empty($where))
			$sql .= substr_replace($where, ' WHERE ', 0, strpos($where, 'AND') + 3);
		
		//ORDER BY
        $sql .= " ORDER BY interviewer.status, interviewer.add_time ";
		
		//LIMIT
		if (!empty($row_count))
        {
            $sql .= " LIMIT $offset, $row_count";
        }
		
		
		
		
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
		{
			foreach($query->result_array() as $val)
			{
				$result[$val['interviewer_id']] = $val;
				$result[$val['interviewer_id']]['interview_time'] = array();
			}
			
			//获取最后一次联系的信息
			$sql = "SELECT time_a.* FROM ".$this->db->dbprefix('hr_interview_time')." as time_a, 
					(SELECT MAX(interview_time_id) as max_interview_time_id FROM ".$this->db->dbprefix('hr_interview_time')." WHERE interviewer_id IN (". implode(',', array_keys($result)) .") GROUP BY interviewer_id ) as time_b
					WHERE time_a.interview_time_id = time_b.max_interview_time_id";
			
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0)
			{
				foreach($query->result_array() as $val)
				{
					$result[$val['interviewer_id']]['interview_time'] = $val;
				}
			}
			
			return $result;
		}
		else
		{
			return array();
		}
	}
	
	function getAll_count($filter)
	{
		$where = '';
		//订单添加的开始时间
		if (isset($filter['add_time_a']) && $filter['add_time_a'])
        {
            $where .= " AND interviewer.add_time >= '{$filter['add_time_a']}' ";
        }
		//订单添加的结束时间
		if (isset($filter['add_time_b']) && $filter['add_time_b'])
        {
            $where .= " AND interviewer.add_time <= '{$filter['add_time_b']}' ";
        }
		//状态
		if (isset($filter['status']) && $filter['status'])
        {
            $where .= " AND interviewer.status = {$filter['status']} ";
        }
		
		//card基本信息
		$sql = "SELECT count(interviewer_id)  as total
				FROM ".$this->db->dbprefix('hr_interviewer')." as interviewer ";
		
		if(!empty($where))
			$sql .= substr_replace($where, ' WHERE ', 0, strpos($where, 'AND') + 3);
		
		$query = $this->db->query($sql);
		$row = $query->row_array();
		return $row['total'];
	}
	
	function get_one($interviewer_id)
	{
		$sql = "SELECT interviewer.*
				FROM ".$this->db->dbprefix('hr_interviewer')." as interviewer
				WHERE interviewer.interviewer_id = $interviewer_id
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
	
	function add($interviewer)
	{
		/*
		 * 插入 join 表
		*/
		$data['name'] = $interviewer['name'];
		$data['mobile'] = $interviewer['mobile'];
		$data['email'] = $interviewer['email'];
		$data['position_id'] = $interviewer['position_id'];
		$data['status'] = HR_STATUS_NEW;
		$data['contact_num'] = 0;
		$data['add_time'] = date('Y-m-d H:i:s');
		if($this->db->insert('hr_interviewer', $data))
		{
			return $this->db->insert_id();
		}
		else
		{
			return false;
		}
	}
	
	function add_interview_time($interview_time)
	{
		/*
		 * 插入 join 表
		*/
		$data['interviewer_id'] = $interview_time['interviewer_id'];
		$data['interviewer_time'] = $interview_time['interviewer_time'];
		$data['notice_method'] = $interview_time['notice_method'];
		$data['add_time'] = date('Y-m-d H:i:s');
		if($this->db->insert('hr_interview_time', $data))
		{
			return $this->db->insert_id();
		}
		else
		{
			return false;
		}
	}
	
	function update_contact_num($interviewer_id)
	{
		$sql = "UPDATE " . $this->db->dbprefix('hr_interviewer') . " SET contact_num=contact_num+1 WHERE interviewer_id=$interviewer_id";
		return $this->db->query($sql);
	}
	
	function get_one_times($interviewer_id)
	{
		//join 基本信息
		$sql = "SELECT interview_time.* 
				FROM " . $this->db->dbprefix('hr_interview_time') . " as interview_time
				WHERE interviewer_id = $interviewer_id";
		
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
	
	function update($interviewer_id, $update_field = array())
	{
		if(empty($update_field))
			return true;
		
		//更新card表
		foreach($update_field as $key => $val)
		{
			if($key == 'contact_num')
				$this->db->set($key, $val,  FALSE);
			else
				$this->db->set($key, $val);
		}
		
		$this->db->where('interviewer_id', $interviewer_id);
		return $this->db->update('hr_interviewer');
	}
	
	function delete($interviewer_id)
	{
		$this->db->where('interviewer_id', $interviewer_id);
		$this->db->delete(array('hr_interviewer', 'hr_interview_time')); 
		return ($this->db->affected_rows() > 0 ) ? TRUE : FALSE;
	}
}
?>

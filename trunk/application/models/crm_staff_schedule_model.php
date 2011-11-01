<?php
class CRM_Staff_Schedule_model extends Model {

	function CRM_Staff_Schedule_model()
	{
		parent::Model();
	}
	
	function add($schedule)
	{
		//必填项
		$data['subject_id'] = $schedule['subject_id'];
		$data['staff_id'] = $schedule['staff_id'];
		$data['start_time'] = $schedule['start_time'];
		$data['end_time'] = $schedule['end_time'];
		$data['day'] = $schedule['day'];
		$data['student_id'] = $schedule['student_id'];
		
		//状态字段
		$data['is_suspend'] = 0;
		$data['add_time'] = date('Y-m-d H:i:s');
		if($this->db->insert('crm_staff_schedule', $data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function get_staff_schedule($staff_id)
	{
		$sql = "SELECT schedule.* FROM ".$this->db->dbprefix('crm_staff_schedule')." as schedule
				WHERE schedule.staff_id = $staff_id 
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
	
	function check_schedule_exists($staff_id)
	{
		$sql = "SELECT staff_schedule_id FROM ".$this->db->dbprefix('crm_staff_schedule')." as schedule
				WHERE schedule.staff_id = $staff_id
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
	
	function update($staff_id, $update_field = array())
	{
		if(empty($update_field))
			return true;
		
		//如果存在则更新，不存在 就添加。
		if($this->check_schedule_exists($staff_id))
		{
			foreach($update_field as $key => $val)
			{
					$data[$key] = $val;
			}
			
			$data['update_time'] = date('Y-m-d H:i:s');
			$this->db->where('staff_id', $staff_id);
			if($this->db->update('crm_staff_schedule', $data))
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			//必填项
			$data['staff_id '] = $staff_id;
			$data['staff_schedule'] = $update_field['staff_schedule'];
			
			$data['add_time'] = date('Y-m-d H:i:s');
			$data['update_time'] = date('Y-m-d H:i:s');
			if($this->db->insert('crm_staff_schedule', $data))
			{
				return true;
			}
			else
			{
				return false;
			}
		}
	}
}
?>
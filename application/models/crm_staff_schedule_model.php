<?php
class CRM_Staff_Schedule_model extends Model {

	function CRM_Staff_Schedule_model()
	{
		parent::Model();
	}
	
	function add($schedule)
	{
		//±ШМоПо
		$data['subject_id'] = $schedule['subject_id'];
		$data['staff_id'] = $schedule['staff_id'];
		$data['start_time'] = $schedule['start_time'];
		$data['end_time'] = $schedule['end_time'];
		$data['day'] = $schedule['day'];
		$data['student_id'] = $schedule['student_id'];
		
		//ЧґМ¬ЧЦ¶О
		$data['is_suspend'] = 0;
		$data['add_time'] = date('Y-m-d H:i:s');
		if($this->db->insert('crm_schedule', $data))
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
	
	function check_schedule($student_id, $staff_id)
	{
		$sql = "SELECT schedule.* FROM ".$this->db->dbprefix('crm_schedule')." as schedule
				WHERE (schedule.student_id = $student_id OR schedule.staff_id = $staff_id)";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
		{
			$result = array();
			foreach( $query->result_array() as $val )
			{
				$result[$val['day']][] = $val;
			}
			return $result;
		}
		else
		{
			return array();
		}
	}
	
	function get_one_schedule($schedule_id)
	{
		$sql = "SELECT student.name, schedule.* FROM ".$this->db->dbprefix('crm_schedule')." as schedule
				INNER JOIN  ".$this->db->dbprefix('crm_student')." as student ON student.student_id = schedule.student_id
				WHERE schedule.schedule_id = $schedule_id
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
	
	function delete($schedule_id)
	{
		$this->db->where('schedule_id', $schedule_id);
		$this->db->delete('crm_schedule'); 
		return ($this->db->affected_rows() > 0 ) ? TRUE : FALSE;
	}
	
	function update($schedule_id, $update_field = array())
	{
		if(empty($update_field))
			return true;
		
		foreach($update_field as $key => $val)
		{
				$data[$key] = $val;
		}
		
		$this->db->where('schedule_id', $schedule_id);
		if($this->db->update('crm_schedule', $data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
}
?>
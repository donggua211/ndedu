<?php
class CRM_Timetable_model extends Model {

	function CRM_Timetable_model()
	{
		parent::Model();
	}
	
	function add($timetable)
	{
		//±ШМоПо
		$data['subject_id'] = $timetable['subject_id'];
		$data['staff_id'] = $timetable['staff_id'];
		$data['start_time'] = $timetable['start_time'];
		$data['end_time'] = $timetable['end_time'];
		$data['day'] = $timetable['day'];
		$data['student_id'] = $timetable['student_id'];
		
		//ЧґМ¬ЧЦ¶О
		$data['is_suspend'] = 0;
		$data['add_time'] = date('Y-m-d H:i:s');
		if($this->db->insert('crm_timetable', $data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function get_student_timetable($student_id)
	{
		$sql = "SELECT staff.name, subject.subject_name, timetable.* FROM ".$this->db->dbprefix('crm_timetable')." as timetable
				LEFT JOIN ".$this->db->dbprefix('crm_staff')." as staff ON staff.staff_id = timetable.staff_id
				LEFT JOIN ".$this->db->dbprefix('crm_subject')." as subject ON subject.subject_id = timetable.subject_id
				WHERE timetable.student_id = $student_id ";
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
	
	function update($calendar_id, $update_field = array())
	{
		if(empty($update_field))
			return true;
		
		foreach($update_field as $key => $val)
		{
				$data[$key] = $val;
		}
		$data['update_time'] = date('Y-m-d H:i:s');
		
		$this->db->where('calendar_id', $calendar_id);
		if($this->db->update('crm_calendar', $data))
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
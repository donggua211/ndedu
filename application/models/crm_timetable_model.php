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
		$sql = "SELECT staff.staff_id, staff.name, staff.phone, subject.subject_name, timetable.* FROM ".$this->db->dbprefix('crm_timetable')." as timetable
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
	
	function get_staff_timetable($staff_id)
	{
		$sql = "SELECT student.name, subject.subject_name, timetable.* FROM ".$this->db->dbprefix('crm_timetable')." as timetable
				LEFT JOIN ".$this->db->dbprefix('crm_student')." as student ON student.student_id = timetable.student_id
				LEFT JOIN ".$this->db->dbprefix('crm_subject')." as subject ON subject.subject_id = timetable.subject_id
				WHERE timetable.staff_id = $staff_id ";
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
	
	function check_timetable($student_id, $staff_id)
	{
		$sql = "SELECT timetable.* FROM ".$this->db->dbprefix('crm_timetable')." as timetable
				WHERE (timetable.student_id = $student_id OR timetable.staff_id = $staff_id)";
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
	
	function get_one_timetable($timetable_id)
	{
		$sql = "SELECT student.name, timetable.* FROM ".$this->db->dbprefix('crm_timetable')." as timetable
				INNER JOIN  ".$this->db->dbprefix('crm_student')." as student ON student.student_id = timetable.student_id
				WHERE timetable.timetable_id = $timetable_id
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
	
	function delete($timetable_id)
	{
		$this->db->where('timetable_id', $timetable_id);
		$this->db->delete('crm_timetable'); 
		return ($this->db->affected_rows() > 0 ) ? TRUE : FALSE;
	}
	
	function update($timetable_id, $update_field = array())
	{
		if(empty($update_field))
			return true;
		
		foreach($update_field as $key => $val)
		{
				$data[$key] = $val;
		}
		
		$this->db->where('timetable_id', $timetable_id);
		if($this->db->update('crm_timetable', $data))
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
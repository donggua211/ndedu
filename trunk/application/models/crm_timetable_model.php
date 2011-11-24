<?php
class CRM_Timetable_model extends Model {

	function CRM_Timetable_model()
	{
		parent::Model();
	}
	
	function add($timetable)
	{
		//必填项
		$data['subject_id'] = $timetable['subject_id'];
		$data['staff_id'] = $timetable['staff_id'];
		$data['start_time'] = $timetable['start_time'];
		$data['end_time'] = $timetable['end_time'];
		$data['day'] = $timetable['day'];
		$data['student_id'] = $timetable['student_id'];
		
		//状态字段
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
	
	function get_all_timetable($filter = array())
	{
		$sql = "SELECT student.name,staff.name as staff_name, subject.subject_name, timetable.* FROM ".$this->db->dbprefix('crm_timetable')." as timetable
				LEFT JOIN ".$this->db->dbprefix('crm_student')." as student ON student.student_id = timetable.student_id
				LEFT JOIN ".$this->db->dbprefix('crm_staff')." as staff ON staff.staff_id = timetable.staff_id
				LEFT JOIN ".$this->db->dbprefix('crm_subject')." as subject ON subject.subject_id = timetable.subject_id";
		
		if (isset($filter['end_date']) && $filter['end_date'])
        {
            $sql .= " where timetable.add_time <= '{$filter['end_date']}' ";
        }
		
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
	
	function add_timetable_suspend_log($new_log)
	{
		//必填项
		$data['timetable_id'] = $new_log['timetable_id'];
		$data['staff_id'] = $new_log['staff_id'];
		$data['suspend_days'] = $new_log['days'];
		$data['suspend_date'] = date('Y-m-d');
		$data['unsuspend_date'] = '0000-00-00';
		$data['add_time'] = date('Y-m-d H:i:s');
		if($this->db->insert('crm_timetable_suspend_log', $data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function update_timetable_suspend_log($timetable_id)
	{
		//获取信息。
		$sql = "SELECT * FROM ".$this->db->dbprefix('crm_timetable_suspend_log')."
				WHERE timetable_id = $timetable_id
				ORDER BY add_time DESC
				LIMIT 1";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
		{
			$suspend_log = $query->row_array();
		}
		else
		{
			return false;
		}
		
		//更新记录
		$data['unsuspend_date'] = date('Y-m-d');
		$this->db->where('suspend_log_id', $suspend_log['suspend_log_id']);
		if($this->db->update('crm_timetable_suspend_log', $data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function get_timetable_suspend_log($staff_id)
	{
		//获取信息。
		$sql = "SELECT log_a.* FROM ".$this->db->dbprefix('crm_timetable_suspend_log')." as log_a, 
				(SELECT MAX(suspend_log_id) as max_suspend_log_id FROM ".$this->db->dbprefix('crm_timetable_suspend_log')." WHERE staff_id = $staff_id GROUP BY timetable_id ) as log_b
				WHERE log_a.suspend_log_id = log_b.max_suspend_log_id
				GROUP BY log_a.timetable_id";
		
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return false;
		}
	}
	
	
	function get_all_suspend_log($filter)
	{
		//获取信息。
		$sql = "SELECT log.* FROM ".$this->db->dbprefix('crm_timetable_suspend_log')." as log ";
		
		if (isset($filter['start_date']) && isset($filter['end_date']) && $filter['start_date'])
        {
            $sql .= " WHERE log.suspend_date <= '{$filter['end_date']}' ";
            $sql .= " AND ( log.unsuspend_date >= '{$filter['start_date']}' OR log.unsuspend_date = '0000-00-00 00:00:00' )";
        }
		
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
		{
			$result;
			foreach( $query->result_array() as $val)
			{
				$result[$val['timetable_id']][] = $val;
			}
			return $result;
		}
		else
		{
			return false;
		}
	}
}
?>
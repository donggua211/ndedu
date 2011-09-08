<?php
class Student_model extends Model {

	function Student_model()
	{
		parent::Model();
	}
	
	function add($student)
	{
		//必填项
		$data['student_name'] = $student['student_name'];
		$data['student_phone'] = $student['student_phone'];
		
		//选填项, 要过滤.
		$data['father_name'] = $student['father_name'];
		$data['father_phone'] = $student['father_phone'];
		$data['mother_name'] = $student['mother_name'];
		$data['mother_phone'] = $student['mother_phone'];
		$data['student_grade'] = $student['student_grade'];
		$data['student_learning_status'] = $student['student_learning_status'];
		$data['remark'] = $student['remark'];
		
		//状态值: 0 => 未报名; 1 => 正在学; 2 => 已学完.
		$data['status'] = 0;
		$data['add_time'] = date('Y-m-d H:m:s');
		
		if($this->db->insert('crm_student', $data))
		{
			$student_id = $this->db->insert_id();
			
			//添加学习历史和联系
			$this->update_study_history(array('student_id' => $student_id, 'study_history' => ''));
			$this->update_contact_history(array('student_id' => $student_id, 'contact_history' => ''));
			
			return $student_id;
		}
		else
		{
			return false;
		}
	}
	
	function update($student_id, $student)
	{
		//必填项
		$data['student_name'] = $student['student_name'];
		$data['student_phone'] = $student['student_phone'];
		
		//选填项, 要过滤.
		$data['father_name'] = $student['father_name'];
		$data['father_phone'] = $student['father_phone'];
		$data['mother_name'] = $student['mother_name'];
		$data['mother_phone'] = $student['mother_phone'];
		$data['student_grade'] = $student['student_grade'];
		$data['student_learning_status'] = $student['student_learning_status'];
		$data['remark'] = $student['remark'];
		
		$this->db->where('student_id', $student_id);
		if($this->db->update('crm_student', $data))
		{			
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function getAll($employee_id = 0, $orderby = 'status ASC')
	{
		$sql = "SELECT * FROM " . $this->db->dbprefix('crm_student_employee') . " as a
				LEFT JOIN " . $this->db->dbprefix('crm_student') . " as b on b.student_id = a.student_id
				LEFT JOIN " . $this->db->dbprefix('crm_contact_history') . " as c on c.student_id = a.student_id
				LEFT JOIN " . $this->db->dbprefix('crm_study_history') . " as d on d.student_id = a.student_id";
		
		if($employee_id > 0)
			$sql .= ' WHERE a.employee_id='.$employee_id;
		
		if(!empty($orderby))
			$sql .=	" ORDER BY ".$orderby;
				
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
	
	function getOne($student_id, $employee_id = 0)
	{
		$sql = "SELECT * FROM " . $this->db->dbprefix('crm_student_employee') . " as a
				LEFT JOIN " . $this->db->dbprefix('crm_student') . " as b on b.student_id = a.student_id
				LEFT JOIN " . $this->db->dbprefix('crm_contact_history') . " as c on c.student_id = a.student_id
				LEFT JOIN " . $this->db->dbprefix('crm_study_history') . " as d on d.student_id = a.student_id";
		$sql .= ' WHERE a.student_id='.$student_id;
		if($employee_id > 0)
			$sql .= ' AND a.employee_id='.$employee_id;
		
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
	
	function creat_student_employee($student_id, $employee_id)
	{
		$data['student_id'] = $student_id;
		$data['employee_id'] = $employee_id;
		if($this->db->insert('crm_student_employee', $data))
		{
			return TRUE;
		}
		else
		{
			return false;
		}
	
	}
	
	function update_contact_history($contact_history)
	{
		if($contact_history['student_id'] < 0)
			return FALSE;
		
		//先查询该student id是否存在.
		$this->db->select('contact_history_id');
		$query = $this->db->get_where('crm_contact_history', array('student_id' => $contact_history['student_id']), 1);
		
		if ($query->num_rows() > 0) //如果存在就更新
		{
			$row = $query->row_array();
			
			$data['contact_history'] = $contact_history['contact_history'];
			$data['update_time'] = date('Y-m-d H:m:s');
			$this->db->where('contact_history_id', $row['contact_history_id']);
			if($this->db->update('crm_contact_history', $data))
			{
				return TRUE;
			}
			else
			{
				return false;
			}
		}
		else //如果不存在就添加
		{
			$data['student_id'] = $contact_history['student_id'];
			$data['contact_history'] = $contact_history['contact_history'];
			$data['update_time'] = date('Y-m-d H:m:s');
			if($this->db->insert('crm_contact_history', $data))
			{
				return TRUE;
			}
			else
			{
				return false;
			}
		}
	
	}
	
	function update_study_history($study_history)
	{
		if($study_history['student_id'] < 0)
			return FALSE;
		
		//先查询该student id是否存在.
		$this->db->select('study_history_id');
		$query = $this->db->get_where('crm_study_history', array('student_id' => $study_history['student_id']), 1);
		
		if ($query->num_rows() > 0) //如果存在就更新
		{
			$row = $query->row_array();
			
			$data['study_history'] = $study_history['study_history'];
			$data['update_time'] = date('Y-m-d H:m:s');
			$this->db->where('study_history_id', $row['study_history_id']);
			if($this->db->update('crm_study_history', $data))
			{
				return TRUE;
			}
			else
			{
				return false;
			}
		}
		else //如果不存在就添加
		{
			$data['student_id'] = $study_history['student_id'];
			$data['study_history'] = $study_history['study_history'];
			$data['update_time'] = date('Y-m-d H:m:s');
			if($this->db->insert('crm_study_history', $data))
			{
				return TRUE;
			}
			else
			{
				return false;
			}
		}
	}
	
	function delect_student($student_id)
	{
		$tables = array('crm_student', 'crm_student_employee');
		$this->db->where('student_id', $student_id);
		$this->db->delete($tables); 
		return ($this->db->affected_rows() > 0 ) ? TRUE : FALSE;
	}
	
	function delect_contact_history($student_id)
	{
		$this->db->where('student_id', $student_id);
		$this->db->delete('crm_contact_history'); 
		return ($this->db->affected_rows() > 0 ) ? TRUE : FALSE;
	}
	
	function delect_study_history($student_id)
	{
		$this->db->where('student_id', $student_id);
		$this->db->delete('crm_study_history'); 
		return ($this->db->affected_rows() > 0 ) ? TRUE : FALSE;
	}
	
	function update_status($student_id, $status)
	{
		$data['status'] = $status;
		$this->db->where('student_id', $student_id);
		if ($this->db->update('crm_student', $data))
		{
			return TRUE;
		}
		else
		{
			return false;
		}
	}
}
?>
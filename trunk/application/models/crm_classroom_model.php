<?php
class CRM_Classroom_model extends Model {

	function CRM_Classroom_model()
	{
		parent::Model();
	}
	
	function add($class_info)
	{
		/*
		 * 插入student表
		*/
		//必填项
		$data['classroom_name'] = $class_info['classroom_name'];
		$data['subject_id'] = $class_info['subject_id'];
		$data['staff_id'] = $class_info['staff_id'];
		$data['day'] = $class_info['day'];
		$data['start_time'] = $class_info['start_time'];
		$data['start_date'] = $class_info['start_date'];
		$data['end_time'] = $class_info['end_time'];
		
		$data['add_time'] = date('Y-m-d H:i:s');
		$data['update_time'] = date('Y-m-d H:i:s');
		
		if($this->db->insert('crm_classroom', $data))
		{
			$classroom_id = $this->db->insert_id();
		}
		
		/*
		 * classroom_student.
		 */
		$data = array();
		$data['classroom_id'] = $classroom_id;
		$data['add_time'] = date('Y-m-d H:i:s');
		foreach($class_info['student_id'] as $val)
		{
			$data['student_id'] = $val;
			$this->db->insert('crm_classroom_student', $data);
		}
		
		return $classroom_id;
	}
	
	function getOne($classroom_id)
	{
		//@TODO: 优化sql
		//student基本信息
		$sql = "SELECT classroom.*
				FROM " . $this->db->dbprefix('crm_classroom') . " as classroom 
				WHERE classroom.classroom_id = $classroom_id";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
		{
			$class_info = $query->row_array();
		}
		else
		{
			return array();
		}
		
		//获取student对应的咨询师.
		$sql = "SELECT classroom_student.*, student.name FROM " . $this->db->dbprefix('crm_classroom_student') . " as classroom_student
				LEFT JOIN ".$this->db->dbprefix('crm_student')." as student ON student.student_id = classroom_student.student_id
				WHERE classroom_id = ".$classroom_id;
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
		{
			
			foreach($query->result_array() as $val)
			{
				$class_info['classroom_student'][$val['student_id']] = $val;
			}
		}
		else
		{
			$class_info['classroom_student'] = array();
		}
		
		return $class_info;
	}
	
	function getAll($filter, $offset = 0, $row_count = 0, $order_by = '', $order = 'ASC')
	{
		$where = '';
		
        if (isset($filter['day']) && $filter['day'])
        {
            $where .= " AND classroom.day = '{$filter['day']}' ";
        }
		//科目
		if (isset($filter['subject_id']) && $filter['subject_id'])
        {
            $where .= " AND student.subject_id = {$filter['subject_id']} ";
        }
		//学员姓名
		if (isset($filter['classroom_name']) && $filter['classroom_name'])
        {
            $where .= " AND classroom.classroom_name LIKE '%{$filter['classroom_name']}%'";
        }
		
		//student基本信息
		$sql = "SELECT classroom.*, staff.name, subject.subject_name FROM ".$this->db->dbprefix('crm_classroom')." as classroom
				LEFT JOIN ".$this->db->dbprefix('crm_staff')." as staff ON staff.staff_id = classroom.staff_id
				LEFT JOIN ".$this->db->dbprefix('crm_subject')." as subject ON subject.subject_id = classroom.subject_id";
		
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
				$class[$row['classroom_id']] = $row;
				$classroom_ids[] = $row['classroom_id'];
			}
		}
		else
		{
			return array();
		}
		
		$classroom_string = implode(",", $classroom_ids);
		$sql = "SELECT COUNT(`classroom_student_id`) as total, classroom_id
				FROM " . $this->db->dbprefix('crm_classroom_student') . "
				WHERE classroom_id IN ( " . $classroom_string . " )
				GROUP BY classroom_id";
		
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
		{
			foreach ($query->result_array() as $row)
			{
				$class[$row['classroom_id']]['student_count'] = $row['total'];
			}
		}
		
		return $class;
	}
	
	function getAll_count($filter)
	{
		$where = '';
		if (isset($filter['day']) && $filter['day'])
        {
            $where .= " AND classroom.day = '{$filter['day']}' ";
        }
		//科目
		if (isset($filter['subject_id']) && $filter['subject_id'])
        {
            $where .= " AND student.subject_id = {$filter['subject_id']} ";
        }
		//学员姓名
		if (isset($filter['classroom_name']) && $filter['classroom_name'])
        {
            $where .= " AND classroom.classroom_name LIKE '%{$filter['classroom_name']}%'";
        }
				
		//student基本信息
		$sql = "SELECT count(classroom_id) as total FROM ".$this->db->dbprefix('crm_classroom')." as classroom ";
		
		if(!empty($where))
			$sql .= substr_replace($where, ' WHERE ', 0, strpos($where, 'AND') + 3);
		
		$query = $this->db->query($sql);
		$row = $query->row_array();
		return $row['total'];
	}
	
	function update($classroom_id, $update_field = array(), $no_update_time = true)
	{
		if(empty($update_field))
			return true;
		
		//更新student表
		foreach($update_field as $key => $val)
		{
			if($val != 'consultant' || $val != 'supervisor')
				$data[$key] = $val;
		}
		
		if($no_update_time)
			$data['update_time'] = date('Y-m-d H:i:s');
		
		$this->db->where('classroom_id', $classroom_id);
		if(!$this->db->update('crm_classroom', $data))
		{
			return false;
		}
		
		return true;
	}
	
	function delete($classroom_id)
	{
		$tables = array('crm_classroom', 'crm_classroom_student');
		$this->db->where('classroom_id', $classroom_id);
		$this->db->delete($tables); 
		return ($this->db->affected_rows() > 0 ) ? TRUE : FALSE;
	}
	
	function insert_classroom_student($student_id, $classroom_id)
	{
		$data['student_id'] = $student_id;
		$data['classroom_id'] = $classroom_id;
		
		$data['add_time'] = date('Y-m-d H:i:s');
		
		if($this->db->insert('crm_classroom_student', $data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function delete_classroom_student($student_id, $classroom_id)
	{
		$data['student_id'] = $student_id;
		$data['classroom_id'] = $classroom_id;
		
		$this->db->delete('crm_classroom_student', $data); 
		return ($this->db->affected_rows() > 0 ) ? TRUE : FALSE;
	}
}
?>
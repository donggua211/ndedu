<?php
class CRM_Student_model extends Model {

	function CRM_Student_model()
	{
		parent::Model();
	}
	
	function add($student, $staff_id)
	{
		//��ʼ����.
		$this->db->trans_begin();
		
		/*
		 * ����student��
		*/
		//������
		$data['name'] = $student['name'];
		$data['branch_id'] = $student['branch_id'];
		$data['grade_id'] = $student['grade_id'];
		$data['province_id'] = $student['province_id'];
		$data['city_id'] = $student['city_id'];
		$data['district_id'] = $student['district_id'];
		$data['consultant_id'] = $staff_id;
		//ѡ����Ϣ.
		$data['father_phone'] = $student['father_phone'];
		$data['mother_phone'] = $student['mother_phone'];
		$data['qq'] = $student['qq'];
		$data['email'] = $student['email'];
		$data['address'] = $student['address'];
		$data['remark'] = $student['remark'];
		//״̬�ֶ�
		$data['supervisor_id'] = 0;
		$data['status'] = STUDENT_STATUS_NOT_SIGNUP;
		$data['is_delete'] = 0;
		$data['add_time'] = date('Y-m-d H:i:s');
		$data['update_time'] = date('Y-m-d H:i:s');
		if($this->db->insert('crm_student', $data))
		{
			$student_id = $this->db->insert_id();
		}
		else
		{
			$this->db->trans_rollback();
			return false;
		}
		/*
		 * ����user_student��.
		 */
		$data = array();
		$data['student_id'] = $student_id;
		$data['user_id'] = 0;
		$data['vip_code'] = $this->_generate_vip_code();
		$data['add_time'] = date('Y-m-d H:i:s');
		$data['update_time'] = date('Y-m-d H:i:s');
		if(!$this->db->insert('crm_user_student', $data))
		{
			$this->db->trans_rollback();
			return false;
		}
		
		
		/*
		 * �ύ����
		*/
		if ($this->db->trans_status() !== FALSE)
		{
			$this->db->trans_commit();
			return $student_id;
		}
		else
			return false;
	}
	
	function getOne($student_id)
	{
		//@TODO: �Ż�sql
		//student������Ϣ
		$sql = "SELECT student.*, grade.grade_name, branch.branch_name FROM " . $this->db->dbprefix('crm_student') . " as student, " . $this->db->dbprefix('crm_grade') . " as grade, " . $this->db->dbprefix('crm_branch') . " as branch
				WHERE student_id = $student_id
				AND student.grade_id = grade.grade_id
				AND student.branch_id = branch.branch_id";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
		{
			$student = $query->row_array();
		}
		else
		{
			return array();
		}
		
		//��ȡstudent��Ӧ����ѯʦ.
		$sql = "SELECT staff_id, name FROM " . $this->db->dbprefix('crm_staff') . " as staff
				WHERE staff_id = ".$student['consultant_id'];
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
		{
			$student['consultant'] = $query->row_array();
		}
		else
		{
			$student['consultant'] = array();
		}
		
		//��ȡstudent��Ӧ�İ�����
		if(!empty($student['supervisor_id']))
		{
			$sql = "SELECT staff_id, name FROM " . $this->db->dbprefix('crm_staff') . " as staff
				WHERE staff_id = ".$student['supervisor_id'];
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0)
			{
				$student['supervisor'] = $query->row_array();
			}
			else
			{
				$student['supervisor'] = array();
			}
		}
		else
		{
			$student['supervisor'] = array();
		}
		
		return $student;
	}
	
	//��ȡuser_student��vip״̬.
	function getOne_vip_code($student_id)
	{
		$sql = "SELECT user_student.vip_code, user_student.user_id, user.user_name
				FROM " . $this->db->dbprefix('crm_user_student') . " as user_student
				LEFT JOIN " . $this->db->dbprefix('user') . " as user ON user_student.user_id  = user.uid
				WHERE user_student.student_id = $student_id
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
	
	function getAll($filter, $offset = 0, $row_count = 0)
	{
		//��ӵ�ʱ���: ��ʼʱ��
		$where = '';
		$where .= " AND student.is_delete = '{$filter['is_delete']}' ";
        if ($filter['start_time'])
        {
            $where .= " AND student.add_time >= '{$filter['start_time']}' ";
        }
		//��ӵ�ʱ���: ����ʱ��
		if ($filter['end_time'])
        {
            $where .= " AND student.add_time <= '{$filter['end_time']}' ";
        }
		//��У��
		if ($filter['branch_id'])
        {
            $where .= " AND student.branch_id = {$filter['branch_id']} ";
        }
		//ѧ��
		if ($filter['grade_id'])
        {
            $where .= " AND student.grade_id = {$filter['grade_id']} ";
        }
		//ѧԱ״̬
		if ($filter['status'] !== FALSE)
        {
            $where .= " AND student.status = {$filter['status']} ";
        }
		//����ʡ
		if ($filter['province_id'])
        {
            $where .= " AND student.province_id = {$filter['province_id']} ";
        }
		//������
		if ($filter['city_id'])
        {
            $where .= " AND student.city_id = {$filter['city_id']} ";
        }
		//��ѯʦ
		if ($filter['consultant_id'])
        {
            $where .= " AND student.consultant_id = {$filter['consultant_id']} ";
        }
		//������
		if ($filter['supervisor_id'])
        {
            $where .= " AND student.supervisor_id = {$filter['supervisor_id']} ";
        }
		//ѧԱ����
		if ($filter['name'])
        {
            $where .= " AND student.name LIKE '%{$filter['name']}%' ";
        }
				
		//student������Ϣ
		$sql = "SELECT DISTINCT student.*, grade.grade_name FROM ".$this->db->dbprefix('crm_student')." as student, ".$this->db->dbprefix('crm_grade')." as grade
				WHERE grade.grade_id = student.grade_id ".$where;
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
		
		$student_string = implode(",", $student_ids);
		//��ȡ��ͬ��ʱ
		$sql = "SELECT student_id, sum(total_hours) as total_hours FROM " . $this->db->dbprefix('crm_contract') . "
				WHERE student_id IN ( " . $student_string . " )
				GROUP BY student_id";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
		{
			foreach ($query->result_array() as $row)
			{
				$students[$row['student_id']]['total_hours'] = $row['total_hours'];
			}
		}
		
		//����յ�: total_hours, refund_value, finished_hours
		foreach($students as $student_id => $value)
		{
			if(!isset($value['total_hours']) || empty($value['total_hours']))
				$students[$student_id]['total_hours'] = 0;
		}
		return $students;
	}
	
	function getAll_count($filter)
	{
		//��ӵ�ʱ���: ��ʼʱ��
		$where = '';
		$where .= " AND student.is_delete = '{$filter['is_delete']}' ";
        if ($filter['start_time'])
        {
            $where .= " AND student.add_time >= '{$filter['start_time']}' ";
        }
		//��ӵ�ʱ���: ����ʱ��
		if ($filter['end_time'])
        {
            $where .= " AND student.add_time <= '{$filter['end_time']}' ";
        }
		//��У��
		if ($filter['branch_id'])
        {
            $where .= " AND student.branch_id = {$filter['branch_id']} ";
        }
		//ѧ��
		if ($filter['grade_id'])
        {
            $where .= " AND student.grade_id = {$filter['grade_id']} ";
        }
		//ѧԱ״̬
		if ($filter['status'] !== FALSE)
        {
            $where .= " AND student.status = {$filter['status']} ";
        }
		//����ʡ
		if ($filter['province_id'])
        {
            $where .= " AND student.province_id = {$filter['province_id']} ";
        }
		//������
		if ($filter['city_id'])
        {
            $where .= " AND student.city_id = {$filter['city_id']} ";
        }
		//��ѯʦ
		if ($filter['consultant_id'])
        {
            $where .= " AND consultant_id = {$filter['consultant_id']} ";
        }
		//������
		if ($filter['supervisor_id'])
        {
            $where .= " AND supervisor_id = {$filter['supervisor_id']} ";
        }
		//ѧԱ����
		if ($filter['name'])
        {
            $where .= " AND student.name LIKE '%{$filter['name']}%' ";
        }
				
		//student������Ϣ
		$sql = "SELECT count(DISTINCT student.student_id) as total FROM ".$this->db->dbprefix('crm_student')." as student, ".$this->db->dbprefix('crm_grade')." as grade
				WHERE student.grade_id = grade.grade_id ".$where;
		$query = $this->db->query($sql);
		$row = $query->row_array();
		return $row['total'];
	}
	
	function update($student_id, $update_field = array())
	{
		if(empty($update_field))
			return true;
		
		//����student��
		foreach($update_field as $key => $val)
		{
			if($val != 'consultant' || $val != 'supervisor')
				$data[$key] = $val;
		}
		$data['update_time'] = date('Y-m-d H:i:s');
		
		$this->db->where('student_id', $student_id);
		if(!$this->db->update('crm_student', $data))
		{
			return false;
		}
		
		return true;
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
		
		//�Ȳ�ѯ��student id�Ƿ����.
		$this->db->select('contact_history_id');
		$query = $this->db->get_where('crm_contact_history', array('student_id' => $contact_history['student_id']), 1);
		
		if ($query->num_rows() > 0) //������ھ͸���
		{
			$row = $query->row_array();
			
			$data['contact_history'] = $contact_history['contact_history'];
			$data['update_time'] = date('Y-m-d H:i:s');
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
		else //��������ھ����
		{
			$data['student_id'] = $contact_history['student_id'];
			$data['contact_history'] = $contact_history['contact_history'];
			$data['update_time'] = date('Y-m-d H:i:s');
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
		
		//�Ȳ�ѯ��student id�Ƿ����.
		$this->db->select('study_history_id');
		$query = $this->db->get_where('crm_study_history', array('student_id' => $study_history['student_id']), 1);
		
		if ($query->num_rows() > 0) //������ھ͸���
		{
			$row = $query->row_array();
			
			$data['study_history'] = $study_history['study_history'];
			$data['update_time'] = date('Y-m-d H:i:s');
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
		else //��������ھ����
		{
			$data['student_id'] = $study_history['student_id'];
			$data['study_history'] = $study_history['study_history'];
			$data['update_time'] = date('Y-m-d H:i:s');
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
	
	function student_status_history($student_id, $from_status, $to_status, $consultant_id, $supervisor_id)
	{
		//������Ϣ.
		$data['student_id'] = $student_id;
		$data['consultant_id'] = $consultant_id;
		$data['supervisor_id'] = $supervisor_id;
		$data['from_status'] = $from_status;
		$data['status'] = $to_status;
		
		$data['add_time'] = date('Y-m-d H:i:s');
		
		if($this->db->insert('crm_student_status_history', $data))
		{
			return $this->db->insert_id();
		}
		else
		{
			return false;
		}
	}
	
	function _generate_vip_code()
	{
		$vip_code = substr(md5(microtime()), 0, 6);
		if($this->_vip_code_exists($vip_code))
			return $this->_generate_vip_code();
		else
			return $vip_code;
	
	}
	
	function _vip_code_exists($vip_code)
	{
		//student������Ϣ
		$sql = "SELECT 	user_student_id FROM " . $this->db->dbprefix('crm_user_student') . "
				WHERE vip_code = '$vip_code'
				LIMIT 1";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
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
<?php
class CRM_Student_model extends Model {

	function CRM_Student_model()
	{
		parent::Model();
	}
	
	function add($student, $staff_info)
	{
		//开始事务.
		$this->db->trans_begin();
		
		/*
		 * 插入student表
		*/
		//必填项
		$data['name'] = $student['name'];
		$data['gender'] = $student['gender'];
		$data['branch_id'] = $student['branch_id'];
		$data['grade_id'] = $student['grade_id'];
		$data['province_id'] = $student['province_id'];
		$data['city_id'] = $student['city_id'];
		$data['district_id'] = $student['district_id'];
		$data['cservice_id'] = $staff_info['staff_id'];
		
		//如果是咨询师添加的，则 $data['consultant_id'] 字段为该咨询师id
		if($staff_info['group_id'] == GROUP_CONSULTANT || $staff_info['group_id'] == GROUP_CONSULTANT_D)
			$data['consultant_id'] = $staff_info['staff_id'];
		else
			$data['consultant_id'] = 0;
		
		//选填信息.
		$data['father_phone'] = $student['father_phone'];
		$data['mother_phone'] = $student['mother_phone'];
		$data['qq'] = $student['qq'];
		$data['email'] = $student['email'];
		$data['address'] = $student['address'];
		$data['remark'] = $student['remark'];
		//状态字段
		$data['supervisor_id'] = 0;
		$data['mark_star'] = 0;
		$data['suyang_id'] = 0;
		$data['jiaowu_id'] = 0;
		$data['status'] = STUDENT_STATUS_NOT_APPOINTMENT;
		$data['is_delete'] = 0;
		$data['add_time'] = date('Y-m-d H:i:s');
		$data['update_time'] = date('Y-m-d H:i:s');
		//ndedu1.2.2 新加字段： dob
		$data['dob'] = $student['dob'];
		//ndedu1.2.5 新加： 星级
		$data['level'] = $student['level'];
			
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
		 * 插入user_student表.
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
		 * ndedu 1.2.4
		 * 插入crm_student_extra表.
		 */
		$data = array();
		$data['student_id'] = $student_id;
		$data['student_from_id'] = $student['student_from'] == 'other' ? 0 : (int)$student['student_from'];
		$data['student_from_other'] = $student['student_from_text'];
		$data['add_time'] = date('Y-m-d H:i:s');
		if(!$this->db->insert('crm_student_extra', $data))
		{
			$this->db->trans_rollback();
			return false;
		}
		
		/*
		 * 提交事务
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
		//@TODO: 优化sql
		//student基本信息
		$sql = "SELECT student_extra.*, student_from.student_from_name, grade.grade_name, branch.branch_name, province.region_name as province_name, city.region_name as city_name, district.region_name as district_name, student.* 
				FROM " . $this->db->dbprefix('crm_student') . " as student 
				LEFT JOIN ".$this->db->dbprefix('crm_grade')." as grade ON grade.grade_id =  student.grade_id
				LEFT JOIN ".$this->db->dbprefix('crm_branch')." as branch ON branch.branch_id =  student.branch_id
				LEFT JOIN ".$this->db->dbprefix('crm_region')." as province ON province.region_id = student.province_id
				LEFT JOIN ".$this->db->dbprefix('crm_region')." as city ON city.region_id = student.city_id
				LEFT JOIN ".$this->db->dbprefix('crm_region')." as district ON district.region_id = student.district_id
				LEFT JOIN ".$this->db->dbprefix('crm_student_extra')." as student_extra ON student_extra.student_id = student.student_id
				LEFT JOIN ".$this->db->dbprefix('crm_student_from')." as student_from ON student_from.student_from_id = student_extra.student_from_id
				WHERE student.student_id = $student_id";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
		{
			$student = $query->row_array();
		}
		else
		{
			return array();
		}
		
		//获取student对应的咨询师.
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
		
		//获取student对应的客服老师.
		$sql = "SELECT staff_id, name FROM " . $this->db->dbprefix('crm_staff') . " as staff
				WHERE staff_id = ".$student['cservice_id'];
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
		{
			$student['cservice'] = $query->row_array();
		}
		else
		{
			$student['cservice'] = array();
		}
		
		//获取student对应的班主任
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
		
		
		//获取student对应的素养老师
		if(!empty($student['suyang_id']))
		{
			$sql = "SELECT staff_id, name FROM " . $this->db->dbprefix('crm_staff') . " as staff
				WHERE staff_id = ".$student['suyang_id'];
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0)
			{
				$student['suyang'] = $query->row_array();
			}
			else
			{
				$student['suyang'] = array();
			}
		}
		else
		{
			$student['suyang'] = array();
		}
		return $student;
	}
	
	//获取user_student的vip状态.
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
	
	function getAll($filter, $offset = 0, $row_count = 0, $order_by = '', $order = 'ASC')
	{
		//添加的时间段: 开始时间
		$where = '';
		
		if (!isset($filter['is_delete']))
        {
            $filter['is_delete'] = 0;
        }
		$where .= " AND student.is_delete = '{$filter['is_delete']}' ";
        if (isset($filter['start_time']) && $filter['start_time'])
        {
            $where .= " AND student.add_time >= '{$filter['start_time']}' ";
        }
		//添加的时间段: 结束时间
		if (isset($filter['end_time']) && $filter['end_time'])
        {
            $where .= " AND student.add_time <= '{$filter['end_time']}' ";
        }
		//分校区
		if (isset($filter['branch_id']) && $filter['branch_id'])
        {
            $where .= " AND student.branch_id = {$filter['branch_id']} ";
        }
		//学阶
		if (isset($filter['grade_id']) && $filter['grade_id'])
        {
            $where .= " AND student.grade_id = {$filter['grade_id']} ";
        }
		//学员状态
		if (isset($filter['status']) && $filter['status'])
        {
			if(is_array($filter['status']))
			{
				foreach($filter['status'] as $val)
					$where_status[] = " student.status = {$val} ";
				
				$where .= " AND ( ".implode(' OR ', $where_status)." )";
			}
			else
				$where .= " AND student.status = {$filter['status']} ";
        }
		//所在省
		if (isset($filter['province_id']) && $filter['province_id'])
        {
            $where .= " AND student.province_id = {$filter['province_id']} ";
        }
		//所在市
		if (isset($filter['city_id']) && $filter['city_id'])
        {
            $where .= " AND student.city_id = {$filter['city_id']} ";
        }
		//咨询师
		if (isset($filter['consultant_id']) && $filter['consultant_id'])
        {
            $where .= " AND student.consultant_id = {$filter['consultant_id']} ";
        }
		//素养老师
		if (isset($filter['suyang_id']) && $filter['suyang_id'])
        {
            $where .= " AND student.suyang_id = {$filter['suyang_id']} ";
        }
		//班主任
		if (isset($filter['supervisor_id']) && $filter['supervisor_id'])
        {
            $where .= " AND student.supervisor_id = {$filter['supervisor_id']} ";
        }
		//客服
		if (isset($filter['cservice_id']) && $filter['cservice_id'])
        {
            $where .= " AND student.cservice_id = {$filter['cservice_id']} ";
        }
		//教务老师
		if (isset($filter['jiaowu_id']) && $filter['jiaowu_id'])
        {
            $where .= " AND student.jiaowu_id = {$filter['jiaowu_id']} ";
        }
		//学员姓名
		if (isset($filter['name']) && $filter['name'])
        {
            $where .= " AND student.name LIKE '%{$filter['name']}%' ";
        }
		
		//1.2.5新加
		if (isset($filter['student_id']) && $filter['student_id'])
        {
            $where .= " AND student.student_id IN (".implode($filter['student_id'], ',').")";
        }
		
		//student基本信息
		$sql = "SELECT DISTINCT student.*, staff_jiaowu.name as jiaowu_name, staff_consultant.name as consultant_name, staff_cs.name as cs_name, staff_suyang.name as suyang_name,  grade.grade_name, contract.finished_hours, contract.total_hours FROM ".$this->db->dbprefix('crm_student')." as student
				LEFT JOIN ".$this->db->dbprefix('crm_contract')." as contract ON contract.student_id = student.student_id 
				LEFT JOIN ".$this->db->dbprefix('crm_grade')." as grade ON grade.grade_id = student.grade_id
				LEFT JOIN ".$this->db->dbprefix('crm_staff')." as staff_consultant ON staff_consultant.staff_id = student.consultant_id
				LEFT JOIN ".$this->db->dbprefix('crm_staff')." as staff_cs ON staff_cs.staff_id = student.cservice_id
				LEFT JOIN ".$this->db->dbprefix('crm_staff')." as staff_suyang ON staff_suyang.staff_id = student.suyang_id
				LEFT JOIN ".$this->db->dbprefix('crm_staff')." as staff_jiaowu ON staff_jiaowu.staff_id = student.jiaowu_id";
		
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
		
		$student_string = implode(",", $student_ids);
		/*
		//获取合同课时
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
		
		//处理空的: total_hours, refund_value, finished_hours
		foreach($students as $student_id => $value)
		{
			if(!isset($value['total_hours']) || empty($value['total_hours']))
				$students[$student_id]['total_hours'] = 0;
		}
		*/
		
		//获取最后联系时间
		$sql = "SELECT student_id, max(`add_time`) as last_contact_time
				FROM " . $this->db->dbprefix('crm_history_contact') . "
				WHERE student_id IN ( " . $student_string . " )
				AND is_delete = 0
				GROUP BY student_id";
		
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
		{
			foreach ($query->result_array() as $row)
			{
				$students[$row['student_id']]['last_contact_time'] = $row['last_contact_time'];
			}
		}
		
		//处理空的: last_contact_time
		foreach($students as $student_id => $value)
		{
			if(!isset($value['last_contact_time']) || empty($value['last_contact_time']))
				$students[$student_id]['last_contact_time'] = 0;
		}
		
		return $students;
	}
	
	function getAll_count($filter)
	{
		//添加的时间段: 开始时间
		$where = '';
		$where .= " AND student.is_delete = '{$filter['is_delete']}' ";
        if ($filter['start_time'])
        {
            $where .= " AND student.add_time >= '{$filter['start_time']}' ";
        }
		//添加的时间段: 结束时间
		if ($filter['end_time'])
        {
            $where .= " AND student.add_time <= '{$filter['end_time']}' ";
        }
		//分校区
		if ($filter['branch_id'])
        {
            $where .= " AND student.branch_id = {$filter['branch_id']} ";
        }
		//学阶
		if ($filter['grade_id'])
        {
            $where .= " AND student.grade_id = {$filter['grade_id']} ";
        }
		//学员状态
		if ($filter['status'] !== FALSE)
        {
            if(is_array($filter['status']))
			{
				foreach($filter['status'] as $val)
					$where_status[] = " student.status = {$val} ";
				
				$where .= " AND ( ".implode(' OR ', $where_status)." )";
			}
			else
				$where .= " AND student.status = {$filter['status']} ";
        }
		//所在省
		if ($filter['province_id'])
        {
            $where .= " AND student.province_id = {$filter['province_id']} ";
        }
		//所在市
		if ($filter['city_id'])
        {
            $where .= " AND student.city_id = {$filter['city_id']} ";
        }
		//咨询师
		if ($filter['consultant_id'])
        {
            $where .= " AND consultant_id = {$filter['consultant_id']} ";
        }
		//咨询师
		if ($filter['suyang_id'])
        {
            $where .= " AND suyang_id = {$filter['suyang_id']} ";
        }
		//班主任
		if ($filter['supervisor_id'])
        {
            $where .= " AND supervisor_id = {$filter['supervisor_id']} ";
        }
		//客服
		if (isset($filter['cservice_id']) && $filter['cservice_id'])
        {
            $where .= " AND student.cservice_id = {$filter['cservice_id']} ";
        }
		//客服
		if (isset($filter['jiaowu_id']) && $filter['jiaowu_id'])
        {
            $where .= " AND student.jiaowu_id = {$filter['jiaowu_id']} ";
        }
		//学员姓名
		if ($filter['name'])
        {
            $where .= " AND student.name LIKE '%{$filter['name']}%' ";
        }
				
		//student基本信息
		$sql = "SELECT count(DISTINCT student.student_id) as total FROM ".$this->db->dbprefix('crm_student')." as student, ".$this->db->dbprefix('crm_grade')." as grade
				WHERE student.grade_id = grade.grade_id ".$where;
		
		$query = $this->db->query($sql);
		$row = $query->row_array();
		return $row['total'];
	}
	
	function update($student_id, $update_field = array(), $no_update_time = true)
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
		
		//先查询该student id是否存在.
		$this->db->select('contact_history_id');
		$query = $this->db->get_where('crm_contact_history', array('student_id' => $contact_history['student_id']), 1);
		
		if ($query->num_rows() > 0) //如果存在就更新
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
		else //如果不存在就添加
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
		
		//先查询该student id是否存在.
		$this->db->select('study_history_id');
		$query = $this->db->get_where('crm_study_history', array('student_id' => $study_history['student_id']), 1);
		
		if ($query->num_rows() > 0) //如果存在就更新
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
		else //如果不存在就添加
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
		//必填信息.
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
	
	function get_student_teacher($student_id, $type = '')
	{
		//student基本信息
		$sql = "SELECT staff.name, student_teacher.* FROM " . $this->db->dbprefix('crm_student_teacher') . " as student_teacher
				LEFT JOIN " . $this->db->dbprefix('crm_staff') . " as staff ON student_teacher.staff_id = staff.staff_id ";
		
		if(is_array($student_id))
			$sql .= " WHERE student_teacher.student_id IN ( ".implode(',', $student_id)." ) ";
		else
			$sql .= " WHERE student_teacher.student_id = '$student_id' ";
		
		if(!empty($type))
			$sql .= " AND student_teacher.student_teacher_type = $type";
		
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
		{
			$result = array();
			foreach($query->result_array() as $val)
				$result[$val['staff_id']] = $val;
			
			return $result;
		}
		else
		{
			return false;
		}
	}
	
	function insert_student_teacher($student_id, $staff_id, $type)
	{
		$data['student_id'] = $student_id;
		$data['staff_id'] = $staff_id;
		$data['student_teacher_type'] = $type;
		
		$data['add_time'] = date('Y-m-d H:i:s');
		
		if($this->db->insert('crm_student_teacher', $data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function delete_student_teacher($student_id, $staff_id, $type)
	{
		$data['student_id'] = $student_id;
		$data['staff_id'] = $staff_id;
		$data['student_teacher_type'] = $type;
		
		$this->db->delete('crm_student_teacher', $data); 
		return ($this->db->affected_rows() > 0 ) ? TRUE : FALSE;
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
		//student基本信息
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
	
	function check_mobile_exist($mobile)
	{
		//student基本信息
		$sql = "SELECT * FROM " . $this->db->dbprefix('crm_student') . " WHERE ";
		
		foreach($mobile as $val)
			if(!empty($val))
				$where[] = " (`father_phone` LIKE '%$val%' OR `mother_phone` LIKE '%$val%') ";
		
		$sql .= implode(' OR ', $where);
		
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
}
?>
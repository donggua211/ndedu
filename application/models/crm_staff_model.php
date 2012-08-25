<?php
class CRM_Staff_model extends Model {

	function CRM_Staff_model()
	{
		parent::Model();
	}
	
	function getAll($filter, $offset = 0, $row_count = 0, $order_by = '', $order = 'ASC')
	{
		//可用的员工
		if (isset($filter['available_staff']) && empty($filter['available_staff']))
			return array();
		
		$where = '';
		if(!isset($filter['is_active']))
			$filter['is_active'] = 1;
        $where .= " WHERE staff.is_active = {$filter['is_active']} ";//是否注销
		if(!isset($filter['is_delete']))
			$filter['is_delete'] = 0;
        $where .= " AND staff.is_delete = {$filter['is_delete']} ";//是否删除
		
		//添加的时间段: 开始时间
        if (isset($filter['start_time']) && $filter['start_time'])
        {
            $where .= " AND staff.add_time >= {$filter['start_time']} ";
        }
		//添加的时间段: 结束时间
		if (isset($filter['end_time']) && $filter['end_time'])
        {
            $where .= " AND staff.add_time <= {$filter['end_time']} ";
        }
		//分校区
		if (isset($filter['branch_id']) && $filter['branch_id'])
        {
            $where .= " AND staff.branch_id = {$filter['branch_id']} ";
        }
		//学阶
		if (isset($filter['grade_id']) && $filter['grade_id'])
        {
            $where .= " AND staff.grade_id = {$filter['grade_id']} ";
        }
		//所在组
		if (isset($filter['group_id']) && $filter['group_id'])
        {
			if(is_array($filter['group_id']))
			{
				foreach($filter['group_id'] as $val)
					$where_status[] = " staff.group_id = {$val} ";
				
				$where .= " AND ( ".implode(' OR ', $where_status)." )";
			}
			else
				$where .= " AND staff.group_id = {$filter['group_id']} ";
			
        }
		elseif(is_school_admin()) //默认校区管理员只能查看咨询师和班主任.
		{
			$where .= " AND staff.group_id > ".GROUP_SCHOOLADMIN;
		}
		//员工姓名
		if (isset($filter['name']) && $filter['name'])
        {
            $where .= " AND staff.name LIKE '%{$filter['name']}%' ";
        }
		//可用的员工
		if (isset($filter['available_staff']) && $filter['available_staff'])
        {
            $where .= " AND staff.staff_id IN ( ".implode(',', $filter['available_staff'])." )";
        }
		
		//按照学科
		if (isset($filter['subject_id']) && $filter['subject_id'])
        {
            $where .= " AND (subject.subject_id = " . $filter['subject_id'] . ' OR subject.parrent_id = "' . $filter['subject_id'] . '")';
        }
		
		//student基本信息
		$sql = "SELECT staff.*, subject.subject_name, subject.subject_id FROM ".$this->db->dbprefix('crm_staff')." as staff
				LEFT JOIN ".$this->db->dbprefix('crm_staff_extra')." as staff_extra ON staff_extra.staff_id = staff.staff_id
				LEFT JOIN ".$this->db->dbprefix('crm_subject')." as subject ON staff_extra.subject_id = subject.subject_id
				". $where;
		
		//order by
		if (!empty($order_by))
        {
            $sql .= " ORDER BY $order_by $order";
        }
		
		//LIMIT
		if (!empty($row_count))
        {
            $sql .= " LIMIT $offset, $row_count";
        }
		
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
		{
			$staffs = array();
			foreach ($query->result_array() as $row)
			{
				$staffs[$row['staff_id']] = $row;
			}
			return $staffs;
		}
		else
		{
			return array();
		}
	}
	
	function getAll_count($filter)
	{
		//可用的员工
		if (isset($filter['available_staff']) && empty($filter['available_staff']))
			return 0;
		
		$where = '';
		$where .= " WHERE staff.is_active = {$filter['is_active']} ";//是否注销
        $where .= " AND staff.is_delete = {$filter['is_delete']} ";//是否删除
		
		//添加的时间段: 开始时间
        if (isset($filter['start_time']) && $filter['start_time'])
        {
            $where .= " AND staff.add_time >= {$filter['start_time']} ";
        }
		//添加的时间段: 结束时间
		if (isset($filter['end_time']) && $filter['end_time'])
        {
            $where .= " AND staff.add_time <= {$filter['end_time']} ";
        }
		//分校区
		if ($filter['branch_id'])
        {
            $where .= " AND staff.branch_id = {$filter['branch_id']} ";
        }
		//学阶
		if ($filter['grade_id'])
        {
            $where .= " AND staff.grade_id = {$filter['grade_id']} ";
        }
		//所在组
		if ($filter['group_id'])
        {
            if(is_array($filter['group_id']))
			{
				foreach($filter['group_id'] as $val)
					$where_status[] = " staff.group_id = {$val} ";
				
				$where .= " AND ( ".implode(' OR ', $where_status)." )";
			}
			else
				$where .= " AND staff.group_id = {$filter['group_id']} ";
        }
		elseif(is_school_admin()) //默认校区管理员只能查看咨询师和班主任.
		{
			$where .= " AND staff.group_id > ".GROUP_SCHOOLADMIN;
		}
		//员工姓名
		if ($filter['name'])
        {
            $where .= " AND staff.name LIKE '%{$filter['name']}%' ";
        }
		//可用的员工
		if (isset($filter['available_staff']) && $filter['available_staff'])
        {
            $where .= " AND staff.staff_id IN ( ".implode(',', $filter['available_staff'])." )";
        }
		
		//按照学科
		if (isset($filter['subject_id']) && $filter['subject_id'])
        {
            $where .= " AND subject.subject_id = " . $filter['subject_id'];
        }
		
		//student基本信息
		$sql = "SELECT COUNT(staff.staff_id) AS total FROM ".$this->db->dbprefix('crm_staff')." as staff 
				LEFT JOIN ".$this->db->dbprefix('crm_staff_extra')." as staff_extra ON staff_extra.staff_id = staff.staff_id
				LEFT JOIN ".$this->db->dbprefix('crm_subject')." as subject ON staff_extra.subject_id = subject.subject_id
				" . $where;
		$query = $this->db->query($sql);
		$row = $query->row_array();
		return $row['total'];
	}
	
	function get_all_performance($filter, $offset = 0, $row_count = 0)
	{
		//获取所有员工.
		$staffs = $this->getAll($filter, $offset, $row_count);
		
		//如果员工为空
		if(empty($staffs))
			return array();
		
		$staff_string = implode(',',array_keys($staffs));
		
		//添加的时间段: 开始时间
		$where = '';
        if ($filter['perf_start_time'])
        {
            $where .= " AND add_time >= {$filter['perf_start_time']} ";
        }
		//添加的时间段: 结束时间
		if ($filter['perf_end_time'])
        {
            $where .= " AND add_time <= {$filter['perf_end_time']} ";
        }
		
		//未报名
		$sql = "SELECT consultant_id, count(status_history_id) as not_signup
				FROM ".$this->db->dbprefix('crm_student_status_history')."
				WHERE consultant_id IN ($staff_string)
				AND status = ".STUDENT_STATUS_NOT_APPOINTMENT.' '.$where.
				" GROUP BY consultant_id";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
		{
			foreach ($query->result_array() as $row)
			{
				$staffs[$row['consultant_id']]['not_signup'] = $row['not_signup'];
			}
		}
		
		//consultant: 已报名
		$sql = "SELECT consultant_id, count(status_history_id) as not_signup
				FROM ".$this->db->dbprefix('crm_student_status_history')."
				WHERE consultant_id IN ($staff_string)
				AND status = ".STUDENT_STATUS_SIGNUP.' '.$where.
				" GROUP BY consultant_id";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
		{
			foreach ($query->result_array() as $row)
			{
				$staffs[$row['consultant_id']]['signup'] = $row['not_signup'];
			}
		}
		
		//consultant: 总课时
		$sql = "SELECT staff_id, SUM(total_hours) as total_hours
				FROM ".$this->db->dbprefix('crm_contract')."
				WHERE staff_id IN ($staff_string) ".$where." GROUP BY staff_id";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
		{
			foreach ($query->result_array() as $row)
			{
				$staffs[$row['staff_id']]['total_hours'] = $row['total_hours'];
			}
		}
		
		//supervisor: 正在学
		$sql = "SELECT supervisor_id, count(status_history_id) as learning
				FROM ".$this->db->dbprefix('crm_student_status_history')."
				WHERE supervisor_id IN ($staff_string)
				AND status = ".STUDENT_STATUS_LEARNING.' '.$where.
				" GROUP BY supervisor_id";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
		{
			foreach ($query->result_array() as $row)
			{
				$staffs[$row['supervisor_id']]['learning'] = $row['learning'];
			}
		}
		
		//supervisor: 已完成课时
		$sql = "SELECT supervisor_id, SUM(finished_hours) as finished_hours
			FROM ".$this->db->dbprefix('crm_contract_finished')."
			WHERE supervisor_id IN ($staff_string) ".$where." GROUP BY supervisor_id";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
		{
			foreach ($query->result_array() as $row)
			{
				$staffs[$row['supervisor_id']]['finished_hours'] = $row['finished_hours'];
			}
		}
		
		//consultant: 退费
		$sql = "SELECT consultant_id, SUM(refund_hours) as refund_hours
				FROM ".$this->db->dbprefix('crm_contract_refund')."
				WHERE consultant_id IN ($staff_string) ".$where." GROUP BY consultant_id";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
		{
			foreach ($query->result_array() as $row)
			{
				$staffs[$row['consultant_id']]['refund_hours'] = $row['refund_hours'];
			}
		}
		
		//投诉.
		$sql = "SELECT staff_id, COUNT(complain_id) as complain
				FROM ".$this->db->dbprefix('crm_complain')."
				WHERE staff_id IN ($staff_string)".$where."GROUP BY staff_id";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
		{
			foreach ($query->result_array() as $row)
			{
				$staffs[$row['staff_id']]['complain'] = $row['complain'];
			}
		}
		
		//处理空的: total_hours, refund_value, finished_hours
		$keys = array('not_signup', 'signup', 'learning', 'total_hours', 'finished_hours', 'refund_hours', 'complain');
		foreach($keys as $key)
		{
			foreach($staffs as $staff_id => $value)
			{
				if(!isset($value[$key]) || empty($value[$key]))
					$staffs[$staff_id][$key] = 0;
			}
		}
		return $staffs;
	}
		
	function getOne($staff_id)
	{
		//staff基本信息
		$sql = "SELECT staff.*, grade.grade_name, branch.branch_name, subject.subject_id, subject.subject_name FROM " . $this->db->dbprefix('crm_staff') . " as staff
				LEFT JOIN ".$this->db->dbprefix('crm_staff_extra')." as staff_extra ON staff_extra.staff_id = staff.staff_id
				LEFT JOIN ".$this->db->dbprefix('crm_subject')." as subject ON staff_extra.subject_id = subject.subject_id
				LEFT JOIN ".$this->db->dbprefix('crm_grade')." as grade ON grade.grade_id = staff.grade_id
				LEFT JOIN ".$this->db->dbprefix('crm_branch')." as branch ON branch.branch_id = staff.branch_id
				WHERE staff.staff_id = $staff_id";
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
	
	function get_all_by_group($group_id = 0)
	{
		$filter['group_id'] = $group_id;
		return $this->getAll($filter, 0,0, $order_by = 'username');
	}
	
	function get_all_by_subject($subject_id = 0)
	{
		$filter['subject_id'] = $subject_id;
		return $this->getAll($filter, 0,0, $order_by = 'username');
	}
	
	function add($staff)
	{
		//必填信息.
		$data['username'] = $staff['username'];
		$data['password'] = md5($staff['password']);
		$data['name'] = $staff['name'];
		$data['phone'] = $staff['phone'];
		$data['qq'] = $staff['qq'];
		$data['email'] = $staff['email'];
		
		//数字的必填信息
		$data['group_id'] = $staff['group_id'];
		$data['branch_id'] = $staff['branch_id'];
		$data['grade_id'] = $staff['grade_id'];
		
		//选填信息.
		$data['title'] = $staff['title'];
		$data['address'] = $staff['address'];
		$data['remark'] = $staff['remark'];
		$data['is_delete'] = 0;
		$data['is_active'] = 1;
		$data['add_time'] = date('Y-m-d H:i:s');
		$data['update_time'] = date('Y-m-d H:i:s');
		
		//ndedu1.2.2 新加： 性别，生日，星级，是否是试用期
		$data['dob'] = $staff['dob'];
		$data['gender'] = $staff['gender'];
		$data['level'] = $staff['level'];
		$data['in_trial'] = $staff['in_trial'];
			
		
		if($this->db->insert('crm_staff', $data))
		{
			$staff_id = $this->db->insert_id();
		}
		else
		{
			return false;
		}
		
		/*
		 * ndedu 1.2.4
		 * 插入crm_student_extra表.
		 */
		$data = array();
		$data['staff_id'] = $staff_id;
		$data['subject_id'] = $staff['subject_id'];
		$data['add_time'] = date('Y-m-d H:i:s');
		if(!$this->db->insert('crm_staff_extra', $data))
		{
			return false;
		}
		
		return true;
	}
	
	function update($staff_id, $update_field = array(), $update_extra_field = array())
	{
		if(!empty($update_field))
		{
			//更新student表
			foreach($update_field as $key => $val)
			{
				$data[$key] = $val;
			}
			$data['update_time'] = date('Y-m-d H:i:s');
			
			$this->db->where('staff_id', $staff_id);
			if(!$this->db->update('crm_staff', $data))
				return false;
		}
		
		if(!empty($update_extra_field))
		{
			$update_field_arr = array();
			$update_extra_field['staff_id'] = $staff_id;
			foreach($update_extra_field as $key => $val)
				$update_field_arr[] = "`$key`='$val'";
			
			$sql = 'INSERT INTO ' . $this->db->dbprefix('crm_staff_extra') . ' SET '.implode(',', $update_field_arr).' ON DUPLICATE KEY UPDATE `add_time`=`add_time`, '.implode(',', $update_field_arr);
			
			if (!$this->db->query($sql))
			{
				return false;
			}
		}
		
		return true;
	}
	
	/*
	  员工登陆. On success, return employ info, on failed, return empty array.
	*/
	function login($staff)
	{
		$sql = 'SELECT staff_id, username, group_id, branch_id FROM '.$this->db->dbprefix('crm_staff').' 
				WHERE username="'.$this->db->escape_str($staff['username']).'"
				AND password="'.md5($staff['password']).'" 
				AND is_active=1 
				AND is_delete=0
				LIMIT 1';
		
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
	
	function check_password($staff_id, $password)
	{
		$sql = "SELECT staff_id FROM ".$this->db->dbprefix('crm_staff')." 
				WHERE staff_id='".$staff_id."'
				AND password='".md5($password)."' 
				AND is_active=1 
				AND is_delete=0
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
	
	function username_has_exist($username)
	{
		$sql = "SELECT staff_id, username, group_id FROM ".$this->db->dbprefix('crm_staff')." 
				WHERE username='".$username."'
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
}
?>
<?php
class Employee_model extends Model {

	function Employee_model()
	{
		parent::Model();
	}
	
	function getAll($orderby = '')
	{
		$sql = "SELECT * FROM " . $this->db->dbprefix('crm_employee') . " as a
				LEFT JOIN " . $this->db->dbprefix('crm_group') . " as b on a.group_id = b.group_id";
		
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
	
	function getGroups()
	{
		$query = $this->db->get('crm_group');

		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
	}
	
	function add($employee)
	{
		$data['name'] = $employee['name'];
		$data['password'] = md5($employee['password']);
		$data['group_id'] = $employee['group'];
		$data['is_active'] = $employee['active'];
		$data['add_time'] = date('Y-m-d H:m:s');
		
		if($this->db->insert('crm_employee', $data))
		{
			return $this->db->insert_id();
		}
		else
		{
			return false;
		}
	}
	
	function update($employee_id, $employee)
	{
		$data['name'] = $employee['name'];
		$data['password'] = md5($employee['password']);
		$data['group_id'] = $employee['group'];
		$data['is_active'] = $employee['active'];
		$data['add_time'] = date('Y-m-d H:m:s');
		
		$this->db->where('employee_id', $employee_id);
		if($this->db->update('crm_employee', $data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	/*
	  ิฑนคตวยฝ. On success, return employ info, on failed, return empty array.
	*/
	function login($employee)
	{
		$sql = "SELECT employee_id, name, group_id FROM ".$this->db->dbprefix('crm_employee')." 
				WHERE name='".$employee['username']."'
				AND password='".md5($employee['password'])."' 
				AND is_active=1";
		
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
	
	function delect_employee($employee_id)
	{
		$this->db->where('employee_id', $employee_id);
		$this->db->delete('crm_employee'); 
		return ($this->db->affected_rows() > 0 ) ? TRUE : FALSE;
	}
}
?>
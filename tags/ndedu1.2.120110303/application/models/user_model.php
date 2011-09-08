<?php
class User_model extends Model {

	function User_model()
	{
		parent::Model();
	}

	function checkUserExist($user)
	{
		$this->db->select('uid');
		$this->db->where('user_name', $user); 
		$this->db->from('user');
		$query = $this->db->get();
		if ($query->num_rows() > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function checkLogin($user)
	{
		$this->db->where('user_name', $user['user_name']); 
		$this->db->where('password', md5($user['password']));
		$this->db->from('user');
		$query = $this->db->get();
		if ($query->num_rows() > 0)
		{
			return $query->row_array();
		}
		else
		{
			return false;
		}
	}
	
	function register($user)
	{
		$data['user_name'] = $user['user_name'];
		$data['real_name'] = $user['real_name'];
		$data['password'] = md5($user['password']);
		$data['phone'] = $user['phone'];
		$data['email'] = $user['email'];
		$data['province'] = $user['province'];
		$data['city'] = $user['city'];
		$data['district'] = $user['district'];
		
		$data['is_vip'] = 0;
		$data['is_active'] = 0;
		$data['add_time'] = date('Y-m-d H:i:s');
		$data['last_login_time'] = date('Y-m-d H:i:s');
				
		if($this->db->insert('user', $data))
		{
			return $this->db->insert_id();
		}
		else
		{
			return false;
		}
	}
		
	function getUserInfo($user_id)
	{
		$this->db->where('uid', $user_id); 
		$query = $this->db->get('user', 1);
		
		if ($query->num_rows() > 0)
		{		
			return $query->row_array();
		}
		else
		{
			return false;
		}
	}
	
	function validUser($uid)
	{
		$data = array('is_active' => 1);
		$this->db->where('uid', $uid);
		return $this->db->update('user', $data);
	}
}
?>
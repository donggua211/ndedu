<?php
class User_Student_model extends Model {

	function User_Student_model()
	{
		parent::Model();
	}
	
	
	function check_vipcode_exist($vipcode)
	{
		$this->db->where('vip_code', $vipcode); 
		$query = $this->db->get('crm_user_student', 1);
		
		if ($query->num_rows() > 0)
		{		
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function update_vip_code($user_id, $vipcode)
	{
		$data['user_id'] = $user_id;
		$data['vip_code'] = '';
		
		$this->db->where('vip_code', $vipcode);
		if($this->db->update('crm_user_student', $data))
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
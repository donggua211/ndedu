<?php
class CRM_Complain_model extends Model {

	function CRM_Complain_model()
	{
		parent::Model();
	}
	
	function add($complain)
	{
		//必填项
		$data['staff_id'] = $complain['staff_id'];
		$data['complain_reason'] = $complain['complain_reason'];
		
		$data['is_delete'] = 0;
		
		$data['add_time'] = date('Y-m-d H:i:s');
		$data['update_time'] = date('Y-m-d H:i:s');
		if($this->db->insert('crm_complain', $data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function get_one_staff_complain($staff_id)
	{
		//获取合同列表信息
		$sql = "SELECT * FROM " . $this->db->dbprefix('crm_complain') . " as complain
				WHERE staff_id = $staff_id
				AND is_delete = 0
				ORDER BY add_time";
		
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
	
	function get_one_complain($complain_id)
	{
		//获取合同列表信息
		$sql = "SELECT * FROM " . $this->db->dbprefix('crm_complain') . " as complain
				WHERE complain_id = $complain_id
				AND is_delete = 0
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
	
	function update($complain_id, $update_field = array())
	{
		if(empty($update_field))
			return true;
		
		foreach($update_field as $key => $val)
		{
				$data[$key] = $val;
		}
		$data['update_time'] = date('Y-m-d H:i:s');
		
		$this->db->where('complain_id', $complain_id);
		if($this->db->update('crm_complain', $data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
}

/* End of file admin.php */
/* Location: ./system/application/controllers/admin.php */
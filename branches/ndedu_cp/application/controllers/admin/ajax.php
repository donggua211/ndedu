<?php
/* 
  用户登录, 退出等功能.
  公共权限
 */
class Ajax extends Controller {

	function Ajax()
	{
		parent::Controller();
		$this->load->model('CRM_Region_model');
		$this->load->model('CRM_Staff_model');
		$this->load->model('CP_card_model');
		$this->load->model('CP_quan_model');
		
		$this->load->library('Services_JSON');
	}
	
	function region($parent, $type, $target)
	{
		$arr['regions'] = $this->CRM_Region_model->get_regions($type, $parent);
		$arr['type']    = $type;
		$arr['target']  = htmlspecialchars($target);
		echo $this->services_json->encode($arr);
		//print_r($this->services_json->decode($arr, 1));
	}
	
	function check_staff_username()
	{
		$username = $this->input->myPost('username');
		if($username == FAlSE)
		{
			echo 'warning: empty username';
		}
		else
		{
			if($this->CRM_Staff_model->username_has_exist($username))
			{
				echo 'yes';
			}
			else
			{
				echo 'no';
			}
		}
	}
	
	function gen_batch()
	{
		do
		{
			$batch = mt_rand(1000, 9999);
		}
		while($this->CP_card_model->check_batch_exist($batch));
		
		echo $batch;
	}
	
	function last_batch()
	{
		echo $this->CP_card_model->get_last_batch();
	}
	
	function last_quan_batch()
	{
		echo $this->CP_quan_model->get_last_batch();
	}
}

/* End of file admin.php */
/* Location: ./system/application/controllers/admin.php */
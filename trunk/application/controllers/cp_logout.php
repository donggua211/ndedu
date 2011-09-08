<?php

class cp_logout extends Controller {

	function cp_logout()
	{
		parent::Controller();
		$this->load->library('session');
	}

	function index()
	{
		setcookie('card_id', '', time() - 3600); 
		redirect('cp_login');
	}
	
}

/* End of file admin.php */
/* Location: ./system/application/controllers/admin.php */
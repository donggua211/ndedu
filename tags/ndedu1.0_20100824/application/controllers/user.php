<?php

class User extends Controller {

	function User()
	{
		parent::Controller();
	}
	
	function login()
	{
		$this->load->view('header_2');
		$this->load->view('login');
		$this->load->view('footer');
	}
}

/* End of file admin.php */
/* Location: ./system/application/controllers/admin.php */
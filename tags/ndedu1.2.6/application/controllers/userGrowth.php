<?php

class userGrowth extends Controller {

	function userGrowth()
	{
		parent::Controller();
	}
	
	function index()
	{
		$data_header['meta_title'] = '学习成长档案';
		$data_header['no_header'] = TRUE;
		
		$this->load->view('header', $data_header);
		$this->load->view('userGrowth/index');
		$this->load->view('footer');
	}
}

/* End of file admin.php */
/* Location: ./system/application/controllers/admin.php */
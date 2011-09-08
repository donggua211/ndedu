<?php

class Entry extends Controller {

	function Entry()
	{
		parent::Controller();
		$this->load->helper('string');
		$this->load->model('Article_model');
	}
	
	function index()
	{
		$data['news'] = $this->Article_model->getArticleByCat(1, 'time');
		$data['news_num'] = 6;
		$data['news_file_id'] = array(

		);

		$this->load->view('header');
		$this->load->view('index', $data);
		$this->load->view('footer');
	}
	
	function contactus()
	{
		$data_header['nav_menu_id'] = 7;
		$data_header['meta_title'] = 'contactus';
		
		$this->load->view('header', $data_header);
		$this->load->view('contactus');
		$this->load->view('footer');
	}
	
	function siteMap()
	{
		$this->load->view('header_1');
		$this->load->view('sitemap');
		$this->load->view('footer');
	}
	
	function oo1()
	{
		$this->load->view('promo0901');
	}
	
}

/* End of file admin.php */
/* Location: ./system/application/controllers/admin.php */
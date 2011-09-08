<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class static_page extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('Article_model');

		$this->load->helper('common');
	}
	
	function service()
	{
		$data['header']['nav_menu_id'] = '2';
		$this->_load_static_page_view('service', $data);
	}
	
	function aboutus()
	{
		$data['header']['nav_menu_id'] = '4';
		$this->_load_static_page_view('aboutus', $data);
	}
	
	function contactus()
	{
		$data['header']['nav_menu_id'] = '5';
		$this->_load_static_page_view('contactus', $data);
	}
	
	function _load_static_page_view($template, $data = array())
	{
		$data['header']['css_file'] = 'static_page.css';
		
		_load_viewer('static_page/'.$template, $data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
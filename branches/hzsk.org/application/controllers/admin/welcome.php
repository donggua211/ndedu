<?php
/* 
  后台入口.
  公共权限
 */
class Welcome extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('admin');
		
		//如果没有经登录, 就跳转到admin/login登陆页
		if (!has_login())
		{
			goto_login();
		}
		
		$this->staff_info = get_staff_info();
	}
	
	function index()
	{
		$data['main_url'] = 'admin/guestbook/';
		$this->load->view('admin/common_frame', $data);
	}
	
	function menu()
	{
		$data_header['css_file'] = 'common_menu.css';
		$this->load->view('admin/header', $data_header);
		$this->load->view('admin/common_menu');
		$this->load->view('admin/footer');
	}
	function top()
	{
		$data_header['css_file'] = 'common_top.css';
		$staff_info = get_staff_info();
		$data_main['username'] = $staff_info['username'];
		$this->load->view('admin/header', $data_header);
		$this->load->view('admin/common_top', $data_main);
		$this->load->view('admin/footer');
	}
	
	function drag()
	{
		$this->load->view('admin/common_drag');
	}
}

/* End of file admin.php */
/* Location: ./system/application/controllers/admin.php */
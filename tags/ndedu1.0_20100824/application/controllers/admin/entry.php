<?php

class Entry extends Controller {

	function Entry()
	{
		parent::Controller();
		
		$this->load->library('session');
		
		if (!$this->session->userdata("adminuser"))
		{
			redirect("admin/admin/login");
		}
		
		$this->load->model('Guestbook_model');
	}
	
	function index()
	{
		$this->load->view('admin/admin');
	}
	
	function menu()
	{
		$this->load->view('admin/menu');
	}
	
	function top()
	{
		$this->load->view('admin/top');
	}
	
	function info()
	{
		$data["new_messages"] = $this->Guestbook_model->getLast10NewGuestBook();
		
		
		$this->load->view('admin/info', $data);
	}
}

/* End of file admin.php */
/* Location: ./system/application/controllers/admin.php */
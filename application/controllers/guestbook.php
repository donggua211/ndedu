<?php

class Guestbook extends Controller {

	function Guestbook()
	{
		parent::Controller();
		
		$this->load->library('session');
		$this->load->model('Guestbook_model');
				
		$this->load->helper('ip');
		$this->load->helper('language');
		
		//$this->output->enable_profiler(TRUE);
	}

	function index()
	{
		$this->load->view('header');
		$this->load->view('guestbook');
		$this->load->view('footer');
	}
	
	function submit()
	{
		$captcha = $this->input->post('captcha');
		
		if($captcha == FAlSE || strtolower($captcha) != strtolower($this->session->userdata("captcha_word")))
		{
			$data['notification'] = 'wrong_safecode';
			$this->load->view('header');
			$this->load->view('guestbook', $data);
			$this->load->view('footer');
			return FALSE;
		}
		
		$message['username'] = $this->input->post('username');
		$message['phone'] = $this->input->post('phone');
		$message['grade'] = $this->input->post('grade');
		$message['message'] = $this->input->post('message');
		$message['from_page'] = $this->input->post('from_page');
		print_r($message);
		exit();
		$message['ip_address'] = real_ip();
		$message['from_page'] = $_SERVER['REQUEST_URI'];
		$message['add_time'] = time();		
		
		//if($message['username'] == FAlSE || $message['phone'] == FAlSE || $message['grade'] == FAlSE || $message['message'] == FAlSE)
		if(FALSE)
		{
			$data['notification'] = 'message_field_empty,';
			$data['notification'] .= $message['username']? '' : 'message_user'. ',';
			$data['notification'] .= $message['phone']? '' : 'message_phone'. ',';
			$data['notification'] .= $message['grade']? '' : 'message_grade'. ',';
			$data['notification'] .= $message['message']? '' : 'message_phone'. ',';
			$data['notification'] = trim($data['notification'], ' ,');
		}
		else
		{
			if($this->Guestbook_model->intertGuestbook($message))
			{
				$data['notification'] = 'message_successful,';
			}
			else
			{
				$data['notification'] = 'message_failed,';
			}
		
		}
		$this->load->view('header');
		$this->load->view('guestbook', $data);
		$this->load->view('footer');	
	}
}

/* End of file news.php */
/* Location: ./system/application/controllers/news.php */
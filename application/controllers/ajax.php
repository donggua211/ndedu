<?php

class Ajax extends CI_Controller {

	function __construct()
	{
		parent::__construct();	
		$this->load->library('session');
		$this->load->model('Guestbook_model');
		$this->load->helper('captcha');
		$this->load->helper('common');
	}
	
	function captcha()
	{
		header("content-type:image/gif");
	
		$pool = '2345678abcdefhijkmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ';

		$str = '';
		for ($i = 0; $i < 4; $i++)
		{
			$str .= substr($pool, mt_rand(0, strlen($pool) -1), 1);
		}
		
		$captcha_word = $str;

		$session_data = array('captcha_word'=>$captcha_word);
		$this->session->set_userdata($session_data);
		$vals = array(
					'word'		 => $captcha_word,
					'img_path'	 => './images/captcha/',
					'img_url'	 => 'http://localhost/project/ndedu.org/images/captcha/',
					'font_path'	 => '',
					'img_width'	 => '60',
					'img_height' => '20',
					'expiration' => 7200
				);
	
		create_captcha($vals);
	}
	
	function checkCaptcha($captcha = '')
	{
		if(empty($captcha) || strtolower($captcha) != strtolower($this->session->userdata("captcha_word")))
		{
			echo 'ng';
		}
		else
		{
			echo 'ok';
		}
	
	}
	
	function submitGuestBook()
	{
		$captcha = $this->input->post('captcha');
		
		if($captcha == FAlSE || strtolower($captcha) != strtolower($this->session->userdata("captcha_word")))
		{
			echo 'captcha wrong';
		}
		else
		{
			$message['username'] = trim($this->input->post('username'));
			$message['phone'] = trim($this->input->post('phone'));
			$message['email'] = trim($this->input->post('email'));
			$message['type'] = trim($this->input->post('type'));
			$message['message'] = trim($this->input->post('message'));
			
			$message['ip_address'] = real_ip();
			$message['add_time'] = date('Y-m-d H:i:s');		
			
			if($message['username'] == FAlSE || $message['phone'] == FAlSE || $message['email'] == FAlSE || $message['type'] == FAlSE || $message['message'] == FAlSE)
			{
				echo 'field empty';
			}
			else
			{
				if($this->Guestbook_model->intertGuestbook($message))
				{
					echo 'ok';
				}
				else
				{
					echo 'ng';
				}
			
			}
		}
	}
}

/* End of file admin.php */
/* Location: ./system/application/controllers/admin.php */
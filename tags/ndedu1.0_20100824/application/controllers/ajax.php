<?php

class Ajax extends Controller {

	function Ajax()
	{
		parent::Controller();		
		$this->load->library('session');
		$this->load->plugin('captcha');
		$this->load->model('Guestbook_model');
		$this->load->helper('ip');
	}
	
	function captcha()
	{
		header("content-type:image/gif");
		$captcha_word = 'asd3';
		

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
			$message['username'] = $this->input->post('username');
			$message['phone'] = $this->input->post('phone');
			$message['grade'] = $this->input->post('grade');
			$message['message'] = $this->input->post('message');
			$message['from_page'] = $this->input->post('from_page');
			
			$message['ip_address'] = real_ip();
			$message['add_time'] = time();		
			
			if($message['username'] == FAlSE || $message['phone'] == FAlSE || $message['grade'] == FAlSE || $message['message'] == FAlSE)
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
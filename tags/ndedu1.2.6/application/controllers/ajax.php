<?php

class Ajax extends Controller {

	function Ajax()
	{
		parent::Controller();		
		$this->load->library('session');
		$this->load->plugin('captcha');
		$this->load->model('Guestbook_model');
		$this->load->model('CP_comment_model');
		$this->load->model('CP_quan_model');
		$this->load->model('User_model');
		$this->load->helper('ip');
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
		$captcha = $this->input->myPost('captcha');
		
		if($captcha == FAlSE || strtolower($captcha) != strtolower($this->session->userdata("captcha_word")))
		{
			echo 'captcha wrong';
		}
		else
		{
			$message['username'] = $this->input->myPost('username');
			$message['phone'] = $this->input->myPost('phone');
			$message['grade'] = $this->input->myPost('grade');
			$message['message'] = $this->input->myPost('message');
			$message['from_page'] = $this->input->myPost('from_page');
			
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
	
	function add_comment()
	{
		$captcha = $this->input->myPost('captcha');
		
		if($captcha == FAlSE || strtolower($captcha) != strtolower($this->session->userdata("captcha_word")))
		{
			echo 'captcha wrong';
		}
		else
		{
			$comment['name'] = trim($this->input->Post('name'));
			$comment['comment'] = trim($this->input->Post('comment'));
			$comment['cat_id'] = $this->input->Post('cat_id');
			
			if($comment['name'] == FAlSE || $comment['comment'] == FAlSE)
			{
				echo 'field empty';
			}
			else
			{
				if($this->CP_comment_model->add($comment))
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
	
	function checkUserExist()
	{
		$username = $this->input->myPost('username');
		if($username == FAlSE)
		{
			echo 'warning: empty username';
		}
		else
		{
			if($this->User_model->checkUserExist($username))
			{
				echo 'yes';
			}
			else
			{
				echo 'no';
			}
		}
	}
	
	function get_ship_value($province_id = 0)
	{
		$ship_fee = get_ship_fee($province_id);
		echo implode(',', $ship_fee);
	}
	
	function check_quan($quan_id = '')
	{
		if(empty($quan_id) )
		{
			echo 'ng';
		}
		else
		{
			$quan_info = $this->CP_quan_model->get_one_quan($quan_id, true);
			if(!empty($quan_info))
			{
				echo $quan_info['value'];
			}
			else
			{
				echo 'ng';
			}
		}
	
	}
}

/* End of file admin.php */
/* Location: ./system/application/controllers/admin.php */
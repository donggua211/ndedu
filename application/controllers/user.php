<?php

class User extends Controller {

	function User()
	{
		parent::Controller();
		$this->load->model('User_model');
		$this->load->model('User_Student_model');
		$this->load->library('session');
		$this->load->library('email');
		
		$this->mailMessage['valid'] = "亲爱的NAME，您好！欢迎您注册尼德教育.
----------------------------------------------------------------
请牢记您的个人信息:
用户名: NAME
密码: PASSWORD

您只需再花1秒钟，点击下面的链接，既可激活您的帐号： ".site_url('user/valid')."/VALIDKEY/BACKURL

尼德教育
http://www.ndedu.org";
	}
	
	function logout($backurl='')
	{
		if(empty($backurl))
		{
			$backurl = (isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER']))?$_SERVER['HTTP_REFERER']:'index.php';
		}
		else
		{
			$backurl = str_replace('-', '/', $backurl);
			$backurl = site_url($backurl);
		}
		$this->session->sess_destroy();
		redirect($backurl, 'refresh');
	}
	
	function login($backurl='')
	{
		if ($this->session->userdata("user_id")>0) 
		{
			if($backurl=='login' || $backurl=='user/login')
			{
				$backurl = '';
			}
			$backurl = str_replace('-', '/', $backurl);
			redirect($backurl, 'refresh');
		}
		
		if(!empty($_POST))
		{
			$user['user_name'] = $this->input->myPost("username");
			$user['password'] = $this->input->myPost("password");
			$user['backurl'] = $this->input->myPost('backurl');
			
			if($user['user_name'] == FAlSE || $user['password'] == FAlSE)
			{
				$data = $user;
				$data['notification'] = '请填写完整信息.';
				$this->loadLoginViewEvaluate(array() , $data);
			}
			else
			{				
				$result = $this->User_model->checkLogin($user);
				if(!$result)
				{
					$data = $user;
					$data['notification'] = '用户名或者密码错误!';
					$this->loadLoginViewEvaluate(array() , $data);
				}
				elseif($result['is_active'] == '0')
				{
					$data = $user;
					list(,$emailurl) = explode('@',$result['email']);
					$data['emailurl'] = 'http://mail.'.$emailurl;
					$data['notification'] = '您的用户尚未激活, <a href="'.$data['emailurl'].'" target="_blank">去我的邮箱激活</a>';
					$this->loadLoginViewEvaluate(array() , $data);
				}
				else
				{
					//登陆成功!
					$this->session->set_userdata(array('user_id'=>$result['uid'], 'user_name'=>$user['user_name']));
					$user['backurl'] = str_replace('-', '/', $user['backurl']);
					redirect($user['backurl'], 'refresh');
				}
			}
		}
		else
		{
			$data['backurl'] = $backurl;
			$this->loadLoginViewEvaluate(array() , $data);
		}
	}
	
	function register($backurl='evaluate')
	{
		if(isset($_POST['submit']) && !empty($_POST['submit']))
		{
			$user['user_name'] = $this->input->myPost('username');
			$user['real_name'] = $this->input->myPost('realname');
			$user['password'] = $this->input->myPost('password');
			$user['password_c'] = $this->input->myPost('password_c');
			$user['phone'] = $this->input->myPost('phone');
			$user['email'] = $this->input->myPost('email');
			$user['province'] = $this->input->myPost('User_Shen');
			$user['city'] = $this->input->myPost('User_Town');
			$user['district'] = $this->input->myPost('User_City');
			$user['vipcode'] = $this->input->myPost('vipcode');
			$user['captcha'] = $this->input->myPost('captcha');
			$user['backurl'] = $this->input->myPost('backurl');

			if($user['user_name'] == FAlSE ||$user['real_name'] == FAlSE ||$user['password'] == FAlSE ||$user['password_c'] == FAlSE ||$user['phone'] == FAlSE ||$user['email'] == FAlSE ||$user['province'] == FAlSE ||$user['city'] == FAlSE ||$user['district'] == FAlSE || $user['captcha'] == FALSE)
			{
				$data = $user;
				$data['notification'] = '请填写完成的注册信息!';
				$this->loadRegisterView(array() , $data);
			}
			elseif($user['password'] != $user['password_c'])
			{
				$data = $user;
				$data['notification'] = '两次输入的密码不一样, 请重新输入!';
				$this->loadRegisterView(array() , $data);
			}
			elseif($this->User_model->checkUserExist($user['user_name']))
			{
				$data = $user;
				$data['notification'] = '对不起, 您所输入的用户名已存在, 请重新输入!';
				$this->loadRegisterView(array() , $data);
			}
			elseif(strtolower($user['captcha']) != strtolower($this->session->userdata("captcha_word")))
			{
				$data = $user;
				$data['notification'] = '您输入的验证码有误， 请重新输入。';
				$this->loadRegisterView(array() , $data);
			}
			elseif($user['vipcode'] && !$this->User_Student_model->check_vipcode_exist($user['vipcode']))
			{
				$data = $user;
				$data['notification'] = '您输入的VIP验证码有误， 请重新输入。';
				$this->loadRegisterView(array() , $data);
			}
			else
			{
				$result = $this->User_model->register($user);
				if(!$result)
				{
					$data = $user;
					$data['notification'] = '对不起, 注册失败, 请重试!';
					$this->loadRegisterView(array() , $data);
				}
				else
				{
					//更新user_student表
					if($user['vipcode'])
					{
						$this->User_Student_model->update_vip_code($result, $user['vipcode']);
					}
					//成功!
					$subject = '尼德教育注册账号激活';
					$validkey = substr(md5($user['password']), 0, 12).$result;
					$this->mailMessage['valid'] = str_replace(array('NAME', 'PASSWORD', 'VALIDKEY', 'BACKURL'), array($user['user_name'], $user['password'], $validkey, $user['backurl']), $this->mailMessage['valid']);
					$this->_sendmail($user['email'], $subject, $this->mailMessage['valid']);
					
					list(,$emailurl) = explode('@',$user['email']);
					$emailurl = 'http://mail.'.$emailurl;
		
					$data = $user;
					$data['emailurl'] = $emailurl;
					$data_header['meta_title'] = '注册成功';
					$this->load->view('header', $data_header);
					$this->load->view('register_successful', $data);
					$this->load->view('footer');
				}
			}
		
		}
		else
		{
			$data['backurl'] = $backurl;
			$this->loadRegisterView(array() , $data);
		}
	}
	
	function valid($validkey, $backurl)
	{
		if(empty($validkey) || (strlen($validkey) < 15))
		{
			$data['notification'] = '对不起, 您输入的验证码有误!';
			$this->loadValidView(array() , $data);
		}
		else
		{
			$password_key = substr($validkey, 0, 12);
			$user_id = substr($validkey, 12);
			$user_info = $this->User_model->getUserInfo($user_id);
			
			if(!$user_info || $password_key != substr($user_info['password'], 0, 12))
			{
				$data['notification'] = '对不起, 您输入的验证码有误!';
				$this->loadValidView(array() , $data);
			}
			elseif($user_info['is_active'] == '1')
			{
				$data['notification'] = '您的账号已经激活, 不需要再次激活.<br/>
					<a href="'.site_url('evaluate').'"><strong>点击这里进入测评</strong></a>';
				$this->loadValidView(array() , $data);
			}
			else
			{
				if($this->User_model->validUser($user_id))
				{
					$this->session->set_userdata(array('user_id'=>$user_id));
					$data = $user_info;
					$this->loadValidView(array() , $data);				
				}
				else
				{
					$data['notification'] = '对不起, 验证失败, 请重试!';
					$this->loadValidView(array() , $data);
				}
			}
		}
	
	}
	
	function loadValidView($data_header=array(), $data=array())
	{
		$data_header['meta_title'] = '用户注册验证';
		$this->load->view('header', $data_header);
		$this->load->view('register_valid', $data);
		$this->load->view('footer');
	}
	
	function loadRegisterView($data_header=array(), $data=array())
	{
		$data_header['meta_title'] = '用户注册';
		$data_footer['load_register_js'] = true;
		$this->load->view('header', $data_header);
		$this->load->view('register', $data);
		$this->load->view('footer', $data_footer);
	}
	function loadLoginViewEvaluate($data_header=array(), $data=array())
	{
		$data_header['meta_title'] = '用户登陆';
		$data_header['no_header'] = true;
		$data_footer['no_footer'] = true;
		$this->load->view('header', $data_header);
		$this->load->view('evaluate/login', $data);
		$this->load->view('footer', $data_footer);
	}
	function _sendmail($email, $subject, $message)
	{
		if(IS_ONLINE)
		{
			$this->email->to($email);
			$this->email->from('yourgrow@gmail.com');
			$this->email->subject($subject);
			$this->email->message($message);
			$this->email->send();
		}
	}
}

/* End of file admin.php */
/* Location: ./system/application/controllers/admin.php */
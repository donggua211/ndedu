<?php

class cp_login extends Controller {

	function cp_login()
	{
		parent::Controller();
		$this->load->library('session');
		
		$this->load->model('CP_card_model');
		$this->load->model('CP_Category_model');
		
		$this->load->helper('common');
		$this->load->helper('cp');
		
		$this->card_id = _getauthcookie('card_id');
		//如果已经登录, 就跳转到cp开始测评
		if($this->card_id)
		{
			goto_cp();
		}
	}
	
	//登陆面
	function index($cat_id = 0, $level = 0)
	{
		$cat_id = (empty($cat_id))? intval($this->input->post('cat_id')) : intval($cat_id);
		$card['cat_id'] = ($cat_id > 0) ? $cat_id : 1;
		$level = (empty($level))? intval($this->input->post('level')) : intval($level);
		$card['level'] = ($level > 0) ? $level : 1;
				
		if(isset($_POST) && count($_POST) > 0)
		{
			$card['card_id'] = floatval($this->input->post('card_id'));
			$card['level'] = $this->input->post('level');
			$card['password'] = $this->input->post('password');
			$card['captcha'] = $this->input->post('captcha');
			
			if(empty($card['level']))
			{
				$notify = '请您选择测评的种类.';
				$this->_load_login_view($notify, $card);
			}
			elseif(empty($card['card_id']))
			{
				$notify = '请您填写您的用户名!';
				$this->_load_login_view($notify, $card);
			}
			elseif(empty($card['password']))
			{
				$notify = '请您填写您的密码!';
				$this->_load_login_view($notify, $card);
			}
			elseif($card['captcha'] == FAlSE || strtolower($card['captcha']) != strtolower($this->session->userdata("captcha_word")))
			{
				$notify = '您输入的验证码不对!';
				$this->_load_login_view($notify, $card);
			}
			else
			{
				//获取批次号, 冲击力批次号.
				$card_info = $this->CP_card_model->get_one_card($card['card_id']);
				if(empty($card_info))
				{
					$notify = '您输入的卡号不正确, 请重新输入!';
					$this->_load_login_view($notify, $card);
				}
				elseif($card_info['password'] != md5($card['password']))
				{
					$notify = '您输入的密码不正确, 请重新输入!';
					$this->_load_login_view($notify, $card);
				}
				elseif($card_info['level'] != $card['level'])
				{
					$notify = '您所选择的测评类型不正确, 请重新选择!';
					$this->_load_login_view($notify, $card);
				}
				else //登陆成功
				{
					//存在加密的cookie. 有效期: seesion结束.
					_setauthcookie('card_id', $card_info['card_id'], 0);
					
					//根据用户状态, 跳转
					switch($card_info['status'])
					{
						case CP_CARD_STATUS_UNUSED:
							$url = 'ceping/agreement';
							break;
						case CP_CARD_STATUS_AGREED:
							$url = 'ceping/userinfo';
							break;
						case CP_CARD_STATUS_STARTED:
							$url = 'ceping/cp';
							break;
						case CP_CARD_STATUS_FINISHED:
							$url = 'ceping/finished';
							break;
					}
					redirect($url);
					exit();
				}
			}
		}
		else
		{
			$this->_load_login_view('', $card);
		}
	}
	
	function _load_login_view($notify = '', $card)
	{
		$data['header']['meta_title'] = '登陆 - 尼德全方位测评系统';
		$data['main']['notification'] = $notify;
		$data['main']['card'] = $card;
		$data['main']['cat_list'] = $this->CP_Category_model->get_all_category();
		$data['footer']['js_file'] = 'cp.js';
		$data['footer']['no_baidu'] = 1;
		_load_cp_viewer('login', $data, false, true, false, true);
	}
}

/* End of file admin.php */
/* Location: ./system/application/controllers/admin.php */
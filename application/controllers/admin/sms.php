<?php
require_once(APPPATH.'libraries/nusoap0.9.5/nusoap.php');

class sms extends Controller {

	function sms()
	{
		parent::Controller();
		$this->load->library('session');
		$this->load->helper('admin');
		
		//如果没有经登录, 就跳转到admin/login登陆页
		if (!has_login())
		{
			goto_login();
		}
		
		$this->staff_info = get_staff_info();
		
		$this->soap_url = 'http://ipyy.net/WS/linkWS.asmx?wsdl';
		$this->corp_id = 'YY8800923';
		$this->password = '991883';
	}
	
	function send()
	{
		$mobile = trim($this->input->post('mobile'));
		$content = trim($this->input->post('content'));
		
		if(empty($content))
		{
			$this->_load_student_sms_viewer($mobile, $content, '短信内容不能为空');
			return false;
		}
		
		//判断黑词典
		$keyword = file_get_contents(APPPATH.'config/sms/keyword.txt');
		$keywords = explode("\n", $keyword);
		
		foreach($keywords as $val)
		{
			if(strpos($content, trim($val)) !== FALSE)
			{
				$this->_load_student_sms_viewer($mobile, $content, '短信中不能包含词语：“'.$val.'”');
				return false;
			}
		}
		
		$client = new nusoap_client($this->soap_url, 'wsdl');
		$client->setUseCurl(1);
		$client->soap_defencoding = 'utf-8';
		$err = $client->getError();
		
		if ($err) {
			echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
			echo '<h2>Debug</h2>';
			echo '<pre>' . htmlspecialchars($client->getDebug(), ENT_QUOTES) . '</pre>';
			exit();
		}
		
		$param = array(
			'CorpID' => $this->corp_id,
			'Pwd' => $this->password,
			'Mobile' => $mobile,
			'Content' => $content,
			'Cell' => '',
			'SendTime' => '',
		);
		
		$result = $client->call('BatchSend', array('parameters' => $param), '', '', false, true);
		
		print_r($result);
		
		if ($client->fault)
		{
			echo '<h2>Fault (Expect - The request contains an invalid SOAP body)</h2><pre>'; print_r($result); echo '</pre>';
		} 
		else
		{
			$err = $client->getError();
			if ($err) 
			{
				echo '<h2>Error</h2><pre>' . $err . '</pre>';
			}
			else 
			{
				switch($result['BatchSendResult'])
				{
					case 0:
						$result_text = '发送成功进入审核阶段';
						break;
					case 1:
						$result_text = '直接发送成功';
						break;
					case -1:
						$result_text = '账号未注册';
						break;
					case -2:
						$result_text = '其他错误';
						break;
					case -3:
						$result_text = '帐号或密码错误';
						break;
					case -4:
						$result_text = '一次提交信息不能超过600个手机号码';
						break;
					case -5:
						$result_text = '余额不足，请先充值';
						break;
					case -6:
						$result_text = '定时发送时间不是有效的时间格式';
						break;
					case -8:
						$result_text = '发送内容需在3到250字之间';
						break;
					case -9:
						$result_text = '发送号码为空';
						break;
					default:
						$result_text = $client->response;
						break;
				
				}
				echo '<h2>Response</h2><pre>' . $result_text . '</pre>';
			}
		}
	}
	
	function check()
	{
		if(isset($_POST['submit']) && !empty($_POST['submit']))
		{
			$content = trim($this->input->post('content'));
		
			if(empty($content))
			{
				$this->_load_ssms_check_viewer($content, '短信内容不能为空');
				return false;
			}
			
			//检查短信长度
			if(mb_strlen($content, 'UTF-8') > 70 )
			{
				$this->_load_ssms_check_viewer($content, '短信不能超过70个字');
				return false;
			}
			
			
			//判断黑词典
			$keyword = file_get_contents(APPPATH.'config/sms/keyword.txt');
			$keywords = explode("\n", $keyword);
			
			foreach($keywords as $val)
			{
				if(strpos($content, trim($val)) !== FALSE)
				{
					$this->_load_ssms_check_viewer($content, '短信中不能包含词语：“'.$val.'”');
					return false;
				}
			}
			
			$data['header']['meta_title'] = '短信内容合格 - 管理学员';
			$data['main']['notification'] = '短信检查成功，可以发送! ';
			$data['main']['content'] = $content;
			_load_viewer($this->staff_info['group_id'], 'sms_check_result', $data);
		}
		else
		{
			$this->_load_ssms_check_viewer();
		}
	}
	
	function _load_ssms_check_viewer($content = '', $notice = '')
	{
		$data['header']['meta_title'] = '短信内容检查 - 管理学员';
		$data['main']['content'] = $content;
		$data['main']['notification'] = $notice;
		_load_viewer($this->staff_info['group_id'], 'sms_check', $data);
	}
	
	function _load_student_sms_viewer($mobile, $content, $notice = '')
	{
		$data['header']['meta_title'] = '发送短信 - 管理学员';
		$data['main']['sms_mobile'] = $mobile;
		$data['main']['content'] = $content;
		$data['main']['notification'] = $notice;
		_load_viewer($this->staff_info['group_id'], 'student_sms', $data);
	}
}

/* End of file admin.php */
/* Location: ./system/application/controllers/admin.php */
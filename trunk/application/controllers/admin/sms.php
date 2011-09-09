<?php
header("Content-Type: text/html; charset=utf-8");

require_once(APPPATH.'libraries/nusoap0.9.5/nusoap.php');

class sms extends Controller {

	function sms()
	{
		parent::Controller();
		$this->load->library('session');
		$this->load->helper('admin');
		$this->load->helper('sms');
		
		/*如果没有经登录, 就跳转到admin/login登陆页*/
		if (!has_login())
		{
			goto_login();
		}
		
		$this->staff_info = get_staff_info();
		
	}
	
	function send()
	{
		$mobile = trim($this->input->post('mobile'));
		$content = trim($this->input->post('content'));
		
		//检查输入为空
		if(empty($mobile) || empty($content))
		{
			$this->_load_student_sms_viewer($mobile, $content, '手机号码或者短信内容不能为空');
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
		
		//发送短信
		$result = $this->_send($mobile, $content);
		
		echo $result;
		
		/*
		if($result === FALSE)
		{
			echo '发送失败，请将页面截图，发至管理员: zhaoyuan@ndedu.org';
			return false;
		}
		
		switch($result['return'])
		{
			case -1:
				$result_text = '发送失败！手机号码或者短信内容不能为空';
				break;
			case 0:
				$result_text = '发送成功！';
				break;
			case 17:
				$result_text = '发送信息失败';
				break;
			case 18:
				$result_text = '发送定时信息失败';
				break;
			case 101:
				$result_text = '客户端网络故障';
				break;
			case 305:
				$result_text = '服务器端返回错误，错误的返回值（返回值不是数字字符串）';
				break;
			case 307:
				$result_text = '目标电话号码不符合规则，电话号码必须是以0、1开头';
				break;
			case 997:
				$result_text = '平台返回找不到超时的短信，该信息是否成功无法确定';
				break;
			case 998:
				$result_text = '由于客户端网络问题导致信息发送超时，该信息是否成功下发无法确定';
				break;
			default:
				$result_text = '未知错误代码：'.$result_text.'。 请将页面截图，发至管理员: zhaoyuan@ndedu.org';
				break;
		}
		
		echo '<h2>Response</h2><pre>' . $result_text . '</pre>';
		*/
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
	
	
	/**
	 * 远程调用，网址： http://www.donggua211.com/ndedu/index.php/admin/sms/send
	 */
	function _send($mobile, $content)
	{
		$url = "http://www.donggua211.com/ndedu/index.php/admin/sms_api/send";
		$post_data = array (
			"mobile" => $mobile,
			"content" => $content.'【尼德教育】',
		);
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		//指定post数据
		curl_setopt($ch, CURLOPT_POST, 1);
		//添加变量
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
		$output = curl_exec($ch);
		
		curl_close($ch);
		
		return $output;
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
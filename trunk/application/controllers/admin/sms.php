<?php
header("Content-Type: text/html; charset=utf-8");

require_once(APPPATH.'libraries/nusoap0.9.5/nusoap.php');

class sms extends Controller {

	function sms()
	{
		parent::Controller();
		$this->load->model('CRM_Sms_history_model');
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
		preg_match('/<font>(.*?)<\/font>/', $result, $matches);
		$status = (int)$matches[1];
		
		//记入history
		$this->_add_sms_history($status, $content, $mobile);
		
		if($status == '0')	//成功
		{
			show_result_page('短信发送成功', '');
		}
		else
		{
			preg_match('/<pre>(.*?)<\/pre>/', $result, $matches);
			$error = $matches[1] ? $matches[1] : '发送失败。';
			show_error_page($error, '');
		}
	}
	
	function _add_sms_history($status, $content, $mobile)
	{
		$resend = trim($this->input->post('resend'));
		
		//重发
		if($resend == '1')
		{
			$sms_history_id = trim($this->input->post('sms_history_id'));
			
			$update_field['status'] = $status;
			$update_field['update_time'] = date('Y-m-d H:i:s');
			$this->CRM_Sms_history_model->update($sms_history_id, $update_field);
		}
		else
		{
			$mobiles = explode(',', $mobile);
			foreach($mobiles as $key => $val)
			{
				$sms_history = array(
					'staff_id' => $this->staff_info['staff_id'],
					'sms_text' => $content,
					'mobile' => $mobile,
					'status' => $status,
				);
				$this->CRM_Sms_history_model->add($sms_history);
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
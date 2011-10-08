<?php
/*
 * 短信 sms 接口文件。用于远程调用。
*/

require_once(APPPATH.'libraries/nusoap0.9.5/nusoap.php');

class sms_api extends Controller {

	function sms_api()
	{
		parent::Controller();
		$this->load->helper('sms');
				
		//配置信息
		$this->url = 'http://sdkhttp.eucp.b2m.cn/sdk/SDKService?wsdl';
		$this->serialNumber = '3SDK-EMY-0130-MEXLO';
		$this->password = '518301';
		$this->sessionKey = '521314';
	}
	
	function send()
	{
		$mobile = trim($this->input->post('mobile'));
		$content = trim($this->input->post('content'));
		
		//检查输入为空
		if(empty($mobile) || empty($content))
		{
			echo '手机号码或者短信内容不能为空';
			return false;
		}
		
		//判断黑词典
		$keyword = file_get_contents(APPPATH.'config/sms/keyword.txt');
		$keywords = explode("\n", $keyword);
		
		foreach($keywords as $val)
		{
			if(strpos($content, trim($val)) !== FALSE)
			{
				echo '短信中不能包含词语：“'.$val.'”';
				return false;
			}
		}
		
		//手机号码转换
		$mobiles = explode(',', $mobile);
		
		foreach($mobiles as $key => $val)
			$mobiles[$key] = trim($val);
		
		//发送短信
		$result = $this->_send($mobiles, $content);
		
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
				$result_text = '未知错误代码：'.$result['return'].'。 请将页面截图，发至管理员: zhaoyuan@ndedu.org';
				break;
		}
		
		echo '<h2>Response</h2><pre>' . $result_text . '</pre>';
	}
	
	//短信费用
	function getEachFee()
	{
		$params = array('arg0'=>$this->serialNumber,'arg1'=>$this->sessionKey);
		$fee = soap_call($this->url, 'getEachFee', $params);
		echo "费用:".$fee;
	}
	
	//短信费用
	function getBalance()
	{
		$params = array('arg0'=>$this->serialNumber,'arg1'=>$this->sessionKey);
		$balance = soap_call($this->url, 'getBalance', $params);
		echo "余额:".$balance;
	}
	
	function login()
	{
		$params = array('arg0'=>$this->serialNumber,'arg1'=>$this->sessionKey, 'arg2'=>$this->password);
		$statusCode = soap_call($this->url, 'registEx', $params);
		
		echo "处理状态码:".$statusCode."<br/>";
		if ($statusCode!=null && $statusCode=="0")
		{
			echo "登录成功, session key:".$this->sessionKey."<br/>";
		}
		else
		{
			echo "登录失败";
		}
	}
	
	function logout()
	{
		$params = array('arg0'=>$this->serialNumber,'arg1'=>$this->sessionKey);
		
		$result = soap_call($this->url, 'logout', $params);

		echo "处理状态码:".$result."<br/>";
	}
	
	
	//得到上行短信 用例
	function getMO()
	{
		$params = array('arg0'=>$this->serialNumber,'arg1'=>$this->sessionKey);
		$result = soap_call($this->url, 'getMO', $params);
		
		if (is_array($result) && count($result)>0)
		{
			if (is_array($result[0]))
			{
				foreach($result as $moArray)
					$moResult[] = $moArray;	
			}else{
				$moResult[] = $result;
			}
				
		}
		
		echo "返回数量:".count($moResult);
		foreach($moResult as $mo)
		{
			//$mo 是位于 Client.php 里的 Mo 对象
			// 实例代码为直接输出
			echo "发送者附加码:".$mo['getAddSerial'];
			echo "接收者附加码:".$mo['getAddSerialRev'];
			echo "通道号:".$mo['getChannelnumber'];
			echo "手机号:".$mo['getMobileNumber'];
			echo "发送时间:".$mo['getSentTime'];
			echo "短信内容:".$mo['getSmsContent'];
			// 上行短信务必要保存,加入业务逻辑代码,如：保存数据库，写文件等等
		}
	}
	
	/**
	 * 短信发送  (注:此方法必须为已登录状态下方可操作)
	 * 
	 * @param array $mobiles		手机号, 如 array('159xxxxxxxx'),如果需要多个手机号群发,如 array('159xxxxxxxx','159xxxxxxx2') 
	 * @param string $content		短信内容
	 * @param string $sendTime		定时发送时间，格式为 yyyymmddHHiiss, 即为 年年年年月月日日时时分分秒秒,例如:20090504111010 代表2009年5月4日 11时10分10秒
	 * 								如果不需要定时发送，请为'' (默认)
	 *  
	 * @param string $addSerial 	扩展号, 默认为 ''
	 * @param string $charset 		内容字符集, 默认GBK
	 * @param int $priority 		优先级, 默认5
	 * @return int 操作结果状态码
	 */
	function _send($mobiles, $content)
	{
		if(empty($mobiles) || empty($content))
			return -1;
		
		$content = iconv('UTF-8', 'gbk', $content);
		
		$params = array(
			'arg0' => $this->serialNumber,
			'arg1' => $this->sessionKey,
			'arg2' => '', //sendTime
			'arg4' => $content,
			'arg5' => '', //addSerial
			'arg6' => 'GBK', //charset
			'arg7' => 5 	//priority
			);
		
		/**
		 * 多个号码发送的xml内容格式是 
		 * <arg3>159xxxxxxxx</arg3>
		 * <arg3>159xxxxxxx2</arg3>
		 * ....
		 * 所以需要下面的单独处理
		 * 
		 */
		foreach($mobiles as $mobile)
		{
			array_push($params,new soapval("arg3", false, $mobile));	
		}
		
		$result = soap_call($this->url, "sendSMS", $params);
		
		return $result;
	}
}

/* End of file admin.php */
/* Location: ./system/application/controllers/admin.php */
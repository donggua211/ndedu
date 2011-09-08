<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* 
	前台页面, 通用方法.
 */
	
	/** 
	 * @param string $string 原文或者密文 
	 * @param string $operation 操作(ENCODE | DECODE), 默认为 DECODE 
	 * @param string $key 密钥 
	 * @param int $expiry 密文有效期, 加密时候有效， 单位 秒，0 为永久有效 
	 * @return string 处理后的 原文或者 经过 base64_encode 处理后的密文 
	 * 
	 * @example 
	 * 
	 *  $a = authcode('abc', 'ENCODE', 'key');
	 *  $b = authcode($a, 'DECODE', 'key');  // $b(abc)
	 * 
	 *  $a = authcode('abc', 'ENCODE', 'key', 3600);
	 *  $b = authcode('abc', 'DECODE', 'key'); // 在一个小时内，$b(abc)，否则 $b 为空 
	 */

	function authcode($string, $operation = 'DECODE', $key = '', $expiry = 3600)
	{
		$default_key = 'ndedu';
		$ckey_length = 4;
		// 随机密钥长度 取值 0-32; 
		// 加入随机密钥，可以令密文无任何规律，即便是原文和密钥完全相同，加密结果也会每次不同，增大破解难度。 
		// 取值越大，密文变动规律越大，密文变化 = 16 的 $ckey_length 次方 
		// 当此值为 0 时，则不产生随机密钥 
		$key = md5($key ? $key : $default_key); 
		$keya = md5(substr($key, 0, 16)); 
		$keyb = md5(substr($key, 16, 16)); 
		$keyc = $ckey_length ? ($operation == 'DECODE' ? substr($string, 0, $ckey_length): substr(md5(microtime()), -$ckey_length)) : ''; 
		$cryptkey = $keya.md5($keya.$keyc); 
		$key_length = strlen($cryptkey);
		$string = $operation == 'DECODE' ? base64_decode(substr($string, $ckey_length)) : sprintf('%010d', $expiry ? $expiry + time() : 0).substr(md5($string.$keyb), 0, 16).$string; 
		$string_length = strlen($string); 
		$result = ''; 
		$box = range(0, 255); 
		$rndkey = array(); 

		for($i = 0; $i <= 255; $i++) { 
			$rndkey[$i] = ord($cryptkey[$i % $key_length]); 
		} 

		for($j = $i = 0; $i < 256; $i++) { 
			$j = ($j + $box[$i] + $rndkey[$i]) % 256; 
			$tmp = $box[$i]; 
			$box[$i] = $box[$j]; 
			$box[$j] = $tmp; 
		} 

		for($a = $j = $i = 0; $i < $string_length; $i++)
		{ 
			$a = ($a + 1) % 256; 
			$j = ($j + $box[$a]) % 256; 
			$tmp = $box[$a]; 
			$box[$a] = $box[$j]; 
			$box[$j] = $tmp; 
			$result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256])); 
		} 

		if($operation == 'DECODE')
		{
			if((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26).$keyb), 0, 16)) { 
			return substr($result, 26); 
			} else { 
			return ''; 
			} 
		} else { 
			return $keyc.str_replace('=', '', base64_encode($result)); 
		}
	}
	
	function _setauthcookie($key, $value, $expire = 0)
	{
		$authcookie_expire = 3600 * 2; //默认2个小时
		$pycrypto_value = authcode($value, 'ENCODE', '', $authcookie_expire);
		setcookie($key, $pycrypto_value, $expire);
	}
	
	function _getauthcookie($key)
	{
		return (isset($_COOKIE[$key])) ? authcode($_COOKIE[$key], 'DECODE') : '';
	}
	
	/* 
		跳转页
	*/
	function goto_url($url)
	{
		redirect($url);
		exit();
	}
	
	/* 
		跳转到登陆页
	*/
	function goto_login()
	{
		redirect("cp_login");
		exit();
	}
	
	function goto_cp()
	{
		redirect("ceping");
		exit();
	}
	
	//获取运费.
	function get_ship_fee($province_id, $key = '')
	{
		$beijing_province_id = 2; //根据数据库.
		switch($province_id)
		{
			case 0:
			case $beijing_province_id: //北京的运费
				$ship_fee = array(
							CP_ORDER_DELIVERY_TYPE_PINGYOU => '8.00',
							CP_ORDER_DELIVERY_TYPE_KUAIDI => '10.00',
							CP_ORDER_DELIVERY_TYPE_EMS => '15.00',
							CP_ORDER_DELIVERY_TYPE_HUODAO => '30.00'
							);
				break;
			default:
				$ship_fee = array(
							CP_ORDER_DELIVERY_TYPE_PINGYOU => '10.00',
							CP_ORDER_DELIVERY_TYPE_KUAIDI => '10.00',
							CP_ORDER_DELIVERY_TYPE_EMS => '15.00',
							CP_ORDER_DELIVERY_TYPE_HUODAO => '30.00'
							);
				break;
		}
		
		return (!empty($key) && array_key_exists($key, $ship_fee)) ? $ship_fee[$key] : $ship_fee;
	}
	
	function _load_viewer($template, $data = array())
	{
		$CI =& get_instance();
		//加载header
		if( !isset($data['header']) )
			$data['header'] = array();
		$CI->load->view('header', $data['header']);
		
		//加载主页面
		if( !isset($data['main']) )
			$data['main'] = array();
		
		if(is_array($template))
		{
			foreach($template as $one)
			{
				$one = add_suffix($one);
				$CI->load->view($one, $data['main']);
			}
		}
		else
		{
			$template = add_suffix($template);
			$CI->load->view($template, $data['main']);
		}
		
		//加载footer
		if( !isset($data['footer']) )
			$data['footer'] = array();
		$CI->load->view('footer', $data['footer']);
	}
	
	function add_suffix($template)
	{
		if(!strpos($template, '.php'))
			$template .= EXT;
		return $template;
	}
	
	function page_nav($total, $pagesize, $current_page)
	{
		$total_page = ceil( $total / $pagesize);
		if( $current_page > $total_page ) $current_page = $total_page;
		if( $current_page < 1 ) $current_page = 1;

		$page_nav = array();	
		$page_nav['total'] = $total;
		$page_nav['total_page'] = $total_page;
		$page_nav['last_page'] = ($total_page == 0) ? 1 : $total_page;
		$page_nav['start'] = ( $current_page - 1 ) * $pagesize;
		
		if( $current_page < $total_page ){
			$page_nav['next'] = $current_page + 1;
		}
		if( $current_page > 1 ){
			$page_nav['previous'] = $current_page - 1;
		}
		$page_nav['current_page'] = $current_page;
		$page_nav['pagesize'] = $pagesize;

		return $page_nav;	
	}
	
	//解析URL中的 filter
	function parse_filter($filter)
	{
		if(empty($filter))
			return array();
		$filter = html_entity_decode($filter);
		$temp = explode('&', $filter);
		$result = array();
		foreach($temp as $val)
		{
			list($key, $value) = explode('=', $val);
			$result[$key] = $value;
		}
		return $result;
	}
	
	//把 filter 封装成URL
	function pack_fileter_url($page, $base_url, $filter)
	{
		if(empty($filter))
			return '';
		
		$filter['page'] = $page;
		
		$temp = array();
		foreach($filter as $key => $val)
		{
			if(empty($val) && ($val === FALSE))
				continue;
			
			$temp[] = $key.'='.$val;
		}
		
		$filter_string = implode('&', $temp);
		return site_url($base_url.'/'.$filter_string);
	}
	
	
	function cp_page_nav($total, $pagesize, $current_page)
	{
		$total_page = ceil( $total / $pagesize);
		if( $current_page > $total_page ) $current_page = $total_page;
		if( $current_page < 1 ) $current_page = 1;

		$page_nav = array();	
		$page_nav['total'] = $total;
		$page_nav['total_page'] = $total_page;
		$page_nav['last_page'] = ($total_page == 0) ? 1 : $total_page;
		$page_nav['start'] = (( $current_page - 1 ) * $pagesize);
		$page_nav['end'] = ($page_nav['last_page'] == $current_page) ? $total : $page_nav['start'] + $pagesize;
		
		if( $current_page < $total_page ){
			$page_nav['next'] = $current_page + 1;
		}
		if( $current_page > 1 ){
			$page_nav['previous'] = $current_page - 1;
		}
		$page_nav['current_page'] = $current_page;
		$page_nav['pagesize'] = $pagesize;

		return $page_nav;	
	}
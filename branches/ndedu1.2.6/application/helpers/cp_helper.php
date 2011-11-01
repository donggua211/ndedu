<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	function get_cp_order_type_text($key = 1)
	{
		$key = intval($key);
		$text_array = array(
			CP_ORDER_TYPE_NORMAL => '普通',
			CP_ORDER_TYPE_PROMO  => '促销',
			CP_ORDER_TYPE_UPDATE => '升级',
		);
		
		if(!array_key_exists($key, $text_array))
			return '';
		else
			return $text_array[$key];
	}
	
	function get_cp_level_text($key = 1)
	{
		$key = intval($key);
		$text_array = array(
			CP_LEVEL_ADVANCED => '高级版',
			CP_LEVEL_LUXURY => '豪华版',
		);
		
		if(!array_key_exists($key, $text_array))
			return '';
		else
			return $text_array[$key];
	}
	
	function get_cp_order_text($key = 1)
	{
		$key = intval($key);
		$text_array = array(
			CP_ORDER_STATUS_NEW => '新订单',
			CP_ORDER_STATUS_CONFIRMED => '已确认',
			CP_ORDER_STATUS_SHIPPED => '已发货',
		);
		
		if(!array_key_exists($key, $text_array))
			return '';
		else
			return $text_array[$key];
	}
	
	function get_cp_status_text($key = 1)
	{
		$key = intval($key);
		$text_array = array(
			CP_CARD_STATUS_UNUSED => '未使用',
			CP_CARD_STATUS_STARTED => '正在做题',
			CP_CARD_STATUS_FINISHED => '已完成做题',
		);
		
		if(!array_key_exists($key, $text_array))
			return '';
		else
			return $text_array[$key];
	}
	
	function get_comments_status_text($key = 1)
	{
		$key = intval($key);
		$text_array = array(
			CP_COMMENT_STATUS_NEW => '未通过验证',
			CP_COMMENT_STATUS_REVIEWED => '通过验证',
		);
		
		if(!array_key_exists($key, $text_array))
			return '';
		else
			return $text_array[$key];
	}
	
	function get_order_delivery_type_text($key = 1)
	{
		$key = intval($key);
		$text_array = array(
			CP_ORDER_DELIVERY_TYPE_PINGYOU => '平邮',
			CP_ORDER_DELIVERY_TYPE_KUAIDI => '快递公司',
			CP_ORDER_DELIVERY_TYPE_EMS => 'EMS',
			CP_ORDER_DELIVERY_TYPE_HUODAO => '货到付款',
		);
		
		if(!array_key_exists($key, $text_array))
			return '';
		else
			return $text_array[$key];
	}
	
	function get_cp_quan_status_text($key = 1)
	{
		$key = intval($key);
		$text_array = array(
			CP_QUAN_STATUS_NEW => '未使用',
			CP_QUAN_STATUS_USED => '已使用',
		);
		
		if(!array_key_exists($key, $text_array))
			return '';
		else
			return $text_array[$key];
	}
	
	function get_cp_quan_used_at_text($key = 1)
	{
		$key = intval($key);
		$text_array = array(
			CP_QUAN_USED_AT_NDEDU => '尼德教育',
			CP_QUAN_USED_AT_TAOBAO => '淘宝',
		);
		
		if(!array_key_exists($key, $text_array))
			return '';
		else
			return $text_array[$key];
	}
	
	function get_option_pre_char($key = 0)
	{
		switch(intval($key))
		{
			case '0':
				$char = 'A';
				break;
			case '1':
				$char = 'B';
				break;
			case '2':
				$char = 'C';
				break;
			case '3':
				$char = 'D';
				break;
			case '4':
				$char = 'E';
				break;
		}
		return $char;
	}
	
	function _load_common_cp_viewer($template, $data = array())
	{
		$data['header']['css_file'] = 'cp.css';
		$template = 'cp/'.$template;
		
		_load_viewer($template, $data);
	}
	
	function _load_cp_viewer($template, $data = array(), $load_header = true, $load_footer = true, $white_footer = true, $ceping_bg = false, $load_common_header_footer = false)
	{
		if(!$load_common_header_footer)
		{
			$data['header']['no_header'] = 1;
			$data['footer']['no_footer'] = 1;
		}
		$data['header']['css_file'] = 'cp.css';
		$data['main']['load_header'] = $load_header;
		$data['main']['load_footer'] = $load_footer;
		$data['main']['white_footer'] = $white_footer;
		$data['main']['ceping_bg'] = $ceping_bg;
		
		$template_arr = array('cp/cp_header', 'cp/'.$template, 'cp/cp_footer');
				
		_load_viewer($template_arr, $data);
	}
	
	function nl2p($text)
	{
		$result = '';
		if(is_array($text))
		{
			foreach($text as $val)
				$result .= nl2p($val);
		}
		else
		{
			$text_arr = explode("\n", $text);
			foreach($text_arr as $val)
				$result .= '<p>'.$val.'</p>';
		}
		return $result;
	}
		
	function update_fee($price_luxury, $price_advanced)
	{
		return ($price_luxury - $price_advanced) * 0.5;
	}
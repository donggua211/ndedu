<?php
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
	
	function utf_substr($string, $length) 
	{
		$wordscut = '';
		$j = 0;
        preg_match_all("/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/", $string, $info);
        for($i=0; $i<count($info[0]); $i++) 
		{
                $wordscut .= $info[0][$i];
                $j = ord($info[0][$i]) > 127 ? $j + 2 : $j + 1;
                if ($j > $length - 3) 
				{
                        return $wordscut." ...";
                }
        }
        return join('', $info[0]);
	}
	
	function real_ip()
	{
		static $realip = NULL;

		if ($realip !== NULL)
		{
			return $realip;
		}

		if (isset($_SERVER))
		{
			if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
			{
				$arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);

				/* 取X-Forwarded-For中第一个非unknown的有效IP字符串 */
				foreach ($arr AS $ip)
				{
					$ip = trim($ip);

					if ($ip != 'unknown')
					{
						$realip = $ip;

						break;
					}
				}
			}
			elseif (isset($_SERVER['HTTP_CLIENT_IP']))
			{
				$realip = $_SERVER['HTTP_CLIENT_IP'];
			}
			else
			{
				if (isset($_SERVER['REMOTE_ADDR']))
				{
					$realip = $_SERVER['REMOTE_ADDR'];
				}
				else
				{
					$realip = '0.0.0.0';
				}
			}
		}
		else
		{
			if (getenv('HTTP_X_FORWARDED_FOR'))
			{
				$realip = getenv('HTTP_X_FORWARDED_FOR');
			}
			elseif (getenv('HTTP_CLIENT_IP'))
			{
				$realip = getenv('HTTP_CLIENT_IP');
			}
			else
			{
				$realip = getenv('REMOTE_ADDR');
			}
		}

		preg_match("/[\d\.]{7,15}/", $realip, $onlineip);
		$realip = !empty($onlineip[0]) ? $onlineip[0] : '0.0.0.0';

		return $realip;
	}
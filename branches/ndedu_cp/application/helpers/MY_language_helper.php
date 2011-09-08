<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('get_language'))
{
	function get_language($filename, $lang, $language_keys)
	{
		$CI =& get_instance();
		
		$files = explode(',', trim($filename, ' ,'));
		
		foreach($files as $file)
			$CI->lang->load(trim($file, ' ,'), $lang);
		
		$language_array = explode(',', trim($language_keys, ' ,'));
		
		$language_string = '';
		foreach($language_array as $value)
		{
			$language_string .= $CI->lang->language[$value];
		}
		
		return  trim($language_string, ' ,');
	}
}


/* End of file xml_helper.php */
/* Location: ./system/helpers/xml_helper.php */
<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class dd
{
	var $dangdang_url = 'http://nokiawidget.dangdang.com/product.php?pid=';
	var $pid = 0;
	/**
	 * Constructor
	 *
	 * @access	public
	 */
	
	function getInfo($pid)
	{	
		$this->pid = $pid;
		//CURL
		$ch = curl_init( $this->dangdang_url.$this->pid);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$content = curl_exec($ch);		
		$info = curl_getinfo( $ch );
		curl_close( $ch );

		// 非200状态时，判定为非正常返回
		if( 200 != $info['http_code'] ) {
			return FALSE;
		}
			
		//获取书得title
		preg_match_all('/<p class="title">(.*?)<\/p>/', $content, $matches);
		$dangdang['product_name'] = isset($matches[1][0]) ? $matches[1][0] : '';
		
		//获取作者
		preg_match_all('/<p>作者:(.*)<\/p>/', $content, $matches);
		$dangdang['author'] = isset($matches[1][0]) ? strip_tags($matches[1][0]) : '';
		
		return $dangdang;
	}
	/**
	 * 将XML文件转换成Array
	 * 
	 * @param string $xml_string 要转换的XML字符串
	 * @param int $get_attributes 是否获取属性，默认获取
	 * @param string $priority 优先内容:tag
	 * @access public
	 * @return array
	 
	function xml_to_array( $xml_string, $get_attributes = 1, $priority = 'tag' )
	{
		if( !$xml_string ) return array(); 

		if( !function_exists( 'xml_parser_create' ) ) { 
			return array(); 
		} 
		
		//Get the XML parser of PHP - PHP must have this module for the parser to work 
		$parser = xml_parser_create(''); 
		xml_parser_set_option( $parser, XML_OPTION_TARGET_ENCODING, 'UTF-8' ); 
		xml_parser_set_option( $parser, XML_OPTION_CASE_FOLDING, 0 ); 
		xml_parser_set_option( $parser, XML_OPTION_SKIP_WHITE, 1 ); 
		xml_parse_into_struct( $parser, trim( $xml_string), $xml_values ); 
		xml_parser_free( $parser ); 

		if( !$xml_values ) return;//Hmm... 

		//Initializations 
		$xml_array = array(); 
		$parents = array(); 
		$opened_tags = array(); 
		$arr = array(); 

		$current = &$xml_array; //Refference 

		//Go through the tags. 
		$repeated_tag_index = array();//Multiple tags with same name will be turned into an array 
		foreach( $xml_values as $data )
		{ 
			unset( $attributes, $value );//Remove existing values, or there will be trouble 

			//This command will extract these variables into the foreach scope 
			// tag(string), type(string), level(int), attributes(array). 
			extract( $data );//We could use the array by itself, but this cooler. 

			$result = array(); 
			$attributes_data = array(); 

			if( isset( $value ) ) { 
				if( $priority == 'tag' ) $result = $value; 
				else $result['value'] = $value; //Put the value in a assoc array if we are in the 'Attribute' mode 
			} 

			//Set the attributes too. 
			if( isset( $attributes ) and $get_attributes ) { 
				foreach( $attributes as $attr => $val ) { 
					if( $priority == 'tag' ) $attributes_data[$attr] = $val; 
					else $result['attr'][$attr] = $val; //Set all the attributes in a array called 'attr' 
				} 
			} 

			//See tag status and do the needed. 
			if( $type == "open" ) 
			{ //The starting of the tag '<tag>' 
				$parent[$level-1] = &$current; 
				if(!is_array($current) or (!in_array($tag, array_keys($current)))) //Insert New tag 
				{
					$current[$tag] = $result; 
					if( $attributes_data ) 
						$current[$tag. '_attr'] = $attributes_data; 
					$repeated_tag_index[$tag.'_'.$level] = 1; 

					$current = &$current[$tag]; 

				} else { //There was another element with the same tag name 

					if( isset( $current[$tag][0] ) ) 
					{
						//If there is a 0th element it is already an array 
						$current[$tag][$repeated_tag_index[$tag.'_'.$level]] = $result; 
						$repeated_tag_index[$tag.'_'.$level]++; 
					} else {//This section will make the value an array if multiple tags with the same name appear together 
						$current[$tag] = array($current[$tag],$result);//This will combine the existing item and the new item together to make an array
						$repeated_tag_index[$tag.'_'.$level] = 2; 

						if(isset($current[$tag.'_attr'])) 
						{ 
							//The attribute of the last(0th) tag must be moved as well 
							$current[$tag]['0_attr'] = $current[$tag.'_attr']; 
							unset( $current[$tag.'_attr'] ); 
						} 

					} 
					$last_item_index = $repeated_tag_index[$tag.'_'.$level]-1; 
					$current = &$current[$tag][$last_item_index]; 
				} 

			} elseif( $type == 'complete' ) 
			{ 
				//Tags that ends in 1 line '<tag />' 
				//See if the key is already taken. 
				if( !isset( $current[$tag] ) ) 
				{ 	
					//New Key 
					$current[$tag] = $result; 
					$repeated_tag_index[$tag.'_'.$level] = 1; 
					if( $priority == 'tag' and $attributes_data ) 
						$current[$tag. '_attr'] = $attributes_data; 

				} else { //If taken, put all things inside a list(array) 
					if( isset( $current[$tag][0] ) and is_array( $current[$tag] ) ) 
					{
						//If it is already an array... 

						// ...push the new element into that array. 
						$current[$tag][$repeated_tag_index[$tag.'_'.$level]] = $result; 

						if($priority == 'tag' and $get_attributes and $attributes_data) 
						{ 
							$current[$tag][$repeated_tag_index[$tag.'_'.$level] . '_attr'] = $attributes_data; 
						} 
						$repeated_tag_index[$tag.'_'.$level]++; 

					} else { //If it is not an array... 
						$current[$tag] = array($current[$tag],$result); //...Make it an array using using the existing value and the new value
						$repeated_tag_index[$tag.'_'.$level] = 1; 
						if( $priority == 'tag' and $get_attributes ) { 
							if( isset( $current[$tag.'_attr'] ) ) //The attribute of the last(0th) tag must be moved as well
							{  
								$current[$tag]['0_attr'] = $current[$tag.'_attr']; 
								unset( $current[$tag.'_attr'] ); 
							} 

							if( $attributes_data ) 
							{ 
								$current[$tag][$repeated_tag_index[$tag.'_'.$level] . '_attr'] = $attributes_data; 
							} 
						} 
						$repeated_tag_index[$tag.'_'.$level]++; //0 and 1 index is already taken 
					} 
				} 

			} elseif( $type == 'close' ) { //End of tag '</tag>' 
				$current = &$parent[$level-1]; 
			} 
		} 
		return $xml_array; 
	}
	*/
}
// END Log Class

/* End of file Log.php */
/* Location: ./system/libraries/Log.php */
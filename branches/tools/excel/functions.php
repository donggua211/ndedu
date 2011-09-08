<?php
function checkRowAvailable($text)
{
	$marked_keyword = array('y', '发短信');
	if( in_array($text, $marked_keyword) )
		return true;
	else
		return false;
}

function is_cell_mobile($text)
{
	return (preg_match( "/^[\d\/-]{8,20}$/", $text ) === 1) ? TRUE : FALSE;
}

function get_mobile($text)
{
	@list($phone_a, $phone_b) = explode(PHONE_SEPERATOR, $text);
	if( is_mobile($phone_a) )
		return $phone_a;
	elseif( is_mobile($phone_b) )
		return $phone_b;
	else
		return '';
}

function is_mobile($text)
{
	return (preg_match( "/^[\d]{11}$/", $text ) === 1)? TRUE : FALSE;
}

function convert_encoding( $string, $to_encode = 'UTF-8' ){
	//当前编码
	$now_encode = detect_encode( $string );

	// 只有编码不同时才转换
	if( strtolower( $to_encode ) != strtolower( $now_encode ) ){
		$string = mb_convert_encoding( $string, $to_encode, $now_encode );
	}

	return $string;
}
function detect_encode( $string ){
	//$encodes = array( 'CP936', 'UTF-8', 'ASCII', 'GBK', 'GB2312' );
	$encodes = array( 'ASCII', 'UTF-8', 'GBK', 'GB2312', 'CP936' );
	$now_encode = mb_detect_encoding( $string, $encodes );
	return $now_encode;
}
?>
<?php 
function get_db_obj()
{
	global $db;
	
	if(isset($db) && is_object($db))
		return $db;
	
	$db = new db();
	return $db;
}

/*
 * $type : result, error;
 */
function show_result($result, $back_url = '', $type = 'result')
{
	global $smarty;
	
	//处理 back url
	if(empty($back_url))
	{
		if(isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER']))
			$back_url = $_SERVER['HTTP_REFERER'];
		else
			$back_url = site_url();
	}
	else
	{
		$back_url = site_url($back_url);
	}
	
	$smarty->assign('title', '结果页');
	$smarty->assign('result', $result);
	$smarty->assign('back_url', $back_url);
	$smarty->assign('type', $type);
	$smarty->display('result.tpl');
	die();
}

function site_url($url = '')
{
	global $config;
	return $config['site_url'].$url;
}
?>
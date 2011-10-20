<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function soap_call($soap_url, $method, $param, $charset = 'GBK')
{
	$client = new nusoap_client($soap_url, false);
	$client->soap_defencoding = $charset;
	$client->decode_utf8 = false;
	$err = $client->getError();
	
	if ($err) {
		echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
		echo '<h2>Debug</h2>';
		echo '<pre>' . htmlspecialchars($client->getDebug(), ENT_QUOTES) . '</pre>';
		exit();
	}
		
	$result = $client->call($method, $param, 'http://sdkhttp.eucp.b2m.cn/');
	
	if ($client->fault)
	{
		echo '<h2>Fault (Expect - The request contains an invalid SOAP body)</h2><pre>'; print_r($result); echo '</pre>';
		return false;
	} 
	else
	{
		$err = $client->getError();
		if ($err) 
		{
			echo '<h2>Error</h2><pre>' . $err . '</pre>';
			return false;
		}
		else 
		{
			return $result;
		}
	}
}
<?php

/**
 * Test script for the apache log parser class
 */

//include the class
require_once('apachelogparser_class_inc.php');
date_default_timezone_set('PRC');
//The access log file
//you will want to change the path here :) and make sure that the logfile is readable by the www user (apache)

$path = 'D:/ndedu/logs/';
$file = $path . 'access.log.20100831';

//Instantiate the object
$log = new apachelogparser();

$farr = $log->log2arr($file);
//iterate through the array above and get the info we need from each line
foreach ($farr as $line)
{
	//you would probably want to insert to a db or something here to do
	//datamining on the logfile, but here we will just print the output to browser
	print_r($log->parselogEntry($line));
}
?>
<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
define('DATABASE_HOST', 'localhost');  
define('DATABASE_NAME', 'distrack_dev');   
define('DATABASE_USER',  'root');  
define('DATABASE_PASSWORD', '');
define('APPLICATION_TITLE', 'Research Tracking System');
define('MAX_ENTRIES_PER_PAGE', 50);  
define('DATE_TIME_FORMAT','Y-m-d H:i:s');

extract($_REQUEST);
function convert_date($date)
{
	if(!isset($date) || trim($date) == '')
		return '';
	$temp = explode("/",$date);
		$da = $temp[2]."-".$temp[0]. "-".$temp[1];
	return $da;
}
function date_reverse($date)
{
	$temp = explode("-",$date);
		$da = $temp[1]."/".$temp[2]. "/".$temp[0];
	return $da;
}
  ?>
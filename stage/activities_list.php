<?php
	$step = '2';
	$path = '..';
	
	$title =  'Student\'s Activity ';
	
	$sname = (isset($sname) && $sname != '') ? $sname : '';//First Name
	$lname = (isset($lname) && $lname != '') ? $lname : '';//Last Name
	$fdate = (isset($fdate) && $fdate != '') ? $fdate : '';//From date
	$tdate = (isset($tdate) && $tdate != '') ? $tdate : '';//To Date
	$activity = (isset($activity) && $activity != 'N') ? 'Y' : 'N';//Actvity
	
	
	$css = array('css/miscpages.css', 'css/jquery.dataTables_themeroller.css', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/start/jquery-ui.css', 'css/list.css', 'css/activites_search.css');
	$js = array('js/list.js', 'js/jquery.metadata.js', 'js/jquery.dataTables.min.js','js/jquery.validate.js', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js', 'js/activities_search.js');
	
	require_once('includes/common.php');
	
	$table = ' vw_dissertation_details details, tb_dissertation_history history, tb_users u  ';
	$cond = ' details.std_id=history.std_id	AND details.dist_id=history.dissertation_id AND u.user_id=history.next_id AND history.history_id
IN (

SELECT MAX( history_id ) 
FROM tb_dissertation_history
GROUP BY dissertation_id
) ';

$cond .= ($sname != '') ? ' AND LOWER(details.std_name) LIKE "'.$sname.'%"' : '';
$cond .= ($activity == 'Y' && $fdate != '' && $tdate != '') ? ' AND (details.login_time BETWEEN \''.convert_date($fdate).'\' AND \''.convert_date($tdate).'\')' : '';
$cond .= ($activity == 'N' && $fdate != '' && $tdate != '') ? ' AND (details.login_time NOT BETWEEN \''.convert_date($fdate).'\' AND \''.convert_date($tdate).'\')' : '';


$fields = ' details.std_name AS name, details.dist_name AS title, details.dist_doc, details.con_name, details.chrt_name, details.program_name, DATE_FORMAT(details.login_time,\'%m-%d-%Y\') AS login_time, DATE_FORMAT(history.doc,\'%m-%d-%Y\') AS doc,history.std_id, history.next_id, details.dist_id, u.user_fullname ';

	$result = $db->fetchAllRecord( $table , $fields, $cond , NULL, '  details.std_name', NULL, 0,'All');
	
	
	require_once($path.'/pages/activities_list.php');

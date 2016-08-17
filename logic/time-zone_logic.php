<?php
require_once('../common/sess.php');
require_once('../common/configure.php');
require_once('../classes/Database.class.php');
require_once('../classes/Query.class.php');	
require_once('../common/checksess.php');

$id = (isset($id)) ? $id : 0;
$sts = '';
$fields = ' tz_name="'.trim($tz_name).'", tz_timezone="'.trim($tz_timezone).'", tz_default="'.$tz_default.'" ';
if(isset($op) && ($op != 'D') && $tz_default == 1){
	$db->storeDetails('tb_timezones', ' tz_default="0" ', ' WHERE tz_default="1" ');
}

switch($op)
{
	case 'ADD':
		$store = $db->storeDetails('tb_timezones', $fields);		
		$id = $db->newRowId;	
	break;
	
	case 'Edit':
		$db->storeDetails('tb_timezones', $fields, ' WHERE 	tz_id = "'.$id.'"');
	break;

	case 'D':
		$db->delData(' tb_timezones ', ' tz_id="'.$id.'" ');
	break;		
}
header('Location: ../stage/manage_time_zone.php?sts='.$sts);
exit;
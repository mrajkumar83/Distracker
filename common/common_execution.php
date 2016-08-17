<?php
require_once('common/configure.php');
require_once(DIR_WS_COMMON.'/wbsession.php');
require_once('classes/Database.class.php');
require_once('classes/Query.class.php');

$db = new Query();

$startPt='';
$css  = '';
$scripts  = '';

/********* fetching posttype records from posttype table  ********* */
$posttypes = $db->fetchAllRecord('posttypes', '*', ' artstatus="A" ' , NULL,  'artno' ,' ASC ',' 0 ', 'All');
/*     *********         */

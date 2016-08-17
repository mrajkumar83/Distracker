<?php
require_once('../common/configure.php');
require_once('../classes/Database.class.php');
require_once('../classes/Query.class.php');
$db = new Query();
if(isset($uname) && isset($upassword))
{
	$rec = $db->fetchRecord('tb_users', ' * ','LOWER(user_name)="'.strtolower($uname).'" AND user_password="'.md5($upassword).'" ');
	if($db->_rowCount > 0)
	{
		if($rec->user_status == 'D')
		{
			header('Location: ../index.php?Err=2');
			exit;
		}		
		session_start();
		$_SESSION['UID'] = $rec->user_id;
		$_SESSION['UNAME'] = $rec->user_name;
		$_SESSION['UTYPE'] = $rec->user_type;
		$_SESSION['UEMAIL'] = $rec->user_email;
		$_SESSION['UFULLNAME'] = $rec->user_fullname;
		$_SESSION['USESS'] = session_id();
		//ADMIN_MAIL
		$admin_mail_arr = array();
		$result = $db->fetchAllRecord(' tb_users', ' user_name,user_email ', ' user_type="AD" AND user_status="A" ', NULL, ' user_email ', NULL, 0,'All');
		while($data = mysql_fetch_object($result))
		{
			$admin_mail_arr[] = array('name'=>$data->user_name, 'mailid'=>$data->user_email);
		}//End of while
		$_SESSION['ADMIN_EMAIL'] = $admin_mail_arr;
				
		$output = $db->storeDetails('tb_users', ' user_sess="'.$_SESSION['USESS'].'", user_login="'.date(DATE_TIME_FORMAT).'" ',' WHERE user_id = "'.$_SESSION['UID'].'"');		
		$data = $db->fetchRecord(' tb_timezones ', ' tz_timezone ', ' tz_default="1" ');
		if(isset($data) && $data && $data->tz_timezone){ $_SESSION['TIMEZONE'] = $data->tz_timezone;}
		header('Location: ../home.php');
		exit;
	}
	else
	{
		header('Location: ../index.php?Err=3');
		exit;
	}
}
header('Location: ../index.php?Err=1');
exit;
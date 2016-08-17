<?php
require_once('../common/configure.php');
require_once('../classes/Database.class.php');
require_once('../classes/Query.class.php');
require_once('../common/attachsendmail.php');

$db = new Query();
if(isset($uemail))
{	
	$rec = $db->fetchRecord('tb_users', ' user_name, user_fullname,user_id,user_status ',' user_email="'.$uemail.'" ');
	if(!isset($rec) || $rec->user_status == '')
	{
		header('Location: ../forgot-password.php?Err=2');
		exit;
	}
	if($rec->user_status == 'D')
	{
		header('Location: ../forgot-password.php?Err=3');
		exit;
	}
	
	session_start();
	$sid = session_id();
	$url = 'http://'.$_SERVER['SERVER_NAME'].'/reset-password.php?mail='.urlencode($uemail).'&id='.urlencode($sid);
	if ($sid && $db->storeDetails('tb_users', ' user_sess="'.$sid.'" ', ' WHERE user_id="'.$rec->user_id.'"') == true)
	{
		
		$arr = array(
						"<EMAIL>" => '<a href="mailto:'.$uemail.'">'.$uemail.'</a>',
						"<URL>" => '<a href="'.$url.'" target="_top">'.$url.'</a>'
					);
		$msg = prepareBody('reset-password', $arr);

		if(mailClient($uemail, $msg, 'Reset password', 'Administrator', 'do-not-reply@distracker.com',$rec->user_fullname)){//$uemail
			header('Location: ../email-confirmation.php');
		}else{
			header('Location: ../index.php?Err=M');
		}
		exit;
	}
	/*
	$rand = 'distracker'.rand(1000, 9999);
	if ($db->storeDetails('tb_users', '  user_password = "'.md5($rand).'"', ' WHERE user_id="'.$rec->user_id.'"') == true)
	{
		$msg = 'Hi '.$rec->user_fullname.",<br>\n";
		$msg.= 'Please find the new password: '."<br>\n";
		$msg.= "&nbsp;&nbsp;".'User name: '.$rec->user_name."<br>\n";
		$msg.= "&nbsp;&nbsp;".'Password: '.$rand."<br>\n";
		$msg.= 'Regards,'."<br>\n".'Administrator';
		if(mailClient($uemail, $msg, 'New password', 'Administrator', 'do-not-reply@distracker.com',$rec->user_fullname)){//$uemail
			header('Location: ../index.php');
		}else{
			header('Location: ../index.php?Err=M');
		}
		exit;
	}
	*/	
}
header('Location: ../forgot-password.php?Err=1');
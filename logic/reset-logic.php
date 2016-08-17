<?php
require_once('../common/configure.php');
require_once('../classes/Database.class.php');
require_once('../classes/Query.class.php');
require_once('../common/attachsendmail.php');

$db = new Query();
if(isset($uemail))
{	
	if($db->storeDetails('tb_users', '  user_password = "'.md5($newpassword).'" , user_sess="" ', ' WHERE user_email="'.$uemail.'"') == true){
		header('Location: ../confirmation.php');
		exit;
	}
}
header('Location: ../forgot-password.php?Err=1');
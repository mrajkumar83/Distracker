<?php
require("../classes/class.phpmailer.php");

function mailClient($email,$body,$subject,$yourname,$youremail,$toname, $attachments=''){
	if($toname == '')
		$toname=$email;
	$mail = new phpmailer();
	$mail->IsSMTP(); // set mailer to use SMTP

	/** *** Change this values *** *
	$mail->Host = 'mail.distracker.com';  // specify main and backup server
	$mail->Username = 'do-not-reply@distracker.com';  // SMTP username
	$mail->Password = 'PAN1BT12'; // SMTP password
        $mail->Port = 26;
	/** *** Change this values *** */

	//$mail->SMTPAuth = true;     // turn on SMTP authentication
	$mail->Timeout = "60";
	//$mail->SMTPDebug = "true";
	$mail->IsHTML(true);
	$mail->From     = $youremail;
	$mail->FromName = $yourname;
	$mail->AddReplyTo($youremail);
	$mail->WordWrap = 50;// set word wrap
	
	$mail->Body    = $body;
	$mail->Subject = $subject;
	$email = explode(',',$email);
	$toname = explode(',',$toname);
	$mail_cnt = count($email);
	for($i=0;$i<$mail_cnt;$i++)
		$mail->AddAddress($email[$i], $toname[$i]);
	
	if(is_array($attachments))
	{
		$attach_cnt = count($attachments);
		for($i=0; $i<$attach_cnt; $i++)
		{
			$mail->AddAttachment($attachments[$i]['path'], $attachments[$i]['name']);
		}
		
		if(!$mail->Send())
		{
		   $msg = "Message was not sent <br />";
		   $msg .= "Mailer Error: " . $mail->ErrorInfo;
		}//End of if
	}
	else{
	return $mail->Send();}
}//End of Func(sending mail)

function prepareBody($fname, $arr)
{
	$fGetContents = file_get_contents('../mails/'.$fname.'.txt');
	foreach($arr as $key => $val)
	{
		$fGetContents = str_replace($key,$val,$fGetContents); 
	}
	return $fGetContents;
}
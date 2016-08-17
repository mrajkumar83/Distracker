<?php
require_once("../common/attachsendmail.php");
$staff_name = '';
$staff_mail = '';
$staff_email = '';
if($UTYPE == 'SD')
{
	$staff_rec = $db->fetchAllRecord(' tb_student_staff_rel r,tb_users u  ', ' u.user_fullname, u.user_email  ', '  dissertation_id="'.$did.'" AND std_id="'.$std_id.'" AND role_id="'.$rid.'" AND rel_status="S" AND user_type<>"SD" AND u.user_id=r.staff_id ', NULL , NULL,  NULL, NULL,'All');
	while($staff_obj = mysql_fetch_object($staff_rec))
	{
		$staff_name .= $staff_obj->user_fullname.',';
		$staff_email .= $staff_obj->user_email.',';
	}//End of while
}
else
{
	$staff_name = $UFULLNAME;
	$staff_email .= $UEMAIL;
}

$staff_name = trim($staff_name,',');
$staff_email = trim($staff_email,',');
$subject = 'Acknowledgement of Dissertation:"'.$dissertation_title.'" Status';
$mail_add[0] = array('name' => $staff_name, 'email'=>$staff_email);
$mail_add[1] = array('name' => $StudentName, 'email'=>$student_email);
$mail_to = ($UTYPE != 'SD') ? 'staff-' : 'student-';
$mail_stg = array('staff', 'student');

$arr = array('<StaffName>' => $staff_name,
		'<StudentName>' => $StudentName,
		'<Comments>' => $msg,
		'<Status>' => status($sts),
		'<Date&TimeSubmitted>' => date(DATE_TIME_FORMAT),
		'<StaffRole>' => $StaffRole,
		'<Cohort>' => $Cohort,
		'<Concentration>' => $Concentration,
		'<URL>' => 'http://'.$_SERVER['SERVER_NAME'].'/index.php'
		);
		
for($i=0; $i<2; $i++)
{
	$mailMsg = prepareBody($mail_to.$mail_stg[$i], $arr);
	mailClient($mail_add[$i]['email'], $mailMsg, $subject, 'Administrator', 'do-not-reply@distracker.com',$mail_add[$i]['name'], $attachments);
}
if($next_id == $std_id && $sts != 'M')
{
	$mail_obj = $db->fetchRecord(' tb_role_stage_rel rel, tb_roles r', ' r.role_title, rel.mail_to ', ' rel.rel_ord="'.$rel_ord.'" AND r.role_id=rel.role_id ');
	if($mail_obj->mail_to > 0)
	{
		$user_obj = $db->fetchAllRecord(' tb_users u, tb_student_staff_rel r', ' u.user_fullname, u.user_email, u.user_type ', ' r.role_id="'.$mail_obj->mail_to.'" AND r.std_id="'.$std_id.'" AND r.dissertation_id="'.$did.'" AND u.user_id=r.staff_id ', NULL, NULL, NULL, 0,'All');
		while($user_rec = mysql_fetch_object($user_obj))
		{
			$subject = 'Notification Mail';			
			$mail_body = 'Hi '.$user_rec->user_fullname."\n";
			$mail_body .= 'This is note that student: "'.$StudentName.'" for Dissertation:"'.$dissertation_title.'" has assigned Staff:"'.$user_rec->user_fullname.'" for the following role: "'.$mail_obj->role_title.'".'."\n";
			$mail_body .= 'Thanks,'."\n";
			$mail_body .= 'Dissertation Buzzer';
			$mail_to = $user_rec->user_email.','.$student_email;
			$mail_name = $user_rec->user_fullname.',';
			
			//$header = "From: Administrator<admin@distracker.com>\r\n"; //optional headerfields
			//mail($user_rec->user_email, $subject, $mail_body, $header);
			
			mailClient($mail_to , $mail_body, $subject, 'Administrator', 'do-not-reply@distracker.com',$mail_name);
		}
	}
}


function status($sts)
{
	switch($sts)
	{
		case 'A':
			return 'Approved';
		break;
		
		case 'C':
			return 'Approved with comments';
		break;
		
		case 'M':
			return 'Major changes required';
		break;
	}
}
<?php
require_once('../common/sess.php');
require_once('../common/configure.php');
require_once('../classes/Database.class.php');
require_once('../classes/Query.class.php');	
require_once('../common/fileupload.php');
require_once("../common/attachsendmail.php");
if(isset($UTYPE))
{
	require_once('../common/checksess.php');
}
else
$db = new Query();
$id = (isset($id)) ? $id : 0;
$url = 'Location: ..'.(isset($UTYPE) ? '/stage': '').'/register.php?';

if($op == 'ADD')
{
	$duplicatedata = $db->fetchRecord(' tb_users ', ' count(1) AS cnt ', '  user_email = "'.$email_id.'" OR LOWER(user_name) = "'.strtolower($userid).'" ');
	if($duplicatedata->cnt > 0)
	{
		header($url.'utype='.$utype.'&Err=D');
		exit;
	}
	
}
if(isset($_FILES['pic_img']))
{
	if(($_FILES['pic_img']["size"]/ 1024) > 1024)
	{
		header($url.'utype='.$utype.'&Err=S');
		exit;
	}
}
$lang = (($utype=='SD') ? '' : implode(',', $lang));

if($op != 'D' && $op != 'E')
{
	if(isset($date_enrollment) && $date_enrollment != '')
	{
		$date_enrollment = convert_date($date_enrollment);		
	}
	else
	{
		$date_enrollment = '';
	}
		
	$user_status = isset($user_status) ? $user_status : 'D';

	$fields = ' user_fname = "'.htmlspecialchars(trim($fname)).'", user_lname= "'.htmlspecialchars(trim($lname)).'", user_prefix= "'.$prefix.'", user_lang = "'.$lang.'", user_doe = "'.$date_enrollment.'", user_mobile = "'.$telephone.'", user_address = "'.$saddress.'",  user_suite = "'.$suite.'", user_city= "'.$City.'", user_state = "'.$state.'", user_country = "'.$country.'", user_zip = "'.$zip.'",  user_skype= "'.$skypeid.'", user_doc = "'.date(DATE_TIME_FORMAT).'"';
}
switch($op)
{
	case 'ADD':
		$Name = $fname.' '.$lname;
		$store = $db->storeDetails('tb_users', '  	user_id="", user_name = "'.strtolower($userid).'", user_password = "'.md5($user_password).'", user_type = "'.$utype.'", user_fullname="'.htmlspecialchars(trim($Name)).'", user_email = "'.$email_id.'", user_doc="'.date(DATE_TIME_FORMAT).'", user_status="'.$user_status.'", user_dom="0000-00-00 00:00:00"');
		if ($store == true)
		{
			$id = $db->newRowId;
			$image = (isset($_FILES['pic_img']) && isset($_FILES['pic_img']['name']) && ($_FILES['pic_img']['name'] != '')) ? fileupload('IMG','../images/photos','pic_img','N', '', $id) : '';
			$fields .= ', user_id = "'.$id.'", user_photo = "'.$image.'"';
			if($utype == 'SD')
			{
				$fields .= ', user_registration = "'.$registrationno.'", user_cohort = "'.$cohort.'", user_concentration = "'.$concentration.'"';
			}
			
			if ( $db->storeDetails(' tb_user_info ', $fields) == true)
			{				
				$subject = "Activate User - Distracker"; //subject
				$arr = array('<FullName>' => $fname,
							'<URL>' => 'http://'.$_SERVER['SERVER_NAME'].'/activate-register.php?un='.$userid.'&ud='.$id );
				
				$mailMsg = prepareBody('activation', $arr);
				mailClient($email_id, $mailMsg, $subject, 'Administrator', 'do-not-reply@distracker.com',$fname);
				
				$location = 'Location: ../'.((isset($pagefrom) && $pagefrom == 'front' ) ? 'registered.php?sts=AA' : 'stage/manage_users.php?sts=AA&utype='.$utype);
				header($location);
				exit;
			}else{
				$db->delData('tb_users', ' user_id="'.$id.'"');
				header($url.'op=A&Err=AA');
			}
		}
		else
			header($url.'op=A&Err=NA');
		
	break;
	case 'Edit':
				$db->storeDetails('tb_users', ' user_fullname="'.htmlspecialchars(trim($fname.' '.$lname)).'", user_email = "'.$email_id.'", user_dom = "'.date(DATE_TIME_FORMAT).'", user_status="'.$user_status.'"', ' WHERE user_id = "'.$id.'"');
				
				$image = (isset($_FILES['pic_img']) && isset($_FILES['pic_img']['name']) && ($_FILES['pic_img']['name'] != '')) ? ', user_photo = "'.fileupload('IMG','../images/photos','pic_img','N', '', $id).'"' : '';
				
				$fields .= $image;

				if($utype == 'SD')
				{
					$fields .= ', user_registration = "'.$registrationno.'", user_cohort = "'.$cohort.'", user_concentration = "'.$concentration.'"';
				}
				
				$output = $db->storeDetails('tb_user_info', $fields,' WHERE user_id = "'.$id.'"');
				if(isset($pagefrom) && ($pagefrom == 'profile'))
				{
					echo '<html><body><script>
					alert("Please login once, to reflect your changes..\n Thank you.");
					window.parent.parent.document.location.href = "../logout.php";</script></body></html>';
					exit;
				}
				else
				{
					$location = 'Location: ../stage/manage_users.php?sts=E'.($output ? 'S' : 'F' ).'&utype='.$utype;
				}
				header($location);
	break;

	case 'D':
			$db->delData('tb_users', ' user_id="'.$id.'"');
			$db->delData('tb_user_info', ' user_id="'.$id.'"');
			header('Location: ../stage/manage_users.php?sts=DD&utype='.$utype);
	break;
	
	case 'E':
			$user_type = $user_type ? $user_type : 'SF';
			$db->storeDetails('tb_users', ' user_type = "'.$user_type.'", user_dom = "'.date(DATE_TIME_FORMAT).'" ', ' WHERE user_id = "'.$id.'"');	
			header('Location: ../stage/manage_admin.php');
	break;
}
exit;
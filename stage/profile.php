<?php
	$path = '..';
	$step = '2';
	$title = 'Profile ::';
	$css = array('css/all.css', 'css/register.css', 'css/jquery.datepick.css', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css');
	$js = array('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js','js/jquery.validate.js', 'js/register.js', 'js/date/jquery.datepick.js');
	require_once('includes/common.php');
	
	$msg = (isset($sts) && $sts == 'ES' ) ? 'Your details have been successfully Updated.' : '';
	$id = $UID;
	$op = 'Edit';
	
	$data = $db->fetchRecord(' tb_users AS u LEFT JOIN tb_user_info AS i on i.user_id = u.user_id ', ' * ', 'u.user_id="'.$id.'"');
	$cntry = $db->fetchAllRecord('tb_country ' , ' country_id,country_name ', ' status="1" ' , NULL, ' country_name ', NULL,NULL,'All');
	$langs = $db->fetchAllRecord('tb_languages ' , ' lang_id,lang_name ', NULL , NULL, ' lang_name ', NULL,NULL,'All');
	if(isset($UTYPE) && $UTYPE == 'SD')
	{
		$chrt = $db->fetchAllRecord('tb_cohort ' , ' cohort_id,cohort_name ', ' cohort_status="A" ' , NULL, ' cohort_name ', NULL,NULL,'All');
		$concen = $db->fetchAllRecord('tb_concentration ' , ' concentration_id,concentration_name ', ' concentration_status="A" ' , NULL, ' concentration_name ', NULL, NULL,'All');
	}
	
	///// Variables //////
	$pagefrom = 'profile';
	$img = $path.'/img/profile_noimg.jpg';
	$prefix = $data->user_prefix;
	$fname = $data->user_fname;
	$lname = $data->user_lname;
	$saddress = $data->user_address;
	$suite = $data->user_suite;
	$City = $data->user_city;
	$zip = $data->user_zip;
	$state = $data->user_state;
	$country = $data->user_country;
	$registrationno = $data->user_registration;
	$date_enrollment = isset($data->user_doe) ? date_reverse($data->user_doe) : '';
	$userid = $data->user_name;
	$cohort = $data->user_cohort;
	$cohort_name = $db->fetchRecord(' tb_cohort ', ' cohort_name ', ' cohort_id="'.$cohort.'"');
	$concentration = $data->user_concentration;
	$con_name = $db->fetchRecord(' tb_concentration ', ' concentration_name ', ' concentration_id="'.$concentration.'"');
	$lang = $data->user_lang;
	$lang_name = $db->fetchRecord(' tb_languages ', ' lang_name ', ' lang_id="'.$lang.'"');
	$email_id = $data->user_email;
	$skypeid = $data->user_skype;
	$telephone = $data->user_mobile;
	if(isset($data->user_photo) && $data->user_photo != '' &&  file_exists('../images/photos/'.$data->user_photo))
	$img = '../images/photos/'.$data->user_photo;
	$utype = $data->user_type;
	$sts = $data->user_status;
	
	
?>
	<div id="main">
		<div id="sts"><?php echo $msg;?></div>
		<div class="top-bar"><h1>Edit Profile</h1></div>
		<?php require_once('../pages/registration.php');?>
	</div>
</body>
</html>



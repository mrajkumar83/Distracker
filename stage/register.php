<?php
	$step = '2';
	$path = '..';
	$title = 'Registration ';
	$css = array('css/all.css', 'css/register.css', 'css/jquery.datepick.css', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css');
	$js = array('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js','js/jquery.validate.js', 'js/register.js', 'js/date/jquery.datepick.js');	
	require_once('includes/common.php');
	
	$cntry = $db->fetchAllRecord('tb_country ' , ' country_id,country_name ', ' status="1" ' , NULL, ' country_name ', NULL,NULL,'All');
	$langs = $db->fetchAllRecord('tb_languages ' , ' lang_id,lang_name ', NULL , NULL, ' lang_name ', NULL,NULL,'All');
	
	///// Variables //////
	$pagefrom = '';
	$id = (isset($id) && $id > 0) ? $id : '';
	$op = (isset($op) && $op != '') ? $op  : 'ADD';
	$prefix = '';
	$fname = '';
	$lname = '';
	$saddress = '';
	$suite = '';
	$City = '';
	$zip = '';
	$state = '';
	$country = '';
	$registrationno = '';
	$date_enrollment = '';
	$userid = '';
	$lang = (isset($utype) && $utype == 'SD') ? '' : array();
	$email_id = '';
	$skypeid = '';
	$telephone = '';
	$img = $path.'/img/profile_noimg.jpg';
	$utype = isset($utype) ? $utype : 'SD';
	$sts = 'A';
	
	if($op == 'E' && $id>0)
	{
		$data = $db->fetchRecord(' tb_users AS u LEFT JOIN tb_user_info AS i on i.user_id = u.user_id ', ' * ', 'u.user_id="'.$id.'"');
		
		$op = 'Edit';
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
		$date_enrollment = date_reverse($data->user_doe);
		$userid = $data->user_name;
		$lang = ($data->user_type == 'SD') ? $data->user_lang : explode(',', $data->user_lang);
		$email_id = $data->user_email;
		$skypeid = $data->user_skype;
		$telephone = $data->user_mobile;
		$img = (($data->user_photo != '') &&  file_exists('../images/photos/'.$data->user_photo)) ? '../images/photos/'.$data->user_photo : $img;
		$sts = $data->user_status;
	}
	$title = ($op == 'Edit') ? 'Edit ': 'Add ';
	
	switch($utype){
		case 'AD':
			$title .= 'Admin';
		break;
		case 'SF':
			$title .= 'Staff';
		break;
		default:
			$title .= 'Student';
		break;
	}
	$errDiv = '';
	if(isset($Err))
	{
		switch($Err)
		{
			case 'D':
				$errDiv = '<div class="complsory">Duplicate entery of UserName OR Email.</div>';
			break;
			
			case 'S':
				$errDiv = '<div class="complsory">Picture size exceeded 1MB limit.  Please choose a smaller size picture.</div>';
			break;
		}
	}
?>
	<div id="main">
		<div class="top-bar"><h1><?php echo $title;?></h1></div>
		<?php 
			echo $errDiv;
			require_once('../pages/registration.php');
		?>
	</div>
</body>
</html>
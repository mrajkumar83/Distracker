<?php
	$path = '.';
	$title =  'New Joinee :: ';
	$css = array('css/all.css', 'css/register.css', 'css/jquery.datepick.css');
	$js = array('js/register.js', 'js/date/jquery.datepick.js');
	require_once('common/configure.php');
	require_once('classes/Database.class.php');
	require_once('classes/Query.class.php');
	require_once('includes/commonheader.php');
	
	$db = new Query();
	$cntry = $db->fetchAllRecord('tb_country ' , ' country_id,country_name ', ' status="1" ' , NULL, ' country_name ', NULL,NULL,'All');
	$langs = $db->fetchAllRecord('tb_languages ' , ' lang_id,lang_name ', NULL , NULL, ' lang_name ', NULL,NULL,'All');
	if(isset($utype) && $utype == 'SD')
	{
		$chrt = $db->fetchAllRecord('tb_cohort ' , ' cohort_id,cohort_name ', ' cohort_status="A" ' , NULL, ' cohort_name ', NULL,NULL,'All');
	$concen = $db->fetchAllRecord('tb_concentration ' , ' concentration_id,concentration_name ', ' concentration_status="A" ' , NULL, ' concentration_name ', NULL, NULL,'All');
	}
	$pagefrom = 'front';
	$id =  '';
	$op =  'ADD';
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
	$cohort = '';
	$concentration = '';
	$lang = ($utype == 'SD') ? '' : array();
	$email_id = '';
	$skypeid = '';
	$telephone = '';
	$img = $path.'/img/profile_noimg.jpg';
	$utype = isset($utype) ? $utype : 'SD';
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
?>
<div id="main">
<div class="logo">
	<a href="index.php"><div class="header-right"><strong>Login</strong></div></a>
</div>
<div class="bodyDiv">
	<div class="top-bar">
			<h1><?php echo $title;?></h1>
		</div>
	<?php require_once('pages/registration.php');?>
</div>
</div>
<?php require('includes/footer.php');?>


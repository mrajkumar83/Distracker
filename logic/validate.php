<?php
require_once('../common/configure.php');
require_once('../classes/Database.class.php');
require_once('../classes/Query.class.php');
$db = new Query();
if(isset($id))
{
	if(isset($email_id) && trim($email_id) != '')
	{
		$db->fetchRecord(' tb_users ', ' * ', ' user_email="'.$email_id.'" AND user_id <> "'.$id.'"');
	}
	if(isset($registrationno) && trim($registrationno) != '')
	{
		$db->fetchRecord(' tb_user_info ', ' * ', ' user_registration="'.$registrationno.'" AND user_id <> "'.$id.'"');
	}
	if(isset($role_title) && trim($role_title) != '')
	{
		$db->fetchRecord(' tb_roles ', ' * ', ' role_title="'.$role_title.'" AND role_id <> "'.$id.'"');
	}
	if(isset($stg_title) && trim($stg_title) != '')
	{
		$db->fetchRecord(' tb_stages ', ' * ', ' stg_title="'.$stg_title.'" AND stg_id <> "'.$id.'"');
	}
	if(isset($country_name) && trim($country_name) != '')
	{
		$db->fetchRecord(' tb_country ', ' * ', ' country_name="'.$country_name.'" AND country_id <> "'.$id.'"');
	}
	if(isset($cohort_name) && trim($cohort_name) != '')
	{
		$db->fetchRecord(' tb_cohort ', ' * ', ' cohort_name="'.$cohort_name.'" AND cohort_id <> "'.$id.'"');
	}
	if(isset($concentration_name) && trim($concentration_name) != '')
	{
		$db->fetchRecord(' tb_concentration', ' * ', ' concentration_name="'.$concentration_name.'" AND concentration_id<> "'.$id.'"');
	}
	if(isset($lang_name) && trim($lang_name) != '')
	{
		$db->fetchRecord(' tb_languages', ' * ', ' lang_name="'.$lang_name.'" AND lang_id<> "'.$id.'"');
	}
	if(isset($program_name) && trim($program_name) != '')
	{
		$db->fetchRecord(' tb_programs', ' * ', ' program_name="'.$program_name.'" AND program_id<> "'.$id.'"');
	}
}
else
{
	if(isset($email_id) && trim($email_id) != '')
	{
		$db->fetchRecord(' tb_users ', ' * ', 'user_email="'.$email_id.'" ');
	}
	if(isset($registrationno) && trim($registrationno) != '')
	{
		$db->fetchRecord(' tb_users ', ' * ', ' user_registration="'.$registrationno.'" ');
	}
	if(isset($userid) && trim($userid) != '')
	{
		$db->fetchRecord(' tb_users ', ' * ', 'user_name="'.$userid.'" ');
	}
	if(isset($role_title) && trim($role_title) != '')
	{
		$db->fetchRecord(' tb_roles ', ' * ', 'role_title="'.$role_title.'" ');
	}
	if(isset($stg_title) && trim($stg_title) != '')
	{
		$db->fetchRecord(' tb_stages ', ' * ', ' stg_title="'.$stg_title.'" ');
	}
	if(isset($country_name) && trim($country_name) != '')
	{
		$db->fetchRecord(' tb_country ', ' * ', ' country_name="'.$country_name.'" ');
	}
	if(isset($cohort_name) && trim($cohort_name) != '')
	{
		$db->fetchRecord(' tb_cohort ', ' * ', ' cohort_name="'.$cohort_name.'" ');
	}
	if(isset($concentration_name) && trim($concentration_name) != '')
	{
		$db->fetchRecord(' tb_concentration ', ' * ', ' concentration_name="'.$concentration_name.'" ');
	}
	if(isset($lang_name) && trim($lang_name) != '')
	{
		$db->fetchRecord(' tb_languages ', ' * ', ' lang_name="'.$lang_name.'" ');
	}
	if(isset($program_name) && trim($program_name) != '')
	{
		$db->fetchRecord(' tb_programs ', ' * ', ' program_name="'.$program_name.'" ');
	}
	if(isset($uemail) && trim($uemail) != '')
	{
		$db->fetchRecord(' tb_users ', ' * ', ' user_email="'.trim($uemail).'" ');
		echo ($db->getRowCount()>0) ?  'true' : 'false';
		exit;
	}
}

echo ($db->getRowCount()>0) ? 'false' : 'true';
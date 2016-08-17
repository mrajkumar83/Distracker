<?php
require_once('../common/sess.php');
require_once('../common/configure.php');
require_once('../classes/Database.class.php');
require_once('../classes/Query.class.php');	
require_once('../common/checksess.php');

if(isset($cohort_edate) && $cohort_edate != '')
{
	$cohort_edate = convert_date($cohort_edate);
}
$id = (isset($id)) ? $id : 0;
switch($op)
{
	case 'E':
	case 'V':
				$data = $db->fetchRecord('tb_cohort', '*', 'cohort_id="'.$id.'"');                    

	break;

	case 'ADD':
		if ($db->storeDetails('tb_cohort', 'cohort_id = "", cohort_name = "'.htmlspecialchars(trim($cohort_name)).'", cohort_ref = "'.htmlspecialchars(trim($cohort_ref)).'", cohort_edate = "'.$cohort_edate.'", cohort_languages = "'.@implode(',', $cohort_languages).'", cohort_description = "'.htmlspecialchars(trim($cohort_description)).'", cohort_status = "'.$cohort_status.'", cohort_created="'.$UID.'",cohort_doc="'.date(DATE_TIME_FORMAT).'", cohort_dom="0000-00-00 00:00:00"') == true)
		{
			header('Location: ../stage/manage_cohort.php?sts=AA');			
		}
		else
			header('Location: ../stage/manage_cohort.php?op=A&Err=NA');				
	break;
	
	case 'Edit':
				$fields = ' cohort_name = "'.htmlspecialchars(trim($cohort_name)).'", cohort_ref = "'.htmlspecialchars(trim($cohort_ref)).'", cohort_edate = "'.$cohort_edate.'", cohort_languages = "'.@implode(',', $cohort_languages).'", cohort_description = "'.htmlspecialchars(trim($cohort_description)).'", cohort_status = "'.$cohort_status.'", cohort_modified="'.$UID.'", cohort_dom="'.date(DATE_TIME_FORMAT).'"';
				$output = $db->storeDetails(' tb_cohort ', $fields, ' WHERE cohort_id="'.$id.'"');
				header('Location: ../stage/manage_cohort.php?sts=E'.($output ? 'S' : 'F'));
	break;

	case 'D':
		$db->delData(' tb_cohort ', ' cohort_id="'.$id.'" ');
		header('Location: ../stage/manage_cohort.php?sts=DD');
	break;		
}
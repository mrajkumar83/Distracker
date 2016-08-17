<?php
require_once('../common/sess.php');
require_once('../common/configure.php');
require_once('../classes/Database.class.php');
require_once('../classes/Query.class.php');	
require_once('../common/checksess.php');

if($concentration_edate && $concentration_edate != '')
{
	$concentration_edate = convert_date($concentration_edate);
}

$id = (isset($id)) ? $id : 0;	
		
switch($op)
{
	case 'E':
	case 'V':
				$data = $db->fetchRecord('tb_concentration', '*', 'concentration_id="'.$id.'"');                    

	break;

	case 'ADD':
		if ($db->storeDetails('tb_concentration', 'concentration_id = "", concentration_name = "'.htmlspecialchars(trim($concentration_name)).'", concentration_ref = "'.htmlspecialchars(trim($concentration_ref)).'", concentration_edate = "'.$concentration_edate.'", concentration_languages = "'.implode(',', $concentration_languages).'", concentration_description = "'.htmlspecialchars(trim($concentration_description)).'", concentration_status = "'.$concentration_status.'", concentration_created="'.$UID.'",concentration_doc="'.date(DATE_TIME_FORMAT).'", concentration_dom="0000-00-00 00:00:00"') == true)
		{
						header('Location: ../stage/manage_concentration.php?sts=AA');
						exit;
		}
		else
			header('Location: ../stage/manage_concentration.php?op=A&Err=NA');
		
	break;
	
	case 'Edit':    
				$fields = ' concentration_name = "'.htmlspecialchars(trim($concentration_name)).'", concentration_ref = "'.htmlspecialchars(trim($concentration_ref)).'", concentration_edate = "'.$concentration_edate.'", concentration_languages = "'.implode(',', $concentration_languages).'", concentration_description = "'.htmlspecialchars(trim($concentration_description)).'", concentration_status = "'.$concentration_status.'", concentration_modified="'.$UID.'", concentration_dom="'.date(DATE_TIME_FORMAT).'"';
				$db->storeDetails('tb_concentration', $fields,' WHERE concentration_id="'.$id.'"');
				header('Location: ../stage/manage_concentration.php?sts=EE');
	break;

	case 'D':
		$db->delData('tb_concentration', ' concentration_id="'.$id.'"');
		header('Location: ../stage/manage_concentration.php');
	break;		
}

<?php
require_once('../common/sess.php');
require_once('../common/configure.php');
require_once('../classes/Database.class.php');
require_once('../classes/Query.class.php');	
require_once('../common/checksess.php');

$id = (isset($id)) ? $id : 0;

switch($op)
{
	case 'E':
	case 'V':
				$data = $db->fetchRecord('tb_languages', '*', 'lang_id="'.$id.'"');                    

	break;

	case 'ADD':
		if ($db->storeDetails('tb_languages', 'lang_id = "", lang_name = "'.htmlspecialchars(trim($lang_name)).'", lang_code="'.$lang_code.'",lang_doc="'.date(DATE_TIME_FORMAT).'", lang_dom="0000-00-00 00:00:00"') == true)
		{
			header('Location: ../stage/manage_languages.php?sts=AA');			
		}
		else
			header('Location: ../stage/manage_languages.php?op=A&Err=NA');				
	break;
	
	case 'Edit':
				$fields = ' lang_name = "'.htmlspecialchars(trim($lang_name)).'", lang_code="'.$lang_code.'", lang_dom="'.date(DATE_TIME_FORMAT).'"';
				$output = $db->storeDetails(' tb_languages ', $fields, ' WHERE lang_id="'.$id.'"');
				header('Location: ../stage/manage_languages.php?sts=E'.($output ? 'S' : 'F'));
	break;

	case 'D':
		$db->delData('tb_languages', ' lang_id="'.$id.'"');
		header('Location: ../stage/manage_languages.php?sts=DD');
	break;		
}
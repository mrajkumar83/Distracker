<?php
require_once('../common/sess.php');
require_once('../common/configure.php');
require_once('../classes/Database.class.php');
require_once('../classes/Query.class.php');	
require_once('../common/checksess.php');

$id = (isset($id)) ? $id : 0;
$program_mandatory = (isset($program_mandatory)) ? $program_mandatory : 'N';
switch($op)
{
	case 'E':
	case 'V':
				$data = $db->fetchRecord('tb_programs', '*', 'program_id="'.$id.'"');                    

	break;

	case 'ADD':
		if ($db->storeDetails('tb_programs', 'program_id = "", program_name = "'.htmlspecialchars(trim($program_name)).'", program_mandatory="'.$program_mandatory.'"') == true)
		{
			header('Location: ../stage/manage_programs.php?sts=AA');			
		}
		else
			header('Location: ../stage/manage_programs.php?op=A&Err=NA');				
	break;
	
	case 'Edit':
				$fields = ' program_name = "'.htmlspecialchars(trim($program_name)).'", program_mandatory="'.$program_mandatory.'" ';
				$output = $db->storeDetails(' tb_programs ', $fields, ' WHERE program_id="'.$id.'"');
				header('Location: ../stage/manage_programs.php?sts=E'.($output ? 'S' : 'F'));
	break;

	case 'D':
		$db->delData('tb_programs', ' program_id="'.$id.'"');
		header('Location: ../stage/manage_programs.php?sts=DD');
	break;		
}
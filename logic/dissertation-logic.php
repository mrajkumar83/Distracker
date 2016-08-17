<?php
require_once('../common/sess.php');
require_once('../common/configure.php');
require_once('../common/fileupload.php');
require_once('../classes/Database.class.php');
require_once('../classes/Query.class.php');	
require_once('../common/checksess.php');

$id = (isset($id)) ? $id : 0;

switch($op)
{
	case 'E':
	case 'V':
				$data = $db->fetchRecord('tb_dissertation', '*', 'dissertation_id="'.$id.'"');                    

	break;

	case 'ADD':
		if ($db->storeDetails('tb_dissertation', 'dissertation_id = "", std_id="'.$std_id.'", disseration_name = "'.htmlspecialchars(trim($disseration_name)).'", disseration_desc = "'.htmlspecialchars(trim($disseration_desc)).'", disseration_cohort = "'.$disseration_cohort.'", disseration_concentration = "'.$disseration_concentration.'", disseration_program = "'.$disseration_program.'", disseration_language = "'.$disseration_language.'", disseration_doc="'.date(DATE_TIME_FORMAT).'", disseration_doe="0000-00-00 00:00:00"') == true)
		{
			$id = $db->newRowId;
			$image = (isset($_FILES['disseration_files']) && isset($_FILES['disseration_files']['name']) && ($_FILES['disseration_files']['name'] != '')) ? fileupload('TXT','../images/disseration_files','disseration_files','N', '', $id) : '';
			if($image)
			{
				$db->storeDetails(' tb_dissertation_documents ', ' document_id = "", document_uploader="'.$UID.'", document_name = "'.htmlspecialchars($_FILES['disseration_files']['name']).'", disseration_id = "'.$id.'", document_path = "'.$image.'"');
			}
			header('Location: ../stage/manage_dissertation.php?sts=AA');			
		}
		else
			header('Location: ../stage/manage_dissertation.php?op=A&Err=NA');				
	break;
	
	case 'Edit':
				$fields = ' std_id="'.$std_id.'", disseration_name = "'.htmlspecialchars(trim($disseration_name)).'", disseration_desc = "'.htmlspecialchars(trim($disseration_desc)).'", disseration_cohort = "'.$disseration_cohort.'", disseration_concentration = "'.$disseration_concentration.'", disseration_program = "'.$disseration_program.'", disseration_language = "'.$disseration_language.'", disseration_status = "'.$disseration_status.'",  disseration_doe="'.date(DATE_TIME_FORMAT).'"';
				
				$output = $db->storeDetails(' tb_dissertation ', $fields, ' WHERE dissertation_id="'.$id.'"');
				$image = (isset($_FILES['disseration_files']) && isset($_FILES['disseration_files']['name']) && ($_FILES['disseration_files']['name'] != '')) ? fileupload('TXT','../images/disseration_files','disseration_files','N', '', $id) : '';
								
				if($image)
				{
					@unlink('../images/disseration_files/'.$oldfile);
					$output = $db->storeDetails(' tb_dissertation_documents ', ' document_name = "'.htmlspecialchars($_FILES['disseration_files']['name']).'", document_path = "'.$image.'" ', ' WHERE document_id="'.$docid.'"');
				}
				
				header('Location: ../stage/manage_dissertation.php?sts=E'.($output ? 'S' : 'F'));
	break;

	case 'D':
		$db->delData('tb_dissertation', ' dissertation_id = "'.$id.'"');
		$result = $db->fetchRecord(' tb_dissertation_documents ' , ' document_path ', ' disseration_id = "'.$id.'" AND document_uploader = "'.$UID.'"');
		if($result->document_path && $result->document_path != '')
		{
			@unlink('../images/disseration_files/'.$result->document_path);
		}
		$db->delData('tb_dissertation_documents', ' disseration_id = "'.$id.'" AND document_uploader = "'.$UID.'"');
		header('Location: ../stage/manage_dissertation.php?sts=DD');
	break;		
}
<?php
require_once('../common/sess.php');
require_once('../common/configure.php');
require_once('../classes/Database.class.php');
require_once('../classes/Query.class.php');	
require_once('../common/checksess.php');

$id = (isset($id)) ? $id : 0;
$sts = '';
$fields = ' role_title="'.htmlspecialchars(trim($role_title)).'", role_sc="'.htmlspecialchars(trim($role_sc)).'", 	
role_desc="'.htmlspecialchars(trim($role_desc)).'", role_num = "'.$role_num.'", 
role_disp_ord = "'.$role_disp_ord.'", role_status = "'.$role_status.'", role_reqd = "'.$role_reqd.'", role_constraints = "'.$role_constraints.'"';

//Order Condition
if($act_ord  != $role_disp_ord)
{
	if(isset($op) && $op == 'Edit'){ $db->storeDetails('tb_roles', ' role_disp_ord="0" ', ' WHERE 	role_id = "'.$id.'"');}
	if($act_ord > $role_disp_ord)
	{
		$result = $db->fetchAllRecord(' tb_roles ' , ' role_id,role_disp_ord ', ' role_disp_ord BETWEEN '.$role_disp_ord.' AND '.$act_ord.' AND role_disp_ord<>"'.$act_ord.'" ' , NULL, ' role_disp_ord ', 'DESC', 0,'All');
		while($data = mysql_fetch_object($result))
		{
			$db->storeDetails('tb_roles', ' role_disp_ord="'.((int)$data->role_disp_ord+1).'" ', ' WHERE 	role_id = "'.$data->role_id.'"');
		}
	}
	else
	{
	
		$result = $db->fetchAllRecord(' tb_roles ' , ' role_id,role_disp_ord ', ' role_disp_ord > "'.$act_ord.'" AND role_disp_ord <= "'.$role_disp_ord.'" ' , NULL, ' role_disp_ord ', 'ASC', 0,'All');
		while($data = mysql_fetch_object($result))
		{
			$db->storeDetails('tb_roles', ' role_disp_ord="'.((int)$data->role_disp_ord-1).'" ', ' WHERE 	role_id = "'.$data->role_id.'"');
		}
	
	}
}



switch($op)
{
	case 'ADD':		
		$fields .=' , role_doc = "'.date(DATE_TIME_FORMAT).'"';
		$store = $db->storeDetails('tb_roles', $fields);
		$id = $db->newRowId;	
	break;
	
	case 'Edit':
		$fields .=' , role_dom = "'.date(DATE_TIME_FORMAT).'"';
		$db->storeDetails('tb_roles', $fields, ' WHERE 	role_id = "'.$id.'"');
	break;

	case 'D':
		$db->delData(' tb_roles ', ' role_id="'.$id.'" ');
	break;		
}
header('Location: ../stage/manage_roles.php?sts='.$sts);
exit;
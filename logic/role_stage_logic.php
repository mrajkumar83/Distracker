<?php
require_once('../common/sess.php');
require_once('../common/configure.php');
require_once('../classes/Database.class.php');
require_once('../classes/Query.class.php');	
require_once('../common/checksess.php');

$id = (isset($id)) ? $id : 0;
$sts = '';
$fields = ' stg_id = "'.$stg_id.'", role_id = "'.$role_id.'", rel_ord = "'.$rel_ord.'", mail_to = "'.$mail_to.'" ';


//Order Condition
if($act_ord  != $rel_ord)
{
	if(isset($op) && $op == 'Edit'){ $db->storeDetails('tb_role_stage_rel', ' rel_ord="0" ', ' WHERE 	stg_role_id = "'.$id.'"');}
	if($act_ord > $rel_ord)
	{
		$result = $db->fetchAllRecord(' tb_role_stage_rel ' , ' stg_role_id,rel_ord ', ' rel_ord BETWEEN '.$rel_ord.' AND '.$act_ord.' AND rel_ord<>"'.$act_ord.'" ' , NULL, ' rel_ord ', 'DESC', 0,'All');
		while($data = mysql_fetch_object($result))
		{
			$db->storeDetails('tb_role_stage_rel', ' rel_ord="'.((int)$data->rel_ord+1).'" ', ' WHERE 	stg_role_id = "'.$data->stg_role_id.'"');
		}
	}
	else
	{
	
		$result = $db->fetchAllRecord(' tb_role_stage_rel ' , ' stg_role_id,rel_ord ', ' rel_ord > "'.$act_ord.'" AND rel_ord <= "'.$rel_ord.'" ' , NULL, ' rel_ord ', 'ASC', 0,'All');
		while($data = mysql_fetch_object($result))
		{
			$db->storeDetails('tb_role_stage_rel', ' rel_ord="'.((int)$data->rel_ord-1).'" ', ' WHERE 	stg_role_id = "'.$data->stg_role_id.'"');
		}
	
	}
}


switch($op)
{
	case 'ADD':
		
		$store = $db->storeDetails('tb_role_stage_rel', $fields);
		$id = $db->newRowId;	
	break;
	
	case 'Edit':
		
		$db->storeDetails('tb_role_stage_rel', $fields, ' WHERE stg_role_id = "'.$id.'"');
	break;

	case 'D':
		$db->delData(' tb_role_stage_rel ', ' stg_role_id="'.$id.'" ');
	break;		
}
header('Location: ../stage/manage_stage_role.php?sts='.$sts);
exit;
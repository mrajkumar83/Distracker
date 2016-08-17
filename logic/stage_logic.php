<?php
require_once('../common/sess.php');
require_once('../common/configure.php');
require_once('../classes/Database.class.php');
require_once('../classes/Query.class.php');	
require_once('../common/checksess.php');

$id = (isset($id)) ? $id : 0;
$sts = '';
$fields = ' stg_title="'.htmlspecialchars(trim($stg_title)).'", stg_description="'.htmlspecialchars(trim($stg_description)).'", 	
stg_order="'.htmlspecialchars(trim($stg_order)).'", stg_sts = "'.$stg_sts.'"';

//Order Condition
if($act_ord  != $stg_order)
{
	if(isset($op) && $op == 'Edit'){ $db->storeDetails('tb_stages', ' stg_order="0" ', ' WHERE 	stg_id = "'.$id.'"');}
	if($act_ord > $stg_order)
	{
		$result = $db->fetchAllRecord(' tb_stages ' , ' stg_id,stg_order ', ' stg_order BETWEEN '.$stg_order.' AND '.$act_ord.' AND stg_order<>"'.$act_ord.'" ' , NULL, ' stg_order ', 'DESC', 0,'All');
		while($data = mysql_fetch_object($result))
		{
			$db->storeDetails('tb_stages', ' stg_order="'.((int)$data->stg_order+1).'" ', ' WHERE 	stg_id = "'.$data->stg_id.'"');
		}
	}
	else
	{
	
		$result = $db->fetchAllRecord(' tb_stages ' , ' stg_id,stg_order ', ' stg_order > "'.$act_ord.'" AND stg_order <= "'.$stg_order.'" ' , NULL, ' stg_order ', 'ASC', 0,'All');
		while($data = mysql_fetch_object($result))
		{
			$db->storeDetails('tb_stages', ' stg_order="'.((int)$data->stg_order-1).'" ', ' WHERE 	stg_id = "'.$data->stg_id.'"');
		}
	
	}
}

switch($op)
{
	case 'ADD':
		
		$fields .=' , stg_doc = "'.date(DATE_TIME_FORMAT).'"';
		$store = $db->storeDetails('tb_stages', $fields);
		$id = $db->newRowId;	
	break;
	
	case 'Edit':
		$fields .=' , stg_dom = "'.date(DATE_TIME_FORMAT).'"';
		$db->storeDetails('tb_stages', $fields, ' WHERE 	stg_id = "'.$id.'"');
	break;

	case 'D':
		$db->delData(' tb_stages ', ' 	stg_id="'.$id.'" ');
	break;		
}
header('Location: ../stage/manage_stages.php?sts='.$sts);
exit;
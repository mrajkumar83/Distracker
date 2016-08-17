<?php
require_once('../common/sess.php');
require_once('../common/configure.php');
require_once('../classes/Database.class.php');
require_once('../classes/Query.class.php');	
require_once('../common/checksess.php');

$id = (isset($id)) ? $id : 0;
$sts = '';
$fields = ' country_name="'.htmlspecialchars(trim($country_name)).'", iso_code_2="'.htmlspecialchars(trim($iso_code_2)).'", iso_code_3="'.htmlspecialchars(trim($iso_code_3)).'", 	
address_format="'.htmlspecialchars(trim($address_format)).'", country_disp_ord = "'.$country_disp_ord.'", status = 1';

//Order Condition
if($act_ord  != $country_disp_ord)
{
	if(isset($op) && $op == 'Edit'){ $db->storeDetails('tb_country', ' country_disp_ord="0" ', ' WHERE 	country_id = "'.$id.'"');}
	if($act_ord > $country_disp_ord)
	{
		$result = $db->fetchAllRecord(' tb_country ' , ' country_id,country_disp_ord ', ' country_disp_ord BETWEEN '.$country_disp_ord.' AND '.$act_ord.' AND country_disp_ord<>"'.$act_ord.'" ' , NULL, ' country_disp_ord ', 'DESC', 0,'All');
		while($data = mysql_fetch_object($result))
		{
			$db->storeDetails('tb_country', ' country_disp_ord="'.((int)$data->country_disp_ord+1).'" ', ' WHERE 	country_id = "'.$data->country_id.'"');
		}
	}
	else
	{
	
		$result = $db->fetchAllRecord(' tb_country ' , ' country_id,country_disp_ord ', ' country_disp_ord > "'.$act_ord.'" AND country_disp_ord <= "'.$country_disp_ord.'" ' , NULL, ' country_disp_ord ', 'ASC', 0,'All');
		while($data = mysql_fetch_object($result))
		{
			$db->storeDetails('tb_country', ' country_disp_ord="'.((int)$data->country_disp_ord-1).'" ', ' WHERE 	country_id = "'.$data->country_id.'"');
		}
	
	}
}


switch($op)
{
	case 'ADD':
	
		$store = $db->storeDetails('tb_country', $fields);
		$id = $db->newRowId;	
	break;
	
	case 'Edit':
		
		$db->storeDetails('tb_country', $fields, ' WHERE country_id = "'.$id.'"');
	break;

	case 'D':
		$db->delData(' tb_country ', ' 	country_id="'.$id.'" ');
		//header('Location: ../stage/manage_stage.php?sts=DD');
	break;		
}
header('Location: ../stage/manage_countries.php?sts='.$sts);
exit;
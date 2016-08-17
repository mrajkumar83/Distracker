<?php
	$step = '2';
	$path = '..';	
	$title =  'Stage :: ';
	$css = array('css/miscpages.css');
	$js = array('js/jquery.validate.js', 'js/stage.js');
	require_once('includes/common.php');
	
	$db = new Query();
	
	$order = $db->fetchRecord(' tb_stages ' , ' MAX(stg_order) AS ord ', NULL , NULL, NULL, NULL, 0,'All');
	$stage_ord = (int)$order->ord;
	
	$id = (isset($id) && $id > 0) ? $id : '';
	$op = (isset($op) && $op != '') ? $op  : 'ADD';
	$stg_title = '';
	$stg_description = '';
	$stage_ord += 1;
	$stg_order = $stage_ord;
	$stg_order_sel = $stg_order;
	$stg_sts = 'A';
	$pageTitle = 'Add Stage';
	
	if($op == 'E' && $id>0)
	{
		$data = $db->fetchRecord(' tb_stages ', ' * ', ' stg_id="'.$id.'"');		
		$op = 'Edit';
		$stg_order = $order->ord;
		$stg_title = $data->stg_title;
		$stg_description = $data->stg_description;
		$stg_order_sel = $data->stg_order;
		$stg_sts = $data->stg_sts;
		$pageTitle = 'Edit Stage';
	}
	
?>
<div id="main">
	<div class="top-bar">
			<h1><?php echo $pageTitle;?></h1>
		</div>
	<?php require_once('../pages/stage.php');?>
</div>
</body>
</html>
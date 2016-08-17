<?php
	$step = '2';
	$path = '..';	
	$title =  'Country :: ';
	$css = array('css/miscpages.css');
	$js = array('js/jquery.validate.js', 'js/country.js');
	require_once('includes/common.php');
	
	$db = new Query();
	$order = $db->fetchRecord(' tb_country ' , ' MAX(country_disp_ord) AS ord ', NULL , NULL, NULL, NULL, 0,'All');
	$country_ord = (int)$order->ord;
	
	
	$id = (isset($id) && $id > 0) ? $id : '';
	$op = (isset($op) && $op != '') ? $op  : 'ADD';
	$country_name = '';
	$iso_code_2 = '';
    $iso_code_3 = '';
	$address_format = '';
	$country_ord += 1;
	$country_order_sel = $country_ord;
	$country_disp_ord = $country_ord;
	//$status = 'A';
	$pageTitle = 'Add Country';
	
	if($op == 'E' && $id>0)
	{
		$data = $db->fetchRecord(' tb_country ', ' * ', ' country_id="'.$id.'"');		
		$op = 'Edit';
		$country_name = $data->country_name;
		$iso_code_2 = $data->iso_code_2;
		$iso_code_3 = $data->iso_code_3;
		$address_format = $data->address_format;
		$country_order_sel = $data->country_disp_ord;
		
		//$role_status = $data->role_status;
		$pageTitle = 'Edit Country';
	}
	
?>
<div id="main">
	<div class="top-bar">
			<h1><?php echo $pageTitle;?></h1>
		</div>
	<?php require_once('../pages/country.php');?>
</div>
</body>
</html>


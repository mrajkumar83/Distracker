<?php
	$step = '2';
	$path = '..';	
	$title =  'Time-zone :: ';
	$css = array('css/miscpages.css');
	$js = array('js/time-zone.js');
	require_once('includes/common.php');
	
	$db = new Query();
	
	$id = (isset($id) && $id > 0) ? $id : '';
	$op = (isset($op) && $op != '') ? $op  : 'ADD';
	$time_name = '';
	$timezone = '';
	$default = '0';
	$pageTitle = 'Add Time-zone';
	
	if($op == 'E' && $id>0)
	{
		$data = $db->fetchRecord(' tb_timezones ', ' * ', ' tz_id="'.$id.'"');		
		$op = 'Edit';
		$time_name = $data->tz_name;
		$timezone = $data->tz_timezone;
		$default = $data->tz_default;
		$pageTitle = 'Edit Time-zone';
	}
	
?>
		<div id="main">
			<div class="top-bar">
				<h1><?php echo $pageTitle;?></h1>
			</div>
			<?php require_once('../pages/time_zone.php');?>
		</div>
	</body>
</html>
<?php
	$step = '2';
	$path = '..';	
	$title =  'Cohort :: ';
	$css = array('css/miscpages.css', 'css/jquery.datepick.css');
	$js = array('js/jquery.validate.js', 'js/cohort.js', 'js/date/jquery.datepick.js');
	require_once('includes/common.php');
	
	$db = new Query();
	$langs = $db->fetchAllRecord('tb_languages ' , ' lang_id,lang_name ', NULL , NULL, NULL, NULL,NULL,'All');
	
	$id = (isset($id) && $id > 0) ? $id : '';
	$op = (isset($op) && $op != '') ? $op  : 'ADD';
	$cohort_name = '';
	$cohort_ref = '';
	$cohort_edate = '';
	$cohort_languages = array();
	$cohort_description = '';
	$cohort_status = 'A';
	$pageTitle = 'Add Cohort';
	
	if($op == 'E' && $id>0)
	{
		$data = $db->fetchRecord(' tb_cohort ', ' * ', ' cohort_id="'.$id.'"');		
		$op = 'Edit';
		$cohort_name = $data->cohort_name;
		$cohort_ref = $data->cohort_ref;
		$cohort_edate = date_reverse($data->cohort_edate);
		$cohort_languages = explode(',', $data->cohort_languages);
		$cohort_description = $data->cohort_description;
		$cohort_status = $data->cohort_status;
		$pageTitle = 'Edit Cohort';
	}
	
?>
<div id="main">
	<div class="top-bar">
			<h1><?php echo $pageTitle;?></h1>
		</div>
	<?php require_once('../pages/cohort.php');?>
</div>
</body>
</html>


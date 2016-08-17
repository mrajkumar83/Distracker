<?php
	$step = '2';
	$path = '..';	
	$title =  'Research Study';
	$css = array('css/register.css', 'css/miscpages.css');
	$js = array('js/jquery.validate.js', 'js/add-dissertation.js');
	require_once('includes/common.php');
	
	$users = $db->fetchAllRecord('tb_users ' , ' user_id, user_fullname ', ' user_type="SD" AND user_status= "A" ' , NULL, ' user_fullname ', NULL,NULL,'All');
	$langs = $db->fetchAllRecord('tb_languages ' , ' lang_id,lang_name ', NULL , NULL, ' lang_name ', NULL,NULL,'All');
	$chrt = $db->fetchAllRecord('tb_cohort ' , ' cohort_id,cohort_name ', ' cohort_status="A" ' , NULL, ' cohort_name ', NULL,NULL,'All');
	$concen = $db->fetchAllRecord('tb_concentration ' , ' concentration_id,concentration_name ', ' concentration_status="A" ' , NULL, ' concentration_name ', NULL, NULL,'All');
	$program = $db->fetchAllRecord('tb_programs ' , ' program_id,program_name,program_mandatory ', NULL , NULL, ' program_name ', NULL, NULL,'All');
	
	$disseration_program = '';
	$disseration_name = '';
	$disseration_desc = '';
	$program_mandatory = 'N';
		
	$id = (isset($id) && $id > 0) ? $id : '';
	$op = (isset($op) && $op != '') ? $op  : 'ADD';
	
	if($UTYPE == 'SD')
	{
		$userdata = $db->fetchRecord(' vw_dissertation_details ', ' * ', ' std_id="'.$UID.'" ');
		$disseration_cohort_name = $userdata->chrt_name;
		$disseration_language_name = $userdata->lang_name;
		$disseration_concentration_name = $userdata->con_name;
		$disseration_cohort = $userdata->chrt_id;
		$disseration_language = $userdata->lang_id;
		$disseration_program = $userdata->program_id;
		$disseration_concentration = $userdata->con_id;
	}
	$disseration_status = 'A';
	$pageTitle = 'Add Research Study';
	$diss_sts = 'N';
	
	if($op == 'E' && $id>0)
	{
		$data = $db->fetchRecord(' tb_dissertation d, tb_users u, tb_programs p ', ' u.user_fullname, d.*, p.program_mandatory ', ' d.std_id=user_id AND p.program_id=d.disseration_program AND d.dissertation_id="'.$id.'" '.(($UTYPE == 'SD') ? 'AND d.std_id="'.$UID.'" ' : ''));
		$op = 'Edit';
		$std_name = $data->user_fullname;
		$diss_sts = $data->disseration_process_state;
		$std_id = $data->std_id;
		$disseration_cohort = $data->disseration_cohort;
		$disseration_concentration = $data->disseration_concentration;
		$disseration_program = $data->disseration_program;
		$program_mandatory = $data->program_mandatory;
		$disseration_language = $data->disseration_language;
		$disseration_name = $data->disseration_name;
		$disseration_desc = $data->disseration_desc;
		$disseration_status = $data->disseration_status;
		$pageTitle = 'Edit Research Study';
	}
	
?>
<div id="main">
	<div class="top-bar">
		<h1><?php echo $pageTitle;?></h1>
	</div>
	<?php require_once('../pages/dissertation.php');?>
</div>
</body>
</html>


<?php
$step = '2';
$path = '..';	
$title =  '';//'Dissertation';
$css = array('css/tinyeditor.css', 'css/report.css', 'css/miscpages.css', 'css/collapsingDiv.css');
$js = array('js/jquery.validate.js', 'js/dissert.js');
if(!isset($op) || $op != 'H' )
{
	$js[] = 'js/tiny.editor.packed.js';
}

require_once('includes/common.php');
require_once('includes/flowFuncs.php');

$stgdata = new stdClass();
$nextstep = true;
$next_order = '';
$nextstep_role = '';
$staff_next_step = 0;
$staff_fail_step = 0;
$max_step = 0;
$chkrole = 0;
$chktable = 3;
$flow_chk = 'F';
//$op = isset($op) ? $op : '';

if(!isset($op) || $op != 'H' )
{
	$steps_cnt = $db->fetchRecord(' tb_role_stage_rel ', ' MAX(rel_ord) step ');
	$max_step = (int)$steps_cnt->step + 1;
	
	require_once('includes/flowLogic.php');
}//End of if(not for history)
else
{
	$userdata = $db->fetchRecord(' vw_dissertation_details i ', ' i.std_id, i.std_name, i.program_name,i.std_photo, i.con_name, i.chrt_id, i.chrt_name, i.dist_name, i.dist_desc, DATE_FORMAT(i.dist_doc, "%b-%e- %Y") dist_doc, i.lang_name, i.email ', '  i.dist_id="'.$did.'" ');
}	
$dissertation = $userdata;
if(!isset($op) || $op != 'H'){	
	require_once('includes/nextrole.php');
}
require_once('includes/history.php');
?>
<div id="main">
	<?php
	if(isset($op) && $op=='C' && isset($sts_sent))
	{
		echo '<div class="MsgDiv">',stsDisplay($sts_sent),'</div>';
	}
	if(!isset($op) || $op != 'H'){
	?>
	<div class="top-bar">
		<h1><?php echo $stgdata->stg_title;?></h1>
	</div>
	<?php
		require_once($path.'/pages/dissertation_details.php');
		require_once('includes/mailConditions.php');
	}
	else if(isset($op) && $op == 'H')
	{
	?>
	<div class="select-bar">
			<!-- <h2 style="text-align:center;">History of <?php echo $userdata->dist_name;?></h2> -->
			<h2 style="text-align:center;">Research Study Interaction</h2>
	</div>
	<?php
		require_once($path.'/pages/dissertation_details.php');
		require_once($path.'/pages/dissertation_progress.php');
	}
	else
	{
		echo '<div style="margin:200px auto;text-align:center; font-weight:bold;font-size:20px;">Allocation Pending</div>';
	}
	?>
</div>
</body>
</html>
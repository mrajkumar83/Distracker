<?php
	$step = '1';
	$title =  'Staff :: ';
	$css = array('css/left_menu.css', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css');
	$js = array('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js', 'js/common.js');
	
	require_once('../common/sess.php');
	require_once('../common/configure.php');
	require_once('../classes/Database.class.php');
	require_once('../classes/Query.class.php');
	require_once('../includes/commonheader.php');
	
	$db = new Query();
	$stg_obj = $db->fetchAllRecord('vw_stage_role_rel ' , ' DISTINCT(stg_id),stg_title ', ' role_id = "'.$r.'" ' , NULL, NULL, NULL,NULL,'All');
	
	$stg_cnt = 0;
	while($stg_rec = $db->getRowObject())
	{
		$stg[$stg_cnt]['id'] = $stg_rec->stg_id;
		$stg[$stg_cnt]['name'] = $stg_rec->stg_title;
		$stg_cnt++;
	}
	$chrt_rec = $db->fetchAllRecord('tb_cohort ' , ' cohort_id,cohort_name ', ' cohort_status = "A" ' , NULL, 'cohort_name', NULL,NULL,'All');
	$total = $db->totalcnt;
	$cohort = array();
	$cnt = 0;
	
	while($chrt =  mysql_fetch_object($chrt_rec))
	{
		$cohort[$cnt]['id'] = $chrt->cohort_id;
		$cohort[$cnt]['name'] = $chrt->cohort_name;
		$cnt++;
	}//End of while{}
	function createLinks($cohort, $cnt, $total, $url)
	{
		for($i=0; $i<$cnt; $i++)
			{
				$cht = $cohort[$i];
				echo '<li class="',($total == $i ? 'last' : 'text'),'"><a target="frame2" href="',$url,$cht['id'],'">',$cht['name'],'</a></li>',"\n\t";
			}
	}
?>
<div id="middle" class="row">
	<div id="left-column" class="col-sm-2">
		<?php
			for($i=0; $i<$stg_cnt; $i++)
			{
		?>
		<h3><?php echo $stg[$i]['name'];?></h3>
		<ul class="nav">
			<?php
				createLinks($cohort, $cnt, $total, 'manage_students_dissertation.php?role='.$r.'&amp;sid='.$stg[$i]['id'].'&amp;op=G&amp;cid=');//for guiding
			?>				
			</ul>
		<?php
			}
		?>
	</div>
	<div class="col-sm-10">
	<iframe id="frame2" name="frame2" src="staff_pending_dissertation.php?role=<?php echo $r;?>" width="100%" height="600px" frameborder="0"></iframe>
	</div>
</div>
</body>
</html>
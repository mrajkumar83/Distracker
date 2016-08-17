<?php
	$path = '..';
	$step = '1';
	$title =  'Profile :: ';
	$css = array('css/left_menu.css', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css');
	$js = array('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js', 'js/common.js');
	require_once('includes/common.php');

	$db = new Query();
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
?>
<div id="middle" class="row">
	<div id="left-column" class="col-sm-2">
        <h3>My Account</h3>
			<ul class="nav">
				<li class="text"><a target="frame2" href="profile.php">Edit Profile</a></li>
				<li class="last"><a target="frame2" href="changepassword.php">Change Password</a></li>				
			</ul>
	<?php
		if($UTYPE != 'SD')
		{
	?>	
			<h3>Cohort Activity</h3>
			<ul class="nav">
			<?php
				for($i=0; $i<$cnt; $i++)
				{
					
					echo '<li class="',(($i+1) == $cnt ? 'last' : 'text'),'"><a target="frame2" href="dissertation_list.php?op=H&amp;cid=',$cohort[$i]['id'],'">',$cohort[$i]['name'],'</a></li>',"\n\t";
				}
				?>
			</ul>

            <h3>Dashboard</h3>
			<ul class="nav">
			<?php
				for($i=0; $i<$cnt; $i++)
				{
					
					echo '<li class="',(($i+1) == $cnt ? 'last' : 'text'),'"><a target="frame2" href="dissertation_list.php?op=R&amp;cid=',$cohort[$i]['id'],'">',$cohort[$i]['name'],'</a></li>',"\n\t";
				}
				?>
			</ul>
	<?php
		}
	?>
		</div>
	<div class="col-sm-10">
	<iframe id="frame2" name="frame2" src="welcome.php" width="100%" height="600px" frameborder="0"></iframe>
	</div>
</div>
</body>
</html>

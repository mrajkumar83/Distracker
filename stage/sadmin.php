<?php
	$step = '1';
	$title =  'Super Administrator :: ';
	$css = array('css/left_menu.css', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css');
	$js = array('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js', 'js/common.js');
	
	require_once('../common/configure.php');
	require_once('../common/sess.php');
	require_once('../includes/commonheader.php');
	if($UTYPE == 'SD')
	{
?>
	<script language="javascript">
		window.parent.document.location.href = "../index.php";
	</script>
</body>
</html>
<?php
	}
?>
<div id="middle" class="row">
	<div id="left-column" class="col-sm-2">
		<h3>Roles</h3>
		<ul class="nav">
			<li><a target="frame2" href="manage_roles.php">Manage Role</a></li>
			<li  class="last"><a target="frame2" href="role.php">Add Role</a></li>
		</ul>
		<h3>Stages</h3>
		<ul class="nav">
			<li><a target="frame2" href="manage_stages.php?utype=SD">Manage Stage</a></li>
			<li  class="last"><a target="frame2" href="stage.php">Add Stage</a></li>
		</ul>
		<h3>Country</h3>
		<ul class="nav">
			<li><a target="frame2" href="manage_countries.php">Manage Countries</a></li>
			<li  class="last"><a target="frame2" href="country.php">Add Country</a></li>
		</ul>
		<h3>Map Relation</h3>
		<ul class="nav">			
			<li><a target="frame2" href="manage_stage_role.php">Manage Role - Stage</a></li>
			<li><a target="frame2" href="role_stage.php">Add Role - Stage</a></li>
		</ul>
		<h3>Time zones</h3>
		<ul class="nav">			
			<li><a target="frame2" href="manage_time_zone.php">Manage Time zones</a></li>
			<li><a target="frame2" href="time_zone.php">Add Time zones</a></li>
		</ul>		
	</div>
	<div class="col-sm-10">
	<iframe id="frame2" name="frame2" src="welcome.php" width="100%" height="600px" frameborder="0"></iframe>
	</div>
</div>
</body>
</html>
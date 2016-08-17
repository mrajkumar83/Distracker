<?php
	$step = '1';
	$title =  'Administrator :: ';
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
		<h3>Administrators</h3>
		<ul class="nav">
			<li class="text"><a target="frame2" href="manage_admin.php">Manage Admin</a></li>
			<li class="last"><a target="frame2" href="allocate_admin.php">Assign Admin</a></li>
		</ul>
		<h3>Students</h3>
		<ul class="nav">
			<li><a target="frame2" href="manage_users.php?utype=SD">Manage Students</a></li>
			<li class="last"><a target="frame2" href="register.php?utype=SD">Add Student</a></li>
		</ul>
		<h3>Staff</h3>
		<ul class="nav">
			<li><a target="frame2" href="manage_users.php?utype=SF">Manage Staff</a></li>
			<li  class="last"><a target="frame2" href="register.php?utype=SF">Add Staff</a></li>
		</ul>
		<h3>Research</h3>
		<ul class="nav">
			<li><a target="frame2" href="manage_dissertation.php">Manage Research</a></li>
			<li class="last"><a target="frame2" href="dissertation.php">Add Research</a></li>
		</ul>
		<h3>Allocation</h3>
		<ul class="nav">
			 <li><a target="frame2" href="manage_allocation.php?project_sts=N">Staff Allocation</a></li>
			<li class="last"><a target="frame2" href="manage_allocation.php?project_sts=A">Modify Allocation</a></a></li>
		</ul>
		<h3>Reports</h3>
		<ul class="nav">
			<li><a target="frame2" href="student_report.php">Student Report</a></li>
			<li class="last"><a target="frame2" href="activities_list.php">Student's Activity</a></li>
			<li  class="last"><a target="frame2" href="staff_report.php">Staff Report</a></li>
		</ul>
		<h3>Misc.</h3>
		<ul class="nav">
			<li><a target="frame2" href="manage_cohort.php">Manage Cohorts</a></li>
			<li><a target="frame2" href="cohort.php">Add a Cohort</a></li>
			<li><a target="frame2" href="manage_concentration.php">Manage Track</a></li>
			<li><a target="frame2" href="concentration.php">Add a Track</a></li>
			<li><a target="frame2" href="manage_languages.php">Manage Languages</a></li>
			<li><a target="frame2" href="language.php">Add a Language</a></li>
			<li><a target="frame2" href="manage_programs.php">Manage Programs</a></li>
			<li><a target="frame2" href="program.php">Add a Program</a></li>
		</ul>
	</div>
	<div class="col-sm-10">
		<iframe id="frame2" name="frame2" src="welcome.php" width="100%" height="600px" frameborder="0"></iframe>
	</div>
</div>
</body>
</html>

<?php
	$title =  'Login to Dissertation Tracker';
	$css = array('student_menu.css');
	$js = array();
	require_once('../includes/commonheader.php');
?>
<div id="middle" class="row">
	<div id="left-column" class="col-sm-2">
		<h3>Students</h3>
		<ul class="nav">
			<li class="last"><a href="Admin_students_add.php">Add New Student</a></li>
			<li  class="last"><a href="Admin_students_Search.php">Edit Student Info</a></li>
		</ul>
		<h3>Staff</h3>
		<ul class="nav">
			<li><a href="Admin_staff_add.php">Add New Staff</a></li>
			<li  class="last"><a href="Admin_staff_EditSearch.php">Edit Staff Info</a></li>
		</ul>
		<h3>Allocation</h3>
		<ul class="nav">
			 <li class="last"><a href="Admin_staff_to_student.php">Staff to Student</a></li>
			<li class="last"><a href="Admin_staff_to_student_Modify.php">Modify Allocation</a></a></li>
		</ul>
		<h3>Reports</h3>
		<ul class="nav">
			<li><a href="Admin_student_Report.php">Student Report</a></li>
			<li  class="last"><a href="Admin_staff_ReportSearch.php">Staff Report</a></li>
		</ul>
		<h3>Misc.</h3>
		<ul class="nav">
			<li><a href="Admin_Cohort_Add.php">Add a Cohort</a></li>
			<li ><a href="Admin_Concentration_Add.php">Add a Concentration</a></li>
			<li  class="last"><a href="#">User ID maintenance</a></li>
		</ul>
	</div>
</div>
</body>
</html>

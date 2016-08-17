<?php
	$step = '2';
	$path = '..';
	require_once('../common/sess.php');
	require_once('../common/configure.php');
	require_once('../classes/Database.class.php');
	require_once('../classes/Query.class.php');
	$title =  'List Research Study';
	$css = array('miscpages.css', 'jquery.dataTables_themeroller.css', 'jquery-ui-1.8.4.custom.css', 'list.css');
	$js = array('list.js', 'jquery.metadata.js', 'jquery.dataTables.min.js');
	require_once('../includes/commonheader.php');
	$con = (($project_sts == 'N') ? ' = ' : ' <> ').'"N"';
	$db = new Query();
	
	$result = $db->fetchAllRecord(' tb_dissertation AS d, tb_users u  LEFT JOIN tb_languages l ON l.lang_id = d.disseration_language LEFT JOIN tb_cohort ct ON ct.cohort_id=disseration_cohort LEFT JOIN tb_concentration cn ON cn.concentration_id=d.disseration_concentration ' , ' d. dissertation_id AS id,d.disseration_name, u.user_fullname,l.lang_name, ct.cohort_name, cn.concentration_name ', ' d.disseration_process_state'.$con , NULL, '  d.disseration_doc', NULL, 0,'All');
	
?>
<div id="main">
	<div class="top-bar">
			<h1>Manage Research Study</h1>
		</div>
	<table cellpadding="0" cellspacing="0" border="0" class="display" id="grid-data" width="100%">
    <thead>
		<th>Title</th>
		<th>Student Name</th>
		<th>Cohort</th>
		<th>Concentration</th>
		<th>Lanaguage</th>
      </thead>
	  <tbody>
      <?php
		$row=0;
		$link = ($project_sts == 'N') ? '?id=' : '?op=E&amp;id=';
		while($data = mysql_fetch_object($result))
		{
			$class = ($row%2) ? 'even' : 'odd';
			echo '<tr class="',$class,'">',"\n\t\t";
      			echo '<td><a href="staff_allocation.php',$link,$data->id,'">',$data->disseration_name,'</a></td>';
				echo '<td>',$data->user_fullname,'</td>';
				echo '<td>',$data->cohort_name,'</td>';
				echo '<td>',$data->concentration_name,'</td>';
				echo '<td>',$data->lang_name,'</td>';
    		echo '</tr>',"\n";
			$row++;
		}
	?>
	</tbody>
  </table>
</div>
</body>
</html>
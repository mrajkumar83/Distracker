<?php
	$step = '2';
	$path = '..';
	require_once('../common/configure.php');
	require_once('../classes/Database.class.php');
	require_once('../classes/Query.class.php');
	$title =  'List Cohort :: ';
	$css = array('css/miscpages.css', 'css/jquery.dataTables_themeroller.css', 'css/jquery-ui-1.8.4.custom.css', 'css/list.css');
	$js = array('js/list.js', 'js/jquery.metadata.js', 'js/jquery.dataTables.min.js');
	require_once('../includes/commonheader.php');
	
	$db = new Query();
	$result = $db->fetchAllRecord(' tb_cohort ' , ' cohort_id,cohort_name,cohort_ref,cohort_status ', NULL , NULL, '  cohort_name', NULL, 0,'All');
	
	function chkCohorts($id)
	{
		global $db;
		$cohort_obj = $db->fetchRecord(' tb_dissertation ', ' count(1) AS cnt ', ' disseration_cohort="'.$id.'"');
		if($cohort_obj->cnt > 0)
		{
			return false;
		}
		
		return true;
	}
	
?>
<div id="main">
	<div class="top-bar"><h1>Manage Cohort</h1></div>
	<table cellpadding="0" cellspacing="0" border="0" class="display" id="grid-data" width="100%">
    <thead>
		<th>Name</th>
		<th>Reference</th>
		<th>Status</th>
		<th>Action</th>
      </thead>
	  <tbody>
      <?php
		$row=0;
		while($data = mysql_fetch_object($result))
		{
			$class = ($row%2) ? 'even' : 'odd';
			echo '<tr class="',$class,'">',"\n\t";
      			echo '<td>',$data->cohort_name,'</td>',"\n";
				echo '<td>',$data->cohort_ref,'</td>';
      			echo '<td class="center">',($data->cohort_status == 'A' ? 'Active' : 'Inactive'),'</td>';
      			echo '<td class="center"><a href="cohort.php?op=E&amp;id=',$data->cohort_id,'" title="Edit Cohort" alt="Edit Cohort"><div class="img edit"></div></a>&nbsp;';
				if(chkCohorts($data->cohort_id))
				{
					echo '<a href="javascript:del(\'../logic/cohort-logic.php?op=D&amp;id=',$data->cohort_id,'\');" title="Delete Cohort" alt="Delete Cohort"><div class="img delete"></div></a>';
				}
    		echo '</td></tr>',"\n";
			$row++;
		}
	?>
	</tbody>
  </table>
</div>
</body>
</html>
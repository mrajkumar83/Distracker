<?php
	$step = '2';
	$path = '..';
	require_once('../common/configure.php');
	require_once('../classes/Database.class.php');
	require_once('../classes/Query.class.php');
	$title =  'List Languages';
	$css = array('css/miscpages.css', 'css/jquery.dataTables_themeroller.css', 'css/jquery-ui-1.8.4.custom.css', 'css/list.css');
	$js = array('js/list.js', 'js/jquery.metadata.js', 'js/jquery.dataTables.min.js');
	require_once('../includes/commonheader.php');
	
	$db = new Query();
	$result = $db->fetchAllRecord(' tb_programs ' , ' * ', NULL , NULL, '  program_name', NULL, 0,'All');
	
?>
<div id="main">
	<div class="top-bar"><h1>Manage Programs</h1></div>
	<table cellpadding="0" cellspacing="0" border="0" class="display" id="grid-data" width="100%">
    <thead>
		<th>Program Name</th>
		<th>Track Mandate</th>
		<th>Action</th>
      </thead>
	  <tbody>
      <?php
		$row=0;
		while($data = mysql_fetch_object($result))
		{
			$class = ($row%2) ? 'even' : 'odd';
			echo '<tr class="',$class,'">',"\n\t";
      			echo '<td>',$data->program_name,'</td>',"\n";
				echo '<td>',(($data->program_mandatory == 'Y') ? 'Yes' : 'No'),'</td>',"\n";
      			echo '<td class="center"><a href="program.php?op=E&amp;id=',$data->program_id,'" title="Edit Program" alt="Edit Program"><div class="img edit"></div></a>&nbsp;';
				echo '<a href="javascript:del(\'../logic/program-logic.php?op=D&amp;id=',$data->program_id,'\');" title="Delete Program" alt="Delete Program"><div class="img delete"></div></a>';
				
    		echo '</td></tr>',"\n";
			$row++;			
		}
	?>
	</tbody>
  </table>
</div>
</body>
</html>
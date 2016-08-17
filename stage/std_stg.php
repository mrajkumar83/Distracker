<?php
	$step = '2';
	$path = '..';
	require_once('../common/sess.php');
	require_once('../common/configure.php');
	require_once('../classes/Database.class.php');
	require_once('../classes/Query.class.php');
	
	$title =  'List Research Study :: ';
	$css = array('css/miscpages.css', 'css/jquery.dataTables_themeroller.css', 'css/jquery-ui-1.8.4.custom.css', 'css/list.css');
	$js = array('js/list.js', 'js/jquery.metadata.js', 'js/jquery.dataTables.min.js');
	require_once('../includes/commonheader.php');
	
	$db = new Query();
	$result = $db->fetchAllRecord(' tb_dissertation AS d LEFT JOIN tb_languages l ON l.lang_id = d.disseration_language ' , ' d. dissertation_id,d.disseration_name,l.lang_name,d.disseration_status ', NULL , NULL, '  d.disseration_doc AND d.std_id="'.$UID.'"', NULL, 0,'All');
?>
<div id="main">
	<div class="top-bar"><h1>Manage Research Study</h1></div>
	<table cellpadding="0" cellspacing="0" border="0" class="display" id="grid-data" width="100%">
    <thead>
		<th>Title</th>
		<th>Lanaguage</th>
		<th>Status</th>
		<th>Action</th>
      </thead>
	  <tbody>
      <?php
		$row=0;
		while($data = mysql_fetch_object($result))
		{
			$class = ($row%2) ? 'even' : 'odd';
			echo '<tr class="',$class,'">',"\n\t\t";
      			echo '<td>',$data->disseration_name,'</td>';
				echo '<td>',$data->lang_name,'</td>';
      			echo '<td class="center">',($data->disseration_status == 'A' ? '' : 'In-'),'Active</td>';
      			echo '<td class="center"><a href="dissertation.php?op=E&amp;id=',$data->dissertation_id,'" title="Edit Dissertation" alt="Edit Dissertation"><div class="img edit"></div></a>&nbsp;<a href="../logic/dissertation-logic.php?op=D&amp;id=',$data->dissertation_id,'" title="Delete Dissertation" alt="Delete Dissertation"><div class="img delete"></div></a></td>';
    		echo '</tr>',"\n";
			$row++;
		}
	?>
	</tbody>
  </table>
</div>
</body>
</html>
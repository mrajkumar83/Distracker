<?php
	$step = '2';
	$path = '..';
	require_once($path.'/common/sess.php');
	require_once($path.'/common/configure.php');
	require_once($path.'/classes/Database.class.php');
	require_once($path.'/classes/Query.class.php');
	$db = new Query();
	require_once($path.'/common/checksess.php');
	$title =  'Dissertation Tracker | List Time zone';
	$css = array('css/miscpages.css', 'css/jquery.dataTables_themeroller.css', 'css/jquery-ui-1.8.4.custom.css', 'css/list.css');
	$js = array('js/list.js', 'js/jquery.metadata.js', 'js/jquery.dataTables.min.js');
	require_once($path.'/includes/commonheader.php');
	
	$result = $db->fetchAllRecord(' tb_timezones' , ' tz_id, tz_name, tz_timezone, tz_default ', NULL , NULL, NULL, NULL, 0,'All');

?>
<div id="main">
	<div class="top-bar"><h1>Time zones</h1></div>
	<table cellpadding="0" cellspacing="0" border="0" class="display" id="grid-data" width="100%">
    <thead>
		<th>GMT Difference</th>
		<th>Time zone</th>
		<th>Default-Status</th>
		<th>Action</th>
      </thead>
	  <tbody>
      <?php
		$row=0;
		while($data = mysql_fetch_object($result))
		{
			$class = ($row%2) ? 'even' : 'odd';
			echo '<tr class="',$class,'">',"\n\t";
      			echo '<td>',$data->tz_name,'</td>',"\n";
				echo '<td>',$data->tz_timezone,'</td>';
				echo '<td>',(($data->tz_default == '1') ? 'Yes' : 'No'),'</td>';
      			echo '<td class="center"><a href="time_zone.php?op=E&amp;id=',$data->tz_id,'" title="Edit Time-zone" alt="Edit Time-zone"><div class="img edit"></div></a>&nbsp;';
				echo '<a href="javascript:del(\'../logic/time_zone_logic.php?op=D&amp;id=',$data->tz_id,'\');" title="Delete Time-zone" alt="Delete Time-zone"><div class="img delete"></div></a>';
    		echo '</td></tr>',"\n";
			$row++;
		}
	?>
	</tbody>
  </table>
</div>
</body>
</html>
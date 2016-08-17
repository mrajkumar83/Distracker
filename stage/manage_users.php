<?php
	$step = '2';
	$path = '..';
	
	$title =  'Manage Users ';
	$css = array('css/miscpages.css', 'css/jquery.dataTables_themeroller.css', 'css/jquery-ui-1.8.4.custom.css', 'css/list.css');
	$js = array('js/list.js', 'js/jquery.metadata.js', 'js/jquery.dataTables.min.js');
	require_once('includes/common.php');
	
	$result = $db->fetchAllRecord(' tb_users u, tb_user_info ui ' , ' u.user_id, u.user_name, CONCAT(ui.user_lname, ", ",ui.user_fname) AS user_fullname, u.user_email, u.user_status ', ' u.user_id = ui.user_id AND u.user_type'.(($utype=='SF') ? '<>"SD" AND u.user_id<>"'.$UID: '="'.$utype) .'" AND u.user_type<>"SA"  ' , NULL, '  ui.user_lname', NULL, 0,'All');
	switch($utype){
		case 'AD':
			$title = 'Admin';
		break;
		case 'SF':
			$title = 'Staff';
		break;
		default:
			$title = 'Student';
		break;
	}
	
	function chkUser($id)
	{
		global $db, $utype;
		if($utype ==  'SD')
		{
			$user_obj = $db->fetchRecord(' tb_dissertation ', ' count(1) AS cnt ', ' std_id="'.$id.'"');
			if($user_obj->cnt > 0)
			{
				return false;
			}
			
			$user_obj = $db->fetchRecord(' tb_student_staff_rel ', ' count(1) AS cnt ', ' std_id="'.$id.'"');
			if($user_obj->cnt > 0)
			{
				return false;
			}
			
			$user_obj = $db->fetchRecord(' tb_dissertation_history ', ' count(1) AS cnt ', ' std_id="'.$id.'"');
			if($user_obj->cnt > 0)
			{
				return false;
			}
			return true;
		}
		$user_obj = $db->fetchRecord(' tb_student_staff_rel ', ' count(1) AS cnt ', ' staff_id="'.$id.'"');
		if($user_obj->cnt > 0)
		{
			return false;
		}
		
		$user_obj = $db->fetchRecord(' tb_dissertation_history ', ' count(1) AS cnt ', ' staff_id="'.$id.'"');
		if($user_obj->cnt > 0)
		{
			return false;
		}
		return true;
	}
?>
<div id="main">
	<div id="sts"></div>
	<div class="top-bar"><h1>Manage <?php echo $title;?></h1></div>
	  <table cellpadding="0" cellspacing="0" border="0" class="display" id="grid-data" width="100%">
    <thead>
		<th>Name</th>
		<th>User Name</th>
		<th>Email</th>
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
      			echo '<td>',$data->user_fullname ,'</td>',"\n";
				echo '<td>',$data->user_name,'</td>';
				echo '<td>',$data->user_email,'</td>';
      			echo '<td class="center">',($data->user_status == 'A' ? '' : 'In-'),'Active</td>';
      			echo '<td class="center"><a href="register.php?op=E&amp;utype=',$utype,'&amp;id=',$data->user_id,'" title="Edit"><div class="img edit"></div></a>&nbsp;';
				if(chkUser($data->user_id))
				{
					echo '<a href="javascript:del(\'../logic/register-logic.php?op=D&amp;id=',$data->user_id,'&amp;utype=',$utype,'\');" title="Delete"><div class="img delete"></div></a>';
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

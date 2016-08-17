<?php
	$step = '2';
	$path = '..';
	$title = 'Assign Admin';
	$css = array('css/all.css', 'css/register.css');
	$js = array();
	require_once('includes/common.php');
	
	$img = $path.'/img/profile_noimg.jpg';
	$data = $db->fetchRecord(' tb_users AS u LEFT JOIN tb_user_info AS i on i.user_id = u.user_id ', ' user_type, user_prefix, user_fname, user_lname, user_doe, user_name, user_photo ', 'u.user_id="'.$id.'"');
	$img = (($data->user_photo != '') &&  file_exists('../images/photos/'.$data->user_photo)) ? '../images/photos/'.$data->user_photo : $img;
?>
	<div id="main">
		<div class="top-bar">
			<h1>Assign Admin</h1>
		</div>
		<div class="table">
			<img src="../img/bg-th-left.gif" width="8" height="7" alt="" class="left" />
			<img src="../img/bg-th-right.gif" width="7" height="7" alt="" class="right" />
			<form method="post" name="registerFrm" id="registerFrm" action="<?php echo $path;?>/logic/register-logic.php?op=E">			
		<table class="listing form" cellpadding="0" cellspacing="0">
				<tr>
					<th class="full" colspan="4">Personal Details</th>
				</tr>
				<tr class="bg">
					<td class="first" ><strong>Title</strong></td>
					<td class="last" colspan="3"><?php echo $data->user_prefix;?></td>
			  <tr>
					<td class="first"><strong>First Name</strong></td>
					<td class="last"><?php echo $data->user_fname;?></td>
					<td class="first"><strong>Last Name</strong></td>
					<td class="last"><?php echo $data->user_lname;?></td>
			  </tr>
				
				<tr>
					<th class="full" colspan="4">Enrolment Details</th>
				</tr>
				
				<tr class="bg">
				  <td class="first" ><strong>User ID</strong></td>
				  <td class="last"><?php echo $data->user_name;?></td>
				  <td class="first">&nbsp;</td>
				  <td class="last">&nbsp;</td>
				  <!--
				  <td class="first" ><strong>Date of Enrolment</strong></td>
				  <td class="last"><?php echo $data->user_doe != '' ? date_reverse($data->user_doe) : '&nbsp;';?></td>
				  -->
				</tr>
				<tr>
				<td class="first"><strong>Assign As:</strong></td>
				<td colspan="3" class="last">					
					<input type="checkbox" class="textarea" name="user_type" value="AD"<?php echo ($data->user_type == 'AD' ? ' checked' : '');?>>&nbsp;Admin&nbsp;
                 </td>
			</tr>	
			</table>
		   <p class="buttons">
		   <input name="id" id="id" type="hidden" value="<?php echo $id;?>">		   
		  <input name="Cancel" type="reset" value="Cancel" onclick="javascript: window.document.location.href='allocate_admin.php';">
			&nbsp; &nbsp;
		  <input name="AddNew" type="submit" value="Submit" />
		</p>
	  </div>
	  <div id="right-column">
		<div class="box"><input name="Profile Picture" type="image" disabled src="<?php echo $img;?>" alt="Profile picture" align="middle" height="120" width="120" /></div>	
	  </div>		  
</form>
	</div>
</body>
</html>


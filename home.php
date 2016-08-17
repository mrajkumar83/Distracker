<?php
	$path = '.';
	$title =  'Home';
	$css = array('css/all.css', 'css/common.css');
	$js = array('js/common.js');
	//PHP
	require_once('common/configure.php');
	require_once('classes/Database.class.php');
	require_once('classes/Query.class.php');
	require_once('common/sess.php');
	require_once('includes/commonheader.php');
	
	$db = new Query();
	$data = $db->fetchRecord(' tb_user_info ', ' CONCAT(user_prefix, " ",user_fname, " ",user_lname) AS fullname, user_photo ', ' user_id="'.$UID.'" ');
	$img = $path.'/img/profile_noimg.jpg';
	if(isset($data->user_photo) && $data->user_photo != '' &&  file_exists('images/photos/'.$data->user_photo))
	$img = 'images/photos/'.$data->user_photo;
?>
<div>
<div class="logo">
	<div class="header-right">
			Welcome&nbsp;<a href="home.php"><?php echo $data->fullname;?> <img src="<?php echo $img;?>" width="27" height="27" alt="user"> </a>
            &nbsp; |&nbsp;
            <a href="logout.php"><strong>logout</strong></a>
	</div>				
</div>
<div class="bodyDiv">
<div id="header">
<ul id="top-navigation">
            <li class="active"><a target="frame1" href="stage/index.php"><span><span>Home</span></span></a></li>
			<?php
				if($UTYPE == 'AD' || $UTYPE == 'SA')
				{
					if($UTYPE == 'SA')
					{
						echo '<li><a target="frame1" href="stage/sadmin.php"><span><span>Super Admin</span></span></a></li>';
					}
					echo '<li><a target="frame1" href="stage/admin.php"><span><span>Admin</span></span></a></li>';					
				}
				
				if($UTYPE != 'SD')
				{				
					$roles_assigned = $db->fetchAllRecord('tb_student_staff_rel AS rel, tb_roles AS r ', ' DISTINCT(rel.role_id), r.role_title ', ' rel.role_id =r.role_id AND rel.staff_id="'.$UID.'" AND (rel.rel_status="S")', NULL, ' r.role_disp_ord ', 'ASC', NULL, 'All');
						// OR rel.rel_status="P"
						while($roles_rec = mysql_fetch_object($roles_assigned))
						{
							echo '<li>
									<a href="stage/staff.php?r=',$roles_rec->role_id,'" target="frame1">
									<span><span>
										',$roles_rec->role_title,'
									</span></span>
									</a>
								</li>';							
						}
				}
				else
				{
			?>
					<li><a target="frame1" href="stage/student.php"><span><span>Student</span></span></a></li>
			<?php } ?>
		</ul>
	</div>
	<div id="middle" class="row">
		<iframe id="frame1" name="frame1" src="stage/index.php" width="100%" height="600px" frameborder="0"></iframe> 
	</div>
</div>
</div>
<?php require('includes/footer.php');?>
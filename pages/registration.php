<form method="post" name="registerFrm" id="registerFrm" action="<?php echo $path;?>/logic/register-logic.php?op=<?php echo $op;?>" enctype="multipart/form-data">
<div class="table col-sm-10">
	<img src="../img/bg-th-left.gif" width="8" height="7" alt="" class="left" />
	<img src="../img/bg-th-right.gif" width="7" height="7" alt="" class="right" />			
	<table class="listing form" cellpadding="0" cellspacing="0">
			<tr>
				<th class="full" colspan="4">Personal Details</th>
			</tr>
			<tr class="bg">
				<td class="first" ><strong>Title</strong><span class="complsory">*</span></td>
				<td class="last" colspan="3">
				<?php
				if(isset($UTYPE) && $UTYPE == 'SD')
				{
					echo $prefix;
					echo '<input type="hidden" name="prefix" id="prefix" value="',$prefix,'">';
				}
				else
				{
				?>
				<select name="prefix" id="prefix" style="width:120px;">
				<option value="">Please select...</option>
				<?php
				if($utype != 'SD')
				{
					echo '<option value="Dr"',(('Dr' == $prefix) ? ' selected="selected"' : ''),'>Dr.</option>';
				}
				?>				
				<option value="Mr"<?php echo (('Mr' == $prefix) ? ' selected="selected"' : '');?>>Mr.</option>
				<option value="Mrs"<?php echo (('Mrs' == $prefix) ? ' selected="selected"' : '');?>>Mrs.</option>
				<option value="Miss"<?php echo (('Miss' == $prefix) ? ' selected="selected"' : '');?>>Miss.</option>
				<option value="Rev"<?php echo (('Rev' == $prefix) ? ' selected="selected"' : '');?>>Rev.</option>
			</select>
				<?php
				}
				?>
			</td>
		  <tr>
				<td class="first"><strong>First Name</strong><span class="complsory">*</span></td>
				<td class="last">
				<?php
				if(isset($UTYPE) && $UTYPE == 'SD')
				{
					echo $fname;
					echo '<input type="hidden" name="fname" id="fname" value="',$fname,'">';
				}
				else
				{
				?>
				<input type="text" class="text" name="fname" id="fname" value="<?php echo $fname;?>">
				<?php
				}
				?>
				</td>
				<td class="first"><strong>Last Name</strong><span class="complsory">*</span></td>
				<td class="last">
				<?php
				if(isset($UTYPE) && $UTYPE == 'SD')
				{
					echo $lname;
					echo '<input type="hidden" class="text" name="lname" id="lname" value="',$lname,'">';
				}
				else
				{
				?>
				<input type="text" class="text" name="lname" id="lname" value="<?php echo $lname;?>">
				<?php
				}
				?>
				</td>
		  </tr>
			<tr class="bg">
				<td class="first"><strong>Street Address</strong></td>
				<td class="last" colspan="3"><input type="text" class="text" style="width:85%"  name="saddress" value="<?php echo $saddress;?>" id="saddress"></td>
			</tr>
			<tr>
				<td class="first"><strong>Apartment / Suite</strong></td>
				<td class="last" colspan="3"><input type="text" class="text" name="suite" id="suite" value="<?php echo $suite;?>"></td>
			</tr>
			<tr class="bg">
				<td class="first"><strong>City</strong></td>
				<td class="last"><input type="text" class="text" name="City" id="City" value="<?php echo $City;?>"></td>
				<td class="first"><strong>Zip code</strong></td>
				<td class="last"><input type="text" class="text" name="zip" id="zip" maxlength="12" value="<?php echo $zip;?>"></td>
			</tr>
			<tr>
				<td class="first"><strong>State</strong></td>
			  <td class="last">
				<input type="text" class="text" name="state" id="state" value="<?php echo $state;?>">
			  </td>
			   <td class="first"><strong>Country</strong></td>
			   <td class="last">
				<select class="text" name="country" id="country">
						<option value="0">Please select...</option>
						<?php
							while($cntry_rec = mysql_fetch_object($cntry))
							{
								echo '<option value="',$cntry_rec->country_id,'"',(($cntry_rec->country_id == $country) ? ' selected="selected"' : ''),'>',$cntry_rec->country_name,'</option>';
							}
						?>
				</select>
			</td>
			</tr>
			<tr>
				<th class="full" colspan="4">Enrolment Details</th>
			</tr>
			<?php
			if($utype == 'SD')
			{
			?>
			<tr class="bg">
				<td class="first"><strong>Registration #</strong><span class="complsory">*</span></td>
				<td class="last">
				<?php
				if(isset($UTYPE) && $UTYPE == 'SD')
				{
					echo $registrationno;
					echo '<input type="hidden" name="registrationno" id="registrationno" class="text" value="',$registrationno,'">';
				}
				else
				{
				?>
				<input type="text" name="registrationno" id="registrationno" class="text" value="<?php echo $registrationno;?>">
				<?php
				}
				?>
				</td>
				
				<td class="first"><strong>Date of Enrolment</strong><span class="complsory">*</span></td>
				<td class="last">
				<?php
				if(isset($UTYPE) && $UTYPE == 'SD')
				{
					echo $date_enrollment;
					echo '<input type="hidden" name="date_enrollment" id="date_enrollment" value="',$date_enrollment,'">';
				}
				else
				{
				?>
				<input type="tevt" class="text" name="date_enrollment" id="date_enrollment" value="<?php echo $date_enrollment;?>">
				<?php
				}
				?>
				</td>
			</tr>
			<?php
			}
			if($op == 'ADD')
			{
			?>
			<tr>
			  <td class="first" ><strong>User ID</strong><span class="complsory">*</span></td>
			  <td class="last"><input type="text" name="userid" id="userid" class="text" value="<?php echo $userid;?>"></td>
			  <td class="first" ><strong>Password</strong><span class="complsory">*</span></td>
			  <td class="last"><input type="password" name="user_password" id="user_password" class="text"></td>
			</tr>
			<?php
			}
			
			if($utype == 'SD')
			{
			
			}
			else
			{
			?>
			<tr>
				<td class="first"><strong>Language</strong></td>
				<td class="last" colspan="3">
					<?php
					if($utype == 'SD' || !is_array($lang))
					{
					?>
					<select name="lang" id="lang" class="text">
						<option value="">Please Select...</option>
						<?php
							while($langs_rec = mysql_fetch_object($langs))
							{
								echo '<option value="'.$langs_rec->lang_id.'"'.(($langs_rec->lang_id == $lang) ? ' selected="selected"' : '').'>',$langs_rec->lang_name,'</option>';
							}								
						?>
					</select>
					<?php
					}
					else
					{
						$c = 0;
						while($langs_rec = mysql_fetch_object($langs))
						{
							echo '<input type="checkbox" name="lang[]" value="',$langs_rec->lang_id,'" id="lang[',$langs_rec->lang_id,']"',(($op == 'ADD' && $c ==0) || in_array($langs_rec->lang_id, $lang) ? ' checked="checked"': ''),'>&nbsp;
						      <label for="lang[',$langs_rec->lang_id,']">',$langs_rec->lang_name,'</label>';
							$i++;
							$c++;
						}
					}?>
				</td>
			</tr>
			<?php
			}
			?>					
		  <tr>
				<th class="full" colspan="4">Communication Details</th>
			</tr>
			<tr class="bg">
				<td class="first"><strong>email-ID</strong><span class="complsory">*</span></td>
				<td class="last" colspan="3"><input name="email_id" id="email_id" type="text" class="text" size="40" value="<?php echo $email_id;?>"></td>
			</tr>
			<tr>
				<td class="first"><strong>Skype ID</strong></td>
				<td class="last"><input type="text" name="skypeid" id="skypeid" class="text" value="<?php echo $skypeid;?>"></td>
				<td class="first" ><strong>Telephone Number</strong></td>
				<td class="last"><input type="text" name="telephone" id="telephone" autocomplete="off" class="text" value="<?php echo $telephone;?>"></td>
		  </tr>
		  <?php
		  //if($op == 'Edit' && isset($pagefrom) && $pagefrom == '')
		  if(isset($pagefrom) && $pagefrom != 'profile')
		  {
		  
		  ?>
		  <tr class="bg">
			<td class="first"><strong>Status</strong></td>
			<td colspan="3" class="last">
                    		<input type="radio" class="textarea" name="user_status" value="A"<?php echo ($sts == 'A' ? ' checked' : '');?>>&nbsp;Active&nbsp;&nbsp;
				<input type="radio" class="textarea" name="user_status" value="D"<?php echo ($sts == 'D' ? ' checked' : '');?>>&nbsp;Inactive&nbsp;
         </td>
		</tr>			  
		<?php
		}
		?>
		</table>
		<p class="buttons">
		   <?php
		   if(isset($pagefrom) && $pagefrom == 'profile')
			{
				echo '<input name="user_status" id="user_status" type="hidden" value="'.$sts.'">';
			}
			?>
		   <input name="utype" id="utype" type="hidden" value="<?php echo $utype;?>">
		   <input name="id" id="id" type="hidden" value="<?php echo $id;?>">
		   <input name="pagefrom" id="pagefrom" type="hidden" value="<?php echo $pagefrom;?>">
		   <?php
		   if(!isset($pagefrom) ||  $pagefrom == '')
		   {
				echo '<input name="Cancel" type="button" value="Cancel" class="login cancel" onclick="javascript: window.document.location.href=\'manage_users.php?utype=',$utype,'\';">';
			}
			if(isset($pagefrom) &&  $pagefrom == 'front')
		   {
				echo '<input name="Cancel" type="button" value="Cancel" class="login cancel" onclick="javascript: window.document.location.href=\'index.php\';">';
			}
			?>
			&nbsp; &nbsp;
		  <input name="AddNew" type="submit" value="Submit" class="login gradient" />
		</p>
	  </div>
	  <div id="right-column" class="col-sm-2">
		<div class="h">Picture</div><br>
		<div class="box"><input name="Profile Picture" type="image" disabled src="<?php echo $img;?>" alt="Profile picture" align="middle" height="110" width="110" /></div><br>
		<input type="file" name="pic_img" id="pic_img"><br>
<span class="complsory">*Picture should be less than 1MB</span>		
	  </div>		  
</form>
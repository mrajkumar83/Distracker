<div class="table">
				<img width="8" height="7" class="left" alt="" src="img/bg-th-left.gif">
				<img width="7" height="7" class="right" alt="" src="img/bg-th-right.gif">
			<table cellspacing="0" cellpadding="0" class="listing form">
					<tbody><tr>
						<th colspan="4" class="full">Student Information</th>
					</tr>
					<tr>
						<td width="149" class="first"><strong>Program</strong></td>
						<td style="background:#ECECEC;" colspan="3" class="last"><?php echo $student->program_name;?></td>
                  </tr>
					<tr>
						<td width="149" class="first"><strong>Name</strong></td>
						<td style="background:#ECECEC;" colspan="3" class="last"><?php echo $student->user_prefix,' ',$student->user_fname,' ',$student->user_lname;?></td>
                  </tr>
				  <tr>
					<td class="first"><strong>Registration #</strong></td>
						<td width="163" style="background:#ECECEC;" class="first"><?php echo $student->user_registration;?></td>
						<td width="178" class="first"><strong>Date of Enrolment</strong></td>
						<td width="121" style="background:#ECECEC;" class="last"><?php echo $student->user_doe;?></td>
				  </tr>
                    <tr>
					    <td class="first"><strong>Cohort</strong></td>
				        <td style="background:#ECECEC;" class="first"><?php echo $student->cohort_name;?></td>
                        <td class="first"><strong>Task</strong></td>
                        <td style="background:#ECECEC;" class="last"><?php echo $student->concentration_name;?></td>
					</tr>
           			<tr>
						<td class="first"><strong>Research Language</strong></td>
					  <td style="background:#ECECEC;" class="first"><?php echo $student->lang_name;?></td>
                       <td class="first">&nbsp;</td>
                       <td style="background:#ECECEC;" class="last">&nbsp;</td>
					</tr>
           			<tr>
           			  <td class="first"><strong>Research Study Title</strong></td>
           			  <td style="background:#ECECEC;" colspan="3" class="last"><?php echo $student->disseration_name;?></td>
   			    </tr>
				<tr>
           			  <td class="first"><strong>Methodology Type</strong></td>
           			  <td style="background:#ECECEC;" colspan="3" class="last"><?php echo $student->disseration_desc;?></td>
   			    </tr>
				</tbody></table>
              <p>&nbsp;</p>
			<form name="allocationfrm" id="allocationfrm" method="post" action="<?php echo $path;?>/logic/allocation-logic.php?op=<?php echo $op;?>">
            <table cellspacing="0" cellpadding="0" class="listing form">
			    <tr>
       
	<?php
		$i= $j = 0;
		if($op != 'Edit' && $roles_rec)
		{
			echo '<th class="full" colspan="4">',$title,'</th></tr>';
			while($role = mysql_fetch_object($roles_rec))
			{
				if($i%2 == 0)
				{
					echo "<tr>";
					$j++;
				}
				$name = ($role->role_num > 1) ? '' : 'stg['.$role->role_id.']' ;
				echo '<td class="first" width="140" ><strong>',$role->role_title,'</strong>',( ($role->role_num > 1) ? '<br> (Please select Min. '.$role->role_num.' staff members)' : ''),'</td>';
				echo '<td class="first">';
					echo createSelect($staff, $staff_cnt, $role->role_num, $name, array(), ($role->role_reqd ? true : false));
				echo '</td>';
				if($role->role_num > 1)
				{
					echo '<td><input type="button" value="&gt;&gt;" onclick="swap(this, true);"><br><input type="button" value="&lt;&lt;" onclick="swap(this, false);"></td>';
					echo '<td><select class="text toSelect" size="5" multiple="multiple" name="stg[',$role->role_id,'][]" id="stg[',$role->role_id,'][]"></td>';
					$i += 2;
				}				
				else
				$i++;	
				if($i%2 == 0)
				{
					echo '</tr>';
				}
			}
			if($i%2==1)
			{
				echo '<td class="first">&nbsp;</td><td class="last">&nbsp;</td></tr>';
			}
		}
		else
		{
			echo '<th class="full" colspan="5">',$title,'</th></tr>';
		?>
			<tr>
				<th class="full">Role</th>
				<th class="full">Existing Allocation</th>
				<th class="full">Change Allocation</th>
				<th class="full">New Allocation</th>
				<th class="full">Status</th>
			</tr>
		<?php
			$i = 0;
			while($role = mysql_fetch_object($roles_rec))
			{
		?>
		
			<tr>
				<td class="first" width="140" ><strong><?php echo $role->role_title;?></strong><?php echo ( ($role->role_num > 1) ? '<br> (Please select Min. '.$role->role_num.' staff members)' : '');?></td>
				<td class="first">
		<?php
			$tot_staff = isset($stg[$role->role_id]) ? implode("<br>", $stg[$role->role_id]['staff']) : '';
			echo $tot_staff;
		?>
				</td>
				<td>
				<?php
					$attrib = array('onchange'=>'displaySelected(this)');
					$bool = ($i==0) ? true : false;
					$name = ($role->role_num > 1) ? 'stg['.$role->role_id.'][]' : 'stg['.$role->role_id.']';
					
					if(isset($stg[$role->role_id]))
					{
						if(in_array('S', $stg[$role->role_id]['sts']) || in_array('A', $stg[$role->role_id]['sts']))
						echo createSelect($staff, $staff_cnt, $role->role_num, $name, $stg[$role->role_id], $bool, $attrib);
						else
						echo $tot_staff;
					}
					else
					{
						echo createSelect($staff, $staff_cnt, $role->role_num, $name, array(), $bool,$attrib);
					}
				?>
				</td>
				<td class="first selectedItem">
					<?php
						$tot_staff = isset($stg[$role->role_id]) ? implode("<br>", $stg[$role->role_id]['staff']) : '';
						echo $tot_staff;
					?>
				</td>
				<td>
				<?php
					if(isset($stg[$role->role_id]))
					{
						$sts = array_values($stg[$role->role_id]['sts']);
						$sts = array_unique($sts);
						$cnt = count($sts);
						if($cnt > 1)
						{
							if(in_array('C', $sts) || in_array('P', $sts))
							{
								echo 'In-Progress';
							}
							else if(in_array('S', $sts))
							{
								echo 'Yet to Start';
							}
							else
							{
								echo 'Not Started';
							}
						}
						else
						{
							switch($sts[0])
							{
								case 'C':
									echo 'Completed';
								break;
								
								case 'P':
									echo 'In-Progress';
								break;
								
								case 'S':
									echo 'Yet to Start';
								break;
								
								default:
									echo 'Not Started';
								break;
							}
						}
					}					
				?>
				&nbsp;
				</td>
			</tr>
			<?php
			$i++;
			}
		}
			?>
			</table>
                
	           <p class="buttons">
			   <input type="hidden" value="<?php echo $student->user_id;?>" name="std_id">
			   <input type="hidden" value="<?php echo $id;?>" name="dissertation_id">
	          <input type="button" value="Cancel" name="Cancel" onclick="javascript: window.document.location.href='manage_allocation.php?project_sts=<?php echo $psts;?>';">
	     &nbsp; &nbsp;
	          <input type="submit" value="Allocate" name="AddNew">
	        </p>
			</form>
		  </div>
		  <div id="right-column">	
		<div class="box"><img width="120" height="120" align="middle" alt="Profile picture" src="<?php echo $img;?>"></div>			
	  </div>
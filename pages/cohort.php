<form name="frm_cohort" id="frm_cohort" action="../logic/cohort-logic.php" method="post">
<table cellspacing="0" cellpadding="0" class="listing form" width="100%">
			  <tbody><tr>
			    <th colspan="4">Cohort</th>
			    </tr>
			  <tr>
                    <td class="first"><strong>Cohort Reference #</strong><span class="complsory">*</span></td>
					<td class="first"><input type="text" class="text" name="cohort_ref" id="cohort_ref" value="<?php echo $cohort_ref;?>"></td>
					<td class="first"><strong>Effective Date</strong></td>
					<td class="last"><input type="text" title="Please enter the date from which the cohort is available" class="text" name="cohort_edate" id="cohort_edate" value="<?php echo $cohort_edate;?>"></td>
		      </tr>
					<tr class="bg">
						<td class="first"><strong>Cohort Name</strong><span class="complsory">*</span></td>
						<td class="first"><input type="text" class="text" name="cohort_name" id="cohort_name" value="<?php echo $cohort_name;?>"></td>
						
						<td class="first"><strong>Available Languages</strong><span class="complsory">*</span></td>
						<td class="last">
						<?php
						while($qrec = mysql_fetch_object($langs))
						{
							echo '<input type="checkbox" name="cohort_languages[]" value="',$qrec->lang_id,'" id="cohort_languages[',$qrec->lang_id,']"',(in_array($qrec->lang_id, $cohort_languages) ? ' checked="checked"': ''),'>&nbsp;
							      <label for="cohort_languages[',$qrec->lang_id,']">',$qrec->lang_name,'</label>';
							$i++;
						}
						?>
                        </td>
				    </tr>
					<tr>
						<td class="first"><strong>Cohort Description</strong></td>
						<td colspan="3" class="last">
                            <textarea class="textarea" name="cohort_description" id="cohort_description" cols="75" rows="2"><?php echo $cohort_description;?></textarea>
                      </td>
					</tr>
					<tr>
						<td class="first"><strong>Cohort Status</strong></td>
						<td colspan="3" class="last">
                            <input type="radio" class="textarea" name="cohort_status" value="A"<?php echo ($cohort_status== 'A' ? ' checked' : '');?>>&nbsp;Active&nbsp;&nbsp;
							<input type="radio" class="textarea" name="cohort_status" value="D"<?php echo ($cohort_status== 'D' ? ' checked' : '');?>>&nbsp;In-Active&nbsp;
                      </td>
					</tr>
	         		
			</tbody></table>
			<p class="buttons">
			<input type="hidden" value="<?php echo $op;?>" name="op">
			<input type="hidden" value="<?php echo $id;?>" name="id" id="id">
	         <input type="reset" value="Cancel" name="Cancel">
               &nbsp; &nbsp;
             <input type="submit" value="Submit" name="Add">
	        </p>
		</form>
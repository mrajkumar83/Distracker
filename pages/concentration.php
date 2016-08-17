<div class="cotable">
<form name="frm_concentration" id="frm_concentration" action="../logic/concentration-logic.php" method="post">				
<table cellspacing="0" cellpadding="0" class="listing form" width="100%">
			  <tbody><tr>
			    <th colspan="4">Track</th>
			    </tr>
			  <tr>
					
                    <td class="first"><strong>Track Reference #</strong></td>
					<td class="first"><input type="text" class="text" name="concentration_ref" id="concentration_ref" value="<?php echo $concentration_ref;?>"></td>
					<td class="first"><strong>Effective Date</strong></td>
					<td class="last"><input type="text" title="Please enter the date from which the cohort is available" class="text" name="concentration_edate" id="concentration_edate" value="<?php echo $concentration_edate;?>"></td>
		      </tr>
					<tr class="bg">
						<td class="first"><strong>Track Name</strong><span class="complsory">*</span></td>
						<td class="first"><input type="text" class="text" name="concentration_name" id="concentration_name" value="<?php echo $concentration_name;?>"></td>
						
						<td class="first"><strong>Available Languages</strong><span class="complsory">*</span></td>
						<td class="last">
						<?php
						while($qrec = mysql_fetch_object($langs))
						{
							echo '<input type="checkbox" name="concentration_languages[]" value="',$qrec->lang_id,'" id="concentration_languages[',$qrec->lang_id,']"',(in_array($qrec->lang_id, $concentration_languages) ? ' checked="checked"': ''),'>&nbsp;
							      <label for="concentration_languages[',$qrec->lang_id,']">',$qrec->lang_name,'</label>';
							$i++;
						}
						?>
                        </td>
				    </tr>
					<tr>
						<td class="first"><strong>Track Description</strong></td>
						<td colspan="3" class="last">
                            <textarea class="textarea" name="concentration_description" id="concentration_description" cols="75" rows="2"><?php echo $concentration_description;?></textarea>
                      </td>
					</tr>
					<tr>
						<td class="first"><strong>Track Status</strong></td>
						<td colspan="3" class="last">
                            <input type="radio" class="textarea" name="concentration_status" value="A"<?php echo ($concentration_status == 'A' ? ' checked' : '');?>>&nbsp;Active&nbsp;&nbsp;
							<input type="radio" class="textarea" name="concentration_status" value="D"<?php echo ($concentration_status == 'D' ? ' checked' : '');?>>&nbsp;Inactive&nbsp;&nbsp;
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
</div>
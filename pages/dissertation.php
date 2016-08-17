<div class="table">
<img src="../img/bg-th-left.gif" width="8" height="7" alt="" class="left" />
<img src="../img/bg-th-right.gif" width="7" height="7" alt="" class="right" />
<form name="frm_dissertation" id="frm_dissertation" action="../logic/dissertation-logic.php" method="post" enctype="multipart/form-data">
    <table cellspacing="0" cellpadding="0" class="listing form" width="100%">
        <tbody>
        <tr>
               <th colspan="4">Research Study</th>
        </tr>
	<tr>
				<td class="first"> <strong>Program</strong><span class="complsory">*</span>
				</td>
				<td class="last" colspan=3> &nbsp;
					<?php
					if($UTYPE == 'SD')
					{
						echo $disseration_program;
						echo '<input type="hidden" value="',$disseration_program,'" name="disseration_program" id="disseration_program" >';
					}else{
						?>
						<select required="required" name="disseration_program" id="disseration_program" previous="<?php echo $disseration_program;?>">
						<option value="">-- Select --</option>
						<?php
						while($program_rec = mysql_fetch_object($program))
							{
								echo '<option value="',$program_rec->program_id,'"',((isset($disseration_program) && $program_rec->program_id == $disseration_program)? ' selected="selected"' : ''),' data-mandatory="',$program_rec->program_mandatory,'">',$program_rec->program_name,'</option>';
							}
						?>
						</select>
					<?php
					}
					?>
				</td>
	</tr>
	
	<tr class="bg">
                <td class="first"><strong>Student Name</strong><span class="complsory">*</span></td>
                <td class="first">
				<?php
					if($UTYPE == 'SD' || $diss_sts != 'N' )
					{
						echo $std_name,
							'<input type="hidden" value="',$std_id,'" name="std_id" id="std_id">';
					}else{
					?>
					<select required="required" name="std_id" id="std_id">
						<option value="">-- Select --</option>
						<?php
							while($std_rec = mysql_fetch_object($users))
							{
								echo '<option value="',$std_rec->user_id,'"',((isset($std_id) && $std_rec->user_id == $std_id)? ' selected="selected"' : ''),'>',$std_rec->user_fullname,'</option>';
							}
						?>
						</select>
				<?php
					}
				?></td>
                <td class="first"><strong>Research Language</strong><span class="complsory">*</span></td>
                <td class="last">
					<?php
					if($UTYPE == 'SD')
					{
						echo $disseration_language_name;
						echo '<input type="hidden" value="',$disseration_language,'" name="disseration_language" id="disseration_language">';
					}else{
					?>
						<select required="required" name="disseration_language" id="disseration_language">
						<option value="">-- Select --</option>
						<?php
							while($lang_rec = mysql_fetch_object($langs))
							{
								echo '<option value="',$lang_rec->lang_id,'"',((isset($disseration_language) && $lang_rec->lang_id == $disseration_language)? ' selected="selected"' : ''),'>',$lang_rec->lang_name,'</option>';
							}
						?>
						</select>
					<?php
					}
					?>
                </td>
            </tr>
			
			
            <tr>
                <td class="first"><strong>Cohort</strong><span class="complsory">*</span></td>
                <td class="first">
					<?php
					if($UTYPE == 'SD')
					{
						echo $disseration_cohort_name;
						echo '<input type="hidden" value="',$disseration_cohort,'" name="disseration_cohort" id="disseration_cohort">';
					}else{
					?>
						<select required="required" name="disseration_cohort" id="disseration_cohort">
						<option value="">-- Select --</option>
						<?php
							while($chrt_rec = mysql_fetch_object($chrt))
							{
								echo '<option value="',$chrt_rec->cohort_id,'"',((isset($disseration_cohort) && $chrt_rec->cohort_id == $disseration_cohort) ? ' selected="selected"' : ''),'>',$chrt_rec->cohort_name,'</option>';
							}
						?>
						</select>
					<?php
					}
					?>
                </td>
				
                <td class="first"><strong>Track</strong></td>
                <td class="last">
					<?php
					if($UTYPE == 'SD')
					{
						echo $disseration_concentration_name;
						echo '<input type="hidden" value="',$disseration_concentration,'" name="disseration_concentration" id="disseration_concentration">';
					}else{
					?>
						<select required="" name="disseration_concentration" id="disseration_concentration"<?php echo (($program_mandatory == 'Y') ? ' disabled="disabled" ' : '');?>>
						<option value="">-- Select --</option>
						<?php
							while($concen_rec = mysql_fetch_object($concen))
							{
								echo '<option value="',$concen_rec->concentration_id,'"',((isset($disseration_concentration) && $concen_rec->concentration_id == $disseration_concentration)? ' selected="selected"' : ''),'>',$concen_rec->concentration_name,'</option>';
							}
						?>
						</select>
					<?php
					}
					?>
                </td>
            </tr>
            
		<tr class="bg">
                <td class="first"><strong>Research Title</strong><span class="complsory">*</span></td>
                <td colspan="3" class="last">
                    <input type="text" required="required" class="text" name="disseration_name" id="disseration_name" value="<?php echo $disseration_name; ?>" size="98">
                </td>
            </tr>
            <tr>
                <td class="first"><strong>Methodology Type</strong></td>
                <td colspan="3" class="last">
                    <textarea class="textarea" name="disseration_desc" id="disseration_desc" cols="75" rows="2"><?php echo $disseration_desc; ?></textarea>
                </td>
            </tr>
			<!--
            <tr class="bg">
                <td class="first"><strong>Upload Document</strong><span class="complsory">*</span></td>
                <td class="first" colspan="3"><input type="file" class="text" name="disseration_files" id="disseration_files">
<?php
if ($op == 'Edit') {
    echo '<span><a href="../common/download.php?filepath=', $document_path, '&amp;filename=', urlencode($document_name), '">', $document_name, '</a></span>';
    echo '<input type="hidden" value="', $document_path, '" name="oldfile">';
    echo '<input type="hidden" value="', $document_id, '" name="docid">';
}
?>
                </td>
            </tr>
			-->
                    <?php
                    if (isset($op) && $op == 'Edit' && $UTYPE != 'SD') {
                        ?>
                <tr>
                    <td class="first"><strong>Research Status</strong></td>
                    <td colspan="3" class="last">
                        <input type="radio" class="textarea" name="disseration_status" value="A"<?php echo ($disseration_status == 'A' ? ' checked' : ''); ?>>&nbsp;Active&nbsp;&nbsp;
                        <input type="radio" class="textarea" name="disseration_status" value="D"<?php echo ($disseration_status == 'D' ? ' checked' : ''); ?>>&nbsp;Inactive&nbsp;
                    </td>
                </tr>
    <?php
}
?>	         		
        </tbody></table>
    <p class="buttons">
        <input type="hidden" value="<?php echo $op; ?>" name="op">
        <input type="hidden" value="<?php echo $id; ?>" name="id">
        <input type="button" value="Cancel" name="Cancel" onclick="javascript:window.document.location.href='manage_dissertation.php';">
		<!-- history.go(-1); sarktechnologies.net -->
        &nbsp; &nbsp;
        <input type="submit" value="Submit" name="Add">
    </p>
</form>
</div>
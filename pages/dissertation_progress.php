<?php
if($nextstep){
	if(($UTYPE == 'SD' && ($userdata->next_id == $userdata->std_id) ) || ($UTYPE != 'SD' && !isset($op))) {
    ?>

        <!--  <div class="select-bar">-->
        <form name="reviewfrm" id="reviewfrm" action="../logic/dissertation_process-logic.php" method="post" enctype="multipart/form-data">
            <div>
		&nbsp;&nbsp;Please upload any of your reviews&nbsp;&nbsp;<input id="mode_field" value="Add Files" type="button">
		<table id="filestable"></table> 
		<span class="error">
			<strong>&nbsp;Note:</strong>
			&nbsp;&nbsp;Only following extensions are allowed Doc(x)|Pdf|Txt|Xls(x)
		</span>
            </div>
            <table cellspacing="0" cellpadding="0" class="listing form">
                <tbody>
                <tr>
                        <th colspan="<?php echo $chktable;?>" class="full"><?php echo ($UTYPE != 'SD') ? 'Notes to the student' : 'Comments'; ?></th>
                    </tr>
                    <tr>
                        <td style="background:#ECECEC;" class="last" colspan="<?php echo $chktable;?>">
				<textarea class="textarea" id="msg" name="msg" rows="7" cols="90"></textarea>
				<script>
					var editor = new TINY.editor.edit('editor', {
									id: 'msg',
									width: 720,
									height: 175,
									cssclass: 'tinyeditor',
									controlclass: 'tinyeditor-control',
									rowclass: 'tinyeditor-header',
									dividerclass: 'tinyeditor-divider',
									controls: ['bold', 'italic', 'underline', 'strikethrough', '|', 'subscript', 'superscript', '|',
										'orderedlist', 'unorderedlist', '|', 'outdent', 'indent', '|', 'leftalign',
										'centeralign', 'rightalign', 'blockjustify', '|', 'unformat', '|', 'undo', 'redo', 'n',
										'font', 'size', 'style', '|', 'image', 'hr', 'link', 'unlink', '|', 'print'],
									footer: false,
									fonts: ['Verdana','Arial','Georgia','Trebuchet MS'],
									xhtml: true,
									cssfile: 'css/custom.css',
									bodyid: 'editor',
									footerclass: 'tinyeditor-footer',
									toggle: {text: 'source', activetext: 'wysiwyg', cssclass: 'toggle'},
									resize: {cssclass: 'resize'}
								});
						</script>
					</td>
                    		</tr>
				<?php
				if ($UTYPE != 'SD') {
				?>
				<tr>
					<td class="first">
						<input type="radio" id="ApprovalStatus_0" value="A" name="sts" checked="checked">
						Approve
					</td>
					<td>
						<input type="radio" id="ApprovalStatus_1" value="C" name="sts">
						Approve with comments
					</td>
					<td class="last">
						<input type="radio" id="ApprovalStatus_2" value="M" name="sts">
						Major Requirements</td>
					<?php
					if($chkrole > 0)
					{//$chktable
					?>
					<td class="last">
						<input type="radio" id="ApprovalStatus_3" value="<?php echo $chkrole;?>" name="sts">
						<label for="ApprovalStatus_3">CFS</label>
					</td>
					<?php
					}
					?>
				</tr>
				<?php
				}
				?>
                </tbody></table>
            <p class="buttons">
                <input type="hidden" value="<?php echo $userdata->std_id; ?>" name="std_id">
                <input type="hidden" value="<?php echo $did; ?>" name="did">
                <input type="hidden" value="<?php echo isset($stgdata->stg_id) ? $stgdata->stg_id : 0 ; ?>" name="sid">
                <input type="hidden" value="<?php echo isset($stgdata->stg_id) ? $stgdata->stg_id : 0; ?>" name="cid">
                <input type="hidden" value="<?php echo isset($stgdata->role_id) ? $stgdata->role_id : 0;?>" name="rid">
                <input type="hidden" value="<?php echo isset($rid) ? $rid : 0; ?>" name="role">
                <input type="hidden" value="<?php echo isset($sid) ? $sid : 0; ?>" name="stg_id">
                <input type="hidden" value="<?php echo $next_order; ?>" name="rel_ord">
                <input type="hidden" value="<?php echo ($UTYPE != 'SD') ? $UID : '0'; ?>" name="staff">
				<input type="hidden" value="<?php echo $staff_next_step; ?>" name="staff_next_step">
				<input type="hidden" value="<?php echo $staff_fail_step; ?>" name="staff_fail_step">
				
				<input type="hidden" value="<?php echo $dissertation->email; ?>" name="student_email">
				<input type="hidden" value="<?php echo $dissertation->dist_name; ?>" name="dissertation_title">
				<input type="hidden" value="<?php echo $std_name; ?>" name="StudentName">
                <input type="hidden" value="<?php echo $role_title; ?>" name="StaffRole">
                <input type="hidden" value="<?php echo $dissertation->con_name; ?>" name="Concentration">
				<input type="hidden" value="<?php echo $dissertation->chrt_name; ?>" name="Cohort">
				<input type="hidden" value="<?php echo $flow_chk; ?>" name="flow_chk">				
				
                <input type="reset" value="Cancel" name="Cancel">
                &nbsp; &nbsp;
                <input type="submit" value="Submit" name="AddNew" id="addbtn">
            </p>
        </form>
    <?php
	}
}
else
{
}
?>
    <div class="select-bar">
        <div class="emptyContainer">
    <?php
    $stg = '';
	$cfs = '';
    while ($history_rec = mysql_fetch_object($history)) {
        if ($stg != $history_rec->stg_id) {
            echo '</div><div class="parentContainers"><div class="Chapters">:: ', $history_rec->stg_title, ' ::</div>';
            $stg = $history_rec->stg_id;
        }
        $img = $path . '/img/profile_noimg.jpg';
        if (isset($history_rec->user_photo) && $history_rec->user_photo != '' && file_exists($path . '/images/photos/' . $history_rec->user_photo))
            $img = $path . '/images/photos/' . $history_rec->user_photo;
        ?>
                <div class="childContainers hideContainer">
                    <div class="title">
                        <div class="floatleft">
							<?php echo (($history_rec->staff_id == 0) ? '<strong>Student:</strong>&nbsp;'.$std_name : '<strong>'.$history_rec->role_title.$cfs.':</strong>&nbsp;'.$history_rec->name); ?><br>
                            <i><?php echo $history_rec->doc; ?></i>
                        </div>
                        <div class="floatright"><img width="27" height="27" src="<?php echo ($history_rec->staff_id == 0) ? $std_photo : $img; ?>"></div>
                    </div>
                    <div class="DataContainer">
                        <p><?php echo htmlspecialchars_decode($history_rec->comments, ENT_QUOTES); ?></p>
						<?php
						$i = -1;
						$document = $db->fetchAllRecord(' tb_dissertation_documents ' , ' document_name, document_path ', '  
document_hid="'.$history_rec->history_id.'" ', NULL , ' document_name ',  ' ASC ', NULL,'All');
						if($db->getRowCount() > 0){ echo '<p><strong>Attachment</strong>:';$i++;}
						while ($document_rec = mysql_fetch_object($document)) {
							if (isset($document_rec->document_name) && $document_rec->document_name != '') {
								echo '&nbsp;<span><a href="../common/download.php?filepath=', $document_rec->document_path, '&amp;filename=', urlencode($document_rec->document_name), '">', $document_rec->document_name, '</a></span>&nbsp;';
								if($i%5 == 4){ echo '<br>';}
								$i++;
							}//End of if()
						}//End of while{}
						if($i > -1){ echo '</p>';}
                        ?>						
                        <p><strong>Status:</strong><?php statusDecode($history_rec->status); ?></p>
                    </div>
                </div>
                    <?php
					//$cfs = ($history_rec->chk_staff > 0 ? '[CFS]': '');
                    }
                    ?>
    <!-- <img width="24" height="24" alt="Word" src="img/word_icon.jpg"> sarktechnologies.net -->
        </div>
    </div>
</div>
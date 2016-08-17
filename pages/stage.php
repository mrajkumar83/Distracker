
<form name="frm_stage" id="frm_stage" action="../logic/stage_logic.php" method="post">
<table cellspacing="0" cellpadding="0" class="listing form" width="100%">
			  <tbody><tr>
			    <th colspan="4">Stage</th>
			    </tr>
			  <tr class="bg">
                    <td class="first"><strong>Stage Title</strong><span class="complsory">*</span></td>
					<td class="first"><input type="text" class="text" name="stg_title" id="stg_title" value="<?php echo $stg_title;?>" tabindex="1"></td>
		      </tr>
		      <tr>
					<td class="first"><strong>Stage  Description</strong></td>
					<td colspan="3" class="last">
                           <textarea class="textarea" name="stg_description" id="stg_description" cols="75" rows="2" tabindex="2"><?php echo $stg_description;?></textarea>
                    </td>
			  </tr>
			  <tr class="bg">
					<td class="first"><strong>Display Order</strong></td>
					<td class="first">
						<select name="stg_order" id="stg_order" tabindex="3">
							<?php
								for($i=1;$i<=$stg_order; $i++)
								{
									echo '<option value="',$i,'"'.(($stg_order_sel == $i) ? ' selected="selected"': '').'>',$i,'</option>';
								}
							?>
						</select>
							<input type="hidden" value="<?php echo $stg_order_sel;?>" name="act_ord">
						</td>	
			  </tr>	
			  
			  <tr>
						<td class="first"><strong>Stage Status</strong></td>
						<td colspan="3" class="last">
                            <input type="radio" class="textarea" name="stg_sts" value="A"<?php echo ($stg_sts== 'A' ? ' checked' : '');?> tabindex="4">&nbsp;Active&nbsp;&nbsp;
							<input type="radio" class="textarea" name="stg_sts" value="D"<?php echo ($stg_sts== 'D' ? ' checked' : '');?> tabindex="5">&nbsp;In-Active&nbsp;
                      </td>
					</tr>
	         		
			</tbody></table>
			<p class="buttons">
			<input type="hidden" value="<?php echo $op;?>" name="op" id="op" />
			<input type="hidden" value="<?php echo $id;?>" name="id" id="id" />
	         <input type="reset" value="Cancel" name="Cancel" onclick="javascript: window.document.location.href='manage_stages.php'" tabindex="6">
               &nbsp; &nbsp;
             <input type="submit" value="Submit" name="Add" tabindex="7">
	        </p>
		</form>
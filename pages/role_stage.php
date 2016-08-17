
<form name="frm_rolestage" id="frm_rolestage" action="../logic/role_stage_logic.php" method="post">
<table cellspacing="0" cellpadding="0" class="listing form" width="600px">
			  <tbody><tr>
			    <th colspan="4">Roles Stage Relation</th>
			   </tr>
			  <tr>
                    <td class="first"><strong>Stage</strong><span class="complsory">*</span></td>
					<td class="first">
						<select name="stg_id" id="stg_id" required="required" tabindex="1">
						<option value="">-- Select --</option>
						<?php
							while($stage_rec = mysql_fetch_object($stage))
							{
								echo '<option value="',$stage_rec->stg_id,'"',(($stage_rec->stg_id == $stg_id)? ' selected="selected"' : ''),'>',$stage_rec->stg_title,'</option>';
							}
						?>
					</select>
				</td>
		      </tr>
		      <tr>
					<td class="first"><strong>Role </strong><span class="complsory">*</span></td>
					<td class="first">
						<select name="role_id" id="role_id" required="required" tabindex="2">
						<option value="">-- Select --</option>
						<?php
							while($roles_rec = mysql_fetch_object($roles))
							{
								echo '<option value="',$roles_rec->role_id,'"',(($roles_rec->role_id == $role_id)? ' selected="selected"' : ''),'>',$roles_rec->role_title,'</option>';
							}
						?>
					</select>
				</td>
			  </tr>
			  <tr class="bg">
					<td class="first"><strong>Display Order</strong></td>
					<td class="first">
						<select name="rel_ord" id="rel_ord" tabindex="3">
			<?php
				for($i=1;$i<=$rel_ord; $i++)
				{
					echo '<option value="',$i,'"'.(($rolestg_order_sel == $i) ? ' selected="selected"': '').'>',$i,'</option>';
				}
			?>
		</select>
						<input type="hidden" value="<?php echo $rolestg_order_sel;?>" name="act_ord">
						</td>	
			  </tr>	
			  <tr>
					<td class="first"><strong>Mail To </strong></td>
					<td class="first">
						<select name="mail_to" id="mail_to" tabindex="4">
						<option value="">-- Select --</option>
						<?php
							while($roles_rec = mysql_fetch_object($roles1))
							{
								echo '<option value="',$roles_rec->role_id,'"',(($roles_rec->role_id == $role_id)? ' selected="selected"' : ''),'>',$roles_rec->role_title,'</option>';
							}
						?>
					</select>
				</td>
			  </tr>
			</tbody></table>
			<p class="buttons">
			<input type="hidden" value="<?php echo $op;?>" name="op">
			<input type="hidden" value="<?php echo $id;?>" name="id">
	         <input type="reset" value="Cancel" name="Cancel" onclick="javascript: window.document.location.href='manage_stage_role.php'" tabindex="6">
               &nbsp; &nbsp;
             <input type="submit" value="Submit" name="Add" tabindex="5">
	        </p>
		</form>
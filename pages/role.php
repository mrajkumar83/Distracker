<form name="frm_role" id="frm_role" action="../logic/role_logic.php" method="post">
<table cellspacing="0" cellpadding="0" class="listing form" width="100%">
			  <tbody><tr>
			    <th colspan="4">Roles</th>
			    </tr>
			 <tr class="bg">
                    <td class="first"><strong>Title</strong><span class="complsory">*</span></td>
					<td class="first"><input type="text" class="text" name="role_title" id="role_title" value="<?php echo $role_title;?>"></td>
					<td class="first"><strong>Short Name</strong></td>
					<td class="first"><input type="text" class="text" name="role_sc" id="role_sc" value="<?php echo $role_sc;?>"></td>
		      </tr>
		      <tr>
					<td class="first"><strong>Description</strong></td>
					<td colspan="3" class="last">
                           <textarea class="textarea" name="role_desc" id="role_desc" cols="75" rows="2"><?php echo $role_desc;?></textarea>
                    </td>
			  </tr>
			  <tr class="bg">
					<td class="first"><strong>Number of Members</strong></td>
					<td class="first">
						<select name="role_num" id="role_num">
                  
                         <option value="1" <?php echo ($role_reqd== '1' ? 'selected="selected"' : '');?>>1</option>
                         <option value="2"<?php echo ($role_reqd== '2' ? 'selected="selected"' : '');?>>2</option>
                         <option value="3"<?php echo ($role_reqd== '3' ? 'selected="selected"' : '');?>>3</option>
                         <option value="4"<?php echo ($role_reqd== '4' ? 'selected="selected"' : '');?>>4</option>
                         <option value="5"<?php echo ($role_reqd== '5' ? 'selected="selected"' : '');?>>5</option>
						</select>
						</td>	
					<td class="first"><strong>Display Order</strong></td>
					<td class="first">
						<select name="role_disp_ord" id="role_disp_ord">
			<?php
				for($i=1;$i<=$role_disp_ord; $i++)
				{
					echo '<option value="',$i,'"'.(($role_order_sel == $i) ? ' selected="selected"': '').'>',$i,'</option>';
				}
			?>
		</select>
		<input type="hidden" value="<?php echo $role_order_sel;?>" name="act_ord">
						</td>	
			  </tr>	
			  
			  <tr>
					<td class="first"><strong>Role required</strong></td>
					<td class="first">
						<select name="role_reqd" id="role_reqd">
                  
                         <option value="1" <?php echo ($role_reqd== '1' ? 'selected="selected"' : '');?>>Yes</option>
                         <option value="0"<?php echo ($role_reqd== '0' ? 'selected="selected"' : '');?>>No</option>
						</select>
						
						</td>	
						
					<td class="first"><strong>Constraints</strong></td>
					<td class="first">
						<select name="role_constraints" id="role_constraints">
						
							<option value="1" <?php echo ($role_constraints== '1' ? 'selected="selected"' : '');?>>Yes</option>
                         <option value="0"<?php echo ($role_constraints== '0' ? 'selected="selected"' : '');?>>No</option>
						</select>
						</td>	
			  </tr>	
			  
			  <tr class="bg">
						<td class="first"><strong>Role Status</strong></td>
						<td colspan="3" class="last">
                            <input type="radio" class="textarea" name="role_status" value="A"<?php echo ($role_status== 'A' ? ' checked' : '');?>>&nbsp;Active&nbsp;&nbsp;
							<input type="radio" class="textarea" name="role_status" value="D"<?php echo ($role_status== 'D' ? ' checked' : '');?>>&nbsp;In-Active&nbsp;
                      </td>
					</tr>
	         		
			</tbody></table>
			<p class="buttons">
			<input type="hidden" value="<?php echo $op;?>" name="op" id="op" />
			<input type="hidden" value="<?php echo $id;?>" name="id" id="id" />
	         <input type="reset" value="Cancel" name="Cancel" onclick="javascript: window.document.location.href='manage_roles.php'">
               &nbsp; &nbsp;
             <input type="submit" value="Submit" name="Add">
	        </p>
		</form>
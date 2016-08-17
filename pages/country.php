
<form name="frm_country" id="frm_country" action="../logic/country_logic.php" method="post">
<table cellspacing="0" cellpadding="0" class="listing form" width="100%">
			  <tbody><tr>
			    <th colspan="4">Roles</th>
			    </tr>
			    <tr class="bg">
					<td class="first"><strong>Country Name</strong><span class="complsory">*</span></td>
					<td class="first"><input type="text" class="text" name="country_name" id="country_name" value="<?php echo $country_name;?>"></td>	
					
			  </tr>
			  <tr >
					<td class="first"><strong>Display Order</strong></td>
					<td class="first">
						<select name="country_disp_ord" id="country_disp_ord">
			<?php
				for($i=1;$i<=$country_disp_ord; $i++)
				{
					echo '<option value="',$i,'"'.(($country_order_sel == $i) ? ' selected="selected"': '').'>',$i,'</option>';
				}
			?>
		</select>
		<input type="hidden" value="<?php echo $country_order_sel;?>" name="act_ord">
					</td>

			  </tr>	
			  <tr  class="bg">
                    <td class="first"><strong>Iso Code 2</strong></td>
					<td class="first"><input type="text" class="text" name="iso_code_2" id="iso_code_2" value="<?php echo $iso_code_2;?>"></td>
				<tr/>
				<tr>	
					<td class="first"><strong>Iso Code 3</strong></td>
					<td class="first"><input type="text" class="text" name="iso_code_3" id="iso_code_3" value="<?php echo $iso_code_3;?>"></td>
		      </tr>
		      <tr  class="bg">
					<td class="first"><strong>Address Format</strong></td>
					<td colspan="3" class="last">
                           <textarea class="textarea" name="address_format" id="address_format" cols="75" rows="2"><?php echo $address_format;?></textarea>
                    </td>
			  </tr>
			  	
			  
			  <!-- <tr>
						<td class="first"><strong>Role Status</strong></td>
						<td colspan="3" class="last">
                            <input type="radio" class="textarea" name="role_status" value="A"<?php echo ($role_status== 'A' ? ' checked' : '');?>>&nbsp;Active&nbsp;&nbsp;
							<input type="radio" class="textarea" name="role_status" value="D"<?php echo ($role_status== 'D' ? ' checked' : '');?>>&nbsp;De-Active&nbsp;
                      </td>
					</tr> -->
	         		
			</tbody></table>
			<p class="buttons">
			<input type="hidden" value="<?php echo $op;?>" name="op" id="op" />
			<input type="hidden" value="<?php echo $id;?>" name="id" id="id" />
	         <input type="reset" value="Cancel" name="Cancel" onclick="javascript: window.document.location.href='manage_countries.php'">
               &nbsp; &nbsp;
             <input type="submit" value="Submit" name="Add">
	        </p>
		</form>
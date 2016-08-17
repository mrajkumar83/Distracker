<div class="table">
<img src="../img/bg-th-left.gif" width="8" height="7" alt="" class="left" />
<img src="../img/bg-th-right.gif" width="7" height="7" alt="" class="right" />
<form name="frm_program" id="frm_program" action="../logic/program-logic.php" method="post">

<table cellspacing="0" cellpadding="0" class="listing form" >
			  <tbody><tr>
			    <th colspan="2">Program</th>
			    </tr>
			  <tr>
                <td class="first"><strong>Program Name</strong><span class="complsory">*</span></td>
				<td class="last"><input type="text" class="text" required="required" name="program_name" id="program_name" value="<?php echo $program_name;?>"></td>
		      </tr>
			  <tr class="bg">
				<td class="first"><strong>Track Manadatory</strong></td>
				<td class="last"><input type="checkbox" class="text" maxlength="4" name="program_mandatory" id="program_mandatory" value="Y" <?php echo ($program_mandatory == 'Y') ? 'checked="checked" ': ''?>></td>
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
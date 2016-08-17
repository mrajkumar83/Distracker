<div class="table">
<img src="../img/bg-th-left.gif" width="8" height="7" alt="" class="left" />
<img src="../img/bg-th-right.gif" width="7" height="7" alt="" class="right" />
<form name="frm_lang" id="frm_lang" action="../logic/language-logic.php" method="post">

<table cellspacing="0" cellpadding="0" class="listing form" >
			  <tbody><tr>
			    <th colspan="2">Language</th>
			    </tr>
			  <tr>
                <td class="first"><strong>Language Name</strong><span class="complsory">*</span></td>
				<td class="last"><input type="text" class="text" required="required" name="lang_name" id="lang_name" value="<?php echo $lang_name;?>"></td>
		      </tr>
			  <tr class="bg">
				<td class="first"><strong>Code</strong><span class="complsory">*</span></td>
				<td class="last"><input type="text" class="text" maxlength="4" required="required" name="lang_code" id="lang_code" value="<?php echo $lang_code;?>"></td>
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
<form name="frm_timezone" id="frm_timezone" action="../logic/time-zone_logic.php" method="post">
	<table cellspacing="0" cellpadding="0" class="listing form" width="100%">
		<tbody>
			<tr>
			    <th colspan="2">Time zone</th>
			</tr>
			<tr class="bg">
				<td class="first"><strong>Name</strong><span class="complsory">*</span></td>
				<td class="first"><input type="text" class="text" name="tz_name" id="tz_name" value="<?php echo $time_name;?>" size="50"></td>
			</tr>
		    <tr>
				<td class="first"><strong>GMT Difference</strong><span class="complsory">*</span></td>
				<td class="first"><input type="text" class="text" name="tz_timezone" id="tz_timezone" value="<?php echo $timezone;?>" size="50"></td>
			</tr>
			<tr class="bg">
				<td class="first"><strong>Default</strong></td>
				<td class="last">
				<select name="tz_default" id="tz_default">                  
				 <option value="0"<?php echo ($default == '0' ? ' selected="selected"' : '');?>>No</option>
				 <option value="1"<?php echo ($default == '1' ? ' selected="selected"' : '');?>>Yes</option>
				</select>
				</td>
		    </tr>
		</tbody>
	</table>
	<p class="buttons">
		<input type="hidden" value="<?php echo $op;?>" name="op" id="op" />
		<input type="hidden" value="<?php echo $id;?>" name="id" id="id" />
		 <input type="reset" value="Cancel" name="Cancel" onclick="javascript: window.document.location.href='manage_time_zone.php'">
		   &nbsp; &nbsp;
		 <input type="submit" value="Submit" name="Add">
	</p>
</form>

 			<table  class="listing" cellpadding="0" cellspacing="0" >
					<tr>
					  <th style="width: auto">&nbsp;</th>
					  <?php
					  for($i = 0; $i < $stage_cnt; $i++)
					  {
						echo '<th><div class="chapter chp',$i+1,'" alt="',$stage[$i]['title'],'" title="',$stage[$i]['title'],'"></div></th>';
					  }
					  ?>
				  </tr>
					<tr  class="bg">
					
						<td class="roleCell"><div class="roleDiv">Student</div>
                        	<span class="allocation"><?php echo $dissertation->std_name;?></span>
                        </td>
						<?php
						for($i = 0; $i < $stage_cnt; $i++)
						{
							$sReport = studentReport($stage[$i]['id']);
							
						?>
							<td>
								<div class="reports_img <?php echo $sReport['i'];?>"></div>
								<div class="roleDiv"><?php echo $sReport['msg'];?></div>
							</td>
						<?php
						}
					  ?>
					</tr>
					<?php
					for($i=0; $i < $role_cnt;$i++)
					{
						$r = $role[$i];
					?>
					<tr class="bg">
						<td class="roleCell">
							<div class="roleDiv"><?php echo $r['title'];?></div>
							<?php echo $r['staff'];?>
                        </td>
					<?php
						for($j=0; $j < $stage_cnt; $j++)
						{
							$stg = $stage[$j]['id'];
							if(isset($rel[$stg][$r['id']]))
							{
								/*
								if($i == $role_cnt-1)
								{
									echo '<td align="center">',@$rel[$stg][$r['id']],'--',$stg,'--',$r['id'],'</td>';
								}
								else
								{*/
								$sReport = staffReport($stg, $r['id'], $r['staff_id'], $r['num']);
							?>
							<td>
								<div class="reports_img <?php echo $sReport['i'];?>"></div>
								<div class="roleDiv"><?php echo $sReport['msg'];?></div>
							</td>
							<?php
								//}
							}
							else
							{
								echo '<td align="center">N/A</td>';
							}
						}
					echo '</tr>';
					}
					?>
				</table>
           </div>          
		</div>
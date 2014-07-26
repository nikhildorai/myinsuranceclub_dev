<div class="content clearfix">
	<div class="col100">
	
		<h2>Claim ratio</h2>
		<div class="download-row">
			<a href="<?php echo $base_url;?>admin/company" class="link_button">Back</a>
		</div>
		<br>
		<br>							
		<?php echo form_open_multipart(); ?>
		
		
		<fieldset>
			
				<?php if (! empty($message)) { ?>
					<div id="message">
						<?php echo $message; ?>
					</div>
				<?php } ?>	
			<div style="display: inline-block;width: 100%">
				<table class="dynatable tablesorter" style="border: 1px solid #aaa;">
                	<thead>
                		<tr>
		                    <th>#</th>
		                    <th>Financial Year</th>
		                    <th>Claim Ratio</th>
						</tr>
                	</thead> 
                	<tbody>
						<?php 
						$curYear = (int)date('Y')-1;
						$i = 1;
						for ($year = 2000; $year <= $curYear; $year++)
						{	
							$prev = $year;
							$cur = $year+1;
							?>
							<tr>
								<td>
									<?php echo $i;?>
									<input type="hidden" name="<?php echo $cur;?>[claim_ratio_id]" value="<?php echo isset($ratioModel[$cur]) ? $ratioModel[$cur]['claim_ratio_id'] : '';?>">
								</td>
								<td>
									<?php echo $prev.' - '.$cur;?>
									<input type="hidden" name="<?php echo $cur;?>[financial_year]" value="<?php echo $prev.'-'.$cur; ?>">
								</td>
								<td>
									<input type="text" name="<?php echo $cur;?>[claim_ratio]" value="<?php echo isset($ratioModel[$cur]) ? $ratioModel[$cur]['claim_ratio'] : '';?>" style="width: 60px;" />%
								</td>
							</tr>
		<?php 				$i++;
						}	?>
					</tbody>
				</table>
					
			</div>
				
		</fieldset>
		
		<fieldset>
			<legend></legend>
			<ul>
				<li>
					<input type="hidden" id="company_id" name="company_id" value="<?php echo $company_id;?>" />
					<label for="search"></label>
					<input type="submit" name="submit" value="Submit" class="link_button"/>
					<a href="<?php echo $base_url; ?>admin/policy" class="link_button grey">Cancel</a>
				</li>
			</ul>
		</fieldset>
		
		
		
		<?php echo form_close();?>
	
	</div>
</div>
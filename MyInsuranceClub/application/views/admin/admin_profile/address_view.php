
		<div class="content clearfix">
			<div class="col100">
				<h2>Manage Address Book</h2>
				<a href="<?php echo $base_url;?>admin/auth_public/insert_address">Insert New Address</a>

			<?php if (! empty($message)) { ?>
				<div id="message">
					<?php echo $message; ?>
				</div>
			<?php } ?>
				
				<?php echo form_open(current_url());	?>  	
					<table>
						<thead>
							<tr>
								<th class="spacer_150 tooltip_trigger"
									title="An alias to reference the address by.">
									Alias
								</th>
								<th>Recipient</th>
								<th>Company</th>
								<th>Post Code</th>
								<th class="spacer_100 align_ctr tooltip_trigger" 
									title="If checked, the row will be deleted upon the form being updated.">
									Delete
								</th>
							</tr>
						</thead>
						<?php 
							if (!empty($addresses)) {
								foreach ($addresses as $address) {
						?>
						<tbody>
							<tr>
								<td>
									<a href="<?php echo $base_url;?>admin/auth_public/update_address/<?php echo $address['uadd_id'];?>/"><?php echo $address['uadd_alias'];?></a>
								</td>
								<td><?php echo $address['uadd_recipient'];?></td>
								<td><?php echo $address['uadd_company'];?></td>
								<td><?php echo $address['uadd_post_code'];?></td>
								<td class="align_ctr">
									<input type="checkbox" name="delete_address[<?php echo $address['uadd_id'];?>]" value="1"/>
								</td>
							</tr>
						</tbody>
						<?php } ?>
						<tfoot>
							<tr>
								<td colspan="5">
									<input type="submit" name="update_addresses" value="Delete Checked Addresses" class="link_button large"/>
								</td>
							</tr>
						</tfoot>
						<?php } else { ?>
						<tbody>
							<tr>
								<td colspan="5">
									<p>There are no addresses in your address book</p>
								</td>
							</tr>
						</tbody>
						<?php } ?>
					</table>
				<?php echo form_close();?>
			</div>
		</div>
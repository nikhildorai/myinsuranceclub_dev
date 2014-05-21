<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>JS/dropdowns.js" ></script>
<script type="text/javascript" src="http://www.google.com/jsapi"></script>
<style type = "text/css">
.ui-datepicker { font-size:9pt !important}
input[readonly="readonly"]
{
    background-color:grey;
}
</style>
<title>Health forms</title>
</head>
<body>
<div style="text-align: center;"><?php //echo validation_errors();?></div>

<?php $form_id=array('id'=>'form_id'); echo form_open('Welcome/health_policy',$form_id);?>
<input type="hidden" id='myField' name="location"/>
<input type="hidden" name="product_des" value="Health Insurance/Mediclaim"/>
<table align="center" style="margin-top:70px;border:1px solid black;">
	<tr><td colspan="5" align="center"><b>Compare And Buy Health Insurance Plans</b></td></tr>
	<tr>
		<td>Policy Details</td><td></td><td></td></tr>
	<tr>
		<td></td>
		<td align="right"><label>Plan Type:</label></td>
		<td><select name="plan_type" id="plan_type" onchange="return family_member();">
				<option value="1" selected="selected">Individual</option>
				<option value="2">Family Floater</option>
			</select>
		</td>						
	</tr>
	<tr id="family_compo" style="display: none;"><td></td>
		<td align="right"><label>Family Composition:</label></td>
		<td><select name="adult" id="adult" onchange="return adult_dob_gender();"><option value="1">1 Adult</option><option value="2" selected="selected">2 Adults</option></select>
			<select name="child" id="child" onchange="return child_dob_gender();"><option value=""></option><option value="1" selected="selected">1 Child</option><option value="2">2 Children</option>
			<option value="3">3 Children</option><option value="4">4 Children</option>
			</select>
		</td>
	</tr>
	<tr><td></td>
		<td align="right"><label>Coverage Amount:</label></td>
		<td><select name="coverage_amount">
				<option value="1">Below 1 Lakh</option>
				<option value="2">1 Lakh</option>
				<option value="3">2 Lakhs</option>
				<option value="4" selected="selected">3 Lakhs</option>
				<option value="5">4 Lakhs</option>
				<option value="6">5 Lakhs</option>
				<option value="7">7.5 Lakhs</option>
				<option value="8">10 Lakhs</option>
				<option value="9">15 Lakhs</option>
				<option value="10">20 Lakhs</option>
				<option value="11">50 Lakhs</option>
			</select></td>
	</tr>
	<tr><td></td>
		<td align="right"><label>Policy Term:</label></td>
		<td><select name="policy_term">
				<option value="1" selected="selected">1 year</option>
				<option value="2" >2 years</option>
				<option value="3">3 years</option>
			</select></td>
	</tr>
	<tr><td colspan="8"><hr/></td></tr>
	<tr>
		<td>Policyholder Details</td><td></td><td></td></tr>
	<tr>
		<td></td>
		<td align="right"><label>Full Name:</label></td>
		<td><input type="text" name="cust_name" value="<?php echo set_value('cust_name');?>"/><?php echo form_error('cust_name');?></td>
	</tr>
	<tr>
		<td></td>
		<td align="right"><label>Date of Birth:</label></td>
		<td><input type="text" name="cust_dob" class="dob" value="<?php echo set_value('cust_dob');?>" readonly="readonly" onchange="return validate_fullname();"/><?php echo form_error('cust_dob');?></td>
		<td><select name="cust_gender">
					<option value="1">Gender</option>
					<option value="2" selected="selected">Male</option>
					<option value="3">Female</option>
		</select></td>
	</tr>
	<tr id="spouse_dd" style="display: none;">
		<td></td>
		<td align="right"><label>Spouse Date of Birth:</label></td>
		<td><input type="text" name="spouse_dob" class="dob" readonly="readonly"/></td>
		<td><select name="spouse_gender">
					<option value="0">Gender</option>
					<option value="1">Male</option>
					<option value="2">Female</option>
		</select></td>
	</tr>
	<tr id="child1_dd" style="display: none;">
		<td></td>
		<td align="right"><label>Child 1 Date of Birth:</label></td>
		<td><input type="text" name="child1_dob" class="dob" readonly="readonly"/></td>
		<td><select name="child1_gender">
					<option value="0">Gender</option>
					<option value="1">Male</option>
					<option value="2">Female</option>
		</select></td>
	</tr>
	<tr id="child2_dd" style="display: none;">
		<td></td>
		<td align="right"><label>Child 2 Date of Birth:</label></td>
		<td><input type="text" name="child2_dob" class="dob" readonly="readonly"/></td>
		<td><select name="child2_gender">
					<option value="0">Gender</option>
					<option value="1">Male</option>
					<option value="2">Female</option>
		</select></td>
	</tr>
	<tr id="child3_dd" style="display: none;">
		<td></td>
		<td align="right"><label>Child 3 Date of Birth:</label></td>
		<td><input type="text" name="child3_dob" class="dob" readonly="readonly"/></td>
		<td><select name="child3_gender">
					<option value="0">Gender</option>
					<option value="1">Male</option>
					<option value="2">Female</option>
		</select></td>
	</tr>
	<tr id="child4_dd" style="display: none;">
		<td></td>
		<td align="right"><label>Child 4 Date of Birth:</label></td>
		<td><input type="text" name="child4_dob" class="dob" readonly="readonly"/></td>
		<td><select name="child4_gender">
					<option value="0">Gender</option>
					<option value="1">Male</option>
					<option value="2">Female</option>
		</select></td>
	</tr>
	<tr>
		<td></td>
		<td align="right"><label>Mobile:</label></td>
		<td><input type="text" name="cust_mobile" value="<?php echo set_value('cust_mobile');?>" maxlength="10" /> <?php echo form_error('cust_mobile');?></td>
	</tr>
	<tr>
		<td></td>
		<td align="right"><label>Email:</label></td>
		<td><input type="text" name="cust_email" value="<?php echo set_value('cust_email');?>" /><?php echo form_error('cust_email');?></td>
	</tr>
	<tr>
		<td></td>
		<td align="right"><label>City:</label></td>
		<td><select name="cust_city">
		<option value=""></option>
			<option value="1">Mumbai,Maharashtra</option>
			<option value="2">Bengaluru,Karnataka</option>
			<option value="3">Hyderabad,Andhra Pradesh</option>
			<option value="4">Chennai,Tamil Nadu</option>
			<option value="5">Kolkata,West Bengal</option>
			<option value="6">Delhi,Delhi</option>
			<option value="7">Ahmedabad,Gujarat</option>
			<option value="8">Pune,Maharashtra</option>
			
		</select> <?php echo form_error('cust_city');?></td>
	</tr>
	<tr><td></td><td></td><td><input type="submit" value="Submit"/><input type="reset" value="Reset"></td></tr>
</table>
<?php echo form_close();?>
</body>
</html>
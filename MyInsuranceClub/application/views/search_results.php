<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Health Search Results</title>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"> </script>
<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>

<script type="text/javascript" src="<?php echo base_url();?>JS/accordian.js"> </script>
<link rel="stylesheet" href="<?php echo base_url();?>css/mic.css"/>

</head>
<body>
<div style="margin-top:60px;text-align:center;">
<?php 
		if(count($customer_details)>1)
		{echo "We've got ".count($customer_details)." plans that meet your search.";}
		else 
		{echo "We've got ".count($customer_details)." plan that meets your search.";} 
		
		?>
</div>
<?php foreach ($customer_details as $result2){

	$room_rent=round(0.01*$result2['sum_assured']);	
	$icu_rent=round(0.02*$result2['sum_assured']);
	if($result2['no_of_members']=='1A')
	{
		$members="Individual";
	}
	else{
			$members=$result2['no_of_members'];
	}
	?>
<div style="margin-top:20px;position:center;">   
<div id="wrapper">
<div class="accordionButton"><div style="margin-top: 10px;"><span><?php echo form_checkbox('compare');?></span><span style="margin-left:40px;"><?php echo $result2['company_shortname'];?></span><span style="margin-left:70px;"><?php echo $result2['policy_name'];?></span>&nbsp;&nbsp;&nbsp;<span style="margin-left:70px;font-size:25px;text-align: center;">Rs.<?php echo $result2['annual_premium'];?></span><span style="font-size:11px;">&nbsp;&nbsp;Coverage Amount&nbsp;Rs.<?php echo $result2['sum_assured'];?></span><span style="margin-left:70px;"><input type="submit" value="Buy Now"/></span></div></div>
<div class="accordionContent">
<table style="width:800px;border:1px solid #ADEAEA;border-radius:12px;">
<tr><td colspan="2"><b>Plan Details</b></td></tr>
<tr><td></td></tr>
<tr><td></td><td style="font-size:13px;">Base Premium:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo "Rs.".$result2['annual_premium'];?></td></tr>
<tr><td></td><td style="font-size:13px;">Service Tax:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo "Rs.".$result2['service_tax'];?></td></tr>
<tr><td></td><td style="font-size:13px;">Gross Premium:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo "Rs.".$result2['final_premium'];?></td></tr>
<tr><td><label>Number Of Members</label></td><td><?php echo $members;?></td></tr>
<tr><td><label>Cashless Treatment</label></td><td><?php echo $result2['cashless_treatment'];?></td></tr>
<tr><td><label>Pre-existing Diseases</label></td><td><?php echo $result2['preexisting_diseases'];?></td></tr>
<tr><td><label>Auto Recharge Of Sum Assured</label></td><td><?php echo $result2['autorecharge_SI'];?></td></tr>
<tr><td><label>Room Rent</label></td><td>Rs.<?php echo $room_rent;?>/day</td></tr>
<tr><td><label>ICU Rent</label></td><td>Rs.<?php echo $icu_rent;?>/day</td></tr>
<tr><td><label>Doctor's Fee</label></td><td>TBD</td></tr>
<tr><td><label>Pre-hospitalisation</label></td><td><?php echo $result2['pre_hosp'];?></td></tr>
<tr><td><label>Post-hospitalisation</label></td><td><?php echo $result2['post_hosp'];?></td></tr>
<tr><td><label>Day care expenses</label></td><td><?php echo $result2['day_care'];?></td></tr>
<tr><td><label>Maternity Benefits</label></td><td><?php echo $result2['maternity'];?></td></tr>
<tr><td><label>Health Check up</label></td><td><?php echo $result2['check_up'];?></td></tr>
<tr><td><label>Ayurvedic treatment</label></td><td><?php echo $result2['ayurvedic'];?></td></tr>
<tr><td><label>Co-payment</label></td><td><?php echo $result2['co_pay'];?></td></tr>
</table>
</div>
</div>
<?php }?>
</div>
</body>

</html>



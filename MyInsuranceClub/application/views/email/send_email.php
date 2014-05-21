<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<link rel="stylesheet" href="<?php echo base_url();?>css/mic.css"/>
<title>Health Search Results</title>
</head>
<body>
<div style="margin-top:60px;text-align:center;">
<?php 
		if(count($send_email)>1)
		{echo "We've got ".count($send_email)." plans that meet your search.";}
		else 
		{echo "We've got ".count($send_email)." plan that meets your search.";} 
		
		?>
</div>

<?php foreach($send_email as $email_data){?>
		<div style="margin-top: 10px;"><span style="margin-left:40px;"><?php echo $email_data['company_shortname'];?></span><span style="margin-left:70px;"><?php echo $email_data['policy_name'];?></span>&nbsp;&nbsp;&nbsp;<span style="margin-left:70px;font-size:25px;text-align: center;">Rs.<?php echo $email_data['annual_premium'];?></span><span style="font-size:11px;">&nbsp;&nbsp;Coverage Amount&nbsp;Rs.<?php echo $email_data['sum_assured'];?></span><span style="margin-left:70px;"><input type="submit" value="Buy Now"/></span></div>
<?php }?>
</body>
</html>
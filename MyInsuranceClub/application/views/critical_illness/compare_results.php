<html>
<head>
<link rel="stylesheet" href="<?php echo base_url();?>/assets/css/custom_style.css"/>
<link rel="stylesheet" href="<?php echo base_url();?>/assets/css/custom.css"/>
<link rel="stylesheet" href="<?php echo base_url();?>/assets/css/font-awesome.min.css"/>
</head>
<body>
<?php echo anchor('health_insurance/criticalIllness/get_critical_illness_results','Go Back To Search Results');?>

<table border='1'>
<?php 
	if (!empty($result))
	{	
		
		foreach ($result as $k1=>$v1)
		{
			
			echo '<tr>';
			
				echo '<td><b>'.$k1.'</b></td>';
				foreach ($v1 as $k2=>$v2)
				{
					if (!empty($v2)){
						if($v2=='Base')
						{
							$v2='N/A';
						}
						if($k1!='Policy Renewable Age Limit' && trim($v2) == 'Yes')
						{
							$v2 = "<i class='fa fa-check fa-2' style='color:#2bbd1c'></i>";
						}
						if($k1!='Policy Renewable Age Limit' && trim($v2) == 'No')
						{
							$v2 = "<i class='fa fa-times fa-2' style='color:red'></i>";
						}
						echo '<td style="text-align:center;">'.$v2.'</td>';
					}
					else 
						echo '<td>N/A</td>';
				}
				
			echo '</tr>';
		}
	}
?>

</table>


</body>

</html>
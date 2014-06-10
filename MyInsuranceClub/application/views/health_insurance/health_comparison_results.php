
<html>
<head>
</head>
<body>
<?php echo anchor('welcome/health_policy','Go Back To Search Results');?>

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
						echo '<td>'.$v2.'</td>';
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


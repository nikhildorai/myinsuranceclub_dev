
<html>
<head>
</head>
<body>
<a href="<?php echo site_url();?>/Welcome/health_policy">Back to Search Results</a>
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


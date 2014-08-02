<link rel="stylesheet" href="<?php echo base_url();?>assets/css/jquery.qtip.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/smart-pricing1.css">
<?php 
	$arrHeaderColorLite = array("blue-lite","green-lite","orange-lite");
	$arrHeaderColorDark = array("blue-dark","green-dark","orange-dark");
	$arrBuyBtnColor = array('blue-btn','green-btn','orange-btn');
	$param = "yes";
?>
<div id="page-wrap" class="container" style="margin-bottom: 100px;">
  <div class="smart-grids">
    <div class="smart-wrapper">
      <div class="back_to"> <i class="fa fa-angle-left arrow_left"></i> <a href="<?php echo base_url().'health-insurance/search-results/'.$param ?>">Back to Search Results</a> </div>
      <div class="difference">
        <div class="checkbox">
          <label class="highlightDiff">
          <input id="Field4" name="agree" type="checkbox" class="field checkbox" value="agree">
          <label for="Field4" class="">Highlight Differences</label>
          </label>
        </div>
      </div>
      <div class="smart-pricing">
        <div class="pricing-tables elegant-style four-colm">
          <?php 
				if (!empty($result))
				{	
					$resultCount = count($result['company_shortname']);
					?>
          <table>
            <thead>
              <tr>
                <th style="background: #fff; color: #000; padding: 0; border: none;" class="colm"> <div class="pricing-header ann">
                    <h2> <span>Annual Premium</span> </h2>
                  </div>
                </th>
                <?php 
								for ($i = 0; $i < $resultCount; $i++)
								{	?>
                <th style="background: none; padding: 0px; border: none;" class="colm"> <div class="pricing-header header-colored">
                    <h1 class="<?php echo $arrHeaderColorLite[$i];?>"> <?php echo $result['company_shortname'][$i];	?>
                      <p class="smart_p"><?php echo $result['policy_name'][$i];	?></p>
                    </h1>
                    <h2 class="<?php echo $arrHeaderColorDark[$i];?>"> <span>&#8377;<?php echo number_format($result['annual_premium'][$i]);	?></span> 
                      <!--<p class="signup"><a href="#" class="btn_offer_block">Buy Now <i class="fa fa-angle-right"></i></a></p>--> 
                    </h2>
                  </div>
                </th>
                <?php 							}	?>
              </tr>
            </thead>
            <tbody>
              <?php 
						$return = '';
						$featureList = Util::featureList('Mediclaim');
						$featureKeys = array_keys($featureList);
						$i = 1;
						$arrSkip = array('major_exclusions');
						$arrFormat1 = array();
						$arrFormat2 = array();
						foreach ($result as $k1=>$v1)
						{
							if (in_array($k1, $featureKeys) && !empty($v1) && !in_array($k1, $arrSkip))
							{
								if (count(array_unique($v1)) === 1) 
									$return .=	'<tr class="sameCol">';
								else
									$return .=	'<tr class="diffCol">';
									$return .= 		'<td class="colm">';
									if (isset($featureList[$k1]['tooltip']) && !empty($featureList[$k1]['tooltip']))
										$return .= 		'<ul class="tool_icon">';
									else 
										$return .= 		'<ul>';
											$return .= 		'<li>
																<a href="javascript:void(0)" title="'.$featureList[$k1]['tooltip'].'">'.$featureList[$k1]['name'].'</a>
															</li>
														</ul>
													</td>';
													foreach ($v1 as $k2=>$v2)
													{			
										$return .=		'<td class="colm pad_l">';
														if (!empty($v2))
														{
															if(trim(strtolower($v2))=='base')
															{
																$return .= 'N/A';
															}
															else if(trim(strtolower($v2)) == 'Covered')
															{
																$return .= "<i class='fa fa-check fa-2' style='color:#2bbd1c'></i>";
															}
															else if(trim(strtolower($v2)) == 'Not Covered')
															{
																$return .= "<i class='fa fa-times fa-2' style='color:red'></i>";
															}
															else if ($k1 == 'major_exclusions')
															{
																$v2 = unserialize($v2);
																if (!empty($v2))
																{
																	$return .=	'<ul>
																					<li class="hospital">
																						<span class="cmp_ul pa_t">';
																			foreach ($v2 as $k3=>$v3)
																			{
																				if (!empty($v3))
																					$return .=	'<span class="ul_t">'.$v3.'</span>';
																			}
																		$return .=		'</span>
																					</li>
																				</ul>';
																}
															}
															else
																$return .=	$v2;
														}
														else
											$return .=		'N/A';
										$return .=		'</td>';
													}
									$return .=	'</tr>';
							}
						}
						echo $return;
?>
              <tr>
                <td class="colm" style="background: #fff; border: none; padding: 5px;"></td>
                <?php 
								for ($i = 0; $i < $resultCount; $i++)
								{	?>
                <td class="colm" style="padding: 20px;"><div class="pricing-footer" style="border: none; padding: 0px;">
                    <button type="button" class="pricing-button <?php echo $arrBuyBtnColor[$i];?> grad-button">Buy Now</button>
                  </div></td>
                <?php 							}	?>
              </tr>
            </tbody>
          </table>
          <?php 			}
				else 
				{
					echo 'No policy selected';
				}
?>
        </div>
      </div>
    </div>
  </div>
</div>
<style>
<!--
.diffColClass{
/* -webkit-box-shadow: 0px 1px 22px 2px rgba(148,148,148,0.82);
-moz-box-shadow: 0px 1px 22px 2px rgba(148,148,148,0.82);
box-shadow: 0 0 0 2px #F2CF71; */

font-weight: bold;
font-size: 15px;
color: green;
}
-->
</style>
<script
	type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.qtip.js"></script> 
<script type="text/javascript">
$(function() {
	$('.highlightDiff').click(function(e){
		if($('#Field4:checked').length == 1)
		{
			$('.diffCol').addClass('diffColClass');
			//$('.sameCol').addClass('diffColClass');
			
		}
		else
		{
			$('.diffCol').removeClass('diffColClass');
			//$('.sameCol').removeClass('diffColClass');
		}
	});
	
	//$('a[title]').qtip({ style: { name: 'cream', tip: true } })
	
	 $('a[title]').each(function () {
        $(this).qtip({
            
            style: {
                classes: 'qtip-shadow qtip-bootstrap'
            },
            position: {
                my: 'center left', // Position my top left...
                at: 'center right', // at the bottom right of...
            }

        });
    });
	
	$('#soi').mouseover(function(){
         $('#soi').addClass('active');   
	  if ( $("#tes" ).hasClass( "tes" ) ) {
		  
		   $("#target").load("include/social.php"); 
		  
		  } 
		        });
				
				
					$('#footer').mouseleave(function(){
				 
				 $('#soi').removeClass('active');  
	     $("#tes").remove();
        });
});		
</script>
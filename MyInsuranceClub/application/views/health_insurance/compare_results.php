<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css'>
<!-- Bootstrap CSS -->
<link href="<?php echo base_url();?>/assets/css/bootstrap/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap third-party plugins css -->
<!-- Font Awesome -->
<link href="<?php echo base_url();?>/assets/css/font-awesome.min.css" rel="stylesheet">
<!-- style -->
<link href="<?php echo base_url();?>/assets/css/theme-style.min.css" rel="stylesheet">
<!-- custom override -->
<link href="<?php echo base_url();?>/assets/css/custom-style.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url();?>/assets/css/slicknav.css">
<link rel="stylesheet" href="<?php echo base_url();?>/assets/css/custom.css">
<link rel="stylesheet" href="<?php echo base_url();?>/assets/css/responsive.css">
<link rel="stylesheet" href="<?php echo base_url();?>/assets/css/jquery.qtip.css">
<link rel="stylesheet" href="<?php echo base_url();?>/assets/css/smart-pricing1.css">
</head>

<body class="page page-index">
<?php $this->load->view('partial_view/header_resultpage'); ?>
<div id="page-wrap" class="container" style="margin-bottom:100px;">
  <div class="smart-grids">
    <div class="smart-wrapper">
      <div class="back_to"><i class="fa fa-angle-left arrow_left"></i><a href="<?php echo base_url();?>health-insurance/search-results">Back to Search Results</a></div>
      <div class="difference">
        <div class="checkbox">
          <label>
            <input id="Field4" name="agree"  type="checkbox" class="field checkbox" value="agree">
          <label  for="Field4" class="">Highlight Differences</label>
          </label>
        </div>
       
      </div>
      <div class="smart-pricing">
        <div class="pricing-tables elegant-style four-colm">
          <table>
            <thead>
              <tr>
                <th style="background:#fff; color:#000; padding:0; border:none;" class="colm"><div class="pricing-header ann">
                    <h2><span>Annual Premium</span></h2>
                  </div></th>
                <th style="background:none; padding: 0px; border: none;" class="colm"><div class="pricing-header header-colored">
                    <h1 class="blue-lite">Bharti AXA
                      <p class="smart_p">Smart Health</p>
                    </h1>
                    <h2 class="blue-dark"><span>&#8377;4,350</span> 
                      <!--<p class="signup"><a href="#" class="btn_offer_block">Buy Now <i class="fa fa-angle-right"></i></a></p>--> 
                    </h2>
                  </div></th>
                <th  style="background:none; padding: 0px; border: none;" class="colm"><div class="pricing-header header-colored">
                    <h1 class="green-lite">Apollo Munich
                      <p class="smart_p">Optima Restore</p>
                    </h1>
                    <h2 class="green-dark"><span>&#8377;6,350</span> 
                      <!--              <p class="signup"><a href="#" class="btn_offer_block">Buy Now <i class="fa fa-angle-right"></i></a></p>
--> </h2>
                  </div></th>
                <th  style="background:none; padding: 0px; border: none;" class="colm"><div class="pricing-header header-colored">
                    <h1 class="orange-lite">Birla Sun Life
                      <p class="smart_p">MediPrime Insurance</p>
                    </h1>
                    <h2 class="orange-dark"><span>&#8377;5,350</span> 
                      <!--              <p class="signup"><a href="#" class="btn_offer_block">Buy Now <i class="fa fa-angle-right"></i></a></p>
--> </h2>
                  </div></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="colm"><ul class="tool_icon">
                    <li><a href="javascript:void(0)"  title="Invoices/Estimates you can send to your clients." >Cashless treatment</a> </li>
                  </ul></td>
                 <td class="colm pad_l">4000 network hospitals</td>
                 <td class="colm pad_l">4000 network hospitals</td>
                 <td class="colm pad_l">4000 network hospitals</td>
              </tr>
              <tr>
                <td class="colm"><ul class="tool_icon">
                    <li><a href="javascript:void(0)" title="Number of clients you can manage in your account.">Pre-existing diseases</a> </li>
                  </ul></td>
                 <td class="colm pad_l">Covered after 4 years</td>
                 <td class="colm pad_l">Covered after 4 years</td>
                 <td class="colm pad_l">Covered after 4 years</td>
              </tr>
              <tr>
                <td class="colm"><ul class="tool_icon">
                    <li><a href="javascript:void(0)" title="Number of automatically generated invoices that are used to send identical invoices to clients as per the occurrence and frequency set by you.">Auto recharge of Sum Insured</a> </li>
                  </ul></td>
                 <td class="colm pad_l">Yes </td>
                 <td class="colm pad_l">Yes </td>
                 <td class="colm pad_l">Yes </td>
              </tr>
              <tr>
                <td class="colm"><ul class="tool_icon">
                    <li><a href="javascript:void(0)" title="Pre-hospitalisation">Pre-hospitalisation</a> </li>
                  </ul></td>
                 <td class="colm pad_l">30 days before hospitalisation</td>
                 <td class="colm pad_l">30 days before hospitalisation</td>
                 <td class="colm pad_l">30 days before hospitalisation</td>
              </tr>
              <tr>
                <td class="colm"><ul class="tool_icon">
                    <li><a href="javascript:void(0)" title="Invoices/Estimates you can send to your clients.">Post-hospitalisation</a> </li>
                  </ul></td>
                 <td class="colm pad_l">60 days after discharge</td>
                 <td class="colm pad_l">60 days after discharge</td>
                 <td class="colm pad_l">60 days after discharge</td>
              </tr>
              <tr>
                <td class="colm"><ul class="tool_icon">
                    <li><a href="javascript:void(0)" title="Invoices/Estimates you can send to your clients.">Day care expenses</a> </li>
                  </ul></td>
                <td class="colm pad_l">Covered</td>
                <td class="colm pad_l">Covered</td>
                <td class="colm pad_l">Covered</td>
              </tr>
              <tr>
                <td class="colm"><ul class="tool_icon">
                    <li><a href="javascript:void(0)" title="Invoices/Estimates you can send to your clients.">API Access</a> </li>
                  </ul></td>
                <td class="colm pad_l">Covered after 4 years</td>
                <td class="colm pad_l">Covered after 4 years</td>
                <td class="colm pad_l">Covered after 4 years</td>
              </tr>
              <tr>
                <td class="colm"><ul class="tool_icon">
                    <li><a href="javascript:void(0)" title="Invoices/Estimates you can send to your clients.">Maternity Benefits</a> </li>
                  </ul></td>
                 <td class="colm pad_l">Yes – only if hospitalisation due to Accident</td>
                 <td class="colm pad_l">Yes – only if hospitalisation due to Accident</td>
                 <td class="colm pad_l">Yes – only if hospitalisation due to Accident</td>
              </tr>
              <tr>
                <td class="colm"><ul class="tool_icon">
                    <li><a href="javascript:void(0)" title="Invoices/Estimates you can send to your clients.">Auto Recharge of Sum Insured</a> </li>
                  </ul></td>
                 <td class="colm pad_l">Up to 1% of Average SI after every 4 </td>
                 <td class="colm pad_l">Up to 1% of Average SI after every 4 </td>
                 <td class="colm pad_l">Up to 1% of Average SI after every 4 </td>
              </tr>
              <tr>
                <td class="colm"><ul class="tool_icon">
                    <li><a href="javascript:void(0)" title="Invoices/Estimates you can send to your clients.">Health Check up</a> </li>
                  </ul></td>
                 <td class="colm pad_l">Continuous claim free policy years</td>
                 <td class="colm pad_l">Continuous claim free policy years</td>
                 <td class="colm pad_l">Continuous claim free policy years</td>
              </tr>
              <tr>
                <td class="colm"><ul class="tool_icon">
                    <li class="hospital"><a href="javascript:void(0)" title="Auto-Billing is a feature of recurring profiles where you get paid automatically once an invoice is sent out from the recurring profile using your client's   credit card details.">Hospitalisation expenses </a>
                    <span class="cmp_ul"> 
                    	<span class="ul_t">Room Rent</span>
                   	    <span class="ul_t">ICU Rent</span> 
                      	<span class="ul_t">Fees of Surgeon, Anesthetist, Nurses, etc</span>
                        
                     </span> 
                     </li>
                  </ul></td>
                 <td class="colm pad_l"><ul>
                    <li class="hospital"> <span class="cmp_ul pa_t"> <span class="ul_t">Rs.3,000/day</span> <span class="ul_t">Rs.6,000/day</span> <span class="ul_t">As per actualsc</span> </span> </li>
                  </ul></td>
                 <td class="colm pad_l"><ul>
                    <li class="hospital"> <span class="cmp_ul pa_t"> <span class="ul_t">Rs.3,000/day</span> <span class="ul_t">Rs.6,000/day</span> <span class="ul_t">As per actualsc</span> </span> </li>
                  </ul></td>
                 <td class="colm pad_l"><ul>
                    <li class="hospital"> <span class="cmp_ul pa_t"> <span class="ul_t">Rs.3,000/day</span> <span class="ul_t">Rs.6,000/day</span> <span class="ul_t">As per actualsc</span> </span> </li>
                  </ul></td>
              </tr>
              <tr>
                <td class="colm"><ul class="tool_icon">
                    <li><a href="javascript:void(0)" title="Invoices/Estimates you can send to your clients.">Ayurvedic Treatment</a> </li>
                  </ul></td>
                 <td class="colm pad_l">Up to Rs.25,000 per year</td>
                 <td class="colm pad_l">Up to Rs.25,000 per year</td>
                 <td class="colm pad_l">Up to Rs.25,000 per year</td>
              </tr>
              <tr>
                <td class="colm"><ul class="tool_icon">
                    <li><a href="javascript:void(0)" title="Invoices/Estimates you can send to your clients.">Co-payment</a> </li>
                  </ul></td>
                 <td class="colm pad_l">10% for every claim or all insured above the age of 80 years</td>
                 <td class="colm pad_l">10% for every claim or all insured above the age of 80 years</td>
                 <td class="colm pad_l">10% for every claim or all insured above the age of 80 years</td>
              </tr>
              <tr>
                <td class="colm" style="background:#fff; border:none; padding:5px;"></td>
                <td class="colm" style="padding:20px;"><div class="pricing-footer" style="border:none; padding:0px;">
                    <button type="button" class="pricing-button blue-btn grad-button">Buy Now</button>
                  </div></td>
                <td class="colm" style="padding:20px;"><div class="pricing-footer" style="border:none; padding:0px;">
                    <button type="button" class="pricing-button green-btn grad-button"> Buy Now</button>
                  </div></td>
                <td class="colm" style="padding:20px;"><div class="pricing-footer" style="border:none; padding:0px;">
                    <button type="button" class="pricing-button orange-btn grad-button">Buy Now</button>
                  </div></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<?php $this->load->view('partial_view/footer_resultpage'); ?>
<!-- ======== @Region: #navigation ======== --> 

<!--Scripts --> 

<!--Legacy jQuery support for quicksand plugin--> 

<!-- Bootstrap JS --> 

<!--Bootstrap third-party plugins--> 

<!--JS plugins--> 
<!--<link href="city/sty.css" rel="stylesheet">

    <div class="mouseout modal" aria-hidden="false" style="display: none;"><div class="housing-logo"></div>
    <div class="content">
<div class="left-content">
<div class="call-bubble call-image"></div>
<div class="call-image">
<i class="icon-phone"></i>
</div>
</div>
<div class="right-content">
<div class="text1">Call us at</div>
<div class="number">03-333-333-333</div>
<div class="text2">AND WE WILL HELP YOU BEST INSURANCE POLICY</div>
</div>
</div></div>--> 

<script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.6.2/modernizr.min.js"></script> 
<script src="<?php echo base_url();?>/assets/js/jquery.min.js"></script> 
<script type="text/javascript" src="<?php echo base_url();?>/assets/js/jquery.qtip.js"></script> 
<script type="text/javascript">


$(function() {
	
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
</body>
</html>

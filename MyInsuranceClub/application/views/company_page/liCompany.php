<link rel="stylesheet" href="<?php echo base_url();?>assets/css/company.css">
<div id="highlighted" style="background:#fff; padding-bottom:50px; margin-bottom:0px;" >
  <div class="container">
    <div class="row">
      
       <div class="col-md-12" style="padding-right:0px;">
        <h2 class="title-divider_h2"> <span>Life Insurance Companies in India</span> </h2>
        <div class="company_abt">
        <h2 class="title-divider_h2_inn">There are <?php echo !empty($companyDetails) ? count($companyDetails) : '0';?> Life insurance companies in India.</h2>
        <p >Life Insurance Corporation of India (LIC) is the only Public Sector insurance company, the rest all being private insurance players. The Life Insurance sector was opened up for private players to participate in the year 2000. Most of the private players have tied up with international insurance biggies for their life insurance foray. </p><p>At MyInsuranceClub.com you can compare life insurance policies from top insurance companies to find policies that best suits you and your family at the lowest cost.</p>
        </div>
			<?php 
				$this->load->view('company_page/_companyListing');
			?>      
        </div>
    </div>
  </div>
</div>
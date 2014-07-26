<script type="text/javascript">
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>
<link
	rel="stylesheet" href="<?php echo base_url();?>assets/css/company.css">
<div id="highlighted"
	style="background: #fff; padding-bottom: 50px; margin-bottom: 0px;">
	<div class="container">
		<div class="row">
		<?php
		if (empty($companyDetails))
		{
			echo 'No company found';
		}
		else
		{	
			$this->load->view('company_page/_companyDetailPage');
		}	?>
		</div>
	</div>
</div>

<?php 
	$this->load->view('partial_view/header_new'); 
		$this->load->view('partial_view/header_resultpage');  
			echo $content; 
?>			
<script src="<?php echo base_url();?>assets/js/number.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery-ui.min.js"></script> 
<script src="<?php echo base_url();?>assets/js/jquery.ui.touch-punch.min.js"></script> 
<script src="<?php echo base_url();?>assets/js/compare.js"></script>
<script src="<?php echo base_url();?>assets/js/typeahead.min.js"></script>
<?php 
	$this->load->view('partial_view/footer_new'); 
?> 


<?php //$this->load->view('partial_view/header_resultpage'); ?> 
	<?php //echo $content; ?>
<?php //$this->load->view('partial_view/footer_resultpage'); ?> 

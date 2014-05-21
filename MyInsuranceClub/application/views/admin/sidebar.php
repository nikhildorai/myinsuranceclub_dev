<div class="span2" >
		  <div class="well sidebar-nav">
			<ul class="nav nav-list">
			  
			  <li class="nav-header"><a href="<?=base_url()?>admin/home"><i class="icon-wrench"></i>Administration</a></li>
              <li class="nav-header"><i class="icon-user"></i> CMS Pages</li>
              <li class="<?=(($this->uri->segment(2)=='cms')&&($this->uri->segment(3)==''))?'active':''?>"><i class=""></i> <a href="<?=base_url()?>admin/cms">CMS Page</a></li>
		 	   
			</ul>
		  </div>
		</div>
		
		<!-- Main Content Goes Here -->
		
		<div id="content-main" class="span9">

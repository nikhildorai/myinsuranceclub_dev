<link rel="stylesheet" href="<?php echo base_url();?>/assets/css/contact.css">

<link href="<?php echo base_url();?>/assets/css/heart.css" rel="stylesheet">

<div id="highlighted" class="single" style="background:#fff; padding-bottom:50px; margin-bottom:0px;" >
  
  
  
  
  <div id="content">
        <div class="container">
          <div class="row">
            <!-- sidebar -->
            
            <!--main content-->
            <div class="col-md-12">
              <h2 class="title-divider">
                <span>Feedback</span></span>
                
              </h2>
               
              <div class="row">
                <div class="col-md-6">
                  <form id="feedback-form" action="#" role="form">
                  
                  <div style=" margin-bottom:20px;" class="clearfix">
                  <div class="form-field absolute_" style="color: rgb(106, 106, 106); margin-bottom:20px;">
      <label class="smiley-cover ng-scope">
      <div class="label_cover  has-sl"><span class="label ng-binding">How useful did you find this website?</span></div>
      <div class="input_cover">
        <div class="smiley-cover">
          <label tooltip="" class="label smiley has-tooltip ng-scope child-0" style="display: inline-block" data-original-title="Terrible">
          <div></div>
          <input type="radio" name="field15[]" value="1">
          </label>
          <label tooltip="" title="" class="label smiley has-tooltip ng-scope child-1" style="display: inline-block" data-original-title="Poor">
          <div></div>
          <input type="radio" name="field15[]" value="2">
          </label>
          <label tooltip="" title="" class="label smiley has-tooltip ng-scope child-2"  style="display: inline-block" data-original-title="Decent">
          <div></div>
          <input type="radio" name="field15[]" value="3">
          </label>
          <label tooltip="" title="" class="label smiley has-tooltip ng-scope child-3" style="display: inline-block" data-original-title="Good">
          <div></div>
          <input type="radio" name="field15[]" value="4">
          </label>
          <label tooltip="" title="" class="label smiley has-tooltip ng-scope child-4"  style="display: inline-block" data-original-title="Awesome">
          <div></div>
          <input type="radio" name="field15[]" value="5">
          </label>
 
      </div>
      </label>
    </div>
                  
                  </div>
                  </div>
                  
                  
                  
                  <!--<div>
                  
                  <div class="form-field absolute_"  style="color: rgb(106, 106, 106);">
      <label class="thumb-cover ng-scope">
      <div class="label_cover  has-sl"><span class="label ng-binding">Would you like to reccomned your friend?</span></div>
      <div class="input_cover">
        <div class="thumb-cover">
          <label class="label thumb-label ng-scope up_c"  style="display: inline-block"><i class="icon-thumbs-up fa fa-thumbs-o-up"></i>
            <input type="radio" name="field8[]" value="Yes">
            <span compile="opt.show"><span class="ng-scope">Yes</span></span></label>
          <label class="label thumb-label ng-scope up_d"  style="display: inline-block"><i class="icon-thumbs-down fa fa-thumbs-o-down"></i>
            <input type="radio" name="field8[]" value="No">
            <span compile="opt.show"><span class="ng-scope">No</span></span></label>
      </div>
      
      </div>
      </label>
    </div>
                  </div>-->
		<div id="heart_show"></div>

                  <div class="toltip_text_p  clearfix"></div>
                  <div class="social_tip  clearfix" style="margin-bottom:30px;">
                  <ul class="">
                  <li class="fbp"> <div id="fb-root"></div><div class="fb-like" data-href="https://www.facebook.com/myinsuranceclub" data-width="200" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div></li>

<li class="twtr" style="margin-left:0px;">

<a href="https://twitter.com/myinsuranceclub" class="twitter-follow-button follow" data-show-count="true" data-size="medium">Follow @myinsuranceclub</a>		

</li>
                  </ul>
                  
                  </div>
                  
                
                  
                 
                    <div class="form-group" style="margin-top:20px;">
                      <label class="sr-only" for="contact-message">Message</label>
                      <textarea rows="7" class="form-control" id="contact-message" placeholder="Your Feedback/ Comments (Maximum 200 characters)"></textarea>
                    </div>
                       <div class="form-group" >
                      <label class="sr-only" for="contact-name">Name</label>
                      <input type="text" class="form-control" id="contact-name" placeholder="Name">
                    </div>
                  
                    <div class="form-group">
                      <label class="sr-only" for="contact-email">Email</label>
                      <input type="email" class="form-control" id="contact-email" placeholder="Email (If you want us to reply)">
                    </div>
                       <div class="form-group">
                      <label class="sr-only" for="contact-namobilee">Mobile</label>
                      <input type="text" class="form-control" id="contact-mobile" placeholder="Mobile (If you want us to call you)">
                    </div>
                    <input type="button" class="btn btn-primary my" value="Send Message" style="float:right;">
                  </form>
                </div>
                
              </div>
            </div>
          </div>
        </div>
      </div>
  
  
  
  
  
  
</div>

 <script src="<?php echo base_url();?>/assets/js/bootstrap-tooltip.js"></script> 


<script src="<?php echo base_url();?>/assets/js/rotate3Di.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>/assets/js/3d-falling-leaves.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
	
	   $(".has-tooltip").tooltip({
        placement : 'top'
    });
	
	$('.icon-thumbs-up').click(function(){
		 $(this).parent().addClass('is_on');
		 $('.icon-thumbs-down').parent().removeClass('is_on');
		
        });
		$('.icon-thumbs-down').click(function(){
		 $(this).parent().addClass('is_on');
		 $('.icon-thumbs-up').parent().removeClass('is_on');
		
        });
		
		
		$('.child-0').click(function(){
		 $(this).addClass('is_on');
		 $('.child-1,.child-2,.child-3,.child-4').removeClass('is_on');
		   $(".toltip_text_p").html('<p class="top_t red ">"Oops, we seemed to have done something really wrong!"</p><p class="top_m red">Do share some more information below so that we can attend to it</p>');
		$('.social_tip').hide();
		$(document).octoberLeaves('stop');
        });
		
		$('.child-1').click(function(){
		 $(this).addClass('is_on');
		 $('.child-0,.child-2,.child-3,.child-4').removeClass('is_on');
		  $(".toltip_text_p ").html('<p class="top_t red">"Poor! That is surely not what we set about wanting to do."</p><p class="top_m red">Do share some more information below so that we can attend to it.</p>');
		 $('.social_tip').hide();
		 $(document).octoberLeaves('stop');
        });
		
		$('.child-2').click(function(){
		 $(this).addClass('is_on');
		 $('.child-1,.child-0,.child-3,.child-4').removeClass('is_on');
		  $(".toltip_text_p").html('<p class="top_t">"Ok, it seems we are getting there. Still a long way to go though."</p><p class="top_m">Do let us know if there is some suggested improvement.</p>');
		 $('.social_tip').hide();
		 $(document).octoberLeaves('stop');
        });
		
		
		$('.child-3').click(function(){
		 $(this).addClass('is_on');
		 $('.child-1,.child-2,.child-0,.child-4').removeClass('is_on');
		  $(".toltip_text_p").html('<p class="top_t green">"Yay, glad you liked what we are doing."</p><p class="top_m green">Anything you want us to do better? And do you mind promoting us?!</p>');
		    $('.social_tip').show();
		  loadSocial_feedback();
		 $(document).octoberLeaves('stop');
        });
		
		
		$('.child-4').click(function(){
		 $(this).addClass('is_on');
		 $('.child-1,.child-2,.child-3,.child-0').removeClass('is_on');
		  $(".toltip_text_p").html('<p class="top_t green">"Woo hoo, this makes us feel proud. Lots of love to you :)"</p><p class="top_m green">Would you mind talking about us on FB/Twitter?</p>');
		  $('.social_tip').show();
		  loadSocial_feedback();
		  $("#heart_show").octoberLeaves('start');
		
        });
	
	});

function loadSocial_feedback() {
    //I will assume that if we have one type of button we have them all
    //If not we'll just exit
    if ($(".twitter-follow-button").length == 0) return;

    //Twitter
    if (typeof (twttr) != 'undefined') {
        twttr.widgets.load();
    } else {
        $.getScript('http://platform.twitter.com/widgets.js');
    }

    //Facebook
    if (typeof (FB) != 'undefined') {
        FB.init({ status: true, cookie: true, xfbml: true });
    } else {
        $.getScript("http://connect.facebook.net/en_US/all.js#xfbml=1", function () {
            FB.init({ status: true, cookie: true, xfbml: true });
        });
    }
  

}
</script>
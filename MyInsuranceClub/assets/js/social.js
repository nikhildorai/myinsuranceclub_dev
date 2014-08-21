
    $(window).load(function () {
       // loadSocial();

        //extra - hook up button event - remove this
        $("#loadbutton").click(function () {
            simulateAjaxRequest();
        });
		
		
		 $('#soi').mouseover(function(){
	 
         $('#soi').addClass('active');   
		//  $("#target").load(base_url); 
		   simulateAjaxRequest34();
	  if ( $("#tes" ).hasClass( "tes" ) ) {
		  
		  /* $("#target").load(base_url); 
		   simulateAjaxRequest34();*/
		   loadSocial();
		  
		  } 
		        });
				
				
				
				
						$('#footer').mouseleave(function(){
				 
				 $('#soi').removeClass('active');  
	    $("#tes").remove();
        });
		
		
		
		
		
		
/*		
 $('#soi').mouseover(function(){
	 
	 var base_url = CI_ROOT+"/include/social.php";
         $('#soi').addClass('active');   
	  if ( $("#tes" ).hasClass( "tes" ) ) {
		  
		   $("#target").load(base_url); 
		  
		  } 
		        });
				
				
					$('#footer').mouseleave(function(){
				 
				 $('#soi').removeClass('active');  
	     $("#tes").remove();
        });*/
		
		
		
    });

function loadSocial() {
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
  
    //Linked-in
    if (typeof (IN) != 'undefined') {
        IN.parse();
    } else {
        $.getScript("http://platform.linkedin.com/in.js");
    }

    //Google - Note that the google button will not show if you are opening the page from disk - it needs to be http(s)
    if (typeof (gapi) != 'undefined') {
        $(".g-plusone").each(function () {
            gapi.plusone.render($(this).get(0));
        });
    } else {
        $.getScript('https://apis.google.com/js/plusone.js');
    }
}


function loadSocial_search() {
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

    function simulateAjaxRequest() {
        //Here we would load content from somewhere and insert that into the page.
        //In this case I will just add another couple of buttons to the loadbutton html
        var html = '<a href="https://twitter.com/share" class="twitter-share-button" data-url="http://www.blackfishweb.com/es" data-text="Blackfish" data-count="horizontal" data-via="BlackfishWeb"></a>';
        html+= '<div class="fb-like" data-href="http://www.blackfishweb.com/es" data-send="false" data-layout="button_count" data-width="90" data-show-faces="false"></div>';
        html+= '<div class="g-plusone" data-size="medium" data-annotation="inline" data-width="90" data-href="http://www.blackfishweb.com"></div>';
        html+= '<scr'+'ipt type="IN/Share" data-url="http://www.blackfishweb.com" data-counter="right"></scr'+'ipt>';
        $("#loadbutton").html(html);

        //Then we call loadSocial to reinit the scripts
        loadSocial();
    }
	
	 function simulateAjaxRequest34() {
        //Here we would load content from somewhere and insert that into the page.
        //In this case I will just add another couple of buttons to the loadbutton html
	//	alert('s');
      //  var html1 = '<div class="fb-like" data-href="https://www.facebook.com/myinsuranceclub" data-width="200" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>';
     //   $(".fbp").html(html1);

        //Then we call loadSocial to reinit the scripts
     //   loadSocial();
    }

  

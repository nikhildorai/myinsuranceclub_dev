/**
 * 
 */


  $(function() {
    $( ".dob" ).datepicker({ changeMonth: true,changeYear: true,yearRange: "-100:+0",dateFormat:"yy-mm-dd",showOn: "button",
    	buttonImage: "images/calendar.gif",
        buttonImageOnly: true});});

 
  function family_member()
  {
	if($("#plan_type").val()=='2')
	{
		$("#family_compo").show();
	}
	else
	{	
		$("#family_compo").hide();
		$("#spouse_dd").hide();
		$("#child1_dd").hide();
		$("#child2_dd").hide();
		$("#child3_dd").hide();
		$("#child4_dd").hide();
	}
  }

  function adult_dob_gender()
  {
	if($("#adult").val()=='2')
	{
		$("#spouse_dd").show();
	}
	else if ($("#adult").val()=='1')
	{
		$("#spouse_dd").hide();
	}

  }
  function child_dob_gender()
  {
	if($("#child").val()=='')
	{
		$("#child1_dd").hide();
		$("#child2_dd").hide();
		$("#child3_dd").hide();
		$("#child4_dd").hide();
	}  

	else if($("#child").val()=='1')
	{
		$("#child1_dd").show();
		$("#child2_dd").hide();
		$("#child3_dd").hide();
		$("#child4_dd").hide();
		
	}
	else if ($("#child").val()=='2')
	{
		$("#child1_dd").show();
		$("#child2_dd").show();
		$("#child3_dd").hide();
		$("#child4_dd").hide();
	}
	
	else if ($("#child").val()=='3')
	{
		$("#child1_dd").show();
		$("#child2_dd").show();
		$("#child3_dd").show();
		$("#child4_dd").hide();
	}
	else if ($("#child").val()=='4')
	{
		$("#child1_dd").show();
		$("#child2_dd").show();
		$("#child3_dd").show();
		$("#child4_dd").show();
	}
  }
  
 
  
  /*****************************/
  
  /*function geoFindMe() {
	  var output = document.getElementById("out");

	  if (!navigator.geolocation){
	    output.innerHTML = "<p>Geolocation is not supported by your browser</p>";
	    return;
	  }

	  function success(position) {
	    var latitude  = position.coords.latitude;
	    var longitude = position.coords.longitude;

	    output.innerHTML = '<p>Latitude is ' + latitude + '° <br>Longitude is ' + longitude + '°</p>';

	    var img = new Image();
	    img.src = "http://maps.googleapis.com/maps/api/staticmap?center=" + latitude + "," + longitude + "&zoom=13&size=300x300&sensor=false";

	    output.appendChild(img);
	  };

	  function error() {
	    output.innerHTML = "Unable to retrieve your location";
	  };

	  output.innerHTML = "<p>Locating…</p>";

	  navigator.geolocation.getCurrentPosition(success, error);
	}*/
  
  
  /***********************/
  
 /** Form validations **/
/*  $(document).ready(function(){
	    $("#form_id").validate({
	        rules: {
	            cust_name: {
	                required:true,
	                alphanumeric:true,
	                maxlength: 45
	            },
	            email: {
	                required: true,
	                email: true,
	                maxlength: 45
	            }
	        },
	        messages: {
	            cust_name: {
	                required:"It would be nice if I know who you are.",
	                alphanumeric:"This field should not contain any funny characters",
	                maxlength:"My dissertation is shorter than your name :) Give me a nickname."
	            },
	            email:  {
	                required:"Please enter your email address.",
	                email:"Oh, come on, this is not an email, you know that!",
	                maxlength:"Maximum characters allowed – 45"
	            }
	        },
	        invalidHandler:function(){
	        }
	        })
	});//document ready close
*/  
  
  /***********************/
  
  /** Complete address of visitor **/
 /* $(document).ready(function(){
  function displayLocation(latitude,longitude){
	  var request = new XMLHttpRequest();

	  var method = 'GET';
	  var url = 'http://maps.googleapis.com/maps/api/geocode/json?latlng='+latitude+','+longitude+'&sensor=true';
	  var async = true;

	  request.open(method, url, async);
	  request.onreadystatechange = function(){
	    if(request.readyState == 4 && request.status == 200){
	      var data = JSON.parse(request.responseText);
	      var address = data.results[5];
	     $('#myField').val(address.formatted_address);
	    }
	  };
	  request.send();
	};

	var successCallback = function(position){
	  var x = position.coords.latitude;
	  var y = position.coords.longitude;
	  displayLocation(x,y);
	};

	var errorCallback = function(error){
	  var errorMessage = 'Unknown error';
	  switch(error.code) {
	    case 1:
	      errorMessage = 'Permission denied';
	      break;
	    case 2:
	      errorMessage = 'Position unavailable';
	      break;
	    case 3:
	     errorMessage = 'Timeout';
	     break;
	  }
	  document.write(errorMessage);
	};

	var options = {
	  enableHighAccuracy: true,
	  timeout: 1000,
	  maximumAge: 0
	};

	navigator.geolocation.getCurrentPosition(successCallback,errorCallback,options);
  });*/
  /********************************/
  
  
 
  
  
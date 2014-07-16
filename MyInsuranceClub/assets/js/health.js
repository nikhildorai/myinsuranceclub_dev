

$(document).ready(function() {
	
	
		$('.accordion').accordion({
			collapsible: true,
			heightStyle : 'content'
			
		});
		$('.accordion.closed').accordion( "option", "active", false );
		 
			/*	 $('#m_cust_dob').click(function() {
				//	alert('s');
  });*/
			 
			 
			 
			 
			  $("#m_cust_dob").on("blur keyup", function(e){
    var $this = $(this),
        value = $this.val();

    //Does the input have "-", if so it is from the webkit datepicker, fix it
    if(value.indexOf("-") !== -1){
        var cleanDateArray = value.split('-');
        value = cleanDateArray[2] + "/" + cleanDateArray[1] + "/" + cleanDateArray[0];
    }

    //Set the hidden value to validate on, trigger the blur and keyup event for validation as you type
    $("#m_cust_dob1").val(value).trigger("blur").trigger("keyup");
});
			 
			 
			   $("#m_spouce_dob").on("blur keyup", function(e){
    var $this = $(this),
        value = $this.val();

    //Does the input have "-", if so it is from the webkit datepicker, fix it
    if(value.indexOf("-") !== -1){
        var cleanDateArray = value.split('-');
        value = cleanDateArray[2] + "/" + cleanDateArray[1] + "/" + cleanDateArray[0];
    }

    //Set the hidden value to validate on, trigger the blur and keyup event for validation as you type
    $("#m_spouce_dob1").val(value).trigger("blur").trigger("keyup");
});


   $("#m_child1_dob").on("blur keyup", function(e){
    var $this = $(this),
        value = $this.val();

    //Does the input have "-", if so it is from the webkit datepicker, fix it
    if(value.indexOf("-") !== -1){
        var cleanDateArray = value.split('-');
        value = cleanDateArray[2] + "/" + cleanDateArray[1] + "/" + cleanDateArray[0];
    }

    //Set the hidden value to validate on, trigger the blur and keyup event for validation as you type
    $("#m_child1_dob1").val(value).trigger("blur").trigger("keyup");
});

 $("#m_child2_dob").on("blur keyup", function(e){
    var $this = $(this),
        value = $this.val();

    //Does the input have "-", if so it is from the webkit datepicker, fix it
    if(value.indexOf("-") !== -1){
        var cleanDateArray = value.split('-');
        value = cleanDateArray[2] + "/" + cleanDateArray[1] + "/" + cleanDateArray[0];
    }

    //Set the hidden value to validate on, trigger the blur and keyup event for validation as you type
    $("#m_child2_dob1").val(value).trigger("blur").trigger("keyup");
});
			 
			 $("#m_child3_dob").on("blur keyup", function(e){
    var $this = $(this),
        value = $this.val();

    //Does the input have "-", if so it is from the webkit datepicker, fix it
    if(value.indexOf("-") !== -1){
        var cleanDateArray = value.split('-');
        value = cleanDateArray[2] + "/" + cleanDateArray[1] + "/" + cleanDateArray[0];
    }

    //Set the hidden value to validate on, trigger the blur and keyup event for validation as you type
    $("#m_child3_dob1").val(value).trigger("blur").trigger("keyup");
}); 

 $("#m_child4_dob").on("blur keyup", function(e){
    var $this = $(this),
        value = $this.val();

    //Does the input have "-", if so it is from the webkit datepicker, fix it
    if(value.indexOf("-") !== -1){
        var cleanDateArray = value.split('-');
        value = cleanDateArray[2] + "/" + cleanDateArray[1] + "/" + cleanDateArray[0];
    }

    //Set the hidden value to validate on, trigger the blur and keyup event for validation as you type
    $("#m_child4_dob1").val(value).trigger("blur").trigger("keyup");
}); 
			 
			 
		/*	 $("#m_cust_dob").on({
        blur: function() {
	    var m_val1 = $("#m_cust_dob").val();
	   $("#m_cust_dob1").val(m_val1);
    }
});*/


/*
			 $("#m_spouce_dob").on({
        blur: function() {
	    var m_val2 = $("#m_cust_dob").val();
	   $("#m_spouce_dob1").val(m_val2);
    }
});

 $("#m_child1_dob").on({
        blur: function() {
	    var m_val2 = $("#m_cust_dob").val();
	   $("#m_child1_dob1").val(m_val2);
    }
});
 $("#m_child2_dob").on({
        blur: function() {
	    var m_val2 = $("#m_cust_dob").val();
	   $("#m_child2_dob1").val(m_val2);
    }
});
 $("#m_child3_dob").on({
        blur: function() {
	    var m_val2 = $("#m_cust_dob").val();
	   $("#m_child3_dob1").val(m_val2);
    }
});

		 $("#m_child4_dob").on({
        blur: function() {
	    var m_val2 = $("#m_cust_dob").val();
	   $("#m_child4_dob1").val(m_val2);
    }
});
*/


				
				
				
		
				
				
				
				// $('#sub_form').click(function() {
					// $( "#form-ui").submit();
					 	
					 
					 
   // $('.load_spin').show();
  //});
  
  //.next().find('.class');
//  $('#sub_form').click(function() {
 // $(this).next().find('.css-label').css('backgroundPosition', '0 -15px');
  
 //   });
	
	/*$('input:radio[name="gender"]').change(
    function(){
	
		$('.css-label.aa').css('backgroundPosition', '0 0');
        if ($(this).is(':checked') ) {
		$(this).next().next().css('backgroundPosition', '0 -15px');
        }
		else{
			
			}
    });*/
	
		/*$('input:radio[name="spouce_gender"]').change(
    function(){
	
		$('.css-label.a').css('backgroundPosition', '0 0');
        if ($(this).is(':checked') ) {
		$(this).next().next().css('backgroundPosition', '0 -15px');
        }
		else{
			
			}
    });
	
		$('input:radio[name="spouce_gender1"]').change(
    function(){
	
		$('.css-label.b').css('backgroundPosition', '0 0');
        if ($(this).is(':checked') ) {
		$(this).next().next().css('backgroundPosition', '0 -15px');
        }
		else{
			
			}
    });
	
		$('input:radio[name="spouce_gender2"]').change(
    function(){
	
		$('.css-label.c').css('backgroundPosition', '0 0');
        if ($(this).is(':checked') ) {
		$(this).next().next().css('backgroundPosition', '0 -15px');
        }
		else{
			
			}
    });
	
		$('input:radio[name="spouce_gender3"]').change(
    function(){
	
		$('.css-label.d').css('backgroundPosition', '0 0');
        if ($(this).is(':checked') ) {
		$(this).next().next().css('backgroundPosition', '0 -15px');
        }
		else{
			
			}
    });*/

 $.validator.addMethod('checkUsername', function(value, element) {
     return this.optional(element) || /[A-Za-z\s.]+$/.test(value);
 }, "Accepts only alphabets,periods and spaces.");
 	
 $.validator.addMethod('checkmobile', function(value, element) {
     return this.optional(element) || /^[7-9]/.test(value);
 }, "Should start with 7,8 or 9.");
 
 $.validator.addMethod('minAge', function(value, element) {
	// alert(1);
	 console.log(value, element);
	 if (this.optional(element)) {
	        return true;
	    }
	 
	 var dateOfBirth = value;
	 var arr_dateText = dateOfBirth.split("/");
	 day = arr_dateText[0];         
	 month = arr_dateText[1]; 
	 year = arr_dateText[2];
	 
	 var mydate = new Date();
	 mydate.setFullYear(year, month-1, day);
	 
	 var maxDate = new Date();
	    maxDate.setYear(maxDate.getYear() - 18);

	    if (maxDate < mydate) {
	        return false;
	    }
	    return true;
	},'Age should be greater than 18 years.');
 	
 $.validator.addMethod('childAge', function(value, element) {
		// alert(1);
		 console.log(value, element);
		 if (this.optional(element)) {
		        return true;
		    }
		 
		 var dateOfBirth = value;
		 var arr_dateText = dateOfBirth.split("/");
		 day = arr_dateText[0];         
		 month = arr_dateText[1]; 
		 year = arr_dateText[2];
		 
		 var mydate = new Date();
		 mydate.setFullYear(year, month-1, day);
		 
		 var maxDate = new Date();
		    maxDate.setYear(maxDate.getYear() - 26);

		    if (maxDate > mydate) {
		        return false;
		    }
		    return true;
		},'Childs age cannot be more than 26.');
 
 $( "#health_form" ).validate({
				
						/* @validation states + elements 
						------------------------------------------- */
	 						onkeyup: true,
	 						//onfocusout: true,
	 						//focusInvalid: true,
						errorClass: "state-error",
						validClass: "state-success",
						errorElement: "em",
						
						/* @validation rules 
						------------------------------------------ */
							
						rules: {
								
								cust_name: {
								
									required:true,
									checkUsername:true
							
								},	
								
								desktop_cust_dob: {
									
									required:true,
									minAge:true
								},
								
								cust_email: {
										required: true,
										email: true
								 },
  								
  								cust_mobile: {
  									
  									required: true,
  									number: true,
  									minlength: 10,
  									checkmobile:true
  									
  								},
  								
  								desktop_spouce_dob: {
  									
  									required:true,
  									minAge:true
  								},
  								
  								desktop_child1_dob:	{
  									required:true,
  									childAge:true
  								},
  								
  								desktop_child2_dob:{
  									required:true,
  									childmaxAge:true
  								},
  								
  								desktop_child3_dob:{
  									required:true,
  									childmaxAge:true
  								},
  								
  								desktop_child4_dob:{
  									required:true,
  									childmaxAge:true
  								},
  								
  								agree: {
  									
  									required:true
  								}
						},
						
						/* @validation error messages 
						---------------------------------------------- */
							
						messages:{
										
							
							cust_email: {
											email: 'Enter a Valid email address'
								},
								
							cust_mobile: {
								
								minlength: 'Please enter 10 digits for phone numbers',
								number: 'This field accepts only numbers',
								
							},
							
							cust_dob: {
								
								required:true
							},
							
							agree: {
								
								required:'Please Accept Terms of Use.'
							}
							
						},

						/* @validation highlighting + error placement  
						---------------------------------------------------- */	
						
						highlight: function(element, errorClass, validClass) {
								$(element).closest('.field').addClass(errorClass).removeClass(validClass);
						},
						unhighlight: function(element, errorClass, validClass) {
								$(element).closest('.field').removeClass(errorClass).addClass(validClass);
						},
						errorPlacement: function(error, element) {
						   if (element.is(":radio")) {//|| element.is(":checkbox")
									element.closest('.option-group').after(error);
						   } else {
									error.insertAfter(element.parent());
						   }
						}
								
				
						
  
  });	
				
 
				
			 
				          
         
	
	
		
		//$.widget( "custom.combobox_with_optgroup", {});
		
		
		$.widget( "custom.combobox", {
    _create: function() {
        this.wrapper = $( "<span>" )
            .addClass( "ui-combobox" )
            .insertAfter( this.element );
        this.element.hide();
        this._createAutocomplete();
        this._createShowAllButton();
		this.input.attr("placeholder", this.element.attr('placeholder'));
    },
    _createAutocomplete: function() {
        var selected = this.element.find( ":selected" ),
            value = selected.val() ? selected.text() : "";
        this.input = $( "<input>" )
            .appendTo( this.wrapper )
            .val( value )
            .attr( "title", "" )
            .addClass( "ui-combobox-input ui-widget ui-widget-content ui-state-default ui-corner-left" )
            .autocomplete({
                delay: 0,
                minLength: 0,
                source: $.proxy( this, "_source" )
            })
            .tooltip({
                tooltipClass: "ui-state-highlight"
            });
        this._on( this.input, {
            autocompleteselect: function( event, ui ) {
                ui.item.option.selected = true;
                this._trigger( "select", event, {
                    item: ui.item.option
                });
            },
            autocompletechange: "_removeIfInvalid"
        });

        this.input.data("uiAutocomplete")._renderMenu = function(ul, items) {
            var self = this,
                currentCategory = "";
            $.each(items, function(index, item) {
                if (item.category != currentCategory) {
                    if (item.category) {
                        ul.append("<li class='ui-autocomplete-category'>" + item.category + "</li>");
                    }
                    currentCategory = item.category;
                }
                self._renderItemData(ul, item);
            });
        };
    },
    _createShowAllButton: function() {
        var input = this.input,
            wasOpen = false;
        $( "<a>" )
            .attr( "tabIndex", -1 )
            .attr( "title", "Ã�Å¸Ã�Â¾Ã�ÂºÃ�Â°Ã�Â·Ã�Â°Ã‘â€šÃ‘Å’ Ã�Â²Ã‘ï¿½Ã�Âµ" )
            .tooltip()
            .appendTo( this.wrapper )
            .button({
                icons: {
                    primary: "ui-icon-triangle-1-s"
                },
                text: false
            })
            .removeClass( "ui-corner-all" )
            .addClass( "ui-combobox-toggle ui-corner-right" )
            .mousedown(function() {
                wasOpen = input.autocomplete( "widget" ).is( ":visible" );
            })
            .click(function() {
                input.focus();

                if ( wasOpen ) {
                    return;
                }

                input.autocomplete( "search", "" );
            });
    },
    _source: function( request, response ) {
        var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
        response( this.element.find( "option" ).map(function() {
            var text = $( this ).text();
            if ( this.value && ( !request.term || matcher.test(text) ) )
                return {
                    label: text,
                    value: text,
                    option: this,
                    category: $(this).closest("optgroup").attr("label")
                };
        }) );
    },
    _removeIfInvalid: function( event, ui ) {

        if ( ui.item ) {
            return;
        }

        var value = this.input.val(),
            valueLowerCase = value.toLowerCase(),
            valid = false;
        this.element.find( "option" ).each(function() {
            if ( $( this ).text().toLowerCase() === valueLowerCase ) {
                this.selected = valid = true;
                return false;
            }
        });

        if ( valid ) {
            return;
        }

        this.input
            .val( "" )
            .attr( "title", value + " Ã�Â½Ã�Âµ Ã‘ï¿½Ã‘Æ’Ã‘â€°Ã�ÂµÃ‘ï¿½Ã‘â€šÃ�Â²Ã‘Æ’Ã�ÂµÃ‘â€š" )
            .tooltip( "open" );
        this.element.val( "" );
        this._delay(function() {
            this.input.tooltip( "close" ).attr( "title", "" );
        }, 2500 );
        this.input.data( "ui-autocomplete" ).term = "";
    },
    _destroy: function() {
        this.wrapper.remove();
        this.element.show();
    }
});
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
		//$( "#combobox" ).combobox();
		$( "#combobox" ).combobox({
      select: function( event, ui ) {
    // alert(ui.item.text);
	  
	  	var am_v=ui.item.text;
   $("#loc").text(am_v);
   $("#cust_city_name").val(am_v);
   
      }
      });
	  
		$( "#toggle" ).click(function() {
			$( "#combobox" ).toggle();
		});
	
	/*	$(".ui-combobox-input").bind("focus", function () {
    this.value = '';
    $(this).autocomplete("search", '');
});*/
		
		
		$("html").click(function(){ 
   // $( "#cust_dob" ).attr("placeholder", "Date of Birth");
});
		var d = new Date();
		var year = d.getFullYear() - 18 ;
		var child_age = d.getFullYear() - 26;
		$('#trigger').click(function() {
					
					$('#cust_dob').datepicker({
					//var curdate = new Date(); 	
					dateFormat: 'dd/mm/yy',
					changeYear: true, 
					yearRange :'1940:'+ d,
					changeMonth: true,
					defaultDate: new Date(year,d.getMonth(), d.getDate()),
					maxDate: new Date(),
					prevText: '<i class="fa fa-chevron-left"></i>',
					nextText: '<i class="fa fa-chevron-right"></i>',
					
				});
      
	});
		/*$('.cal').datepicker({
					changeYear: true, yearRange : '1940:2014',
					changeMonth: true,
					prevText: '<i class="fa fa-chevron-left"></i>',
					nextText: '<i class="fa fa-chevron-right"></i>',
					
				});*/
	
	
		$('#trigger1').click(function() {
					
					$('#spouce_dob').datepicker({
						
						dateFormat: 'dd/mm/yy',
					changeYear: true, yearRange : '1940:' + d,
					changeMonth: true,
					defaultDate: new Date(year,d.getMonth(), d.getDate()),
					maxDate: new Date(),
					prevText: '<i class="fa fa-chevron-left"></i>',
					nextText: '<i class="fa fa-chevron-right"></i>',
					
				});
      
	});
	
		$('#trigger2').click(function() {
					
					$('#child1_dob').datepicker({
						dateFormat: 'dd/mm/yy',
					changeYear: true, yearRange : '1940:' + d,
					changeMonth: true,
					prevText: '<i class="fa fa-chevron-left"></i>',
					nextText: '<i class="fa fa-chevron-right"></i>',
					
				});
      
	});
	
		$('#trigger3').click(function() {
					
					$('#child2_dob').datepicker({
						dateFormat: 'dd/mm/yy',
					changeYear: true, yearRange : '1940:' + d,
					changeMonth: true,
					prevText: '<i class="fa fa-chevron-left"></i>',
					nextText: '<i class="fa fa-chevron-right"></i>',
					
				});
      
	});
	
		$('#trigger4').click(function() {
					
					$('#child3_dob').datepicker({
						dateFormat: 'dd/mm/yy',
					changeYear: true, yearRange : '1940:' + d,
					changeMonth: true,
					prevText: '<i class="fa fa-chevron-left"></i>',
					nextText: '<i class="fa fa-chevron-right"></i>',
					
				});
      
	});
	
		$('#trigger5').click(function() {
					
					$('#child4_dob').datepicker({
						dateFormat: 'dd/mm/yy',
					changeYear: true, yearRange : '1940:' + d,
					changeMonth: true,
					prevText: '<i class="fa fa-chevron-left"></i>',
					nextText: '<i class="fa fa-chevron-right"></i>',
					
				});
      
	});
	
	
	var width =$(window).width();
	if( width >900){
$('.mob_cal').hide();
$('.desk_cal').show();
$('.desk_gen').show();
$('.mob_gen').hide();


	}
	else {
		//$('.desk_cal').remove();
		$('.desk_cal').hide();
		$('.mob_cal').show();
		//$('.desk_gen').remove();
		$('.desk_gen').hide();
		$('.mob_gen').show();
		}
	
	
$(window).resize(function () {
   
   var width =$(window).width();
	if( width >900){
$('.mob_cal').hide();
$('.desk_cal').show();
$('.mob_gen').hide();
$('.desk_gen').show();
//$("#myDiv").html('<div id="mySecondDiv"></div>');

/*$("#cal_d").html(' <div class="desk_cal"><label class="input" style="position:relative"> <i class="icon-append fa fa-calendar " id="trigger"></i><input type="text" name="cust_dob" id="cust_dob" class="form-control cal"  placeholder="Date of Birth" required></label></div>');*/

	}
	else {
		/*$("#cal_d").html('<div class="mob_cal"> <label class="input form-control" style="position:relative; margin:0px;"> <i class="icon-append fa fa-calendar "></i> <input type="date" name="cust_dob" id="m_cust_dob" class="native_date_picker" value="2012-10-01"/>  </label>   </div>');*/
		
	//	$('.desk_cal').remove();
	$('.desk_cal').hide();
		$('.mob_cal').show();
		//$('.desk_gen').remove();
		$('.desk_gen').hide();
		$('.mob_gen').show();
		}
   
});

$(':input[type=number]').on('mousewheel', function(e){
    $(this).blur(); 
});
$(".cal").on({
    focus: function(){
        $(this).attr("placeholder", "DD/MM/YYYY");
    },
    blur: function() {
       $(this).attr("placeholder", "Date of Birth");
    }
});
$(".cal").keyup(function(e){
                if (e.keyCode != 8){   
				var keysPressed = [];
				
				  if((e.keyCode) !== -1){
          //  alert("you have pressed this key before");
          }
		
          
				 
                    if ($(this).val().length === 2){
                        $(this).val($(this).val() + "/");
                    }else if ($(this).val().length === 5){
                        $(this).val($(this).val() + "/");
                    }
					else if ($(this).val().length >= 11){
                        //$(this).val($(this).val());
						var temp = $(this).val();
						$(this).val(temp.substring(0, 10));
					//	alert('d');
                    }
                }
				
			
				
            });   
	
	
	
	});




/*MODIFY ON 09/07/2014*/


function InitialCaps(theString) {
    theString = theString.toLowerCase();
	
    theString = theString.substr(0, 1).toUpperCase() + theString.substring(1, theString.length);
    var i = 0;
    var j = 0;
    while ((j = theString.indexOf(" ", i)) && (j !== -1)) {
			theString = theString.substring(0, j + 1) + theString.substr(j + 1, 1).toUpperCase() + theString.substring(j + 2, theString.length);
        i = j + 1;
    }
    return theString;
}

function validateName(tb) {
    
    $(tb).val(InitialCaps($(tb).val()));

    return true;
}

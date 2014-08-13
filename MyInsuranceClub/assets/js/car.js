

$(document).ready(function() {
	
	
	
	
	
	
	
	
	    $('.selectpicker').selectpicker();
		
			 $("#veh_man").change(function() {
        var veh_man = $("#veh_man").val();
		 $("#veh_model").removeAttr("disabled");
		 $('#veh_model').selectpicker('refresh');
      
    });
	
	
		 $("#veh_model").change(function() {
        var veh_model = $("#veh_model").val();
		$("#veh_variant").removeAttr("disabled");
		$('#veh_variant').selectpicker('refresh');
      
    });
	
		 $("#veh_variant").change(function() {
        var veh_variant = $("#veh_variant").val();
		$("#veh_year").removeAttr("disabled");
		$('#veh_year').selectpicker('refresh');
		
      
    });
		
		
		 $("#veh_year").change(function() {
        var veh_year = $("#veh_year").val();
		$("#Policy_details").fadeIn();
	//	car_ani();
      
    });
	
	function car_ani(){
	
		$(".car_d_open").animate({ overflow: "hidden", height: "0px" }, 600);
		
	//setInterval('cycleMe()');
		
	/*	 setInterval(function () {
       cycleMe();
    },600);
	*/
	
	
	setTimeout(function() {
    cycleMe();
}, 600); // <-- time in milliseconds
	
	}
	
	

	
	 $("#one_edit").click(function() {
		 $('#car_d_l').removeClass('active_c');
		// alert('k');
		 
		 $(".car_d_open").animate({ overflow: "visible", height: "50px" }, 600);
	
		//$(".car_d_open").fadeIn();
		$(".car_d_close").fadeOut();
			 $(".car_d_open").fadeIn();
      
    });
	
	
	//$("#Policy_details,#Car_reg_details,#Policy_holder_details").fadeIn();

	
	
 $('.mic_btn_tl_one').mouseover(function(){
	 
         $(this).addClass('mic_btn_tl-hover');   
	 
				 
				
        });
		 $('.mic_btn_tl_one').mouseleave(function(){
	 
         $(this).removeClass('mic_btn_tl-hover');   
	 
				 
				
        });
	
		
	$('.claim_but_y').click(function(){
		 $(this).addClass('mic_btn_tl_chkd');
		 
		 $('.claim_but_n').removeClass('mic_btn_tl_chkd');   
		 $("#add_cover_details").fadeIn();
		 $("#ncb_hide").fadeOut();
        });
	
	$('.claim_but_n').click(function(){
		 $(this).addClass('mic_btn_tl_chkd');
		 $('.claim_but_y').removeClass('mic_btn_tl_chkd');   
		 $("#add_cover_details").fadeOut();
		 
		 $("#ncb_hide").fadeIn();
        });
		
		
		 $("#accident_cover_paid").change(function() {
        $("#avail_discount").fadeIn();
    });
		
		
			$('.member_aai_y').click(function(){
		 $(this).addClass('mic_btn_tl_chkd');
		 
		 $('.member_aai_n').removeClass('mic_btn_tl_chkd');   
		 $("#aai_member_number").fadeIn();
        });
	
	$('.member_aai_n').click(function(){
		 $(this).addClass('mic_btn_tl_chkd');
		 $('.member_aai_y').removeClass('mic_btn_tl_chkd');   
		 $("#aai_member_number").fadeOut();
        });
		
			$('.anti_theft_y').click(function(){
		 $(this).addClass('mic_btn_tl_chkd');
		 
		 $('.anti_theft_n').removeClass('mic_btn_tl_chkd');  
		 
		 $("#Car_reg_details").fadeIn(); 
        });
	
	$('.anti_theft_n').click(function(){
		 $(this).addClass('mic_btn_tl_chkd');
		 $('.anti_theft_y').removeClass('mic_btn_tl_chkd');  
		  $("#Car_reg_details").fadeIn();  
        });
		
		
		
		
		$('.car_reg_individual').click(function(){
		 $(this).addClass('mic_btn_tl_chkd');
		 
		 $('.car_reg_company').removeClass('mic_btn_tl_chkd');   
		 $("#Policy_holder_details").fadeIn();
        });
	
	$('.car_reg_company').click(function(){
		 $(this).addClass('mic_btn_tl_chkd');
		 $('.car_reg_individual').removeClass('mic_btn_tl_chkd');  
		 $("#Policy_holder_details").fadeIn(); 
        });
		
		
		$('.ncb_0').click(function(){
		 $(this).addClass('mic_btn_tl_chkd');
		 $('.ncb_20,ncb_25,.ncb_35,.ncb_45,.ncb_50,.ncb_65,.ncb_d_no').removeClass('mic_btn_tl_chkd');  
		 $("#add_cover_details").fadeIn();
        });
		
		$('.ncb_20').click(function(){
		 $(this).addClass('mic_btn_tl_chkd');
		 $('.ncb_0,ncb_25,.ncb_35,.ncb_45,.ncb_50,.ncb_65,.ncb_d_no').removeClass('mic_btn_tl_chkd');  
		 $("#add_cover_details").fadeIn();
        });
		$('.ncb_25').click(function(){
		 $(this).addClass('mic_btn_tl_chkd');
		 $('.ncb_0,.ncb_20,.ncb_35,.ncb_45,.ncb_50,.ncb_65,.ncb_d_no').removeClass('mic_btn_tl_chkd');  
		 $("#add_cover_details").fadeIn();
        });
		$('.ncb_35').click(function(){
		 $(this).addClass('mic_btn_tl_chkd');
		 $('.ncb_0,.ncb_20,.ncb_25,.ncb_45,.ncb_50,.ncb_65,.ncb_d_no').removeClass('mic_btn_tl_chkd');  
		 $("#add_cover_details").fadeIn();
        });
		$('.ncb_45').click(function(){
		 $(this).addClass('mic_btn_tl_chkd');
		 $('.ncb_0,.ncb_20,.ncb_25,.ncb_35,.ncb_50,.ncb_65,.ncb_d_no').removeClass('mic_btn_tl_chkd');  
		 $("#add_cover_details").fadeIn();
        });
		$('.ncb_50').click(function(){
		 $(this).addClass('mic_btn_tl_chkd');
		 $('.ncb_0,.ncb_20,.ncb_25,.ncb_35,.ncb_45,.ncb_65,.ncb_d_no').removeClass('mic_btn_tl_chkd');  
		 $("#add_cover_details").fadeIn();
        });
		$('.ncb_65').click(function(){
		 $(this).addClass('mic_btn_tl_chkd');
		 $('.ncb_0,.ncb_20,.ncb_25,.ncb_35,.ncb_45,.ncb_50,.ncb_d_no').removeClass('mic_btn_tl_chkd');  
		 $("#add_cover_details").fadeIn();
        });
		$('.ncb_d_no').click(function(){
		 $(this).addClass('mic_btn_tl_chkd');
		 $('.ncb_0,.ncb_20,ncb_25,.ncb_35,.ncb_45,.ncb_50,.ncb_65').removeClass('mic_btn_tl_chkd'); 
		 $("#add_cover_details").fadeIn(); 
        });
		
		
		
		
		
			$(document).delegate('.go-button.renew','click',function() {
		
		 
		 $('.prmBx.renew').addClass('active');
		 $('.prmBx.buy').removeClass('active');   
		  $('#Car_details').show();
		  
		  if($(document).hasClass("js-clingify-locked")){
			  $('html, body').animate({scrollTop:$(".sc_top").offset().top -120},100);
		  }
		  else{
			  $('html, body').animate({scrollTop:$(".sc_top").offset().top -20},100);
		  }
		 
		 
		 
        });
		
			$('.go-button.buy').click(function(){
		 $('.prmBx.buy').addClass('active');
		  $('#Car_details').show();
		 $('.prmBx.renew').removeClass('active');  
		 $('html, body').animate({scrollTop:$(".sc_top").offset().top -20},100);
        });
	
	
	
	var d = new Date();
	$('.for_datepicker').datepicker({
		changeMonth: true,
            changeYear: true,
			yearRange :'1940:'+ d,
		dateFormat: 'dd-mm-yy',
										prevText: '<i class="fa fa-chevron-left"></i>',
					nextText: '<i class="fa fa-chevron-right"></i>',
					
	onSelect: function(){}
					
				});
				
				
				$('.dob_datepicker').datepicker({
		changeMonth: true,
            changeYear: true,
			yearRange :'1940:'+ d,
		dateFormat: 'dd-mm-yy',
										prevText: '<i class="fa fa-chevron-left"></i>',
					nextText: '<i class="fa fa-chevron-right"></i>',
					
	onSelect: function(){}
					
				});
				
					$('.ped_datepicker').datepicker({
		changeMonth: true,
            changeYear: true,
			yearRange :'1940:'+ d,
		dateFormat: 'dd-mm-yy',
										prevText: '<i class="fa fa-chevron-left"></i>',
					nextText: '<i class="fa fa-chevron-right"></i>',
					
	onSelect: function(){}
					
				});
		
	
	
	

    $(".car_hlp a").tooltip({
        placement : 'top'
    });

	
	
	
	
	
	});
	
	
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
            .attr( "title", "" )
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
            .attr( "title", value + " " )
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
	


function cycleMe(){

		$(".car_d_open").css({display:"none"});
			$('#car_d_l').addClass('active_c');
		$(".car_d_close,#Policy_details").fadeIn();
		
	}
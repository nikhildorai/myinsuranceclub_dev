 $(document).ready(function() {
      var id = document.getElementById("tablerowcount").value;
      if(id == 0)
    	  id = 1;
      // Add button functionality
      $("table.dynatable a.add").click(function() {

          id++;
          var master = $(this).parents("table.dynatable");
          
          // Get a new row based on the prototype row
          var prot = master.find(".prototype").clone();
          prot.attr("class", id + " item").attr('id', 'tr'+id);
          prot.find(".id").text(id);
          prot.find('input[type=text]').attr({value:""});
          prot.find('.eventDate').attr({id:"eventDate_"+id}).val("");
          prot.find('.eventFrom').attr({id:"eventFrom_"+id}).val("").css('display','none');
        //  prot.find('.eventFrom').attr({id:"eventFrom_"+id}).val("").addClass('datetime24');
          prot.find('.combodate').remove();
          master.find("tbody").append(prot);
          prot.append('<td class="button-column"><a href="javascript:void(0)" class="remove">Remove</a></td>');
          delegateDatepicker();
          
      });
      
      // Remove button functionality
      $("table.dynatable a.remove").live("click", function() {
          $(this).parents("tr").remove();
          recalcId();
          id--;
      });
  });

function recalcId(){
$.each($("table tr.item"),function (i,el){
  $(this).find("td:first span").text(i + 2); // Simply couse the first "prototype" is not counted in the list
})
}


function delegateDatepicker(){


	$('.datetime24').combodate({
		firstItem: 'name',
		minuteStep: 1,
	}); 
	
    var minEDate = $('#GurudwaraEvents_date_from').val();
    var maxEDate = $('#GurudwaraEvents_date_to').val();
	jQuery('.datepicker').removeClass('hasDatepicker').datepicker({
	    dateFormat: 'dd-mm-yy',
	    minDate: minEDate,
	    maxDate: maxEDate,
	    });
	
	$('.datepicker').live('click', function(){
		 $('.datepicker').datepicker({
			    dateFormat: 'dd-mm-yy',
			    minDate: minEDate,
			    maxDate: maxEDate,
		 });
		 
		});
}


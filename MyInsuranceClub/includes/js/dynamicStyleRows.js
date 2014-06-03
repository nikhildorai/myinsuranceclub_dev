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
          prot.find('input[type=hidden]').attr({value:""});
          master.find("tbody").append(prot);
          prot.append('<td class="button-column"><a href="javascript:void(0)" class="remove">Remove</a></td>');
          
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


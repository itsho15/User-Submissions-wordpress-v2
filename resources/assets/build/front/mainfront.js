jQuery(document).ready(function($) {

	$(document).on('click','.Edit_sub',function(){
		var target = $(this).data('target');
		$('#'+target).modal('show');  
	});

	$(document).on('click','.del_sub',function(){
		var target = $(this).data('target');
		$('#'+target).modal('show');  
	});
	
	$('.default_qatar').val('QA').prop('selected', true);
	 $(document).on('click','.delDoc',function(event){
      event.preventDefault();

      var getId = $(this).data('id');
       $('input[name="docId"]').val(getId);
       $( "#deletedoc" ).submit();
    });
});

function filterFunc() {
	  var input, filter, table, tr, td, i;
	  input = document.getElementById("myInput");
	  filter = input.value.toUpperCase();
	  table = document.getElementById("myTable");
	  tr = table.getElementsByTagName("tr");
	  for (i = 0; i < tr.length; i++) {
	    td = tr[i].getElementsByTagName("td")[1];
	    if (td) {
	      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
	        tr[i].style.display = "";
	      } else {
	        tr[i].style.display = "none";
	      }
	    }       
	  }
}
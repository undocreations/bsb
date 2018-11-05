// Autocomplete in Main Page
$(document).ready(function(){
 
 $('#brand_name').typeahead({
  source: function(query, result)
  {
   $.ajax({
    url:"../mods/autocomplete.php",
    method:"POST",
    data:{query:query},
    dataType:"json",
    success:function(data)
    {
     result($.map(data, function(item){
      return item;
     }));
    }
   })
  }
 });
 
});
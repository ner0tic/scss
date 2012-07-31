$(document).ready(function() {
  $('input:checkbox').click(function() {
    $.post('ajaxGrid',
           {chkbox:$(this).attr('id')},
           function(data) {
             if(data) $(this).attr('checked',!$(this).checked)
            });
  });
 });

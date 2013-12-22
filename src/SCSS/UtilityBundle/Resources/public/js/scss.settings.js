$(document).ready(function(){
	$('legend').click(function(){
      $(this).parent().find('div.content').slideToggle("slow");
      
    });
	$('input[type=checkbox]').tzCheckbox({labels:['On','Off']}); 
});
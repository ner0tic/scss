$(document).ready(function() { 
  $("label").inFieldLabels(); 
  $("select").each().change(function(){
    $('label[for="reason"]').hide();
  });
  yr = new Date('Y');
  $( "#dob" ).datepicker({ minDate: '-18y', maxDate:'-10y'});
});
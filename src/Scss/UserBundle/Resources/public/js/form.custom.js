$(document).ready(function() { 
// turn on in-field labels
  $("label").inFieldLabels();   
// datepicker
//  yr = new Date('Y');//
//  $( "#dob" ).datepicker({minDate: '-18y', maxDate:'-10y', altFormat: 'yy-mm-dd',buttonImageOnly: true});
// toggle help msgs
  $('li.help-item').removeClass('active');
  $('.form-msg-wrapper ul li:first-child').addClass('active');
  $(".text-input, .select-input, .date-select-input").focus(function() {
    $('li.help-item.active').removeClass('active');
    $('li#'+$(this).attr('id')+'-help').addClass('active');
  });
});
// header fixed
$(window).scroll(function(){
    if ($(window).scrollTop() >= 90) {
       $('header').addClass('fixed-header');
       $('body').addClass('fixed-body');
    }
    else {
       $('header').removeClass('fixed-header');
       $('body').removeClass('fixed-body');
    }
});



$(document).ready(function(){
  $('.userporthead_port').click( function(e) {
    e.preventDefault(); 
    e.stopPropagation();
    $('#croudmenu').slideToggle();
  });
  $('.userporthead_port').click( function(e) {
    e.stopPropagation(); 
  });
  $('body').click( function() {
    $('#croudmenu').hide();
  });

  var windowHeight = $(window).innerHeight();
  var contentSection = windowHeight -85;
  $('.content_section').css('min-height', contentSection);


  var paymentperiod = $('#paymentperiod').outerHeight();
  var paymentinfo = $('#paymentinfo').outerHeight();
  var paymentinfopaymentperiod = paymentperiod + paymentinfo + 25
  $('#contactinformations, #planDetails').css('min-height', paymentinfopaymentperiod)

});


$('.filteredCol button').click(function(){
  $(this).toggleClass('togglebtns');
});


$(window).resize(function(){
  var windowHeight = $(window).innerHeight();
  var contentSection = windowHeight - 85;
  $('.content_section').css('min-height', contentSection);


  var paymentperiod = $('#paymentperiod').outerHeight();
  var paymentinfo = $('#paymentinfo').outerHeight();
  var paymentinfopaymentperiod = paymentperiod + paymentinfo + 25
  $('#contactinformations, #planDetails').css('min-height', paymentinfopaymentperiod)
});





$('#leftPanelMenu').click(function(){
  $('body').toggleClass('menuHide');
  //$('.sectionPanel_Right').css('width', 100 + '%');
});



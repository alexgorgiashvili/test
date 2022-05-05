

$(document).ready(function() {
  
  
  $('#pollbtn-1').on('click',function (e) { 
    e.preventDefault();
    $('#pollone').fadeIn();
    $('#polltwo').fadeOut();
  });
  
  $('#pollbtn-2').on('click',function (e) { 
    e.preventDefault();
    $('#pollone').fadeOut();
    $('#polltwo').fadeIn();
  });
  
  $('.dis-btn').click(function(){
    $(this).addClass('disabled');
  });
  
  $('.admin-dlt-modal').on('click',function (e) { 
    e.preventDefault();
    $('.modal-fixed-delete').fadeIn();
    
  });
  
  $('.dlt-btn-close').on('click',function (e) { 
    e.preventDefault();
    $('.modal-fixed-delete').fadeOut();
    
  });
  $('.admin-spam-modal').on('click',function (e) { 
    e.preventDefault();
    $('.modal-fixed-spams').fadeIn();
    
  });
  
  $('.spam-btn-close').on('click',function (e) { 
    e.preventDefault();
    $('.modal-fixed-spams').fadeOut();
    
  });
  
  // chart Slide
  
  $( ".mChartBtn" ).click(function() {
    $(this).removeClass('btn-outline-primary').addClass('btn-primary');
    $(".yChartBtn").removeClass('btn-primary').addClass('btn-outline-primary');
    $( ".monthChart" ).slideDown( "slow");
    $( ".yearChart" ).fadeOut( "slow");
  });
  
  $( ".yChartBtn" ).click(function() {
    $(this).removeClass('btn-outline-primary').addClass('btn-primary');
    $(".mChartBtn").removeClass('btn-primary').addClass('btn-outline-primary');
    $( ".monthChart" ).fadeOut( "slow");
    $( ".yearChart" ).slideDown( "slow");
  });
  
  // panel chekbox 
  
  $('.typeofcheckbox').on('change', function() {
    $('.typeofcheckbox').not(this).prop('checked', false);  
  });
  $('.statuscheckbox').on('change', function() {
    $('.statuscheckbox').not(this).prop('checked', false);  
  });
  
  // add active class to sidebar _items
  
  // $(".items-addactive").on('focus',function () {
  //   $(".items-addactive").removeClass("active");
  //   $(this).addClass("active");     
  // });


  $("#sidebarNav a")
  .click(function(e) {
      var link = $(this);

      var item = link.parent("li");
      
      if (item.hasClass("active")) {
          item.removeClass("active").children("a").removeClass("active");
      } else {
          item.addClass("active").children("a").addClass("active");
      }

      if (item.children("ul").length > 0) {
          var href = link.attr("href");
          link.attr("href", "#");
          setTimeout(function () { 
              link.attr("href", href);
          }, 300);
          e.preventDefault();
      }
  })
  .each(function() {
      var link = $(this);
      if (link.get(0).href === location.href) {
          link.addClass("active").parents("li").addClass("active");
          return false;
      }
  }); 


  
  
  

















});








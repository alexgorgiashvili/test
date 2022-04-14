    
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

  
  
     




    
 $("#pollbtn-1").on('click',function (e) { 
    e.preventDefault();
    $("#pollone").fadeIn();
    $("#polltwo").fadeOut();
});

$("#pollbtn-2").on('click',function (e) { 
    e.preventDefault();
    $("#pollone").fadeOut();
    $("#polltwo").fadeIn();
});

$(".dis-btn").click(function(){
    $(this).addClass("disabled");
  });

  
  
     




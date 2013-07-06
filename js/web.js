// menu controls

var menu_timer, current_id, child_id;
var i, left_px, menu_count;

$(document).ready(function(){

  // how many menu entries is here
  
  menu_count = $(".menuentry").length;

  // submenus should be under their parents, so we have to move them right a bit

  i = 1;  
  left_px = 0;
  while (i < menu_count)
  {
    left_px += parseInt($(".menutitle").eq(i-1).css('width'));
    $(".submenu").eq(i).css("left",left_px);
    i++;
  }
  
  // showing and hiding of submenus

  $(".menuentry").mouseenter(function () {
    if (current_id == $(this).attr('id'))
      clearTimeout(menu_timer);
    else
      $(".submenu").fadeOut("50");  
        
    current_id = $(this).attr('id');
    $(this).children(".submenu").fadeIn("50");
  });
  $(".menuentry").mouseleave(function () {  
    child_id = $(this).children(".submenu").attr('id');      
    menu_timer = setTimeout('$("#"+child_id).fadeOut("50");',100);    
  });
});


// leftbox - top news controls

var topnews_timer, images_count;
var j = 0;

// control arrows

$(document).ready(function(){
  $(".arrow_left_big").mouseenter(function () {
    $(this).fadeTo("medium",1);
  });
  $(".arrow_left_big").mouseleave(function () {
    $(this).fadeTo("medium",0.4);
  }); 
  
    $(".arrow_right_big").mouseenter(function () {
    $(this).fadeTo("medium",1);
  });
  $(".arrow_right_big").mouseleave(function () {
    $(this).fadeTo("medium",0.4);
  }); 
});

// click and timer controls

$(document).ready(function(){
  images_count = $(".top_news_logo").length;

  // this will start auto change of images
  setTopnewsTimer();

  $(".arrow_right_big").click(function () {
    changeImage("forth");
    clearTimeout(topnews_timer);
    setTopnewsTimer();
  });
  $(".arrow_left_big").click(function () {
    changeImage("back");
    clearTimeout(topnews_timer);
    setTopnewsTimer();
  });
  
  $(".top_news_logo").mouseenter(function () {
    clearTimeout(topnews_timer);
  });
  
  $(".top_news_logo").mouseleave(function () {
    setTopnewsTimer();
  });

  
});

function setTopnewsTimer()
  {
  topnews_timer = setTimeout("changeImage('forth');setTopnewsTimer()",5000);
  }

  
function changeImage(direction)
  {
  if (direction == "forth") {
    if (j < images_count-1) {
      j++; 
    } else {
      j = 0;
    }
  }
  
  else {
     if(j > 0){
        j--;
      }
      else{
        j = images_count - 1; 
      }
  }
    
  $(".top_news_logo").fadeOut("slow");
  $(".top_news_logo").eq(j).fadeIn("slow");    
  }
  

// rightbox controls

var rightbox_timer, rightbox_count;
var k = 0;

// control arrows

$(document).ready(function(){
  $(".arrow_left_small").mouseenter(function () {
    $(this).fadeTo("medium",1);
  });
  $(".arrow_left_small").mouseleave(function () {
    $(this).fadeTo("medium",0.4);
  }); 
  
    $(".arrow_right_small").mouseenter(function () {
    $(this).fadeTo("medium",1);
  });
  $(".arrow_right_small").mouseleave(function () {
    $(this).fadeTo("medium",0.4);
  }); 
});


// click and timer controls

$(document).ready(function(){
  rightbox_count = $(".rightbox_text").length;

  // this will start auto change of images
  setRightboxTimer();

  $(".arrow_right_small").click(function () {
    changeRightbox("forth");
    clearTimeout(rightbox_timer);
    setRightboxTimer();
  });
  $(".arrow_left_small").click(function () {
    changeRightbox("back");
    clearTimeout(rightbox_timer);
    setRightboxTimer();
  });
  
  $(".rightbox_text").mouseenter(function () {
    clearTimeout(rightbox_timer);
  });
  
  $(".rightbox_text").mouseleave(function () {
    setRightboxTimer();
  });

  
});

function setRightboxTimer()
  {
  rightbox_timer = setTimeout("changeRightbox('forth');setRightboxTimer()",5000);
  }

  
function changeRightbox(direction)
  {
  if (direction == "forth") {
    if (k < rightbox_count-1) {
      k++; 
    } else {
      k = 0;
    }
  }
  
  else {
     if(k > 0){
        k--;
      }
      else{
        k = rightbox_count - 1; 
      }
  }
    
  $(".rightbox_text").fadeOut("slow");
  $(".rightbox_text").eq(k).fadeIn("slow");    
  }
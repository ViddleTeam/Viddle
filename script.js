/**
 * 
 *       Viddle
 * All rights reserved!
 * 
 */
let premiere = 0;

function loaded() {
  setTimeout(showPage, 500);
}

function showPage() {
  $(".loader").animate({opacity: 0}, 500, ()=>{
    $('.loader').css({display: 'none'});
  });
  $(".website").animate({opacity: 1}, 500);
}

function uploadCheck() {
  if (premiere == 0) {
    $('.upload-one').css({transform: 'translateY(-5px)'}, 300);
    $('.upload-two').css({transform: 'translateY(0)'}, 300);
    $('#getDate').css({display: 'none'});
    $('#getTime').css({display: 'none'});
  } else {
    $('.upload-one').css({transform: 'translateY(0)'}, 300);
    $('.upload-two').css({transform: 'translateY(-5px)'}, 300);
    $('#getDate').css({display: 'block'});
    $('#getTime').css({display: 'block'});
  }
}
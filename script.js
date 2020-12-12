/**
 * 
 *        VDP
 * All rights reserved!
 * 
 */
function loaded() {
  setTimeout(showPage, 500);
}
function showPage() {
  $(".loader").animate({opacity: 0}, 500, ()=>{
    $('.loader').css({display: 'none'});
  });
  $(".website").animate({opacity: 1}, 500);
}
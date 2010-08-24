var $j = jQuery.noConflict();
$j(function(){
  //Get our elements for faster access and set overlay width
  var div = $j('div.sc_menu'),
               ul = $j('ul.sc_menu'),
               // unordered list's left margin
               ulPadding = 15;
 
  //Get menu width
  var divWidth = div.width();
 
  //Remove scrollbars
  div.css({overflow: 'hidden'});
 
  //Find last image container
  var lastLi = ul.find('li:last-child');
 
  //When user move mouse over menu
  div.mousemove(function(e){
 
    //As images are loaded ul width increases,
    //so we recalculate it each time
    var ulWidth = lastLi[0].offsetLeft + lastLi.outerWidth() + ulPadding;
 
    var left = (e.pageX - div.offset().left) * (ulWidth-divWidth) / divWidth;
    div.scrollLeft(left);
  });
});

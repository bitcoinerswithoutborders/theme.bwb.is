//~ function toggleControls (video, e) {
  //~ var event = e || window.event;
//~ 
  //~ if (video.hasAttribute("controls")) {
     //~ video.removeAttribute("controls")   
  //~ } else {
     //~ video.setAttribute("controls","controls")   
  //~ }
  //~ if (event.stopPropagation) {
    //~ event.stopPropagation();
  //~ } else {
    //~ event.cancelBubble = true;
  //~ }
//~ }
//~ 
//~ window.onload = function() {
  //~ var video = document.getElementById('player')
    //~ , menuContainer = document.getElementById('menu-container')
    //~ , menu_hovered = false;
//~ 
  //~ if ( video && menuContainer ) {
    //~ menuContainer.onmouseover = function () {
      //~ menu_hovered = true;
    //~ }
    //~ menuContainer.onmouseout = function () {
      //~ window.setTimeout(function() {
        //~ menu_hovered = false;
      //~ }, 200);
    //~ }
    //~ 
    //~ video.onmouseover = function (evt) {
      //~ console.log('menu hovered = ' + menu_hovered);
      //~ if ( ! menu_hovered ) {
        //~ toggleControls(video, evt);
      //~ }
      //~ return false;
    //~ }
//~ 
    //~ video.onmouseout = function (evt) {
      //~ toggleControls(video, evt);
      //~ return false;
    //~ }
  //~ }
//~ }

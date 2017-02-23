
window.addEventListener("load",function load(event){
  window.removeEventListener("load", load, false); //remove listener, no longer needed
  menu.init();
});

var menu = {
  isClosed: true,
  toggle: function(e){
    if ( e === undefined ){
      e = this ;
    }
    if( menu.isClosed == true){
      e.setAttribute("aria-expanded","true") ;
      menu.isClosed = false ;
    } else {
      e.setAttribute("aria-expanded","false") ;
      menu.isClosed = true ;
    }
  },
  init: function() {
    var mainMenu = document.querySelector("header > nav") ;
    document.getElementById("main-menu-button").addEventListener("click",function(){menu.toggle(mainMenu);});
  }
} ;

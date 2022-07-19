document.addEventListener("DOMContentLoaded", function () {

    var icon = document.querySelector('.icon');
  
    icon.addEventListener("click", function(){
      var nav = document.getElementById("myTopnav");
  
      if (nav.className === "topnav") {
        nav.className += " responsive";
      } else {
        nav.className = "topnav";
      }
    });

 
  
  });
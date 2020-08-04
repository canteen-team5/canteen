function confirmationDelete(anchor){
  var conf = confirm('Are you sure want to delete this category?');
  if(conf)
    window.location=anchor.attr("href");
}

function mobile_icon(){
  document.getElementById("nav_mobile").style.display = "flex";
}

  function mobile_icon_off() {
    var x = window.matchMedia("(max-width: 780px)")
    if (x.matches) { // If media query matches
      document.getElementById("nav_mobile").style.display = "none";
    }
  }

  /*function myFunction(x) {
    if (x.matches) { // If media query matches
      mobile_icon();
    } 
  }
  
  var x = window.matchMedia("(min-width: 800px)")
  myFunction(x) // Call listener function at run time
  x.addListener(myFunction)*/
// validating registration form
function checkSignUp() {
    var roll_no = document.getElementById("roll_no").value;
    var fname = document.getElementById("fname").value;
    var lname = document.getElementById("lname").value;
    var email_id = document.getElementById("email_id").value;
    var mobile_no = document.getElementById("mobile_no").value;
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;
    var picture = document.getElementById("picture").value;

    if(roll_no == null || roll_no == "") {
      window.alert("Please enter Roll no!");
      document.getElementById("roll_no").focus();
      return false;
    }
    else if(!roll_no.match(/[1-9][0-9]{2,10}/)){
      window.alert("Roll no. must contain only number and should be greater than equal to 3 and less than 11");
      document.getElementById("roll_no").focus();
      return false;
    }

    else if(fname == null || fname == "") {
      window.alert("Please enter First Name!");
      document.getElementById("fname").focus();
      return false;
    }
    else if(!fname.match(/[A-Z][a-zA-Z ]{2,19}/)){
      window.alert("First name must contain only alphabets and should be greater than equal to 3 and less than 20");
      document.getElementById("fname").focus();
      return false;
    }

    else if(lname == null || lname == "") {
      window.alert("Please enter Last Name!");
      document.getElementById("lname").focus();
      return false;
    }
    else if(!lname.match(/[A-Z][a-zA-Z ]{2,19}/)){
      window.alert("Last name must contain only alphabets and should be greater than equal to 3 and less than 20");
      document.getElementById("lname").focus();
      return false;
    }

    else if(email_id == null || email_id == "") {
      window.alert("Please enter your Email Id!");
      document.getElementById("email_id").focus();
      return false;
    }
    else if(!email_id.match(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/)){
      window.alert("Inavlid email format");
      document.getElementById("email_id").focus();
      return false;
    }

    else if(mobile_no == null || mobile_no == "") {
      window.alert("Please enter your Mobile Number!");
      document.getElementById("mobile_no").focus();
      return false;
    }
    else if(!mobile_no.match(/[6-9]\d{9}/)){
      window.alert("Mobile number should be 10 digits long and must start with 6-9");
      document.getElementById("mobile_no").focus();
      return false;
    }

    else if(username == null || username == "") {
      window.alert("Please enter Username!");
      document.getElementById("username").focus();
      return false;
    }
    else if(!username.match(/[\w@&%$]{5,20}/)){
      window.alert("Username should be 5 to 20 characters long and must only contain alphabets, numbers and @,%,$,&");
      document.getElementById("username").focus();
      return false;
    }

    else if(password == null || password == "") {
      window.alert("Please enter Password!");
      document.getElementById("password").focus();
      return false;
    }
    else if(!password.match(/[\w@&%$]{5,20}/)){
      window.alert("Password should be 5 to 20 characters long and must only contain alphabets, numbers and @,%,$,&");
      document.getElementById("password").focus();
      return false;
    }

    else if(picture == null || picture == ""){
      window.alert("Please select your Photo!");
      document.getElementById("password").focus();
      return false;
    }

    return true;
  
}

//validating Login form
function checkLogin() {
  var username = document.getElementById("username").value;
  var password = document.getElementById("password").value;

  if(username == null || username == "") {
    window.alert("Please enter Username!");
    document.getElementById("username").focus();
    return false;
  }
  else if(!username.match(/[\w@&%$]{5,20}/)){
    window.alert("Username should be 5 to 20 characters long and must only contain alphabets, numbers and @,%,$,&");
    document.getElementById("username").focus();
    return false;
  }

  else if(password == null || password == "") {
    window.alert("Please enter Password!");
    document.getElementById("password").focus();
    return false;
  }
  else if(!password.match(/[\w@&%$]{5,20}/)){
    window.alert("Password should be 5 to 20 characters long and must only contain alphabets, numbers and @,%,$,&");
    document.getElementById("password").focus();
    return false;
  }

  return true;
}

//validating Change Password form
function checkChangePwd() {
  var oldpwd = document.getElementById("oldpwd").value;
  var newpwd = document.getElementById("newpwd").value;
  var confirmpwd = document.getElementById("confirmpwd").value;

  if(oldpwd == null || oldpwd == "") {
    window.alert("Please enter Old Password!");
    document.getElementById("oldpwd").focus();
    return false;
  }
  else if(!oldpwd.match(/[\w@&%$]{5,20}/)){
    window.alert("Old Password should be 5 to 20 characters long and must only contain alphabets, numbers and @,%,$,&");
    document.getElementById("oldpwd").focus();
    return false;
  }

  else if(newpwd == null || newpwd == "") {
    window.alert("Please enter New Password!");
    document.getElementById("newpwd").focus();
    return false;
  }
  else if(!newpwd.match(/[\w@&%$]{5,20}/)){
    window.alert("New Password should be 5 to 20 characters long and must only contain alphabets, numbers and @,%,$,&");
    document.getElementById("newpwd").focus();
    return false;
  }

  else if(confirmpwd == null || confirmpwd == "") {
    window.alert("Please enter Confirm Password!");
    document.getElementById("confirmpwd").focus();
    return false;
  }
  else if(!confirmpwd.match(/[\w@&%$]{5,20}/)){
    window.alert("Confirm Password should be 5 to 20 characters long and must only contain alphabets, numbers and @,%,$,&");
    document.getElementById("confirmpwd").focus();
    return false;
  }

  return true;
}

// Validating Add Product Form
function checkAddPrd() {
  var name = document.getElementById("name").value;
  var prc = document.getElementById("prc").value;
  var dsc = document.getElementById("description").value;
  var pic = document.getElementById("picture").value;
  var qty = document.getElementById("qty").value;

  if(name == null || name == "") {
    window.alert("Please enter Item name!");
    document.getElementById("name").focus();
    return false;
  }
  else if(!name.match(/[A-Z][a-zA-Z ]{2,19}/)){
    window.alert("Item name must contain only alphabets and should be greater than equal to 3 and less than 20");
    document.getElementById("name").focus();
    return false;
  }

  else if(prc == null || prc == "") {
    window.alert("Please enter Item price!");
    document.getElementById("prc").focus();
    return false;
  }
  else if(!prc.match(/[1-9][0-9]{0,10}/)){
    window.alert("Price must not be zero");
    document.getElementById("prc").focus();
    return false;
  }

  else if(dsc == null || dsc == "") {
    window.alert("Please enter Item description!");
    document.getElementById("description").focus();
    return false;
  }
  else if(!dsc.match(/[A-Z][a-zA-Z ]{4,500}/)){
    window.alert("Item description must contain only alphabets and should be greater than equal to 5 and less than 500");
    document.getElementById("description").focus();
    return false;
  }

  else if(pic == null || pic == "") {
    window.alert("Please enter Item picture!");
    document.getElementById("picture").focus();
    return false;
  }

  if(qty == null || qty == "") {
    window.alert("Please enter Item Quantity!");
    document.getElementById("qty").focus();
    return false;
  }
  else if(!qtyprc.match(/[1-9][0-9]{0,10}/)){
    window.alert("Quantity must not be zero");
    document.getElementById("qty").focus();
    return false;
  }

  return true;
}

//validating Category Form 
function checkCat() {
  var name = document.getElementById("name").value;

  if(name == null || name == "") {
    window.alert("Please enter Category name!");
    document.getElementById("name").focus();
    return false;
  }
  else if(!name.match(/[A-Z][a-zA-Z ]{2,19}/)){
    window.alert("Category name must contain only alphabets and should be greater than equal to 3 and less than 20");
    document.getElementById("name").focus();
    return false;
  }

  return true;
}


function confirmationCatDelete(anchor){
  var conf = confirm('Are you sure want to delete this category?');
  if(conf)
    window.location=anchor.attr("href");
}

function confirmationPrdDelete(anchor){
  var conf = confirm('Are you sure want to delete this product?');
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
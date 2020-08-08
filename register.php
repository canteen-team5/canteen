<?php
  
  include('header.php');
  $rollno = $fname = $lname = $gender = $email = $mobile = $usrpic = $usrname = $usrpwd = $err = $msg = "";

  if(isset($_POST["submit"])){
    $rollno = secure($_POST["roll_no"]);
    $fname = secure($_POST["firstname"]);
    $lname = secure($_POST["lastname"]);
    $gender = secure($_POST["gender"]);
    $email = secure($_POST["email"]);
    $mobile = secure($_POST["mobile_no"]);
    $usrpic = $rollno.$_FILES["picture"]["name"];
    $usrname = secure($_POST["user_name"]);
    $usrpwd = secure($_POST["password"]);
    
    // validating Form
    if($rollno == "")
      $err = "Please enter Roll no!";
    elseif(!preg_match("/^[1-9][0-9]{2,10}$/", $rollno))
      $err = "Roll no. must contain only number and should be greater than equal to 3 and less than 11";

    elseif($fname == "")
      $err = "Please enter First Name!";
    elseif(!preg_match("/^[A-Z][a-zA-Z ]{2,19}$/", $fname))
      $err = "First name must contain only alphabets and should be greater than equal to 3 and less than 20";

    elseif($lname == "")
      $err = "Please enter Last Name!";
    elseif(!preg_match("/^[A-Z][a-zA-Z ]{2,19}$/", $lname))
      $err = "Last name must contain only alphabets and should be greater than equal to 3 and less than 20";

    elseif($gender == "")
      $err = "Please select gender!";

    elseif($email == "")
      $err = "Please enter your email!";
    elseif(!filter_var($email, FILTER_VALIDATE_EMAIL))
      $err = "Inavlid email format";

    elseif($mobile == "")
      $err = "Please enter Mobile Number!";
    elseif(!preg_match("/^[6-9]\d{9}$/", $mobile))
      $err = "Mobile number should be 10 digits long and must start with 6-9";

    elseif($usrname == "")
      $err = "Please enter Username!";
    elseif(!preg_match("/^[\w@&%$]{5,20}$/", $usrname))
      $err = "Username should be 5 to 20 characters long and must only contain alphabets, numbers and @,%,$,&";

    elseif($usrpwd == "")
      $err = "Please enter Password!";
    elseif(!preg_match("/^[\w@&%$]{5,20}$/", $usrpwd))
      $err = "Password should be 5 to 20 characters longand must only contain alphabets, numbers and @,%,$,&";

    elseif($usrpic == "") 
      $err = "Please input your picture!";

    else{
      $sql = "call insusr($rollno, '$fname', '$lname', '$usrpic', '$mobile', '$email', '$gender', '$usrname', '$usrpwd')";
      if ($conn->query($sql) === TRUE) {
        if($usrpic!="")
        move_uploaded_file ($_FILES["picture"]["tmp_name"],"stupics/".$rollno.$_FILES["picture"]["name"]);
        $msg = "Registration successful";
        //header('location:index.php');
      } else $err =  $conn->error;

    }
    //if($err != "") echo $err;
    
  }
  function secure($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Canteen</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Damion' rel='stylesheet' type='text/css'>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/templatemo-style.css" rel="stylesheet">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon"/>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <style>
      body{
        background: #e4e4e4;
      }
      h2{
        font-size: 40px;
      }
      
    </style>
  </head>
  <body>

    <!----------------- Header ------------------------>
    <header class="tm-top-header">
      <div class="container">
        <div class="row">
          <div class="tm-top-header-inner">
            <div class="tm-logo-container" onclick="mobile_icon_off()">
              <img src="img/logo.png" alt="Logo" class="tm-site-logo" width="50px" height="50px">
              <h1 class="tm-site-name tm-handwriting-font">Canteen</h1>
            </div>
            <div class="mobile-menu-icon" onclick="mobile_icon()">
              <i class="fa fa-bars"></i>
            </div>
            <nav class="tm-nav" id="nav_mobile">
              <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="menu.php">Menu</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="cart.php">Cart</a></li>
                <li><a href="login.php">Sign In</a></li>               
              </ul>
            </nav>   
          </div>           
        </div>    
      </div>
    </header>

    <!----------------- Alert Box -------------------------------->
    <?php 

      if(!$err == "")
      echo '<div class="err"> '.$err.' </div>';
    
      if(!$msg == "")
        echo '<div class="msg"> '.$msg.' </div>';
    ?>

    <!----------------- Registration Form ------------------------>
    <section class="border" onclick="mobile_icon_off()">
      <h1 style="text-align: center; font-size: 40px; margin: 20px 0 30px; width: 85%;">Registeration Form</h1>

      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data" class="add">
        <div class="row">
          <div class="col-25">
            <label for="roll no">Roll No</label>
          </div>
          <div class="col-75">
            <input type="text" id="roll no" name="roll_no" placeholder="Your roll no.." value="<?php echo $rollno;?>">
          </div>
        </div>

        <div class="row">
          <div class="col-25">
            <label for="fname">First Name</label>
          </div>
          <div class="col-75">
            <input type="text" id="fname" name="firstname" placeholder="Your first name.." value="<?php echo $fname;?>">
          </div>
        </div>
        
        <div class="row">
          <div class="col-25">
            <label for="lname">Last Name</label>
          </div>
          <div class="col-75">
            <input type="text" id="lname" name="lastname" placeholder="Your last name.." value="<?php echo $lname;?>">
          </div>
        </div>
        
        <div class="row">
          <div class="col-25">
            <label for="gender">Gender</label>
          </div>
          <div class="col-75">
            <input type="radio" id="male" name="gender" value="Male" checked>
            <label for="male">Male</label>
            <input type="radio" id="female" name="gender" value="Female" <?php if($gender == "Female")echo "checked";?>>
            <label for="female">Female</label>
            <input type="radio" id="other" name="gender" value="Other" <?php if($gender == "Other")echo "checked";?>>
            <label for="other">Other</label>
          </div>
        </div>

        <div class="row">
          <div class="col-25">
            <label for="email">Email</label>
          </div>
          <div class="col-75">
            <input type="email" id="email_id" name="email" placeholder="Your email-id.." value="<?php echo $email;?>">
          </div>
        </div>

        <div class="row">
          <div class="col-25">
            <label for="mobile no">Mobile No</label>
          </div>
          <div class="col-75">
            <input type="text" id="mobile_no" name="mobile_no" placeholder="Your mobile no.." value="<?php echo $mobile;?>">
          </div>
        </div>

        <div class="row">
          <div class="col-25">
            <label for="item_picture">Image</label>
          </div>
          <div class="col-75">
            <input type="file"  name="picture" placeholder="Choose File" value="<?php echo $usrpic;?>">
          </div>
        </div>

        <div class="row">
          <div class="col-25">
            <label for="user name">User Name</label>
          </div>
          <div class="col-75">
            <input type="text" id="user name" name="user_name" placeholder="Your user name.." value="<?php echo $usrname;?>">
          </div>
        </div>

        <div class="row">
          <div class="col-25">
            <label for="password">Password</label>
          </div>
          <div class="col-75">
            <input type="password" id="password" name="password" placeholder="Your Password..">
          </div>
        </div>
        
        <div class="row">
          <input type="submit" value="Submit" name="submit">
        </div>
      </form>
    </section>

    <!-------------------- Footer content--------------------------> 
    <?php
      include('footer.html');
    ?>
     
  </body>
</html>
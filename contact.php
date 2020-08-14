<?php
  include('header.php');
?>

<!DOCTYPE html>
<html lang="en">
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
        .tm-section{
          padding: 5em;
          margin: 0;
        }
        form{
          display: flow-root;
        margin: auto;
        }
        .input{
          display: flow-root;
        width: 60%;
        margin: auto; 
        }
        #contact_message {
          width: 100%;
          padding: 12px;
          border: 1px solid #ccc;
          border-radius: 4px;
          resize: vertical;
        }
        .form-group{
          margin: 0 auto 10px;
        }
        .form-control , button.tm-more-button{
          margin: auto;
        }
        .dropdown-menu>li>a {
        display: block;
        padding: 3px 20px;
        clear: both;
        font-weight: 400;
        line-height: 1.42857143;
        color: #333;
        white-space: nowrap;
      }
      .dropdown-menu>li>a:hover{
        color: black;
        background-color: #e4e4e4;
      }
      .dropdown-menu>li:hover{
        color: grey;
      }
      .dropdown-menu>li>a>form>button {
        display: block;
        clear: both;
        font-weight: 400;
        line-height: 1.42857143;
        color: #333;
        white-space: nowrap;
        border: 0;
        background: transparent;
        padding: 0;
      }
      @media screen and (max-width: 767px){
      .input{
        width: 100%;
      }
      .tm-section {
        padding: 1em;
      }
    }
    </style>
  </head>


  <body>
    <div class="tm-top-header">
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
                <li><a href="contact.php" class="active">Contact</a></li>
                <li><a href="cart.php">Cart</a></li>
                
                <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-user" aria-hidden="true" style="font-size:20px;"> </i> <span class="caret"></span></a>
                  <ul class="dropdown-menu"> 
                    <?php 
                      if(isset($_SESSION["ucod"])){
                        echo '<li><a href="viewprofile.php">View Profile</a></li>
                        <li><a href="myord.php">My Orders</a></li>
                        <li><a href="changepwd.php">Change Password</a></li>
                        <li><a> <form action="index.php" method="post">
                          <button type="submit" name="logout"> Logout </button> 
                        </form> </a></li>';
                      }
                      else
                        echo '<li><a href="login.php">Sign In</a></li>
                        <li><a href="register.php">Sign Up</a></li>';
                    ?>
                  </ul>
                </li>

              </ul>
            </nav>   
          </div>           
        </div>    
      </div>
    </div>


    <section class="tm-welcome-section" onclick="mobile_icon_off()">
      <div class="container tm-position-relative">
        <div class="tm-lights-container">
          <img src="img/light.png" alt="Light" class="light light-1">
          <img src="img/light.png" alt="Light" class="light light-2">
          <img src="img/light.png" alt="Light" class="light light-3">  
        </div>        
        <div class="row tm-welcome-content">
          <h2 class="white-text tm-handwriting-font tm-welcome-header"><img src="img/header-line.png" alt="Line" class="tm-header-line">&nbsp;Contact Us&nbsp;&nbsp;<img src="img/header-line.png" alt="Line" class="tm-header-line"></h2>
        </div>
        <img src="img/table-set.png" alt="Table Set" class="tm-table-set img-responsive">            
      </div>      
    </section>


    <div class="tm-main-section light-gray-bg" onclick="mobile_icon_off()">
      <div class="container" id="main">
        <section class="tm-section row">

          <form action="#" method="post" class="tm-contact-form">
              <h2 class="col-lg-12 margin-bottom-30">Send us a message</h2>
            <div class="input">
              <div class="form-group">
                <input type="text" id="contact_name" class="form-control" placeholder="NAME" />
              </div>
              <div class="form-group">
                <input type="email" id="contact_email" class="form-control" placeholder="EMAIL" />
              </div>
              <div class="form-group">
                <input type="text" id="contact_subject" class="form-control" placeholder="SUBJECT" />
              </div>
              <div class="form-group">
                <textarea id="contact_message" class="form-control" rows="6" placeholder="MESSAGE"></textarea>
              </div>
              <div class="form-group">
                <button class="tm-more-button" type="submit" name="submit">Send message</button> 
              </div>               
            </div>
          </form>
        </section>
      </div>
    </div> 


    <?php
      include('footer.html');
    ?>

  </body>
</html>
<?php
  session_start();
  include('conn.php');

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
      .tm-section-header-container{
        margin: 30px auto 0;
      }
      span.bttn{
        width: 100%;
      margin: 10px 5px 0;
      }
      .tm-product img{
        width: 150px;
      height: 150px;
      }
      .bttn a{
        width: 100%;
      }
      .bttn a:hover{
        background: #309034;
      }
      .tm-side-menu li{
        background: url(./img/tm-brown-button.png);
      background-size: cover;
      margin: 5px;
      padding: 10px;
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
      #btn{
        font-size: 25px;
        border: 0;
        background: #4CAF50;
        color: white;
        border-radius: 4px;
        padding: 0.3em 3em;
      }
    #btn:hover{
      background: #309034;
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
                <li><a href="menu.php" class="active">Menu</a></li>
                <li><a href="contact.php">Contact</a></li>
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
          <h2 class="white-text tm-handwriting-font tm-welcome-header"><img src="img/header-line.png" alt="Line" class="tm-header-line">&nbsp;Our Menu&nbsp;&nbsp;<img src="img/header-line.png" alt="Line" class="tm-header-line"></h2>
        </div>
        <img src="img/table-set.png" alt="Table Set" class="tm-table-set img-responsive">  
      </div>      
    </section>

    <div class="tm-main-section light-gray-bg" onclick="mobile_icon_off()">
      <div class="container" id="main">  
        <section class="tm-section row">

          <div class="col-lg-12 tm-section-header-container margin-bottom-30">
            <h2 class="tm-section-header gold-text tm-handwriting-font"><img src="img/logo.png" alt="Logo" class="tm-site-logo" width="50px" height="50px"> Search here..  </h2>
            <div class="tm-hr-container"><hr class="tm-hr"></div>
          </div>

          <form action="menu.php" method="post"  class="add">
            <div class="row" style="width: 80%; margin:auto;">
              
              <div class="col-75">
                <input type="search" name="search" placeholder="Search...." value="" style="width: 90%;">
              </div>

              <div class="col-25">
                <button type="submit" name="btnsubmit" class="btn" id="btn">Search</button>
              </div>
            </div>
          </form>

          <?php
            if(isset($_POST["btnsubmit"])){
              $search = $_POST["search"];
              $search = htmlspecialchars($search);
              $search = mysqli_real_escape_string($conn, $search);
              if(strlen($search) > 2){
                $sql = "select * from tbmenu where (`foodname` like '%".$search."%')";
                $result = $conn->query($sql);
                echo '<div class="col-lg-12 tm-section-header-container margin-bottom-30">
                  <h2 class="tm-section-header gold-text tm-handwriting-font"><img src="img/logo.png" alt="Logo" class="tm-site-logo" width="50px" height="50px"> Search results  </h2>
                  <div class="tm-hr-container"><hr class="tm-hr"></div>
                  </div>';
                if($result->num_rows > 0){ 
                  while($row = $result->fetch_assoc()){
                    if($row["foodisavl"] == "True"){
                      echo '<div class="tm-product" >
                      <img src="prdpics/'.$row["foodpic"].' " alt="Product" >
                      <div class="tm-product-text">
                      <h3 class="tm-product-title">'.$row["foodname"].'</h3>
                      <p class="tm-product-description">'.$row["fooddsc"].'</p>
                      <span class="bttn"> <a href="cart.php?fcod='.$row["foodcod"].'&action=add ">Add to Cart</a></span></div>
                      <div class="tm-product-price">
                      <span class="tm-product-price-link tm-handwriting-font">₹'.$row["foodprc"].'</span>
                      </div>
                      </div>';
                    }
                  }
                } else echo "<div class='empty-cart'><p class='cat' ><span class='text'> No matching record found </span> </p>
                <p class='cat'> <span class='text'> <a href='menu.php'>Go to Menu</a> </span> </p></div>";
                $conn->close();
              }
            }
            else {
              echo'
                <div class="col-lg-12 tm-section-header-container margin-bottom-30" id="fullmenu">
                  <h2 class="tm-section-header gold-text tm-handwriting-font"><img src="img/logo.png" alt="Logo" class="tm-site-logo" width="50px" height="50px"> Our Menu  </h2>
                  <div class="tm-hr-container"><hr class="tm-hr"></div>
                </div>

                <div>
                  <div class="col-lg-3 col-md-3">
                    <div class="tm-position-relative margin-bottom-30">              
                      <nav class="tm-side-menu">
                        <ul>';
                            include('conn.php');
                            $i = 0;
                            $sql = "call dspmenu";
                            $result = $conn->query($sql);
                            if($result->num_rows > 0){
                              while($row = $result->fetch_assoc()){
                                if($row["foodisavl"] == "True"){
                                  $i++;
                                  echo '<li><a href="#itm'.$i.'">'.$row["foodname"].'</a></li>';
                                }
                              }
                            }
                            $conn->close();
                          echo'
                        </ul>              
                      </nav>    
                    </div>  
                  </div> 
                  
                  
                  <div class="tm-menu-product-content col-lg-9 col-md-9"> <!-- menu content -->';
                    $j = 0;
                    include('conn.php');
                    $sql = "call dspmenu";
                    $result = $conn->query($sql);
                    if($result->num_rows > 0){
                      while($row = $result->fetch_assoc()){
                        if($row["foodisavl"] == "True"){
                          $j++;
                          echo '<div class="tm-product" id="itm'.$j.'">
                          <img src="prdpics/'.$row["foodpic"].' " alt="Product" >
                          <div class="tm-product-text">
                          <h3 class="tm-product-title">'.$row["foodname"].'</h3>
                          <p class="tm-product-description">'.$row["fooddsc"].'</p>
                          <span class="bttn"> <a href="cart.php?fcod='.$row["foodcod"].'&action=add ">Add to Cart</a></span></div>
                          <div class="tm-product-price">
                          <span class="tm-product-price-link tm-handwriting-font">₹'.$row["foodprc"].'</span>
                          </div>
                          </div>';
                        }
                      }
                    } 
            }
          ?>
              
              </div>
            </div>
          </div>          
        </section>
      </div>
    </div> 


    <?php
      include('footer.html');
    ?>  
  
  </body>
</html>
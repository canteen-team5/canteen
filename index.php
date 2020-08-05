<?php
  session_start();
  include('conn.php');

  if(isset($_POST["logout"])){
    unset($_SESSION["ucod"]);
  }

  

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
      .tm-popular-item-img{
        width: 100%;
      }

      .tm-popular-item{
        margin-bottom: 0;
      }
      .pop_info{
        height: 600px;
        overflow: hidden;
      }
      .tm-popular-item-description{
        height: 260px;
        overflow: hidden;
      }
      .pop_dsc{
        height: 160px;
        overflow: auto;
      }
      .order-now-link:hover{
        border-color: #c79c60;
        color: #c79c60;
        text-decoration: none;
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
            <div class="mobile-menu-icon" id="mobile" onclick="mobile_icon()" >
              <i class="fa fa-bars" ></i>
            </div>
            <nav class="tm-nav" id="nav_mobile">
              <ul>
                <li><a href="index.php" class="active">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="menu.php">Menu</a></li>
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


    <section class="tm-welcome-section"  onclick="mobile_icon_off()">
      <div class="container tm-position-relative">
        <div class="tm-lights-container">
          <img src="img/light.png" alt="Light" class="light light-1">
          <img src="img/light.png" alt="Light" class="light light-2">
          <img src="img/light.png" alt="Light" class="light light-3">  
        </div>        
        <div class="row tm-welcome-content">
          <h2 class="white-text tm-handwriting-font tm-welcome-header"><img src="img/header-line.png" alt="Line" class="tm-header-line">&nbsp;Welcome To&nbsp;&nbsp;<img src="img/header-line.png" alt="Line" class="tm-header-line"></h2>
          <h2 class="gold-text tm-welcome-header-2">Canteen</h2>
          <p class="gray-text tm-welcome-description">The <span class="gold-text">canteen</span> is very big and could accommodate many student at a time. Our<span class="gold-text"> canteen</span> provide many kinds of food .Many student came here to have the food. The cook of our canteen are very nice and they make sure that we student get the best food. </p>
                
        </div>
        <img src="img/table-set.png" alt="Table Set" class="tm-table-set img-responsive">             
      </div>      
    </section>


    <div class="tm-main-section light-gray-bg"  onclick="mobile_icon_off()">
      <div class="container" id="main">

        <section class="tm-section row">
          <div class="col-lg-9 col-md-9 col-sm-8">
            <h2 class="tm-section-header gold-text tm-handwriting-font">The Best Canteen for you</h2>
            <h2>Canteen</h2>
            <p class="tm-welcome-description">Our<span class="blue-text"> canteen</span> is very well equipped. One can buy almost every kind of snack there, like samosas, chips, sandwiches, sweet, cakes etc. They are prepared in very hygienic surroundings by our school cook, and tables to sit on and eat, and ovens to keep the food warm. There is also a soda fountain which is Very popular among the older students.</p> 
          </div>
          <div class="col-lg-3 col-md-3 col-sm-4 tm-welcome-img-container">
            <div class="inline-block shadow-img">
              <img src="img/images.jfif" alt="Image" class="img-circle img-thumbnail">  
            </div>              
          </div>            
        </section>    

        <section class="tm-section tm-section-margin-bottom-0 row">

          <div class="col-lg-12 tm-section-header-container">
            <h2 class="tm-section-header gold-text tm-handwriting-font"><img src="img/logo.png" alt="Logo" class="tm-site-logo" width="50px" height="50px"> Popular Items</h2>
            <div class="tm-hr-container"><hr class="tm-hr"></div>
          </div>

          <div class="col-lg-12 tm-popular-items-container">
            <?php
              $sql_disp = "select * from tbmenu where foodispopular='yes' ";
              $result_disp = $conn->query($sql_disp); 
              $i = 0;
              if($result_disp->num_rows > 0){
                while ($row = $result_disp->fetch_assoc()){
                  echo '<div class="tm-popular-item-row">
                  <div class="tm-popular-item">
                    <div class="pop_info">
                      <img src="img/'.$row["foodpic"].'" alt="Popular" class="tm-popular-item-img"width="286px" height="286px">
                      <div class="tm-popular-item-description">
                        <h3 class="tm-handwriting-font tm-popular-item-title"><span class="tm-handwriting-font bigger-first-letter"></span>'.$row["foodname"].'</h3><hr class="tm-popular-item-hr">
                        <p class="pop_dsc">'.$row["fooddsc"].'</p>
                      </div>
                    </div>
                  </div>
                  <div class="order-now-container">
                        <a href="cart.php?fcod='.$row["foodcod"].'&action=add " class="order-now-link tm-handwriting-font">Order Now</a>
                      </div>              
                </div>';
                  $i++;
                  if($i == 3) break;
                }
              } else echo "<p class='cat' ><span class='text'> No record found </span> </p>";
              $conn->close();
            ?>  

          </div>          
        </section>
        
        <section class="tm-section tm-section-margin-bottom-0 row"  onclick="mobile_icon_off()">
          <div class="col-lg-12 tm-section-header-container">
            <h2 class="tm-section-header gold-text tm-handwriting-font"><img src="img/logo.png" alt="Logo" class="tm-site-logo" width="50px" height="50px"> Go to Menu</h2>
            <div class="tm-hr-container"><hr class="tm-hr"></div>
          </div>
          <div class="container">
            <a class="menu_page" href = "menu.php">
              <img src="./img/menu.jpg" alt="Menu">
            </a>
          </div>
        </section>

      </div>
    </div> 


    <?php
      include('footer.html');
    ?>
    
  </body>
</html>
 
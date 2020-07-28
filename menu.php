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
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Damion' rel='stylesheet' type='text/css'>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/templatemo-style.css" rel="stylesheet">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />


    <style>
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
      .tm-side-menu li{
        background: url(./img/tm-brown-button.png);
      background-size: cover;
      margin: 5px;
      padding: 10px;
      }
    </style>
  </head>

  <body>
    <div class="tm-top-header">
      <div class="container">
        <div class="row">
          <div class="tm-top-header-inner">
            <div class="tm-logo-container">
              <img src="img/logo.png" alt="Logo" class="tm-site-logo" width="50px" height="50px">
              <h1 class="tm-site-name tm-handwriting-font">Canteen</h1>
            </div>
            <div class="mobile-menu-icon">
              <i class="fa fa-bars"></i>
            </div>
            <nav class="tm-nav">
              <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="#" class="active">Menu</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="cart.php">Cart</a></li>
              </ul>
            </nav>   
          </div>           
        </div>    
      </div>
    </div>

    <section class="tm-welcome-section">
      <div class="container tm-position-relative">
        <div class="tm-lights-container">
          <img src="img/light.png" alt="Light" class="light light-1">
          <img src="img/light.png" alt="Light" class="light light-2">
          <img src="img/light.png" alt="Light" class="light light-3">  
        </div>        
        <div class="row tm-welcome-content">
          <h2 class="white-text tm-handwriting-font tm-welcome-header"><img src="img/header-line.png" alt="Line" class="tm-header-line">&nbsp;Our Menus&nbsp;&nbsp;<img src="img/header-line.png" alt="Line" class="tm-header-line"></h2>
        </div>
        <img src="img/table-set.png" alt="Table Set" class="tm-table-set img-responsive">  
      </div>      
    </section>

    <div class="tm-main-section light-gray-bg">
      <div class="container" id="main">  
        <section class="tm-section row">
          <div class="col-lg-12 tm-section-header-container margin-bottom-30">
            <h2 class="tm-section-header gold-text tm-handwriting-font"><img src="img/logo.png" alt="Logo" class="tm-site-logo" width="50px" height="50px"> Our Menus</h2>
            <div class="tm-hr-container"><hr class="tm-hr"></div>
          </div>
          <div>
            <div class="col-lg-3 col-md-3">
              <div class="tm-position-relative margin-bottom-30">              
                <nav class="tm-side-menu">
                  <ul>
                    <?php
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
                    ?>
                  </ul>              
                </nav>    
              </div>  
            </div> 
            
            
            <div class="tm-menu-product-content col-lg-9 col-md-9"> <!-- menu content -->
            <?php 
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
            ?>
              
              </div>
            </div>
          </div>          
        </section>
      </div>
    </div> 


    <footer>
        <div class="container">
          <div class="row tm-copyright">
           <p class="col-lg-12 small copyright-text text-center">Copyright &copy; 2084 Your Canteen</p>
          </div>  
        </div>
    </footer> <!-- Footer content-->  
  
  </body>
</html>
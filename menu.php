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
          <h2 class="gold-text tm-welcome-header-2">Canteen</h2>
          <p class="gray-text tm-welcome-description">The <span class="gold-text">canteen</span> is very big and could accommodate many student at a time. Our<span class="gold-text"> canteen</span> provide many kinds of food .Many student came here to have the food. The cook of our canteen are very nice and they make sure that we student get the best food. </p>     
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
                      $sql = "call dspmenu";
                      $result = $conn->query($sql);
                      if($result->num_rows > 0){
                        while($row = $result->fetch_assoc()){
                          echo '<li><a href="#">'.$row["foodname"].'</a></li>';
                        }
                      }
                      $conn->close();

                    ?>
                    
                  </ul>              
                </nav>    
                <img src="img/vertical-menu-bg.png" alt="Menu bg" class="tm-side-menu-bg">
              </div>  
            </div>            
            <div class="tm-menu-product-content col-lg-9 col-md-9"> <!-- menu content -->

            <?php
              include('conn.php');
              $sql = "call dspmenu";
                      $result = $conn->query($sql);
                      if($result->num_rows > 0){
                        while($row = $result->fetch_assoc()){
                          echo '<div class="tm-product">
              <img src="prdpics/'.$row["foodpic"].' " alt="Product" width="150px" height="150px">
              <div class="tm-product-text">
                <h3 class="tm-product-title">'.$row["foodname"].'</h3>
                <p class="tm-product-description">'.$row["fooddsc"].'</p>
              </div>
              <div class="tm-product-price">
                <a href="cart.php?fcod='.$row["foodcod"].'" class="tm-product-price-link tm-handwriting-font">
                <span class="tm-product-price-currency"></span>₹'.$row["foodprc"].'</a>
              </div>
            </div>';
                        }
                      }

              
            ?>
              <div class="tm-product">
                <img src="img/popular-1.jpg" alt="Product" width="150px" height="150px">
                <div class="tm-product-text">
                  <h3 class="tm-product-title">Maggie</h3>
                  <p class="tm-product-description">Maggie is an international brand of seasonings, instant soups, and noodles that originated in Switzerland in late 19th century.Maggie is a 2015 American post-apocalyptic horror drama film directed by Henry Hobson.</p>
                </div>
                <div class="tm-product-price">
                  <a href="#" class="tm-product-price-link tm-handwriting-font"><span class="tm-product-price-currency">$</span>30</a>
                </div>
              </div>
              <div class="tm-product">
                <img src="img/popular-2.jfif" alt="Product" width="150px" height="150px">
                <div class="tm-product-text">
                  <h3 class="tm-product-title">Pasta</h3>
                  <p class="tm-product-description">Pasta is the Italian designation or name given to a type of starchy noodle or dish typically made from grain flour, commonly wheat, mixed into a paste or dough, usually with water or eggs, and formed or cut into sheets or other shapes.</p>
                </div>
                <div class="tm-product-price">
                  <a href="#" class="tm-product-price-link tm-handwriting-font"><span class="tm-product-price-currency">Order Now</span></a>
                </div>
              </div>
              <div class="tm-product">
                <img src="img/popular-3.webp" alt="Product" width="150px" height="150px">
                <div class="tm-product-text">
                  <h3 class="tm-product-title">Samosa</h3>
                  <p class="tm-product-description">A samosa is a fried or baked pastry with a savoury filling, such as spiced potatoes, onions, peas, cheese, beef and other meats, or lentils. It may take different forms, including triangular, cone, or half-moon shapes, depending on the region. </p>
                </div>
                <div class="tm-product-price">
                  <a href="#" class="tm-product-price-link tm-handwriting-font"><span class="tm-product-price-currency">$</span>15</a>
                </div>
              </div>
              <div class="tm-product">
                <img src="img/special-1.jpg" alt="Product" width="150px"  height="150px">
                <div class="tm-product-text">
                  <h3 class="tm-product-title">Coffee</h3>
                  <p class="tm-product-description">Coffee is a brewed drink prepared from roasted coffee beans, the seeds of berries from certain Coffea species. When coffee berries turn from green to bright red in color – indicating ripeness – they are picked, processed, and dried. Dried coffee seeds are roasted to varying degrees, depending on the desired flavor.</p>
                </div>
                <div class="tm-product-price">
                  <a href="#" class="tm-product-price-link tm-handwriting-font"><span class="tm-product-price-currency"></span>₹25</a>
                </div>
              </div>
              <div class="tm-product">
                <img src="img/special-3.jfif" alt="Product">
                <div class="tm-product-text">
                  <h3 class="tm-product-title">Cold Drink</h3>
                  <p class="tm-product-description">A soft drink is a drink that usually contains carbonated water, a sweetener, and a natural or artificial flavoring. The sweetener may be a sugar, high-fructose corn syrup, fruit juice, a sugar substitute, or some combination of these.</p>
                </div>
                <div class="tm-product-price">
                  <a href="#" class="tm-product-price-link tm-handwriting-font"><span class="tm-product-price-currency">$</span>15</a>
                </div>
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
     </div>
   </footer> <!-- Footer content-->  
  
 </body>
 </html>
<?php
  session_start();
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
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/font-awesome.min.css" rel="stylesheet">
    <link href="../css/templatemo-style.css" rel="stylesheet">
    <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon" />

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
      body{
        background: #ffffff;
      }
      .tm-main-section {
        padding-top: 0;
        display: inline-table;
      }
      .tm-popular-item{
        max-width: 100%;
        text-align: center;
        margin: 0;
      }
      .tm-popular-item-img{
        height:90%;
        margin-top: 40px;
        margin-left: 40px;
      }
      .banner{
        background: #e4e4e4;
      }
      .bar{
        background: #282726;
        color: #c79c60;
        text-align: center;
        height: 200px;
        padding: 10px;
      }
      .bar h1{
        margin: 1%;
        font-size: 70px;
      }
      .w3l_banner_nav_left {
        float: left;
        width: 20%;
        background: #ffffff;
        height: 560px;
        margin-top: -150px;
        border-radius: 5px;
      }
      .w3l_banner_nav_right {
        float: right;
        width: 80%;
        height: 480px;
        margin-top: -70px;
      }
      .navbar {
        margin-bottom: 0;
        border: none;
      }

      .navbar-nav {
        float: none;
        margin: 0;
      }
      .navbar-nav > li {
        float: none;
        display: flex;
        border-bottom: 1px dotted #CDCDCD;
      }
      .w3ls_logo_products_left {
        float: left;
        width: 100%;
      }
      .w3ls_logo_products_left  img{
        width: 150px;
        height: 150px;
        border-radius: 50%;
        margin: 15px auto;
        display: block;
      }
      h1, h2, h3, h4, h5, h6, a {
        font-family: 'Ubuntu', sans-serif !important;
        margin: 0;
      }
      .w3ls_logo_products_left h1 a {
        font-size: 1.5em;
        color: #212121;
        text-decoration: none;
        text-transform: uppercase;
        display: block;
        background: url(../images/img-sp.png) no-repeat 54px 6px;
        line-height: 1;
        height: 97px;
      }
      .w3ls_logo_products_left h1 a span {
        font-size: .3em;
        display: block;
        color: #FA1818;
      }
      .navbar-nav > li > a {
        color: #212121;
        padding: 10px 0px 10px 40px;
        width: 100%;
      }
      .bttn a{
        font-size: 18px;
      }
      span.bttn {
        float: none; 
        display: table;
        margin: 10px auto;
      }
      .row{
        margin: 0;
        padding: 0 10px;
      }
      .tot{
        width: 25%;
        float: left;
        padding: 10px;
        border-radius: 5px;

      }
      .data{
        text-align: center;
        height: 240px;
        background: #ffffff;
        box-shadow: 9px 8px 6px 2px rgb(0,0,0,0.3);
        padding: 10px;
        border-radius: 5px;
      }
      .inr-h1{
        margin: 23.5% 0;
        font-weight: 600;
        font-size: 50px;
      }
      .inr-p{
        background: #a2a2a2de;
        padding: 10%;
        margin: 0 -10px;
        font-weight: bold;
        font-size: 18px;
      }
      .row2{
        padding: 10px;
        margin: 20px 0;
        text-align: center;
        display: flow-root;
      }
      .row2 h1{
        border-bottom: 5px solid #c7c7c7;
      }
      .quick_link{
        width: 25%;
        float: left;
        padding: 10px;
      }
      .link{
        background: #a2a2a2de;
        padding: 15% 0;
        box-shadow: 5px 5px 7px 3px rgb(64 64 64 / 30%)
      }
      .link a{
        font-size: 30px;
        color: #000000;
      }

    </style>
  </head>
  <body>
    <div class="tm-top-header">
      <div class="container" style="max-width:80%">
        <div class="row">
          <div class="tm-top-header-inner">
            <div class="tm-logo-container">
              <img src="../img/logo.png" alt="Logo" class="tm-site-logo" width="50px" height="50px">
              <h1 class="tm-site-name tm-handwriting-font">Canteen</h1>
            </div>
            <div class="mobile-menu-icon">
              <i class="fa fa-bars"></i>
            </div>
            <nav class="tm-nav">
              <ul>
                <li><a href="dashboard.php" class="active">Dashboard</a></li>
                <li><a href="category.php">Category</a></li>
                <li><a href="addprd.php">Add Product</a></li>
                <li><a href="prdlist.php">Product List</a></li>
                <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Orders <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="allorder.php">All orders</a></li>
                    <li><a href="pendingord.php">Pending orders</a></li>
                    <li><a href="acceptedord.php">Accepted orders</a></li>
                    <li><a href="cancelledord.php">Cancelled orders</a></li>
                  </ul>
                </li>
              </ul>
            </nav>   
          </div>           
        </div>    
      </div>
    </div>

    <div class="banner">
      <div class="bar"><h1>Dashboard</h1></div>
      <div class="w3l_banner_nav_left">
        <nav class="navbar nav_bottom">
           <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
            <ul class="nav navbar-nav nav_1">
              <li><div class="w3ls_logo_products_left">
                <?php
                  include('../conn.php');
                  $sql = "select * from tbusr where usrrol = 'A' ";
                  $result = $conn->query($sql);
                  if($result->num_rows > 0){
                    $row = $result->fetch_assoc();
                    $pic = $row["usrpic"];
                    echo '<img src="../stupics/'.$pic.'">';
                  }
                ?>
                <span class="bttn"><a href="#"><i><b> Admin </b></i> </a></span>
                </div>
              </li>
              <li><a href="#">View Profile</a></li>
              <li><a href="#">Verify User</a></li>
              <li><a href="#">View Sales</a></li>
              <li><a href="#">Check Inventary</a></li>
              <li><a href="#">Change Password</a></li>
            </ul>
           </div><!-- /.navbar-collapse -->
        </nav>
      </div>

      
      <div class="w3l_banner_nav_right">
        <section class="tm-section tm-section-margin-bottom-0 ">

          <div class="row">
            <div class="tot">
              <div class="data">
                <h1 class="inr-h1">
                  <?php
                    include('../conn.php');
                    $sql = "select sum(ordcost) from tbord where ordstatus = 'Accepted' ";
                    $result = $conn->query($sql) ;
                    $row = $result->fetch_assoc();
                    if(!$row["sum(ordcost)"] == "")
                      echo $row["sum(ordcost)"];
                    else echo "0";
                    $conn->close();
                  ?> 
                </h1>
                <p class="inr-p"> Total Sales </p>
              </div>
            </div>

            <div class="tot">
              <div class="data">
                <h1 class="inr-h1">
                  <?php
                    include('../conn.php');
                    $sql = "select count(ordcod) from tbord ";
                    $result = $conn->query($sql) ;
                    $row = $result->fetch_assoc();
                    echo $row["count(ordcod)"];
                    $conn->close();
                  ?> 
                </h1>
                <p class="inr-p"> Total Orders </p>
              </div> 
            </div>

            <div class="tot">
              <div class="data">
                <h1 class="inr-h1"> 
                  <?php
                    include('../conn.php');
                    $sql = "select count(usrcod) from tbusr where verification = 'Verified' ";
                    $result = $conn->query($sql) ;
                    $row = $result->fetch_assoc();
                    echo $row["count(usrcod)"];
                    $conn->close();
                  ?>
                </h1>
                <p class="inr-p"> Verified Users </p>
              </div>
            </div>

            <div class="tot">
              <div class="data">
                <h1 class="inr-h1">
                  <?php
                    include('../conn.php');
                    $sql = "select count(ordcod) from tbord where ordstatus = 'Pending' ";
                    $result = $conn->query($sql) ;
                    $row = $result->fetch_assoc();
                    echo $row["count(ordcod)"];
                    $conn->close();
                  ?>  
                </h1>
                <p class="inr-p"> Pending orders </p>
              </div>
            </div>

          </div>

          <div class="row2">
            
            <div class="col-lg-12 tm-section-header-container">
              <h2 class="tm-section-header gold-text tm-handwriting-font"> Useful Links</h2>
              <div class="tm-hr-container"><hr class="tm-hr"></div>
            </div>

            <div class="quick_link">
              <div class="link">
                <a href="prdlist.php">Top Sellings</a>
              </div>
            </div>

            <div class="quick_link">
              <div class="link">
                <a href="#">Special Products</a>
              </div>
            </div>

            <div class="quick_link">
              <div class="link">
                <a href="allorder.php">Orders</a>
              </div>
            </div>

            <div class="quick_link">
              <div class="link">
                <a href="prdlist.php#allprd">Products</a>
              </div>
            </div>

          </div>
                     
        </section>
      </div>

      <div class="clearfix"></div>
    </div>

    <footer>
      <div class="container">
        <div class="row tm-copyright">
          <p class="col-lg-12 small copyright-text text-center">Copyright &copy; 2020 MAIMT Canteen</p>
        </div>  
      </div>
    
    </footer> 
  </body>
</html>
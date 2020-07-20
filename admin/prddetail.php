<?php
  session_start();
  include('../conn.php');

  $fnam = $fpic = $fdsc = $favl = $fqty = $fprc = $msg ="";
  $_SESSION["fcod"] = $_REQUEST["fcod"];
  $fcod = $_SESSION["fcod"];
  $sql = "call fndmenu($fcod)";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $fnam = $row["foodname"];
    $fpic = $row["foodpic"];
    $fdsc = $row["fooddsc"];
    $favl = $row["foodisavl"];
    $fqty = $row["foodqty"];
    $fprc = $row["foodprc"];

    $_SESSION["fnam"] = $fnam;
    $_SESSION["fdsc"] = $fdsc;
    $_SESSION["fnam"] = $fnam;
    $_SESSION["favl"] = $favl;
    $_SESSION["fprc"] = $fprc;
    $_SESSION["fqty"] = $fqty;
    $_SESSION["fcatcod"] = $row["foodcatcod"];
  } else echo "No results";
  $conn->close();

  include('../conn.php');
  if(isset($_REQUEST["fcod"]) && isset($_REQUEST["mod"])){
    if($_REQUEST["mod"] == 'D'){
      $sql = "call delmenu($fcod)";
      if ($conn->query($sql) === TRUE) {
        $msg = "Record deleted successfully";
        if(!$msg == "") echo "<script> alert('$msg'); </script>";
        header('location:prdlist.php');

      } else {
        $msg = "Error deleting record: " . $conn->error;
      }
    }
  }

  if(!$msg == "") echo "<script> alert('$msg'); </script>";
?>


<!DOCTYPE HTML>
<html lang="en"><head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Canteen</title>
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,700" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Damion" rel="stylesheet" type="text/css">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/font-awesome.min.css" rel="stylesheet">
    <link href="../css/templatemo-style.css" rel="stylesheet">
    <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
    <style>
        body{
            background-color: #e4e4e4;
        }
        h1{
            font-size: 50px;
        font-family: 'Damion', cursive;
        text-align: center;
        margin: 30px 0 10px;
        }
        h2{
          margin: 0 0 10px;
          font-weight: 600;
          font-size: 40px;
        }
      span.bigsize{
        font-size: 40px;
        font-family: 'Damion', cursive;;
      }
      .tm-main-section{
        padding-top: 0;
      }
      .tm-popular-item{
          max-width: 100%;
          text-align: center;
          padding: 20px;
      }
      .imgdsc{
        display: flex;
    padding: 10px;
    margin: 10px 0;

      }
      .tm-popular-item-img{
          height:80%;
      }
      .dsc{
        font-size: 20px;
    width: 60%;
    padding: 1em;
    float: left;
      }
      .bttn a{
        margin: 0 15%;
      }
      footer{
        margin: 0;
      }
    </style>
    </head>
    <body>
      <div class="tm-top-header">
        <div class="container">
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
                    <li><a href="../index.php">Home</a></li>
                    <li><a href="category.php">Category</a></li>
                    <li><a href="addprd.php">Add Product</a></li>
                    <li><a href="prdlist.php">Product List</a></li>
                    <li><a href="order.php">Orders</a></li>
                </ul>
              </nav>   
            </div>           
          </div>    
        </div>
      </div>
      <h1>PRODUCT &nbsp; DETAILS</h1>
        <div class="tm-main-section light-gray-bg">
         <div class="container" id="main">
          <section class="tm-section tm-section-margin-bottom-0 row">
            <div class="tm-popular-item">
                <div class="tm-popular-item-description">
                  <h3 class="tm-handwriting-font tm-popular-item-title">
                      <span class="tm-handwriting-font bigger-first-letter"><?php echo $fnam; ?></span></h3>
                      <hr class="tm-popular-item-hr">
                  <div class="imgdsc">
                    <img src="../prdpics/<?php echo $fpic; ?>" alt="Popular" class="tm-popular-item-img" width="300px" height="300px">
                    <div class="dsc">
                      <h2 class="tm-handwriting-font">Description:</h2>
                      <p><?php echo $fdsc; ?></p>
                    </div>
                  </div>
                  <h3 class="tm-handwriting-font tm-popular-item-title" style="width: 50%; float: left;">
                      <span class="tm-handwriting-font bigger-first-letter">A</span>vailable:<?php echo $favl; ?></h3>
                  <h3 class="tm-handwriting-font tm-popular-item-title"> <span class="tm-handwriting-font bigger-first-letter">Q</span>uantity:<?php echo $fqty; ?></h3><hr class="tm-popular-item-hr">
                  <h3 class="tm-handwriting-font tm-popular-item-title"><span class="tm-handwriting-font bigger-first-letter">P</span>rice:<?php echo $fprc; ?></h3><hr class="tm-popular-item-hr">
                   
                  <?php echo '<h3 <span class="bttn"> <a href="addprd.php?fcod='.$_SESSION["fcod"].'&mod=E ">Edit</a>
                    <a href="prddetail.php?fcod='.$_SESSION["fcod"].'&mod=D ">Delete</a> </span></h3>'; ?>
                </div>
            </div>
          </section>
         </div>
        </div>
      <footer>
        <div class="container">
            <div class="row tm-copyright">
             <p class="col-lg-12 small copyright-text text-center">Copyright © 2020 Your Canteen</p>
           </div>  
         </div>
      </footer> <!-- Footer content-->  
    
  
   </body></html>
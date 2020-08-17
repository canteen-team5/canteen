<?php
  
  include('header.php');

  $msg = $err = "";
  
  if(isset($_REQUEST["fcod"]) && isset($_REQUEST["mod"])){
    $fcod = $_REQUEST["fcod"];
    if($_REQUEST["mod"] == 'D'){
      $pic = $_REQUEST["pic"];
      $file = "../prdpics/$pic";
      $sql = "DELETE from tbmenu WHERE foodcod =$fcod";
      if ($conn->query($sql) === TRUE) {
        $msg = "Product deleted ";
        unlink($file);
      } else {
        $err = "Error deleting record: " . $conn->error;
      }
    }
  }


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
  <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon"/>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  
  <style>
    body{
      background-color: #e4e4e4;
    }
    h1{
      text-align: center;
      margin-top: 50px;
    }
    p.cat{
      text-align: center;
    }
    footer{
      margin: 10vh 0 0;
    }
    #head_big{
      width: 450px;
    }
    @media screen and (max-width: 780px){
        .h1{
          width: 100%;
        }
        .tm-main-section{
          padding-top: 30px;
        }
        p.cat{
          max-width: 90%;
        }
        .category_name{
          width: 95%;
        }
        .tm-section-header-container{
          width: 100%;
        } 
        .tm-section-header{
          width: 100%;
        }
        #head_big{
          width: 100%;
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
              <img src="../img/logo.png" alt="Logo" class="tm-site-logo" width="50px" height="50px">
              <h1 class="tm-site-name tm-handwriting-font">Canteen</h1>
            </div>
            <div class="mobile-menu-icon" onclick="mobile_icon()">
              <i class="fa fa-bars"></i>
            </div>
            <nav class="tm-nav" id="nav_mobile" >
              <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="category.php">Category</a></li>
                <li><a href="addprd.php">Add Product</a></li>
                <li><a href="prdlist.php" class="active">Product List</a></li>
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

    <!----------------- Alert Box -------------------------------->
    <?php 

      if(!$err == "")
      echo '<div class="err"> '.$err.' </div>';
    
      if(!$msg == "")
        echo '<div class="msg"> '.$msg.' </div>';
    ?>

    
    <h1 onclick="mobile_icon_off()"> <span> PRODUCTS </span> </h1>
    <div class="tm-main-section light-gray-bg" onclick="mobile_icon_off()">
        <section class="tm-section tm-section-margin-bottom-0 row">
          <div class="category_name">
            <div class="col-lg-12 tm-section-header-container">
              <h2 class="tm-section-header gold-text tm-handwriting-font" id="head_big"><img src="../img/logo.png" alt="Logo" class="tm-site-logo" width="50px" height="50px"> Currently Unavailable</h2>
              <div class="tm-hr-container"><hr class="tm-hr"></div>
            </div>
          </div>
          <?php
            include('../conn.php');
            $j = 0;
            $sql_disp = "SELECT * FROM tbmenu";
            $result_disp = $conn->query($sql_disp); 
            if($result_disp->num_rows > 0){
              while ($row = $result_disp->fetch_assoc()){
                if($row["foodqty"] < 1){
                  $j++;
                  echo "<p class='cat' ><span class='text'> 
                  <a href=prddetail.php?fcod=".$row["foodcod"]." >".$row["foodname"]." </a>
                  </span> <span class='bttn'> <a onclick='confirmationPrdDelete($(this));return false;' href=prdlist.php?fcod=".$row["foodcod"]."&mod=D&pic=".$row["foodpic"]." >Delete</a> </span> </p>";
                } 
              }
              if($j == 0) echo "<p class='cat' ><span class='text'> All Products are Available </span> </p>";
            } else echo "<p class='cat' ><span class='text'> All Products are Available </span> </p>";
            $conn->close();
          ?>            
        </section>
    </div>  


    <div class="tm-main-section light-gray-bg" onclick="mobile_icon_off()">
        <section class="tm-section tm-section-margin-bottom-0 row" id="allprd">
          <div class="category_name">
            <div class="col-lg-12 tm-section-header-container">
              <h2 class="tm-section-header gold-text tm-handwriting-font"><img src="../img/logo.png" alt="Logo" class="tm-site-logo" width="50px" height="50px"> All Products </h2>
              <div class="tm-hr-container"><hr class="tm-hr"></div>
            </div>
          </div>

          <?php
            include('../conn.php');
            $sql_disp = "SELECT * FROM tbmenu";
            $result_disp = $conn->query($sql_disp); 
            //$i = 0;
            if($result_disp->num_rows > 0){
              while ($row = $result_disp->fetch_assoc()){
                echo "<p class='cat' ><span class='text'> 
                <a href=prddetail.php?fcod=".$row["foodcod"]." >".$row["foodname"]." </a>
                </span> <span class='bttn'> <a onclick='confirmationPrdDelete($(this));return false;' href=prdlist.php?fcod=".$row["foodcod"]."&mod=D&pic=".$row["foodpic"]." >Delete</a> </span> </p>";
              }
            } else echo "<p class='cat' ><span class='text'> No record found </span> </p>";
            $conn->close();
          ?>  
                  
        </section>
      </div>

      


    <!-------------------- Footer content--------------------------> 
    <?php
      include('footer.html');
    ?>  

  </body>
</html>
 
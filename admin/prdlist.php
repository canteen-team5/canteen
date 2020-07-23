<?php
  session_start();
  include('../conn.php');
  $msg = "";
  
  if(isset($_REQUEST["fcod"]) && isset($_REQUEST["mod"])){
    $fcod = $_REQUEST["fcod"];
    if($_REQUEST["mod"] == 'D'){
      $pic = $_REQUEST["pic"];
      $file = "../prdpics/$pic";
      $sql = "call delmenu($fcod)";
      if ($conn->query($sql) === TRUE) {
        $msg = "Record deleted successfully";
        unlink($file);
      } else {
        $msg = "Error deleting record: " . $conn->error;
      }
    }
  }

  if(!$msg == "") echo "<script> alert('$msg'); </script>";

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
  <style>
    body{
      background-color: #e4e4e4;
    }
    h1{
      text-align: center;
      font-style: italic;
      margin-top: 50px;
    }
    p.cat{
      text-align: center;
    }
    footer{
      margin: 10vh 0 0;
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
                <li><a href="#" class="active">Product List</a></li>
                <li><a href="order.php">Orders</a></li>
              </ul>
            </nav>   
          </div>           
        </div>    
      </div>
    </div>
    <h1>PRODUCTS</h1>


    <div class="tm-main-section light-gray-bg">
        <section class="tm-section tm-section-margin-bottom-0 row">
          <div class="category_name">
            <div class="col-lg-12 tm-section-header-container">
              <h2 class="tm-section-header gold-text tm-handwriting-font"><img src="../img/logo.png" alt="Logo" class="tm-site-logo" width="50px" height="50px"> Top Selling</h2>
              <div class="tm-hr-container"><hr class="tm-hr"></div>
            </div>
          </div>
      <?php
        $sql_disp = "call dspmenu";
        $result_disp = $conn->query($sql_disp); 
        $i = 0;
        if($result_disp->num_rows > 0){
          while ($row = $result_disp->fetch_assoc()){
            echo "<p class='cat' ><span class='text'> 
            <a href=prddetail.php?fcod=".$row["foodcod"]." >".$row["foodname"]." </a>
             </span> <span class='bttn'> <a href=prdlist.php?fcod=".$row["foodcod"]."&mod=D&pic=".$row["foodpic"]." >Delete</a> </span> </p>";
            $i++;
            if($i == 3) break;
          }
        } else echo "<p class='cat' ><span class='text'> No record found </span> </p>";
        $conn->close();
      ?>  
                  
        </section>
    </div> 


    <div class="tm-main-section light-gray-bg">
        <section class="tm-section tm-section-margin-bottom-0 row">
          <div class="category_name">
            <div class="col-lg-12 tm-section-header-container">
              <h2 class="tm-section-header gold-text tm-handwriting-font"><img src="../img/logo.png" alt="Logo" class="tm-site-logo" width="50px" height="50px"> All Products </h2>
              <div class="tm-hr-container"><hr class="tm-hr"></div>
            </div>
          </div>
      <?php
        include('../conn.php');
        $sql_disp = "call dspmenu";
        $result_disp = $conn->query($sql_disp); 
        //$i = 0;
        if($result_disp->num_rows > 0){
          while ($row = $result_disp->fetch_assoc()){
            echo "<p class='cat' ><span class='text'> 
            <a href=prddetail.php?fcod=".$row["foodcod"]." >".$row["foodname"]." </a>
             </span> <span class='bttn'> <a href=prdlist.php?fcod=".$row["foodcod"]."&mod=D&pic=".$row["foodpic"]." >Delete</a> </span> </p>";
          }
        } else echo "<p class='cat' ><span class='text'> No record found </span> </p>";
        $conn->close();
      ?>  
                  
        </section>
    </div>

    <div class="tm-main-section light-gray-bg">
        <section class="tm-section tm-section-margin-bottom-0 row">
          <div class="category_name">
            <div class="col-lg-12 tm-section-header-container">
              <h2 class="tm-section-header gold-text tm-handwriting-font"><img src="../img/logo.png" alt="Logo" class="tm-site-logo" width="50px" height="50px"> Not Avilable</h2>
              <div class="tm-hr-container"><hr class="tm-hr"></div>
            </div>
          </div>
      <?php
        include('../conn.php');
        $sql_disp = "call dspmenu";
        $result_disp = $conn->query($sql_disp); 
        if($result_disp->num_rows > 0){
          while ($row = $result_disp->fetch_assoc()){
            if($row["foodisavl"] == "False"){
              echo "<p class='cat' ><span class='text'> 
              <a href=prddetail.php?fcod=".$row["foodcod"]." >".$row["foodname"]." </a>
              </span> <span class='bttn'> <a href=prdlist.php?fcod=".$row["foodcod"]."&mod=D&pic=".$row["foodpic"]." >Delete</a> </span> </p>";
            }
          }
        } else echo "<p class='cat' ><span class='text'> All Products are Available </span> </p>";
        $conn->close();
      ?>            
        </section>
    </div> 


    <footer>
        <div class="container">
          <div class="row tm-copyright">
           <p class="col-lg-12 small copyright-text text-center">Copyright &copy; 2020 Your Canteen</p>
          </div>  
        </div>
    
   </footer> <!-- Footer content-->  

 </body>
 </html>
 
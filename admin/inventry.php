<?php
  
  include('header.php');

  $addqty = $fqty = "";

  if(isset($_REQUEST["fcod"]) && isset($_POST["submit"])){
    $fcod = $_REQUEST["fcod"];
    $addqty = $_POST["addqty"];
    $result = $conn->query("select foodqty from tbmenu where foodcod = $fcod");
    if($result->num_rows > 0){
      $row = $result->fetch_assoc();
      $fqty = $row["foodqty"];
    }
    $conn->close();
    include('../conn.php');
    $tot_qty = $fqty + $addqty;
    $sql = "update tbmenu set foodqty=$tot_qty where foodcod=$fcod ";
    if(mysqli_query($conn, $sql)){
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
  <style>
    h1{
      font-size: 50px;
      font-family: 'Damion', cursive;
      text-align: center;
    }
   .table{
    width: 60%;
    margin-left: 20%;
    margin-right:20%;
    margin-top: 3%;
   }
   .table>tbody>tr>td{
    padding: 8px;
    text-align: center;
    vertical-align: middle;
   }
    tr>th{
     text-align: center;
   }
   input[type=text],input[type=number], input[type=email], input[type=password], select, textarea {
    width: 90%;
    padding: 6px;
    border: 1px solid #ccc;
    border-radius: 4px;
    resize: vertical;
    text-align: center;
   }
   section{
     min-height: 61vh;
   }

  
  </style>
  </head>
  <body>
  <div class="tm-top-header">
      <div class="container" style="max-width:80%">
        <div class="row">
          <div class="tm-top-header-inner">
            <div class="tm-logo-container" onclick="mobile_icon_off()">
              <img src="../img/logo.png" alt="Logo" class="tm-site-logo" width="50px" height="50px">
              <h1 class="tm-site-name tm-handwriting-font">Canteen</h1>
            </div>
            <div class="mobile-menu-icon" onclick="mobile_icon()">
              <i class="fa fa-bars"></i>
            </div>
            <nav class="tm-nav" id="nav_mobile">
              <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
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

    <h1>Check Inventory</h1>

    <?php

      $sql = "select * from tbmenu order by foodcatcod ";
      $result = $conn->query($sql);
      if($result->num_rows > 0){
        echo '<section>
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Category</th>
              <th>Item Name</th>
            <th>Available Quantity</th>
            <th>Add </th>
            
            </tr>
          </thead>
          <tbody>';
        while($row = $result->fetch_assoc()){
          $foodcod = $row["foodcod"];
          echo '<tr>
            <td>';
              include('../conn.php');
              $catcod = $row["foodcatcod"];
              $sql_cat = "call fndcat($catcod)";
              $result_cat = $conn->query($sql_cat);
              if($result_cat->num_rows > 0 ){
                $row_cat = $result_cat->fetch_assoc();
                $catname = $row_cat["catname"];
                echo $catname;
              }
          echo '
            </td>
            <td>'.$row["foodname"].'</td>
            <td><b>'.$row["foodqty"].'</b></td>
            <form action="inventry.php?fcod='.$foodcod.'" method="post">
            <td><input type="number" name="addqty" value="'.$fqty.' " ></td>
            <td><button type="submit" name="submit">Update</button></td>
            </form>
            </tr>';
        }
        echo '</tbody>
          </table>
        </section>';
        
      }
    ?>
    
        
        
    <?php
      include('footer.html');
    ?>
  </body>
</html>
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
        background: #e4e4e4;
      }
      h1{
        font-size: 50px;
        font-family: 'Damion', cursive;
        text-align: center;
        margin: 30px 0 10px;
      }
      span.bigsize{
        font-size: 40px;
        font-family: 'Damion', cursive;;
      }
      .imgdsc{
        display: flex;
        padding: 10px;
        margin: 10px 0;
      }
      .det{
        font-size: 20px;
        width: 60%;
        padding: 1em;
        float: left;
      }
      .tm-main-section{
        padding-top: 0;
      }
      .tm-popular-item{
          max-width: 100%;
          text-align: center;
          padding: 20px;
      }
      .tm-popular-item-img{
        width: 200px;
        height: 200px;
        border-radius: 10%;
        margin: 1em;
      }
      th{
        text-align: center;
      }
      .bttn{
        display: contents;
      }
      .bttn a{ 
        margin: 10px;
      }
      .bttn button {
        background: #4CAF50;
        border: 0;
      }
      label{
        float:left;
        font-size: 30px;
        padding: 10px 0 0;
      }
      select{
        width:60%;
        padding:10px;
      }
      .cat{
        text-align: center;
      }
      footer{
        margin: 0;
      }
      @media screen and (max-width: 767px){
          .det{
            font-size: 18px;
            width: 100%;
            padding: 1em;
            float: none;
          }
          .imgdsc{
            display: block;
          }
          .tm-popular-item-description {
            padding: 0;
          }
          .bigger-first-letter {
            font-size: 50px;
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
            <div class="mobile-menu-icon">
              <i class="fa fa-bars"></i>
            </div>
            <nav class="tm-nav" id="nav_mobile" onclick="mobile_icon()">
              <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="category.php">Category</a></li>
                <li><a href="addprd.php">Add Product</a></li>
                <li><a href="prdlist.php">Product List</a></li>
                <li class="dropdown"><a class="dropdown-toggle active" data-toggle="dropdown" href="#">Orders <span class="caret"></span></a>
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


     <h1 onclick="mobile_icon_off()">Cancelled Orders</h1>
     <?php
       include('../conn.php');
       $sql = "select * from tbord where ordstatus='Cancelled' order by ordcod DESC ";
       $result = $conn->query($sql);
       if($result->num_rows > 0){
          while($row = $result->fetch_assoc() ){
            echo ' <div class="tm-main-section light-gray-bg" onclick="mobile_icon_off()">
              <div class="container" id="main">
                <section class="tm-section tm-section-margin-bottom-0 row">
                  <div class="tm-popular-item">
                    <div class="tm-popular-item-description">
                      <h3 class="tm-handwriting-font tm-popular-item-title"><span class="tm-handwriting-font bigger-first-letter">';
                        $ucod = $row["ordusrcod"];
                        $time = $row["ordtime"];
                        $date = $row["orddate"];
                        $ordstatus = $row["ordstatus"];
                        $fcod = $row["ordfoodcod"];
                        echo 'Order No. '.$row["ordcod"];
                        //$conn->close();

                        include('../conn.php');
                        $sql_usr = "SELECT * FROM tbusr where usrcod=$ucod";
                        $result_usr = $conn->query($sql_usr);
                        if($result_usr->num_rows > 0){
                          $row_usr = $result_usr->fetch_assoc();
                          $_SESSION["email"] = $row_usr["email"];
                          $mobile = $row_usr["mobile"];
                         echo '</span></h3><hr class="tm-popular-item-hr">
                          <div class="imgdsc">
                           <img src="../stupics/'.$row_usr["usrpic"].'" alt="User Picture" class="tm-popular-item-img" >
                          <p class="det" >';
                            echo '<i>Date: </i><b>'.$date.' '.date("g:i a", strtotime("$time")).'</b></br> <i>Roll No: </i><b>'.$row_usr["rollno"].'</b></br>
                             <i>Name: </i><b>'.$row_usr["fname"].' '.$row_usr["lname"].' </b> <br>
                            <i>Contact No.: </i><b> '.$row_usr["mobile"].'</b><br><i>Email: </i><b> '.$row_usr["email"].'</b><br>
                            <span class="highlight"> <i>Order Status: </i><b>'. $ordstatus.' </b></span> </p></div>';
      
                            }
                          $conn->close();
                        echo '<hr class="tm-popular-item-hr">';

                       include('../conn.php');
                        if(isset($fcod)){
                          $str = $fcod;
                          $arr = explode("," , $str);
                          foreach($arr as $item){
                            $contents[$item] = isset($contents[$item])?$contents[$item]+1:1;
                          }
                          if(count($contents) != 0){
                            $tot_all = 0;
                            echo '<div class = "cart table-responsive">
                            <table class="table table-striped">
                            <thead>
                              <tr>
                                <th>Item</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Amount</th>
                              </tr>
                            </thead>
                            <tbody>';
                            foreach($contents as $key => $value){
                              include('../conn.php');
                              $tot = 0;
                              $sql_menu = "SELECT * FROM tbmenu where foodcod=$key";
                              $result_menu = $conn->query($sql_menu);
                              if($result_menu->num_rows > 0){
                                while($row_menu = $result_menu->fetch_assoc()){
                                  echo '<tr>
                                  <td>'.$row_menu["foodname"].'</td>
                                  <td>'.$row_menu["foodprc"].'</td>
                                  <td>'.$value.'</td>';
                                  $tot += $row_menu["foodprc"] * $value;
                                  $tot_all += $tot;
                                  echo '<td>'.$tot.'</td> </tr>';
                                }
                              }
                              $conn->close();
                            }
                            echo '<tr><td></td> <td></td> <td>Total Amount:</td><td>'.$tot_all.'</td><td></td></tr>
                                  
                                </tbody>
                              </table>
                            </div>';
                          } 
                        } else{
                          echo "<div class='empty-cart'><p class='cat' ><span class='text'> Something went wrong! </span> </p>
                          <p class='cat'> <span class='text'> <a href='menu.php'>Go To Menu</a> </span> </p></div>";
                        }
              
                
                            echo '  <hr class="tm-popular-item-hr"> 
                  </div>
                </section>
              </div>
            </div>';
          }
        } else{
          echo "<div class='empty-cart'><p class='cat' ><span class='text'> No Cancelled order </span> </p>
          <p class='cat'> <span class='text'> <a href='allorder.php'>Go To All Order </a> </span> </p></div>";
        }

     ?>
     
            
    <!-------------------- Footer content--------------------------> 
    <?php
      include('footer.html');
    ?> 

 </body>
 </html>
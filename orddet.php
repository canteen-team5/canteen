<?php

<<<<<<< HEAD
  session_start();
  include('conn.php');
  $ordstatus = $date = $time = $fcod = $ordcod = $prev_key = $prev_ord = "";
=======
  
  include('header.php');
  $ordstatus = $date = $time = $fcod = $ordcod = "";
>>>>>>> 0381feff0a1521b6a2328945084526e7c5cf6b24

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
        footer{
          margin: 0;
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
        .empty-cart{
          padding: 50px;
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
                <li><a href="menu.php">Menu</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="cart.php" >Cart</a></li>
                
                <li class="dropdown"><a class="dropdown-toggle active" data-toggle="dropdown" href="#"><i class="fa fa-user" aria-hidden="true" style="font-size:20px;"> </i> <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="viewprofile.php">View Profile</a></li>
                      <li><a href="myord.php">My Orders</a></li>
                      <li><a href="changepwd.php">Change Password</a></li>
                      <li><a> <form action="index.php" method="post">
                        <button type="submit" name="logout"> Logout </button> </form> </a>
                      </li> 
                  </ul>
                </li>

              </ul>
            </nav>   
          </div>           
        </div>    
      </div>
    </div>


     <h1 onclick="mobile_icon_off()">Description of Order</h1>
     <?php
     include('conn.php');
     $ucod = $_SESSION["ucod"];
     $time = $_SESSION["time"];
     $sql = "select * from tbord where ordusrcod = $ucod and ordtime = '$time'";
     $result = $conn->query($sql);
     if($result->num_rows > 0){
       $row = $result->fetch_assoc();
       $ordcod = $row["ordcod"];
       $ordstatus = $row["ordstatus"];
       $date = $row["orddate"];
       $time = $row["ordtime"];
       $fcod = $row["ordfoodcod"];
        echo '
        <div class="tm-main-section light-gray-bg" onclick="mobile_icon_off()">
            <div class="container" id="main">
              <section class="tm-section tm-section-margin-bottom-0 row">
                <div class="tm-popular-item">
                    <div class="tm-popular-item-description">
                      <h3 class="tm-handwriting-font tm-popular-item-title"><span class="tm-handwriting-font bigger-first-letter">';
                  
                    
                      echo 'Order No. '.$ordcod;
                    

                      include('conn.php');
                      $ucod = $_SESSION["ucod"];
                      $sql = "call fndusr($ucod)";
                      $result = $conn->query($sql);
                      if($result->num_rows > 0){
                        $row = $result->fetch_assoc();
                        $email = $row["email"];
                        $mobile = $row["mobile"];
                        echo '</span></h3><hr class="tm-popular-item-hr">
                          <div class="imgdsc">
                          <img src="stupics/'.$row["usrpic"].'" alt="Popular" class="tm-popular-item-img" >
                          <p class="det" >';
                        
                        echo '<i>Date: </i><b>'.$date.' '.date("g:i a", strtotime("$time")).'</b></br> <i>Roll No: </i><b>'.$row["rollno"].'</b></br>
                          <i>Name: </i><b>'.$row["fname"].' '.$row["lname"].' </b> <br>
                          <i>Contact No.: </i><b> '.$row["mobile"].'</b><br><i>Email: </i><b> '.$row["email"].'</b><br>
                          <span class="bttn"><a><i>Order Status: </i><b>'. $ordstatus.' </b></a></span></p></div>
                          <hr class="tm-popular-item-hr">';

                      }
                      $conn->close();
                  
                      if($fcod){
                        $str = $fcod;
                        $arr = explode("," , $str);
                        foreach($arr as $item){
                          $contents[$item] = isset($contents[$item])?$contents[$item]+1:1;
                        }
                        if(count($contents) != 0){
                          $tot_all = 0;
                          echo '
                          <div class = "cart">
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
                                include('conn.php');
                                $tot = 0;
                                $sql = "call fndmenu($key)";
                                $result = $conn->query($sql);
                                if($result->num_rows > 0){
                                  while($row = $result->fetch_assoc()){
                                    $foodcod = $row["foodcod"];
                                    echo '<tr>
                                    <td>'.$row["foodname"].'</td>
                                    <td>'.$row["foodprc"].'</td>
                                    <td>'.$value.'</td>';
                                    $tot += $row["foodprc"] * $value;
                                    $tot_all += $tot;
                                    echo '<td>'.$tot.'</td> </tr>';
                                  }
                                }
                                $conn->close();
                                
                              }
                              echo '<tr><td></td> <td></td> <td>Total Amount:</td><td>'.$tot_all.'</td><td></td></tr>
                                    
                              </tbody>
                            </table> 
                          </div>
                          <hr class="tm-popular-item-hr">
                        </div>
                      </section>
                    </div>
                </div>';
                        }
                      } 
                         
                    } else{
                      echo "<div class='empty-cart'><p class='cat' ><span class='text'> Something went wrong! </span> </p>
                      <p class='cat'> <span class='text'> <a href='menu.php'>Go To Menu</a> </span> </p></div>";
                    }

                  ?>
            
                 
            
    <?php
      include('footer.html');
    ?> 

  </body>
</html>
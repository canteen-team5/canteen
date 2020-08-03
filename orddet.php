<?php

  session_start();
  include('conn.php');
  $ordstatus = $date = $time = $fcod = $ordcod = "";

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
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon"/>
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
                <li><a href="login.php">Login</a></li>
              </ul>
            </nav>   
          </div>           
        </div>    
      </div>
    </div>


     <h1 onclick="mobile_icon_off()">Description of Order</h1>
     <div class="tm-main-section light-gray-bg" onclick="mobile_icon_off()">
         <div class="container" id="main">
          <section class="tm-section tm-section-margin-bottom-0 row">
            <div class="tm-popular-item">
                <div class="tm-popular-item-description">
                  <h3 class="tm-handwriting-font tm-popular-item-title"><span class="tm-handwriting-font bigger-first-letter">
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
                      echo 'Order No. '.$ordcod;
                    }
                    else echo 'Order No. #';
                    //unset($_SESSION["time"]); 

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
                      
                      echo '<i><b>Date: </b></i>'.$date.' '.date("g:i a", strtotime("$time")).'</br> <i><b>Roll No: </b></i>'.$row["rollno"].'</br>
                        <i><b>Name: </b></i>'.$row["fname"].' '.$row["lname"].'  <br>
                        <i><b>Contact No.: </b></i> '.$row["mobile"].'<br><i><b>Email: </b></i> '.$row["email"].'<br>
                        <span class="bttn"><a><i><b>Order Status: </b></i>'. $ordstatus.' </a></span></p></div>';

                    }
                    $conn->close();
                  ?>

                  <hr class="tm-popular-item-hr">

                  <?php
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

                              //Submitting data in Orderdetail table
                              /*include('conn.php');
                              if(!($prev_ord == $ordcod && $prev_key == $key)){
                                $sql = "call insorddet($ordcod, $key, $value, $tot)";
                                mysqli_query($conn, $sql);
                                echo $prev_key." = ".$key."<br>";
                                echo $prev_ord." = ".$ordcod;
                                $prev_key = $key;
                                $prev_ord = $ordcod;
                                
                              }*/
                              
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

                  ?>
            
                 <hr class="tm-popular-item-hr">
              </div>
            </section>
          </div>
      </div>
            
    <?php
      include('footer.html');
    ?> 

  </body>
</html>
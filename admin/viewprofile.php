<?php
  session_start();
  $ucod = $_SESSION["ucod"];

?>

<!DOCTYPE html>
<!-- saved from url=(0052)file:///C:/Users/RAJAT%20SHARMA/Desktop/Canteen.html -->
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
            background-color: #e4e4e4;
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
      .tm-main-section{
        padding-top: 0;
      }
      .tm-popular-item{
          max-width: 100%;
          text-align: center;
          padding: 20px;
      }
      .tm-popular-item-img{
          height:80%;
      }
      .bttn a{
        margin: 1% 10%;
      }
      
      .imgdsc{
        display: block;
        padding: 10px;
        margin: 10px 0
      }
      .bkpic{
        background: #33312f;
        height: 100px;
      }
      .img{
        width: 150px;
        height: 150px;
        border-radius: 50%;
        margin-top: -10%;
      }
      
      .tm-popular-item-title{
          text-align: left;
      }
      .tm-popular-item:hover .tm-popular-item-title { color: #888; }
      
      .tm-popular-item:hover .dark{
        color: #4e4944;
      }
      .tm-popular-item:hover .order-now-link {
        border-color: #c79c60;
        color: #000;
        text-decoration: none;
      }
      .tm-popular-item-title:hover {
        color: #c79c60;
      }
      p.cat{
        text-align: center;
        margin: 2em auto;
      }
      .empty-cart{
        margin: 5em auto;
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

      <h1 onclick="mobile_icon_off()">ADMIN &nbsp; PROFILE</h1>
      <?php
        include('../conn.php');
        $sql = "select * from tbusr where usrcod=$ucod ";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
          while($row = $result->fetch_assoc()){
            $rollno = $row["rollno"];
            $pic = $row["usrpic"];
            $name = $row["fname"]." ".$row["lname"];
            $gen = $row["gender"];
            $email = $row["email"];
            $mob = $row["mobile"];
            $_SESSION["pic"] = $pic;
            echo'
              <div class="tm-main-section light-gray-bg" onclick="mobile_icon_off()">
              <div class="container" id="main">
                <section class="tm-section tm-section-margin-bottom-0 row">
                  <div class="tm-popular-item">
              
                    <div class="tm-popular-item-description">
                      <div class="imgdsc" >
                        <div class="bkpic"></div>
                        <div >
                            <img src="../stupics/'.$pic.'" alt="Popular" class="img" >
                        </div>
                        <h3 style="display: grid;">
                            <span class="highlight">   Verification: Verified  </span>
                        </h3>
                      </div>

                      <h3 class=" tm-popular-item-title" style="width: 60%;float: left;">
                        Name: <span class="dark">'.$name.'</span>
                      </h3>
                      <h3 class=" tm-popular-item-title">
                        Gender: <span class="dark">'.$gen.'</span>
                      </h3><hr class="gold">
                      <h3 class=" tm-popular-item-title" style="width: 60%;float: left;FONT-SIZE: 30px;">
                        Email: <span class="dark">'.$email.'</span>
                      </h3>
                      <h3 class=" tm-popular-item-title">
                        Mobile: <span class="dark">'.$mob.'</span>
                      </h3>
                      
                    </div>
                  </div>
                </section>
              </div>
            </div> ';
          }
        } else{
            echo "<div class='empty-cart' onclick='mobile_icon_off()'><p class='cat' ><span class='text'> No pending Verification left </span> </p>
            <p class='cat'> <span class='text'> <a href='dashboard.php'>Go To Dashboard</a> </span> </p></div>";
        }
        $conn->close();
      ?> 
      
    <!-------------------- Footer content--------------------------> 
    <?php
      include('footer.html');
    ?>  
    
  
   </body></html>
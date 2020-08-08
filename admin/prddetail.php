<?php
  
  include('header.php');

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
    $_SESSION["fpic"] = $fpic;
    $_SESSION["fcatcod"] = $row["foodcatcod"];
  } else echo "No results";
  $conn->close();

  include('../conn.php');
  if(isset($_REQUEST["fcod"]) && isset($_REQUEST["mod"])){
    if($_REQUEST["mod"] == 'D'){
      $pic = $_REQUEST["pic"];
      $file = "../prdpics/$pic";
      $sql = "call delmenu($fcod)";
      if($conn->query($sql) === TRUE) {
        $msg = "Record deleted successfully";
        if(!$msg == "") echo "<script> alert('$msg'); </script>";
        unlink($file);
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
        width: 300px;
        height: 240px;
        border-radius: 10px;
      }
      .dsc{
        font-size: 20px;
    width: 60%;
    padding: 0 0 0 1em;
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
              <div class="tm-logo-container"onclick="mobile_icon_off()">
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

      <h1 onclick="mobile_icon_off()">PRODUCT &nbsp; DETAILS</h1>
        <div class="tm-main-section light-gray-bg" onclick="mobile_icon_off()">
         <div class="container" id="main">

          <section class="tm-section tm-section-margin-bottom-0 row">
            <div class="tm-popular-item">
              <div class="tm-popular-item-description">
                <h3 class="tm-handwriting-font tm-popular-item-title">
                    <span class="tm-handwriting-font bigger-first-letter"><?php echo $fnam; ?></span></h3>
                    <hr class="tm-popular-item-hr">
                <div class="imgdsc">
                  <img src="../prdpics/<?php echo $fpic; $_SESSION["fpic"] = $fpic ?>" alt="Popular" class="tm-popular-item-img" >
                  <div class="dsc">
                    <h2 class="tm-handwriting-font">Description:</h2>
                    <p><?php echo $fdsc; ?></p>
                  </div>
                </div>
                <h3 class="tm-handwriting-font tm-popular-item-title" style="width: 50%; float: left;">
                    <span class="tm-handwriting-font bigger-first-letter">A</span>vailable: <?php echo $favl; ?></h3>
                <h3 class="tm-handwriting-font tm-popular-item-title"> <span class="tm-handwriting-font bigger-first-letter">Q</span>uantity: <?php echo $fqty; ?></h3><hr class="tm-popular-item-hr">
                <h3 class="tm-handwriting-font tm-popular-item-title"><span class="tm-handwriting-font bigger-first-letter">P</span>rice: ₹<?php echo $fprc; ?></h3><hr class="tm-popular-item-hr">
                   
                <?php echo '<h3 <span class="bttn"> <a href="addprd.php?fcod='.$_SESSION["fcod"].'&mod=E ">Edit</a>
                  <a href="prddetail.php?fcod='.$_SESSION["fcod"].'&mod=D&pic='.$_SESSION["fpic"].' ">Delete</a> </span></h3>'; ?>
              </div>
            </div>
          </section>

         </div>
        </div>


    <!-------------------- Footer content--------------------------> 
    <?php
      include('footer.html');
    ?>  
    
  
  </body>
</html>
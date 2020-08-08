<?php

include('../header.php');


$catnam = $cnam = $msg = $result_disp = $err = "";

if (isset($_POST["catsubmit"])) {
  $catnam = $_POST["cat_name"];
  if ($catnam == "") $err = "Please input name";

  elseif (isset($_SESSION["ccod"])) {
    $ccod = $_SESSION["ccod"];
    unset($_SESSION['ccod']);
    $sql = "call updcat($ccod,'$catnam')";
    if (mysqli_query($conn, $sql))
      $msg = "Category name updated successfully";
    else
      $err = "Error updating record: " . mysqli_error($conn);
  } else {
    $sql = "call inscat('$catnam')";
    if ($conn->query($sql) === true) {
      $msg = "New category added successfully";
    } else {
      $err = "Error: " . $sql . "<br>" . $conn->error;
    }
  }
}

if (isset($_REQUEST["ccod"])) {

  if ($_REQUEST["mod"] == 'D') {
    $catcod = $_REQUEST["ccod"];
    $sql = "call delcat($catcod)";
    if ($conn->query($sql) === true) $err = "Category deleted";
    else $err = "Error deleting record: " . $conn->error;
  }

  if ($_REQUEST["mod"] == 'E') {
    $_SESSION["ccod"] = $_REQUEST["ccod"];
    $catcod = $_REQUEST["ccod"];
    $sql = "call fndcat($catcod)";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $cnam = $row["catname"];
    }
    $conn->close();
        /*$sql_disp = "call dspcat";
        $result_disp = $conn->query($sql_disp); 
        print_r($result_disp); */
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
    <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon" />

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
      h1{
        text-align: center;
        font-style: italic;
        margin-top: 50px;
      }
      h2{
        text-align: center;
        font-style: italic;
        margin-top: 50px;
      }
      input[type=text] {
        margin: 20px auto;
        text-align: center;
        width: 90%;
        font-size: large;
      }

      label {
        padding: 12px 62px 12px 30px;
        display: block;
        margin-top: 20px;
        width: 35%;
        font-size: 20px;
        text-align: right;
        float: left;
      }

      input[type=submit] {
        float: left;
        display: block;
        width: 90%;
        margin: 0;
        font-size: large;
      }

      input[type=submit]:hover {
        background-color: #45a049;
      }

      .catsubrght{
        width: 50%;
        float: left;
      }
      span.text{
        width: auto;
      }
      @media screen and (max-width: 780px){
        .h1{
          width: 100%;
        }
        .catsubrght{
          width: 65%;
        }
        .category_name{
          width: 100%;
        }
        p.cat{
          max-width: 90%;
        }
        .tm-section-header-container, .tm-section-header{
          width: 100%;
        }
      }


    </style>
  </head>

  <body class="body">
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
            <nav class="tm-nav" id="nav_mobile">
              <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="#" class="active">Category</a></li>
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

    <!----------------- Alert Box -------------------------------->
    <?php 

      if(!$err == "")
      echo '<div class="err"> '.$err.' </div>';
    
      if(!$msg == "")
        echo '<div class="msg"> '.$msg.' </div>';
    ?>

    <!------------------------------------------------------------------>

    <h1 style="width:85%;" onclick="mobile_icon_off()">CATEGORY</h1>
    <form method="post"  action="category.php" name="frmcat" style="padding-bottom: 5em;" onclick="mobile_icon_off()">

      <div class="row" style="padding:4% 0 0;" >
        <label for="cat_name">Categories Name:</label>
        <div class="catsubrght">
          <input type="text" name="cat_name" placeholder="Your category name.." value="<?php echo$cnam;?>">   
          <?php
            if (isset($_REQUEST["ccod"]) && $_REQUEST["mod"] == "E")
              echo '<input type="submit" value="Update" name="catsubmit" >';
            else
              echo '<input type="submit" value="Add Category" name="catsubmit" >';
          ?>
        </div>
      </div>

      <div class="category_name">
        <div class="col-lg-12 tm-section-header-container">
          <h2 class="tm-section-header gold-text tm-handwriting-font"><img src="../img/logo.png" alt="Logo" class="tm-site-logo" width="50px" height="50px"> Category List</h2>
          <div class="tm-hr-container"><hr class="tm-hr"></div>
        </div>
      </div>
      <?php
      include('../conn.php');
      $sql_disp = "call dspcat";
      $result_disp = $conn->query($sql_disp);
      if ($result_disp->num_rows > 0) {
        while ($row = $result_disp->fetch_assoc()) {
          echo "<p class='cat' ><span class='text'>" . $row["catname"] . "</span> <span class='bttn'> <a href=category.php?ccod=" . $row["catcod"] . "&mod=E >Edit</a>
            <a onclick='confirmationDelete($(this));return false;' href='category.php?ccod=" . $row["catcod"] . "&mod=D'  >Delete</a> </span> </p>";
        }
      } else echo "<p class='cat' ><span class='text'> No record found </span> </p>";
      ?>
    </form>

    <!-------------------- Footer content--------------------------> 
    <?php
      include('footer.html');
    ?> 

   </body>
</html>
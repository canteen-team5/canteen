<?php
session_start();
include('../conn.php');
    //error_reporting(0);

$catnam = $cnam = $msg = $result_disp = "";

if (isset($_POST["catsubmit"])) {
  $catnam = $_POST["cat_name"];
  if ($catnam == "") $msg = "Please input name";

  elseif (isset($_SESSION["ccod"])) {
    $ccod = $_SESSION["ccod"];
    unset($_SESSION['ccod']);
    $sql = "call updcat($ccod,'$catnam')";
    if (mysqli_query($conn, $sql))
      $msg = "Record updated successfully";
    else
      $msg = "Error updating record: " . mysqli_error($conn);
  } else {
    $sql = "call inscat('$catnam')";
    if ($conn->query($sql) === true) {
      $msg = "New record created successfully";
    } else {
      $msg = "Error: " . $sql . "<br>" . $conn->error;
    }
  }
  if (!$msg == "") echo "<script> alert('$msg'); </script>";
}

if (isset($_REQUEST["ccod"])) {

  if ($_REQUEST["mod"] == 'D') {
    $catcod = $_REQUEST["ccod"];
    $sql = "call delcat($catcod)";
    if ($conn->query($sql) === true) $msg = "Record deleted successfully";
    else $msg = "Error deleting record: " . $conn->error;
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
  if (!$msg == "") echo "<script> alert('$msg'); </script>";
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
    
* {
  box-sizing: border-box;
}

body{
  background-color: #e4e4e4;

}
input[type=text] {
  width: 90%;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 4px;
    resize: vertical;
    margin: 20px auto;
    text-align: center;

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
  background-color: #4CAF50;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    display: block;
    width: 90%;
}

input[type=submit]:hover {
  background-color: #45a049;
}

.col-25 {
  float: left;
  width: 25%;
  margin-top: 6px;
}

.col-75 {
  float: left;
  width: 75%;
  margin-top: 6px;
}

.catsubrght{
  width: 50%;
    float: left;
}
span.text{
  width: auto;
}
/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
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
    <h1 style="width:85%;">CATEGORY</h1>
    <form method="post"  action="category.php" name="frmcat" style="padding-bottom: 5em;" >
    <div class="row" style="padding:4% 0 0;" >
      <label for="cat_name">Categories Name:</label>
      <div class="catsubrght">
        <input type="text" name="cat_name" placeholder="Your category name.." value="">   
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
            <a href=category.php?ccod=" . $row["catcod"] . "&mod=D >Delete</a> </span> </p>";
        }
      } else echo "<p class='cat' ><span class='text'> No record found </span> </p>";

      ?>
      </form>

      <footer >
        <div class="container">
          <div class="row tm-copyright">
           <p class="col-lg-12 small copyright-text text-center">Copyright &copy; 2084 Your Canteen</p>
         </div>  
       </div>
     </div>
   </footer> 
  </body>
  </html>
<?php
    session_start();
    include('../conn.php');
    error_reporting(0);

    $catnam = $msg = "";
    if(isset($_POST["catsubmit"])){
        $catnam = $_POST["cat_name"];
        if($catnam == "") $msg = "Please input name";
        else{
            $sql = "call inscat('$catnam')";
            if($conn->query($sql) === TRUE) {
              $msg = "New record created successfully";
            } else {
              $msg = "Error: " . $sql . "<br>" . $conn->error;
            }
            echo "<script> alert('$msg'); </script>";
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

input[type=text], select, textarea {
  width: 50%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  resize: vertical;
  margin-left:200px;
  margin-top: 60px;
}

label {
  padding: 12px 12px 12px 30px;
  display: inline-block;
  margin-left: 300px;
  margin-top:60px;
}

input[type=submit] {
  background-color: #4CAF50;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  margin-left:40%;
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

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}


/* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 600px) {
  .col-25, .col-75, input[type=submit] {
    width: 100%;
    margin-top: 0;
  }
}
p{
  max-width: 60%;
  margin: 1em auto;
  background-color: #e2e2e2;
  border-radius: 1em;
  padding: 2px;
}
span.text{
  width: 50%;
  font-size: 20px;
  font-weight: 600;
  display: inline-block;
  padding: 9px;
}
span.bttn{
  float: right;
}
input[type=button] {
  background-color: #4CAF50;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
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
                <li><a href="product.php">Product</a></li>
                <li><a href="order.php">Orders</a></li>
              </ul>
            </nav>   
          </div>           
        </div>    
      </div>
    </div>
    <h1>CATEGORY</h1>
    <form method="post"  action="category.php" name="frmcat" >
       <div class="row">
      <div class="col-25">
        <label for="cat_name">Categories Name:</label>
      </div>
      <div class="col-75">
        <input type="text" name="cat_name" placeholder="Your category name..">
      </div>
    </div>
      <input type="submit" value="Submit" name="catsubmit" >
      <h2>CATEGORY NAME</h2>
      <?php
        $sql_disp = "call dspcat";
        $result_disp = $conn->query($sql_disp);
        if($result_disp->num_rows > 0){
          while ($row = $result_disp->fetch_assoc()){
            echo "<p><span class='text'>".$row["catname"]."</span> <span class='bttn'> <input type='button' name='edit' value='Edit'> <input type='button' name='delete' value='Delete'> </span> </p>";
          }
        } else echo "0 results";

      ?>
      </form>
  </body>
  </html>
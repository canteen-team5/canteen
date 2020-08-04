<?php
  session_start();
  include('../conn.php');

  $sel_cat = $itm_nam = $itm_prc = $itm_dsc = $itm_pic = $itm_avail = $itm_qty = $msg = "";
  if(isset($_POST["submit"])){
    $sel_cat = $_POST["category"];
    $itm_nam = $_POST["item_name"];
    $itm_prc = $_POST["price"];
    $itm_dsc = $_POST["describe"];
    $itm_pic = $_FILES["picture"]["name"];
    $itm_avail = $_POST["available"];
    $itm_qty = $_POST["item_qty"];

    if($sel_cat == "") $msg = "Please add category first";
    elseif($itm_nam == "") $msg = "Please enter Item name";
    elseif($itm_prc == "") $msg = "Please enter Item price";
    elseif($itm_dsc == "") $msg = "Please enter Item description";
    elseif($itm_pic == "") $msg = "Please input Item picture";
    //elseif($itm_qty == "") $itm_qty = "null";
    else {
      if(isset($_SESSION["check"])){
          $fcod = $_SESSION['fcod'];
          $sql = "call updmenu($fcod, '$itm_nam', '$itm_dsc', '$itm_pic', $itm_prc, $sel_cat, '$itm_avail', $itm_qty)";
          if ($conn->query($sql) === TRUE) {
            $msg = "Record updated successfully";
          } else {
            $msg = "Error updating record: " . $conn->error;
          }
          unset($_SESSION["check"]);
      }
      else{
        $sql = "call insmenu('$itm_nam', '$itm_dsc', '$itm_pic', $itm_prc, $sel_cat, '$itm_avail', $itm_qty)";
      if (mysqli_query($conn, $sql)) 
        $msg = "New record created successfully";
      else
        $msg = "Error: " . $sql . "<br>" . mysqli_error($conn);
      }
    }
    if($itm_pic!="")
      move_uploaded_file ($_FILES["picture"]["tmp_name"],"../prdpics/".$_FILES["picture"]["name"]);

    if(!$msg == "") echo "<script> alert('$msg'); </script>";
  }


  //update data
  if(isset($_REQUEST['fcod'])){
    $itm_nam = $_SESSION["fnam"];
    $itm_prc = $_SESSION["fprc"];
    $itm_dsc = $_SESSION["fdsc"];
    $itm_avail = $_SESSION["favl"];
    $itm_qty = $_SESSION["fqty"];
    $_SESSION["check"] = 1;
  }
?>


<!DOCTYPE html>
<html>
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
        background: #e4e4e4;
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
                <li><a href="#" class="active">Add Product</a></li>
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


    <div class="border">
    <h1 style="text-align: center; font-size: 40px; margin: 20px 0 30px; width: 85%;">ADD PRODUCT</h1>

      <form method='post' action='addprd.php' enctype="multipart/form-data">
        <div class="row">
          <div class="col-25">
            <label for="item_name">Item Name</label>
          </div>
          <div class="col-75">
            <input type="text"  name="item_name" placeholder="Your product name.." value="<?php echo $itm_nam; ?>">
          </div>
        </div>

        <div class="row">
          <div class="col-25">
            <label for="item_price">Item Price</label>
          </div>
          <div class="col-75">
            <input type="text"  name="price" placeholder="Your Item price.." value="<?php echo $itm_prc; ?>">
          </div>
        </div>

        <div class="row">
          <div class="col-25">
            <label for="item_desc">Item Description</label>
          </div>
          <div class="col-75">
            <textarea id="description" name="describe" placeholder="Your item description.." style="height:100px" value=""><?php echo $itm_dsc; ?> </textarea>
          </div>
        </div>

        <div class="row">
          <div class="col-25">
            <label for="item_picture">Item Picture</label>
          </div>
          <div class="col-75">
            <input type="file"  name="picture" placeholder="Choose File" >
          </div>
        </div>

        <div class="row">
          <div class="col-25">
            <label for="category">Select Category</label>
          </div>
          <div class="col-75">
            <select id="category" name="category">
              <?php
                $sql = "call dspcat";
                $result = $conn->query($sql);
                if($result->num_rows >0){
                  while($row = $result->fetch_assoc()){
                    echo "<option value=".$row["catcod"].">".$row["catname"]."</option>";
                    
                    
                    /*if($row["catcod"] == $_SESSION["fcatcod"])
                      echo "selcted  >".$row["catname"]."</option>";
                    else
                    echo ">".$row["catname"]."</option>";*/
                  }
                }

              ?>
              </select>
          </div>
        </div>

        <div class="row">
          <div class="col-25">
            <label for="item_available">Item Available</label>
          </div>
          <div class="col-75">
            <select id="Available" name="available">
                <?php
                  if(isset($_REQUEST["fcod"])){
                    if($itm_avail == "True"){
                      echo '<option name="Avail" value="True" selected>Available</option>';
                      echo '<option name="not-avail" value="False">Not Available</option>';
                    }
                    else{
                      echo '<option name="Avail" value="True">Available</option>';
                      echo '<option name="not-avail" value="False" selected >Not Available</option>';
                    }
                  }
                  else{
                    echo '<option name="Avail" value="True">Available</option>';
                    echo '<option name="not-avail" value="False">Not Available</option>';
                  }

                ?>	
              </select>
          </div>
        </div>

        <div class="row">
          <div class="col-25">
            <label for="item_name">Item Quantity</label>
          </div>
          <div class="col-75">
            <input type="text"  name="item_qty" placeholder="Your item Quantity.." value="<?php echo $itm_qty; ?>">
          </div>
        </div>
        
        <div class="row">
          <?php
            if(isset($_REQUEST['fcod']))
              echo '<input type="submit" value="Update" name="submit">';
            else
              echo '<input type="submit" value="Submit" name="submit">';
          ?>
        </div>
      </form>
    </div>

    <footer>
      <div class="container">
        <div class="row tm-copyright">
          <p class="col-lg-12 small copyright-text text-center">Copyright &copy; 2020 MAIMT Canteen</p>
        </div>  
      </div>
    </footer>
    
  </body>
</html>

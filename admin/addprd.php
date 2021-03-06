<?php
 
  include('header.php');

  $sel_cat = $itm_nam = $itm_prc = $itm_dsc = $itm_pic = $itm_avail = $itm_qty = $msg = $err = "";
  if(isset($_POST["submit"])){
    $sel_cat = $_POST["category"];
    $itm_nam = secure($_POST["item_name"]);
    $itm_prc = secure($_POST["price"]);
    $itm_dsc = secure($_POST["describe"]);
    $itm_pic = $_FILES["picture"]["name"];
    $itm_qty = secure($_POST["item_qty"]);

    if($itm_nam == "") 
      $err = "Please enter Item name!";
    elseif(!preg_match("/^[A-Z][a-zA-Z ]{2,19}$/", $itm_nam))
      $err = "Item name must contain only alphabets and should be greater than equal to 3 and less than 20";

    elseif($itm_prc == "") 
      $err = "Please enter Item price!";
    elseif(!preg_match("/^[1-9][0-9]{0,10}$/", $itm_prc))
      $err = "Price must not be zero";

    elseif($itm_dsc == "") 
      $err = "Please enter an item description!";
    elseif(!preg_match("/^[A-Z][a-zA-Z ]{4,500}$/", $itm_dsc))
      $err = "Item description must contain only alphabets and should be greater than equal to 5 and less than 500";

    elseif($itm_qty == "") 
      $err = "Please enter Item Quantity!";
    elseif(!preg_match("/^[1-9][0-9]{0,10}$/", $itm_qty))
      $err = "Quantity must not be zero";
      
    elseif($itm_pic == "") $err = "Please input Item picture!";

    else {
      if(isset($_SESSION["check"])){
          $fcod = $_SESSION['fcod'];
          $sql = "UPDATE tbmenu set foodname='$itm_nam', fooddsc='$itm_dsc', foodpic='$itm_pic', foodprc=$itm_prc, foodcatcod=$sel_cat, foodqty=$itm_qty where foodcod = $fcod ";
          if ($conn->query($sql) === TRUE) {
            $msg = "Item updated successfully";
          } else {
            $err = "Error updating record: " . $conn->error;
          }
          unset($_SESSION["check"]);
      }
      else{
        $sql = "INSERT tbmenu VALUES(null, '$itm_nam', '$itm_dsc', '$itm_pic', $itm_prc, $sel_cat, $itm_qty, 'no') ";
      if (mysqli_query($conn, $sql)) 
        $msg = "Item added successfully";
      else
        $err = "Error: " . $sql . "<br>" . mysqli_error($conn);
      }
    }
    if($itm_pic!="")
      move_uploaded_file ($_FILES["picture"]["tmp_name"],"../prdpics/".$_FILES["picture"]["name"]);
  }


  //update data
  if(isset($_REQUEST['fcod'])){
    $itm_nam = $_SESSION["fnam"];
    $itm_prc = $_SESSION["fprc"];
    $itm_dsc = $_SESSION["fdsc"];
    $itm_qty = $_SESSION["fqty"];
    $_SESSION["check"] = 1;
  }

  function secure($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
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
                <li><a href="addprd.php" class="active">Add Product</a></li>
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
    
    <!------------------ Main Content ---------------------------->
    <div class="border" onclick="mobile_icon_off()">
    <h1 style="text-align: center; font-size: 40px; margin: 20px 0 30px; width: 85%;">Add Product</h1>

      <form method='post' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>' enctype="multipart/form-data" class="add" onsubmit="return(checkAddPrd())">
        <div class="row">
          <div class="col-25">
            <label for="item_name">Item Name</label>
          </div>
          <div class="col-75">
            <input type="text" id="name" name="item_name" placeholder="Your product name.." value="<?php echo $itm_nam; ?>">
          </div>
        </div>

        <div class="row">
          <div class="col-25">
            <label for="item_price">Item Price</label>
          </div>
          <div class="col-75">
            <input type="text" id="prc" name="price" placeholder="Your Item price.." value="<?php echo $itm_prc; ?>">
          </div>
        </div>

        <div class="row">
          <div class="col-25">
            <label for="item_desc">Item Description</label>
          </div>
          <div class="col-75">
            <textarea id="description" name="describe" placeholder="Item description.." style="height:100px" value=""><?php echo $itm_dsc; ?></textarea>
          </div>
        </div>

        <div class="row">
          <div class="col-25">
            <label for="item_picture">Item Picture</label>
          </div>
          <div class="col-75">
            <input type="file" id="picture" name="picture" placeholder="Choose File" >
          </div>
        </div>

        <div class="row">
          <div class="col-25">
            <label for="category">Select Category</label>
          </div>
          <div class="col-75">
            <select id="category" name="category">
              <?php
                $sql = "SELECT * from tbcat";
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
            <label for="qty">Item Quantity</label>
          </div>
          <div class="col-75">
            <input type="text" id="qty" name="item_qty" placeholder="Product Quantity.." value="<?php echo $itm_qty; ?>">
          </div>
        </div>

        <!----------<div class="row">
          <div class="col-25">
            <label for="item_name">Mark as Popular</label>
          </div>
          <div class="col-75">
            <input type="checkbox"  name="ispopular"  value="<?php echo $itm_qty; ?>">
          </div>
        </div>------>
        
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

    <!-------------------- Footer content--------------------------> 
    <?php
      include('footer.html');
    ?>
    
  </body>
</html>

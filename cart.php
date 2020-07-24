<?php
  session_start();
  include('conn.php');

  //for submitting order
  if(isset($_POST["btnsubmit"])){
    if(!isset($_SESSION["ucod"]))
      header('location:login.php');
    $date = date("Y-m-d");
    $usrcod = $_SESSION["ucod"];
    $fcod = $_SESSION["cart"];
    $fqty = "null";
    $temp_time = date("h:i a"); 
    $time =  date("H:i", strtotime($temp_time));
    $status = "Placed";
    $sql = "call insord('$date', $usrcod, '$fcod', '$fqty', '$time', '$status')";
    echo $sql.$fcod;;
    if(mysqli_query($conn, $sql)){
      $msg = "Order Placed successfully";
      header('location:orddet.php');
    } else {
      $msg = "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

  }



  //for adding the product into cart
  if(isset($_REQUEST["fcod"]) && $_REQUEST["action"] == "add"){
    if(isset($_SESSION["cart"])){
      $_SESSION["cart"] = $_SESSION["cart"].",".$_REQUEST["fcod"];
    }
    else
      $_SESSION["cart"] = $_REQUEST["fcod"];
  }

  //for updating the quantity
  if(isset($_REQUEST["action"]) && $_REQUEST["action"] == "update"){
    foreach($_POST as $key=>$value){
      if(strstr($key,'qty')){
        $fcod = str_replace('qty', '', $key);
        for($i = 0; $i < $value; $i++){
          if(isset($newcart))
            $newcart .= ','.$fcod;
          else
            $newcart = $fcod;
        }
      }
      if(isset($newcart))
        $_SESSION["cart"] = $newcart;
    }
  }

  //for deleting any item
  if(isset($_REQUEST["fcod"]) &&  $_REQUEST["action"] == "delete"){
    if(isset($_SESSION["cart"])){
      $str = $_SESSION["cart"];
      $arr = explode(',', $str);
      $str1 = "";
      for($i = 0; $i < count($arr); $i++){
        if($arr[$i] != $_REQUEST["fcod"]){
          if($str1 == "")
            $str1 = $arr[$i];
          else
            $str1 .= ",".$arr[$i];
        }
      }
      $_SESSION["cart"] = $str1;
      if($_SESSION["cart"] == ""){
        unset($_SESSION["cart"]);
      }
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
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/font-awesome.min.css" rel="stylesheet">
  <link href="css/templatemo-style.css" rel="stylesheet">
  <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon"/>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <style>
    h1{
      font-size: 50px;
      font-family: 'Damion', cursive;
      text-align: center;
    }
   .table{
    width: 60%;
    margin: 3% auto 0;
    text-align: center;
   }
   .table th, input{
    text-align: center;
   }
   .cat{
     text-align: center;
     padding: 50px;
   }
   .empty-cart{
     padding: 50px;
   }
   .cart{
     min-height: 50vh;
   }
   .btnsubmit{
    padding: 2em;
    width: 100%;
    text-align: center;
   }
   #suborder{
    font-size: 25px;
    border: 0;
    background: #339033;
    border-radius: 4px;
    box-shadow: 4px 5px 8px grey;
    padding: 0.5em 3em;
   }
  #suborder:hover{
    background: #57b557;
  }

  </style>
  </head>
  <body>
    <div class="tm-top-header">
      <div class="container">
        <div class="row">
          <div class="tm-top-header-inner">
            <div class="tm-logo-container">
              <img src="img/logo.png" alt="Logo" class="tm-site-logo" width="50px" height="50px">
              <h1 class="tm-site-name tm-handwriting-font">Canteen</h1>
            </div>
            <div class="mobile-menu-icon">
              <i class="fa fa-bars"></i>
            </div>
            <nav class="tm-nav">
              <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="menu.php">Menu</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="" class="active">Cart</a></li>
              </ul>
            </nav>   
          </div>           
        </div>    
      </div>
    </div>
    <h1>SHOPPING CART</h1>

        <?php
        echo $_SESSION["cart"];
          if(isset($_SESSION["cart"])){
            $str = $_SESSION["cart"];
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
              <tbody>
              <form action="cart.php?action=update" method="post">';
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
                    <td><input type="number" name="qty'.$key.'" value="'.$value.'"></td>';
                    $tot += $row["foodprc"] * $value;
                    $tot_all += $tot;
                    echo '<td>'.$tot.'</td>
                    <td><button type="submit" name="update"> <a> Update </a> </button>&nbsp;
                    <button><a href="cart.php?fcod='.$row["foodcod"].'&action=delete ">Delete</a></button></td>
                    </tr>';
                  }
                }
                $conn->close();
              }
              echo '<tr><td></td> <td></td> <td>Total Amount:</td><td>'.$tot_all.'</td><td></td></tr>
                    
                  </tbody>
                </table>
                <div class="btnsubmit">
                <div class="btn"><button type="submit" name="btnsubmit" id="suborder">Submit Order</button></div> </div>
                </form>
              </div>
                
              ';
            } 
          } else{
            echo "<div class='empty-cart'><p class='cat' ><span class='text'> Your cart is Empty </span> </p>
            <p class='cat'> <span class='text'> <a href='menu.php'>Go To Menu</a> </span> </p></div>";
          }

        ?>

      
    <footer>
      <div class="container">
          <div class="row tm-copyright">
           <p class="col-lg-12 small copyright-text text-center">Copyright &copy; 2020 Your Canteen</p>
         </div>  
       </div>
    </footer> <!-- Footer content-->  
  </body>
</html>
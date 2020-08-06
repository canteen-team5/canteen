<?php
  session_start();
  include('conn.php');

  //for submitting order
  if(isset($_POST["btnsubmit"])){

    if(!isset($_SESSION["ucod"]))
      header('location:login.php');

    date_default_timezone_set("Asia/Kolkata");
    $date = date("Y-m-d");
    $usrcod = $_SESSION["ucod"];
    $fcod = $_SESSION["cart"];
    $temp_time = date("h:i:s a"); 
    $time =  date("H:i:s", strtotime($temp_time));
    $status = "Pending";
    $total = $_SESSION["tot_all"];
    $sql = "call insord('$date', $usrcod, '$fcod', '$time', '$status', $total)";
    if(mysqli_query($conn, $sql)){
      $_SESSION["time"] = $time;


      $msg = "Order Placed successfully";

      //fetching usr-email;
      $result = $conn->query("call fndusr($usrcod)");
      if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $email = $row["email"];
        $mob = $row["mobile"];
      }
      // for sending mail
      require("PHPMailer/src/PHPMailer.php");
      require("PHPMailer/src/SMTP.php");

        $mail = new PHPMailer\PHPMailer\PHPMailer();
        $mail->IsSMTP(); // enable SMTP

        //$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
        $mail->SMTPAuth = true; // authentication enabled
        $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 465; // or 587
        $mail->IsHTML(true);
        $mail->Username = "team5canteen@gmail.com";
        $mail->Password = "canteen@team5";
        $mail->SetFrom("team5canteen@gmail.com", 'Canteen');
        $mail->Subject = "Order Placed";
        $mail->Body = "Thanks for ordering food";
        $mail->AddAddress($email);
        $mail->Send();


        //for sending messages
        
        $field = array(
          "sender_id" => "FSTSMS",
          "language" => "english",
          "route" => "qt",
          "numbers" => "$mob",
          "message" => "32698",
          "variables" => "",
          "variables_values" => ""
      );
      
      $curl = curl_init();
      
      curl_setopt_array($curl, array(
        CURLOPT_URL => "https://www.fast2sms.com/dev/bulk",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_SSL_VERIFYHOST => 0,
        CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => json_encode($field),
        CURLOPT_HTTPHEADER => array(
          "authorization: wSxrquok0NJQCMad2DgBPjHlznZhLE68iFbImy9RA14Y3s5p7f8hI3XsobKBJZ1ElfumQvAWy9cV5iGS",
          "cache-control: no-cache",
          "accept: */*",
          "content-type: application/json"
        ),
      ));
      
      $response = curl_exec($curl);
      $err = curl_error($curl);
      
      curl_close($curl);
      
      if ($err) {
        echo "cURL Error #:" . $err;
      } else {
        echo $response;
      }
          // end of sending msg
      
      unset($_SESSION["cart"]);
      header('location:orddet.php');
    } else {
      $err = "Error: " . $sql . "<br>" . mysqli_error($conn);
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
  if(!isset($_POST["btnsubmit"]) && isset($_REQUEST["action"]) && $_REQUEST["action"] == "update"){
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
        background: #ffffff;
      }
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
      min-height: 61.1vh;
    }
    .btnsubmit{
      padding: 2em;
      width: 100%;
      text-align: center;
    }
    #suborder{
      font-size: 25px;
      border: 0;
      background: #4CAF50;
      color: white;
      border-radius: 4px;
      box-shadow: 4px 5px 8px grey;
      padding: 0.5em 3em;
    }
    #suborder:hover{
      background: #309034;
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
                <li><a href="cart.php" class="active">Cart</a></li>
                
                <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-user" aria-hidden="true" style="font-size:20px;"> </i> <span class="caret"></span></a>
                  <ul class="dropdown-menu"> 
                    <?php 
                      if(isset($_SESSION["ucod"])){
                        echo '<li><a href="viewprofile.php">View Profile</a></li>
                        <li><a href="myord.php">My Orders</a></li>
                        <li><a href="changepwd.php">Change Password</a></li>
                        <li><a> <form action="index.php" method="post">
                          <button type="submit" name="logout"> Logout </button> 
                        </form> </a></li>';
                      }
                      else
                        echo '<li><a href="login.php">Sign In</a></li>
                        <li><a href="register.php">Sign Up</a></li>';
                    ?>
                  </ul>
                </li>

              </ul>
            </nav>   
          </div>           
        </div>    
      </div>
    </div>


    <h1>SHOPPING CART</h1 onclick="mobile_icon_off()">

        <?php
        include('conn.php');
          if(isset($_SESSION["cart"])){
            $str = $_SESSION["cart"];
            $arr = explode("," , $str);
            foreach($arr as $item){
              $contents[$item] = isset($contents[$item])?$contents[$item]+1:1;
            }
            if(count($contents) != 0){
              $tot_all = 0;
              echo '
              <div class = "cart" onclick="mobile_icon_off()">
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
              echo '<tr><td></td> <td></td> <td><b>Total Amount:</b></td><td><b>'.$tot_all.'</b></td><td></td></tr>
                    
                  </tbody>
                </table>
                <div class="btnsubmit">
                <div class="btn"><button type="submit" name="btnsubmit" id="suborder">Make Payment</button></div> </div>
                </form>
              </div>';
              $_SESSION["tot_all"] = $tot_all;
            } 
          } else{
            echo "<div class='empty-cart'><p class='cat' ><span class='text'> Your cart is Empty </span> </p>
            <p class='cat'> <span class='text'> <a href='menu.php'>Go To Menu</a> </span> </p></div>";
          }

        ?>

      
      <?php
      include('footer.html');
    ?>
    
  </body>
</html>
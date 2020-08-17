<?php
  
  include('header.php');

  //for submitting order
  if(isset($_POST["btnsubmit"])){

    if($_POST["payment"] == "pod"){
      date_default_timezone_set("Asia/Kolkata");
      $date = date("Y-m-d");
      $usrcod = $_SESSION["ucod"];
      $fcod = $_SESSION["cart"];
      $temp_time = date("h:i:s a"); 
      $time =  date("H:i:s", strtotime($temp_time));
      $total = $_SESSION["tot_all"];
      $sql = "INSERT tbord VALUES(null,'$date', $usrcod, '$fcod', '$time', 'Pending', $total, 'COD' )";
      if(mysqli_query($conn, $sql)){
        $_SESSION["time"] = $time;

        //setup for sending email
        //fetching usr-email;
        /*$result = $conn->query("SELECT * FROM tbusr where usrcod=$usrcod)");
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
          */

        //for inserting data into orddet table
        $conn->close();
        include('conn.php');
        $sql = "select * from tbord where ordusrcod = $usrcod and ordtime = '$time'";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
          $row = $result->fetch_assoc();
          $ordcod = $row["ordcod"];
        
          $conn->close();
          include('conn.php');
          $str_det = $fcod;
          $arr_det = explode(',', $str_det);
          foreach($arr_det as $item){
            $contents[$item] = isset($contents[$item]) ? $contents[$item] + 1 : 1 ;
          }
          foreach($contents as $key=>$value){
            $sql_ins = "INSERT tborddet VALUES (null, $ordcod, $key, $value)";
            if(mysqli_query($conn, $sql_ins)) {
              //echo "sucess";

              // updating menu table
              $result_menu = $conn->query("select foodqty from tbmenu where foodcod = $key");
              $fqty = 0;
              if($result_menu->num_rows > 0){
                $row_menu = $result_menu->fetch_assoc();
                $fqty = $row_menu["foodqty"];
              }
              $conn->close();
              include('conn.php');
              $tot_qty = $fqty - $value;

              //updating menu table
              if($fqty == $value){
                $sql_menu = "update tbmenu set foodqty=$tot_qty where foodcod=$key ";
                if(mysqli_query($conn, $sql_menu)){
                  //$mail->Send();
                }
              }
              elseif($fqty < $value){
                $wrong_ord = 1;
                $sql_delord = "delete from tbord where ordcod=$ordcod;";
                $sql_delorddet = "delete from tborddet where orddetordcod=$ordcod and orddetfoodcod=$key  ";
                if( mysqli_query($conn, $sql_delord) && mysqli_query($conn, $sql_delorddet) ) {
                  //echo "cancelled";
                  //header('location:index.php');
                }
              }
              else{
                $sql_menu = "update tbmenu set foodqty=$tot_qty where foodcod=$key ";
                if(mysqli_query($conn, $sql_menu)) {
                  //$mail->Send();
                }
              }

            }
          }

          //updating food quantity for wrong order
          if(isset($wrong_ord)){
            $conn->close();
            include('conn.php');
            $sql_det = "select * from tborddet where orddetordcod=$ordcod";
            $result_det = $conn->query($sql_det);
            if($result_det->num_rows > 0){
              while( $row_det = $result_det->fetch_assoc()){
                $fcod = $row_det["orddetfoodcod"];
                $fqty_det = $row_det["orddetfoodqty"];

                $conn->close();
                include('conn.php');
                $sql_menu = "select * from tbmenu where foodcod=$fcod ";
                $result_menu = $conn->query($sql_menu);
                $fqty_menu = 0;
                if($result_menu->num_rows > 0){
                  $row_menu = $result_menu->fetch_assoc();
                  $fqty_menu = $row_menu["foodqty"];
                }
                $conn->close();
                include('conn.php');
                $tot_qty = $fqty_menu + $fqty_det;
                $sql_menu = "update tbmenu set foodqty=$tot_qty where foodcod=$fcod ";
                if(mysqli_query($conn, $sql_menu)) {
                  //echo "done";
                }
              }
              $sql_delorddet = "delete from tborddet where orddetordcod=$ordcod ";
              if(mysqli_query($conn, $sql_delorddet) ) {
                //echo "cancelled update";
                //header('location:index.php');
              }
            }
          } //end


        }

        


        //echo "Order Placed successfully";

        
        

          //for sending messages
          
          /*$field = array(
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
            "accept: *//*",
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
        }*/
            // end of sending msg
        
        unset($_SESSION["cart"]);
        header('location:orddet.php');
      } else {
        $err = "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    }

    elseif ($_POST["payment"] == "online") {
      # code...
    }

  }

?>

<html>
   <head>
   <title>Payment Page</title>
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
        background: #e4e4e4;
      }
     h1{
        font-size: 50px;
        font-family: 'Damion', cursive;
        text-align: center;
        margin: 30px 0 10px;
        }
      .row{
	   margin: auto;
         text-align: center;
         display: inline;
      }
      .col-75{
	width: 100%;
      }
      .btnsubmit{
      padding: 2em 0;
      width: 100%;
      text-align: center;
      display: flow-root;
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
                <li><a href="cart.php">Cart</a></li>
                
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
    
    <h1> Payment Methods</h1> 
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
      <div class="row">      
          <div class="col-75">
            <input type="radio" name="payment" value="pod" checked>
            <label for="pay on delivery">Pay on delivery</label><br>
            <input type="radio"  name="payment" value="online" disabled >
            <label for="online mode" title="Online Payment mode is currently unavaiable">Online mode</label>
          </div>
      </div>

      <div class="btnsubmit">
        <div class="btn"><button type="submit" name="btnsubmit" id="suborder">Submit Order</button></div> 
      </div>
    </form>        

    <?php
      include('footer.html');
    ?>
  </body>
</html>


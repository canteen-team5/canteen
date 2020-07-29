<?php
    session_start();
    include('conn.php');

    error_reporting(0);
    $usr = $pwd = $msg = $ucod = "";
    
    if(isset($_POST["btnlogin"])){
        $usr = $_POST["username"];
        $pwd = $_POST["password"];
        if($usr == "") $msg = "Please enter username";
        elseif($pwd == "") $msg = "Please enter password";
        else { 
            $sql = "call login_check('$usr', '$pwd')";
            $result = $conn->query($sql);
            if($result->num_rows > 0){
                $row = $result->fetch_assoc();
                $rol = $row["usrrol"];
                $ucod = $row["usrcod"];
                $verification = $row["verification"];

                if($verification == "Verified"){
                    $_SESSION["ucod"] = $ucod;
                    if ($rol == "A") header ("location:admin/prdlist.php");
                    else {
                        if(isset($_SESSION["cart"]))
                            header("location:cart.php");
                        else
                            header("location:index.php");
                    }
                }
                else
                    $msg = "You are not verified yet";
                  
            }
            else echo "<script type='text/javascript'> alert('Incorrect Password'); </script>";
        }
        if(!$msg == "") echo "<script type='text/javascript'> alert('$msg'); </script>";
    }
?>



<!DOCTYPE HTML>
<html lang="en">
    <head>
        <!-- Required meta tags-->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Colorlib Templates">
        <meta name="author" content="Colorlib">
        <meta name="keywords" content="Colorlib Templates">
        <link href="css/font-awesome.min.css" rel="stylesheet">
        <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon"/>

        <!-- Title Page-->
        <title>Login</title>
        <link href="css/font-awesome.min.css" rel="stylesheet" media="all">
        

        <!-- Main CSS-->
        <link href="css/main.css" rel="stylesheet" media="all">
    </head>

    <body>
        <div class="blurr"></div>
        <div class="page-wrapper bg-red p-t-180 p-b-100 font-robo">
            <div class="wrapper wrapper--w960">
                <div class="card card-2">
                    <div class="card-heading"></div>
                    <div class="card-body">
                        <h2 class="title">User Login</h2>
                        <div class="modal-body">
                            <form method="post" action="login.php" name="login_form">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input type="text" class="form-control" name="username" placeholder="Username" value="<?php echo $usr;?>">
                                    </div>
                                
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                            <input type="password" class="form-control" name="password" placeholder="Password" value="" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" name="btnlogin" class="btn btn-primary btn-block btn-lg">Log In</button>
                                    </div>
                                </div>
                            </form>
                    <div class="modal-footer">Don't have an account? <a href="register.php">Create one</a></div>
                </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end document-->
    </body>
    <!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>
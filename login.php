<?php
    
    include('header.php');

    $usr = $pwd = $err = $ucod = "";
    if(isset($_POST["btnlogin"])){
        $usr = secure($_POST["username"]);
        $pwd = secure($_POST["password"]);
        if($usr == "")
            $err = "Please enter Username!";
        elseif(!preg_match("/^[\w@&%$]{5,20}$/", $usr))
            $err = "Username should be 5 to 20 characters long and must only contain alphabets, numbers and @,%,$,&";
  
        elseif($pwd == "")
            $err = "Please enter Password!";
        elseif(!preg_match("/^[\w@&%$]{5,20}$/", $pwd))
            $err = "Password should be 5 to 20 characters longand must only contain alphabets, numbers and @,%,$,&";

        else { 
            $sql = "select * from tbusr where usrname='$usr' and usrpwd='$pwd' ";
            $result = $conn->query($sql);
            if($result->num_rows > 0){
                $row = $result->fetch_assoc();
                $rol = $row["usrrol"];
                $ucod = $row["usrcod"];
                $verification = $row["verification"];

                //if($verification == "Verified"){
                    $_SESSION["ucod"] = $ucod;
                    if ($rol == "A") {
                        $_SESSION["rol"] = 'A';
                        header ("location:admin/dashboard.php");
                    }
                    else {
                        if(isset($_SESSION["cart"]))
                            header("location:payment.php");
                        else 
                            header("location:index.php");
                    }
                /*}
                else
                    $err = "You are not verified yet";*/
                  
            }
            else echo "<script type='text/javascript'> alert('Incorrect Login Details'); </script>";
        }
        if(!$err == "") echo "<script type='text/javascript'> alert('$err'); </script>";
    }
    function secure($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
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
        <style>
            
        </style>
    </head>

    <body id="lgn">
        <div class="blurr"></div>
        <div class="page-wrapper bg-red p-t-180 p-b-100 font-robo">
            <div class="wrapper wrapper--w960">
                <div class="card card-2">
                    <div class="card-heading"><img src="img/ctnn.jpeg" class="top_img"></div>
                    <div class="card-body">
                        <h2 class="title">User Login</h2>
                        <div class="modal-body">
                            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" name="login_form" onsubmit="return(checkLogin())">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input type="text" class="form-control" id="username" name="username" placeholder="Username" value="<?php echo $usr;?>">
                                    </div>
                                
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="" >
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
        
        <script src="js/script.js"></script>
        <!-- end document-->
    </body>
    <!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>
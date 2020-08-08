<?php
<<<<<<< HEAD
    session_start();

    if(!isset($_SESSION["ucod"])){
        header('location:index.php');
    }
    
    include('conn.php');
=======
    
    include('header.php');
>>>>>>> 0381feff0a1521b6a2328945084526e7c5cf6b24
    $err = $msg = "";

    if(isset($_SESSION["ucod"]) && isset($_POST["btnsubmit"])){
        $ucod = $_SESSION["ucod"];
        $oldpwd = secure($_POST["oldpwd"]);
        $newpwd = secure($_POST["newpwd"]);
        $confirmpwd = secure($_POST["confirmpwd"]);

        if($oldpwd == "")
            $err = "Please enter Username!";
        elseif(!preg_match("/^[\w@&%$]{5,20}$/", $oldpwd))
            $err = "Old Password should be 5 to 20 characters long and must only contain alphabets, numbers and @,%,$,&";
  
        elseif($newpwd == "")
            $err = "Please enter Password!";
        elseif(!preg_match("/^[\w@&%$]{5,20}$/", $newpwd))
            $err = "New Password should be 5 to 20 characters longand must only contain alphabets, numbers and @,%,$,&";

        elseif($confirmpwd == "")
            $err = "Please enter Password!";
        elseif(!preg_match("/^[\w@&%$]{5,20}$/", $confirmpwd))
            $err = "Confirm Password should be 5 to 20 characters longand must only contain alphabets, numbers and @,%,$,&";

        elseif ($confirmpwd != $newpwd) $err = "Confirm password didn't match!";

        else{
            $sql = "call fndusr($ucod)";
            $result = $conn->query($sql);
            if($result->num_rows > 0){
                $row = $result->fetch_assoc();
                if($oldpwd == $row["usrpwd"]){
                    $conn->close();
                    include('conn.php');
                    $sql_upd = "update tbusr set usrpwd='$newpwd' where usrcod=$ucod ";
                    if ($conn->query($sql_upd) === TRUE) {
                        //$msg = "Password changed successfully";

                    } else {
                        $err =  $conn->error;
                    }
                    
                    $conn->close();
                }
                else echo "You have entered wrong password";    

            }
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
    <title>Canteen</title>
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
                    <h2 class="title">Change Password</h2>
                    <div class="modal-body">
					<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-lock"></i></span>
								<input type="password" class="form-control" name="oldpwd" placeholder="Old Password">
							</div>
						
						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-lock"></i></span>
								<input type="password" class="form-control" name="newpwd" placeholder="New Password">
							</div>
							<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-lock"></i></span>
								<input type="password" class="form-control" name="confirmpwd" placeholder="Confirm Password">
							</div>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-primary btn-block btn-lg" name="btnsubmit">Change Password</button>
						</div>
						</div></form>
					</div>
                </div>
            </div>
        </div>
    </div>



</body>
</html>
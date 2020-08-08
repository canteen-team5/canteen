<?php
    
    include('header.php');
    $err = $msg = "";

    if(isset($_SESSION["ucod"]) && isset($_POST["btnsubmit"])){
        $ucod = $_SESSION["ucod"];
        $oldpwd = $_POST["oldpwd"];
        $newpwd = $_POST["newpwd"];
        $confirmpwd = $_POST["confirmpwd"];

        if ($oldpwd == "") $err = "Please enter the old password!";
        //elseif(!preg_match("/^[0-9]{3,20}$/", $rollno))
           //$err = "";
        elseif ($newpwd == "") $err = "Please enter the new password!";
        elseif ($confirmpwd == "") $err = "Please enter confirm password!";
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
        if(!$err == "") echo $err;
        if(!$msg == "") echo $msg;

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
					<form action="changepwd.php" method="post">
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
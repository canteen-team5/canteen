<?php
    //error_reporting(0);
    $server = "localhost";
    $user = "root";
    $pwd = "";
    $db = "dbcanteen";
    $conn = mysqli_connect($server, $user, $pwd, $db);

    if(!$conn) die("Connection failed: " . mysqli_connect_error());
    /*else echo "connected successfully";*/

?>
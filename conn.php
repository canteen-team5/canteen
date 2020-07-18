<?php
    $user = "root";
    $pwd = "";
    $db = "dbcanteen";
    $conn = mysqli_connect($user,$pwd,$db);

    if(!conn) die("Connection failed: " . mysqli_connect_error());
    /*else echo "connected successfully";*/

?>
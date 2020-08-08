<?php
  session_start();

  if( !isset($_SESSION["ucod"]) || (!isset($_SESSION["rol"]) && $_SESSION["rol"] == 'A')){
    header('location:../index.php');
  }
  
  include('../conn.php');
   //error_reporting(0);
?>
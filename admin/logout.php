<?php 
session_start();
unset($_SESSION['login_name']);
session_destroy();
header("location:login.php");
?>
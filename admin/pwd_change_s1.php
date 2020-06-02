<?php
session_start();
require_once('../db_connection.php');
if($_POST['c_pwd'] != null)
{
$c_pwd = md5($_POST['c_pwd']);
				
$result = mysql_query("UPDATE admin SET password = '".$c_pwd."' WHERE id = '".$_SESSION["login_id"]."'");
if(! $result )
{
  die('Could not enter data: ' . mysql_error());
}	
	unset($_SESSION['login_id']);
	session_destroy();
	echo"<script>alert('Password Updated Successful! Please Login again.');</script>";
	echo "<script>window.location.href = 'index.php';</script>";
}else{
	echo"<script>alert('Password has not been changed.');</script>";
	echo "<script>window.location.href = 'index.php';</script>";
}

 

?>

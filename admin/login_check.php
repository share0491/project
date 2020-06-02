<?php

ob_start();
$host="leavesys.db.10911249.e65.hostedresource.net"; // Host name 
$username="leavesys"; // Mysql username 
$password="Avita123##"; // Mysql password 
$db_name="leavesys"; // Database name 
$tbl_name="admin"; // Table name 

// Connect to server and select databse.
mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
mysql_select_db("$db_name")or die("cannot select DB");
// Define $myusername and $mypassword 
$myusername=$_POST['myusername']; 
$mypassword= md5($_POST['mypassword']); 

// To protect MySQL injection (more detail about MySQL injection)
$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);
$myusername = mysql_real_escape_string($myusername);
$mypassword = mysql_real_escape_string($mypassword);
$sql="SELECT * FROM $tbl_name WHERE name='$myusername' AND password='$mypassword'";
$result=mysql_query($sql);
while($result2 = mysql_fetch_array($result)){
	$log_id = $result2['id'];
	$log_name = $result2['name'];
	$log_password = $result2['password'];
}
// Mysql_num_row is counting table row
$count=mysql_num_rows($result);

// If result matched $myusername and $mypassword, table row must be 1 row
if($count==1){

// Register $myusername, $mypassword and redirect to file "login_success.php"
session_register("adminusername");
$_SESSION["login_id"]=$log_id;
$_SESSION["login_name"]=$log_name;
$_SESSION["login_password"]=$log_password;
//session_register("mypassword");
header("location:index.php");
}
else {
echo "<script>
alert('ID or Password Invalid');
window.location.href='login.php';
</script>";
}
ob_end_flush();
?>

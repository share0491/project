<?php
$today_date = date("Y-m-d");
if($_POST['al']!=NULL){
	$sql1 = "INSERT INTO leavesys.due_leave(user_id,leave_type,day,date,e_date) VALUES ('".$_POST['employee_id']."', 'al', '".$_POST['al']."', '".$today_date."', '".$_POST['eDate']."');";
	$retval1 = mysql_query($sql1);
	if(! $retval1 )
	{
	  die('Could not enter data: ' . mysql_error());
	}
}

if($_POST['ot']!=NULL){
	$sql2 = "INSERT INTO leavesys.due_leave(user_id,leave_type,day,date,e_date) VALUES ('".$_POST['employee_id']."', 'ot', '".$_POST['ot']."', '".$today_date."', '".$_POST['eDate']."');";
	$retval2 = mysql_query($sql2);
	if(! $retval2 )
	{
	  die('Could not enter data: ' . mysql_error());
	}
}

echo "<script>window.location.href = 'index.php?loc=off_in_lieu_adjustment';</script>";

?>
<?php
if($_POST['hr']!=NULL){
	$sql1 = "INSERT INTO leavesys.accumulate_leave(staff_id,admin_id,hour,date,status) VALUES ('".$_POST['employee_id']."', '".$_POST['login_id']."', '".$_POST['hr']."', '".$_POST['gDate']."', '0');";
	$retval1 = mysql_query($sql1);
	if(! $retval1 )
	{
	  die('Could not enter data: ' . mysql_error());
	}
}


echo "<script>window.location.href = 'index.php?loc=accumulate_leave';</script>";

?>
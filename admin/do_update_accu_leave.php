<?php
$total_hour = 0;
foreach($_POST['accbox'] as $check) {
	$sql = mysql_query("SELECT * FROM accumulate_leave WHERE id='".$check."'");
	$result=mysql_fetch_assoc($sql);
	$total_hour += $result['hour'];
}

$day = $total_hour/4;

if(strpos($day, ".") == TRUE){
	echo"<script>alert('Hour unable to round up');</script>";
	echo "<script>window.history.go(-1)</script>";
	exit;
}

$actual_day = $day/2;

$result2 = mysql_query("INSERT INTO due_leave (user_id, leave_type, day, date, e_date, status) VALUES('".$_POST['employee_id']."', 'ot','".$actual_day."','".date('Y-m-d')."','".$_POST['eDate']."', '0')");
if(! $result2)
{
  die('Could not enter data: ' . mysql_error());
}

foreach($_POST['accbox'] as $check) {
	$result3 = mysql_query("UPDATE leavesys.accumulate_leave SET status='1' WHERE id='".$check."'");
	if(! $result3 )
	{
	  die('Could not enter data: ' . mysql_error());
	}
}

echo "<script>window.location.href = 'index.php?loc=accumulate_leave';</script>";
?>
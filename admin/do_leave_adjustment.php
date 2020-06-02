<?php
$sql1 = mysql_query("SELECT * FROM leave_type");
while($result1 = mysql_fetch_array($sql1)){
	$text = $result1["code"];
	if($_POST[$text] != NULL){
		$sql2 = mysql_query("SELECT * FROM user WHERE id = '".$_POST['employee_id']."'");
		$result2 = mysql_fetch_assoc($sql2);
		$total_number = $result2[$text]+$_POST[$text];
		$result = mysql_query("UPDATE leavesys.user SET ".$result1['code']."='".$total_number."' WHERE id='".$_POST['employee_id']."'");
		if(! $result )
		{
		  die('Could not enter data: ' . mysql_error());
		}
		//movemet
	}
	
}

echo "<script>window.location.href = 'index.php?loc=remaining_leave';</script>";

?>
<?php
$this_time = date("Y-m-d h:i:s");
if(isset($_POST['approve_btn'])){
	$action = '1';
}else if(isset($_POST['reject_btn'])){
	$action = '2';
}else{
	$action = '0';
}

$result = mysql_query("UPDATE leavesys.leave SET approve_by = '".$_SESSION["login_id"]."', approve_date = '".$this_time."', reason = '".$_POST['comment']."', status = '".$action."' WHERE id='".$_POST['record_id']."'");
if(! $result )
{
  die('Could not enter data: ' . mysql_error());
}

if($action == '2'){
	echo "<script>window.location.href = 'index.php?loc=pending_records&page=1';</script>";
	exit();
}

$sql1 = mysql_query("SELECT * FROM leavesys.leave WHERE id = '".$_POST['record_id']."'");
$result1 = mysql_fetch_assoc($sql1);

$fromDate = new DateTime($result1['from_date']);
$toDate = new DateTime($result1['to_date']);


for($i = $fromDate; $i <= $toDate; $i->modify('+1 day')){
	$timestamp = $i->getTimestamp();
	$weekday= date("l", $timestamp );
	$offday = strtolower($weekday);
	
	$this_date = date("Y-m-d", $timestamp);
	$ccc = $i->format('Y-m-d');
	
	//insert leave details
	if($ccc == $result1['from_date']){
		if($result1['from_half'] == 1){
			$sql2 = "INSERT INTO leavesys.leave_details(applicant_id, date, half, ref_id) VALUES ('".$result1['applicant_id']."' ,'".$this_date."' , '1', '".$_POST['record_id']."');";
		}else if($result1['from_half'] == 2){
			$sql2 = "INSERT INTO leavesys.leave_details(applicant_id, date, half, ref_id) VALUES ('".$result1['applicant_id']."' ,'".$this_date."' , '2', '".$_POST['record_id']."');";
		}else{
			$sql2 = "INSERT INTO leavesys.leave_details(applicant_id, date, half, ref_id) VALUES ('".$result1['applicant_id']."' ,'".$this_date."' , '0', '".$_POST['record_id']."');";
		}
	}else if($ccc == $result1['to_date']){
		if($result1['to_half'] == 1){
			$sql2 = "INSERT INTO leavesys.leave_details(applicant_id, date, half, ref_id) VALUES ('".$result1['applicant_id']."' ,'".$this_date."' , '1', '".$_POST['record_id']."');";
		}else if($result1['to_half'] == 2){
			$sql2 = "INSERT INTO leavesys.leave_details(applicant_id, date, half, ref_id) VALUES ('".$result1['applicant_id']."' ,'".$this_date."' , '2', '".$_POST['record_id']."');";
		}else{
			$sql2 = "INSERT INTO leavesys.leave_details(applicant_id, date, half, ref_id) VALUES ('".$result1['applicant_id']."' ,'".$this_date."' , '0', '".$_POST['record_id']."');";
		}
	}else{
		$sql2 = "INSERT INTO leavesys.leave_details(applicant_id, date, half, ref_id) VALUES ('".$result1['applicant_id']."' ,'".$this_date."' , '0', '".$_POST['record_id']."');";
	}
	$retval2 = mysql_query($sql2);
	if(! $retval2 )
	{
	  die('Could not enter data: ' . mysql_error());
	}
	
}

//check due or leave have to deduct
$sql3 = mysql_query("SELECT SUM(day) AS total_due FROM leavesys.due_leave WHERE user_id = '".$result1['applicant_id']."' AND leave_type = '".$result1['leave_type']."' AND status = 0");
$result3 = mysql_fetch_assoc($sql3);
$balance_leave = $result1['total_date']; //total apply leave
if($result3['total_due'] > 0){
	//deduct due until leave apply become 0;
	$sql4 = mysql_query("SELECT * FROM leavesys.due_leave WHERE user_id = '".$result1['applicant_id']."' AND leave_type = '".$result1['leave_type']."' ORDER BY e_date ASC");
	while($result4 = mysql_fetch_array($sql4)){
		if($result4['day'] >= $balance_leave){
			if($result4['day'] > $balance_leave){
				$left_due = $result4['day'] - $balance_leave;
				$result6 = mysql_query("UPDATE leavesys.due_leave SET day = '".$left_due."' WHERE id='".$result4['id']."'");
				if(! $result6 )
				{
				  die('Could not enter data: ' . mysql_error());
				}
				//movement
				$sql7 = "INSERT INTO leavesys.leave_movement(leave_type,day,from_table,ref_id, leave_id) VALUES ('".$result1['leave_type']."', '".$balance_leave."', '1','".$result4['id']."', '".$_POST['record_id']."');";
				$retval7 = mysql_query($sql7);
				if(! $retval7 )
				{
				  die('Could not enter data: ' . mysql_error());
				}
				break;
			}else{
				$result6 = mysql_query("UPDATE leavesys.due_leave SET status = '1' WHERE id='".$result4['id']."'");
				if(! $result6 )
				{
				  die('Could not enter data: ' . mysql_error());
				}
				//movement
				$sql8 = "INSERT INTO leavesys.leave_movement(leave_type,day,from_table,ref_id, leave_id) VALUES ('".$result1['leave_type']."', '".$result4['day']."', '1','".$result4['id']."', '".$_POST['record_id']."');";
				$retval8 = mysql_query($sql8);
				if(! $retval8 )
				{
				  die('Could not enter data: ' . mysql_error());
				}
				break;
			}
			
		}else{
			//deduct all due than go to leave table.
			$total_deduct_due_leave += $result4['day']; //updated apply leave amount
			$result5 = mysql_query("UPDATE leavesys.due_leave SET status = '1' WHERE id='".$result4['id']."'");
			if(! $result5 )
			{
			  die('Could not enter data: ' . mysql_error());
			}
			//movement
			$sql9 = "INSERT INTO leavesys.leave_movement(leave_type,day,from_table,ref_id, leave_id) VALUES ('".$result1['leave_type']."', '".$result4['day']."', '1','".$result4['id']."', '".$_POST['record_id']."');";
			$retval9 = mysql_query($sql9);
			if(! $retval9 )
			{
			  die('Could not enter data: ' . mysql_error());
			}
			if($result3['total_due'] == $total_deduct_due_leave){
				$sql6 = mysql_query("SELECT * FROM leavesys.user WHERE id = '".$result1['applicant_id']."'");
				$result6 = mysql_fetch_assoc($sql6);
				$leaveTypeName = $result1['leave_type'];
				$left_apply = $balance_leave - $total_deduct_due_leave;
				$new_leave_amount = $result6[$leaveTypeName] - $left_apply;
				
				$result6 = mysql_query("UPDATE leavesys.user SET ".$result1['leave_type']." = '".$new_leave_amount."' WHERE id='".$result1['applicant_id']."'");
				if(! $result6 )
				{
				  die('Could not enter data: ' . mysql_error());
				}
				
				//movement
				$sql10 = "INSERT INTO leavesys.leave_movement(leave_type,day,from_table,ref_id, leave_id) VALUES ('".$result1['leave_type']."', '".$left_apply."', '0','".$result1['applicant_id']."', '".$_POST['record_id']."');";
				$retval10 = mysql_query($sql10);
				if(! $retval10 )
				{
				  die('Could not enter data: ' . mysql_error());
				}
			}
		}
	}
}else{
	//no due, direct deduct leave
	$sql6 = mysql_query("SELECT * FROM leavesys.user WHERE id = '".$result1['applicant_id']."'");
	$result6 = mysql_fetch_assoc($sql6);
	$leaveTypeName = $result1['leave_type'];
	$new_leave_amount = $result6[$leaveTypeName] - $balance_leave;
	
	$result6 = mysql_query("UPDATE leavesys.user SET ".$result1['leave_type']." = '".$new_leave_amount."' WHERE id='".$result1['applicant_id']."'");
	if(! $result6 )
	{
	  die('Could not enter data: ' . mysql_error());
	}
	
	//movement
	$sql11 = "INSERT INTO leavesys.leave_movement(leave_type,day,from_table,ref_id, leave_id) VALUES ('".$result1['leave_type']."', '".$balance_leave."', '0','".$result1['applicant_id']."', '".$_POST['record_id']."');";
	$retval11 = mysql_query($sql11);
	if(! $retval11 )
	{
	  die('Could not enter data: ' . mysql_error());
	}
}




echo "<script>window.location.href = 'index.php?loc=pending_records&page=1';</script>";

?>
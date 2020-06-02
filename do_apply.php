<?php
$fromDate = new DateTime($_POST['fromDate']);
$toDate = new DateTime($_POST['toDate']);

//pop up documnet submit
switch($_POST['optradio']){
	case "cp":
		echo"<script>alert('Please Submit Documentary Evidence.');</script>";
		break;
	case "ia":
		echo"<script>alert('Please Submit Documentary Evidence.');</script>";
		break;
	case "hp":
		echo"<script>alert('Please Submit Documentary Evidence.');</script>";
		break;
	case "ns":
		echo"<script>alert('Please Submit Documentary Evidence.');</script>";
		break;
	case "mg":
		echo"<script>alert('Please Submit Documentary Evidence.');</script>";
		break;
	case "mt":
		echo"<script>alert('Please Submit Documentary Evidence.');</script>";
		break;
	case "pt":
		echo"<script>alert('Please Submit Documentary Evidence.');</script>";
		break;
	case "mc":
		echo"<script>alert('Please Submit Documentary Evidence.');</script>";
		break;
}

//check form
if($_POST['fromDate'] == NULL || $_POST['toDate'] == NULL){
	echo"<script>alert('Please Select a Date Range.');</script>";
	echo "<script>window.history.go(-1)</script>";
	exit;
}

if($fromDate > $toDate){
	echo"<script>alert('Date Range incorrect.');</script>";
	echo "<script>window.history.go(-1)</script>";
	exit;
}

if($fromDate == $toDate){
	if($_POST['fromHalf'] == 1 && $_POST['toHalf'] == 2){
		echo"<script>alert('Date Range incorrect.');</script>";
		echo "<script>window.history.go(-1)</script>";
		exit;
	}
	
	if($_POST['fromHalf'] == 2 && $_POST['toHalf'] == 1){
		echo"<script>alert('Date Range incorrect.');</script>";
		echo "<script>window.history.go(-1)</script>";
		exit;
	}
}

//check duplicated leave
$sql2 = mysql_query("SELECT * FROM leavesys.leave WHERE applicant_id ='".$_POST['login_id']."' AND status = '1'");
while($result2 = mysql_fetch_array($sql2)){
	if(strtotime($_POST['fromDate']) >= strtotime($result2['from_date']) && strtotime($_POST['fromDate']) <= strtotime($result2['to_date'])){
		echo"<script>alert('Duplicated Record(s) found.');</script>";
		echo "<script>window.history.go(-1)</script>";
		exit;
	}
	
	if(strtotime($_POST['toDate']) >= strtotime($result2['from_date']) && strtotime($_POST['toDate']) <= strtotime($result2['to_date'])){
		echo"<script>alert('Duplicated Record(s) found.');</script>";
		echo "<script>window.history.go(-1)</script>";
		exit;
	}
}


//verify actual leave amount
$total_day=1;
for($i = $fromDate; $i <= $toDate; $i->modify('+1 day')){
	$timestamp = $i->getTimestamp();
	$weekday= date("l", $timestamp );
	$offday = strtolower($weekday);
	
	if (($offday != "monday") && ($offday != "sunday")) {
		$total_day += 1;
	}
	
	
	$this_date = date("Y-m-d", $timestamp);
	$ccc = $i->format('Y/m/d');
	
	/*
	//insert leave details
	if($ccc == $_POST['fromDate']){
		if($_POST['fromHalf'] == 1){
			$sql1 = "INSERT INTO leavesys.leave_details(applicant_id, date, half) VALUES ('".$_POST['login_id']."' ,'".$this_date."' , '1');";
		}else if($_POST['fromHalf'] == 2){
			$sql1 = "INSERT INTO leavesys.leave_details(applicant_id, date, half) VALUES ('".$_POST['login_id']."' ,'".$this_date."' , '2');";
		}else{
			$sql1 = "INSERT INTO leavesys.leave_details(applicant_id, date, half) VALUES ('".$_POST['login_id']."' ,'".$this_date."' , '0');";
		}
	}else if($ccc == $_POST['toDate']){
		if($_POST['toHalf'] == 1){
			$sql1 = "INSERT INTO leavesys.leave_details(applicant_id, date, half) VALUES ('".$_POST['login_id']."' ,'".$this_date."' , '1');";
		}else if($_POST['toHalf'] == 2){
			$sql1 = "INSERT INTO leavesys.leave_details(applicant_id, date, half) VALUES ('".$_POST['login_id']."' ,'".$this_date."' , '2');";
		}else{
			$sql1 = "INSERT INTO leavesys.leave_details(applicant_id, date, half) VALUES ('".$_POST['login_id']."' ,'".$this_date."' , '0');";
		}
	}else{
		$sql1 = "INSERT INTO leavesys.leave_details(applicant_id, date, half) VALUES ('".$_POST['login_id']."' ,'".$this_date."' , '0');";
	}
	$retval1 = mysql_query($sql1);
	if(! $retval1 )
	{
	  die('Could not enter data: ' . mysql_error());
	}
	
	*/
}

//deduct half day
/*if($_POST['fromHalf'] == 1 && $_POST['toHalf'] == 1){
	$total_day -= 0.5;
}else if($_POST['fromHalf'] == 2 && $_POST['toHalf'] == 2){
	$total_day -= 0.5;
}else if($_POST['fromHalf'] == 1 && $_POST['toHalf'] == 2){
	$total_day -= 1;
}else if($_POST['fromHalf'] == 2 && $_POST['toHalf'] == 1){
	$total_day -= 1;
}*/

if($_POST['fromDate'] == $_POST['toDate']){
	if($_POST['fromHalf'] == 1 && $_POST['toHalf'] == 1){
	$total_day -= 0.5;
	}else if($_POST['fromHalf'] == 2 && $_POST['toHalf'] == 2){
		$total_day -= 0.5;
	}
}else{
	if($_POST['fromHalf'] == 1){
		$total_day -= 0.5;
	}

	if($_POST['fromHalf'] == 2){
		$total_day -= 0.5;
	}

	if($_POST['toHalf'] == 1){
		$total_day -= 0.5;
	}

	if($_POST['toHalf'] == 2){
		$total_day -= 0.5;
	}
}

$total_day--;

//current timestamp
$objDateTime = new DateTime('NOW');
$apply_date = $objDateTime->format('Y-m-d H:i:s');

 
//insert leave
$sql = "INSERT INTO leavesys.leave(applicant_id, leave_type, applicant_reason, from_date, from_half, to_date, to_half, total_date, apply_date) VALUES ('".$_POST['login_id']."' ,'".$_POST['optradio']."' ,'".$_POST['comment']."' ,'".$_POST['fromDate']."', '".$_POST['fromHalf']."' ,'".$_POST['toDate']."', '".$_POST['toHalf']."' ,'".$total_day."' ,'".$apply_date."');";
$retval = mysql_query($sql);
if(! $retval )
{
  die('Could not enter data: ' . mysql_error());
}else{
	echo "<script>alert('You have successfully applied your leave, waiting for approval.');</script>";
	echo "<script>window.location='index.php?loc=apply'</script>";
}

?>
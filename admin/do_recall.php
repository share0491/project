<?php
$sql = mysql_query("SELECT * FROM leavesys.leave_movement WHERE leave_id = '".$_POST['record_id']."'");
while($result = mysql_fetch_array($sql)){
	if($result['from_table'] == 0){
		$retval1 = mysql_query("UPDATE leavesys.user SET ".$result['leave_type']." = ".$result['leave_type']." + ".$result['day']." WHERE id='".$result['ref_id']."'");
		if(! $retval1 )
		{
		  die('Could not enter data1: ' . mysql_error());
		}
		
		//delete records
		$retval2 = mysql_query("DELETE FROM leave_movement WHERE id='".$result['id']."'");
		if(! $retval2 )
		{
		  die('Could not enter data2: ' . mysql_error());
		}
	}else{
		$sql3 = mysql_query("SELECT * FROM due_leave WHERE id = '".$result['ref_id']."'");
		$result3 = mysql_fetch_assoc($sql3);
		if($result['day'] == $result3['day']){
			$retval1 = mysql_query("UPDATE due_leave SET status = '0' WHERE id='".$result['ref_id']."'");
			if(! $retval1 )
			{
			  die('Could not enter data3: ' . mysql_error());
			}
			
			//delete records
			$retval2 = mysql_query("DELETE FROM leave_movement WHERE id='".$result['id']."'");
			if(! $retval2 )
			{
			  die('Could not enter data4: ' . mysql_error());
			}
		}else{
			//due leave more than apply leave
			$retval1 = mysql_query("UPDATE due_leave SET day = day + ".$result['day']." WHERE id='".$result['ref_id']."'");
			if(! $retval1 )
			{
			  die('Could not enter data5: ' . mysql_error());
			}
			
			//delete records
			$retval2 = mysql_query("DELETE FROM leave_movement WHERE id='".$result['id']."'");
			if(! $retval2 )
			{
			  die('Could not enter data6: ' . mysql_error());
			}
		}
	}
}


//update leave status to recall
$retval4 = mysql_query("UPDATE leavesys.leave SET status = '3' WHERE id='".$_POST['record_id']."'");
if(! $retval4 )
{
  die('Could not enter data7: ' . mysql_error());
}

//remove leave details
$retval5 = mysql_query("DELETE FROM leave_details WHERE ref_id='".$_POST['record_id']."'");
if(! $retval5 )
{
  die('Could not enter data7: ' . mysql_error());
}

echo "<script>window.location.href = 'index.php?loc=app_details&page=1';</script>";
?>
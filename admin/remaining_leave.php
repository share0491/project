<div class="panel panel-default table-responsive">
<div class="panel-heading">Staff Leave Remaining List</div>
<table class="table table-bordered table-hover">
<tr><th class='text-center'>#</th><th class='text-center'>Staff</th><th class='text-center'>AL</th><th class='text-center'>NPL</th><th class='text-center'>MC</th><th class='text-center'>CCL</th><th class='text-center'>MAT</th><th class='text-center'>PL</th><th class='text-center'>COMP</th><th class='text-center'>HL</th><th class='text-center'>ML</th><th class='text-center'>IA</th><th class='text-center'>NS</th><th class='text-center'>OT</th></tr>

<?php
$i=1;
$sql = mysql_query("SELECT * FROM user");
while($result = mysql_fetch_array($sql)){
	echo "<tr><td class='text-center'>".$i."</td>";
	echo "<td class='text-center'><a href='?loc=leave_balance&user_id=".$result['id']."'>".$result['name']."</a></td>";
	echo "<td class='text-center'>";
	if($result['is_al']==1){
		echo $result['al'];
		calDueLeave('al', $result['id']);
	}else{
		echo"N/A";
	};
	echo"</td>";
	echo "<td class='text-center'>";
	if($result['is_np']==1){
		echo $result['np'];
		calDueLeave('np', $result['id']);
	}else{
		echo"N/A";
	};
	echo"</td>";
	echo "<td class='text-center'>";
	if($result['is_mc']==1){
		echo $result['mc'];
		calDueLeave('mc', $result['id']);
	}else{
		echo"N/A";
	};
	echo"</td>";
	echo "<td class='text-center'>";
	if($result['is_cc']==1){
		echo $result['cc'];
		calDueLeave('cc', $result['id']);
	}else{
		echo"N/A";
	};
	echo"</td>";
	echo "<td class='text-center'>";
	if($result['is_mt']==1){
		echo $result['mt'];
		calDueLeave('mt', $result['id']);
	}else{
		echo"N/A";
	};
	echo"</td>";
	echo "<td class='text-center'>";
	if($result['is_pl']==1){
		echo $result['pl'];
		calDueLeave('pl', $result['id']);
	}else{
		echo"N/A";
	};
	echo"</td>";
	echo "<td class='text-center'>";
	if($result['is_cp']==1){
		echo $result['cp'];
		calDueLeave('cp', $result['id']);
	}else{
		echo"N/A";
	};
	echo"</td>";
	echo "<td class='text-center'>";
	if($result['is_hp']==1){
		echo $result['hp'];
		calDueLeave('hp', $result['id']);
	}else{
		echo"N/A";
	};
	echo"</td>";
	echo "<td class='text-center'>";
	if($result['is_mg']==1){
		echo $result['mg'];
		calDueLeave('mg', $result['id']);
	}else{
		echo"N/A";
	};
	echo"</td>";
	echo "<td class='text-center'>";
	if($result['is_ia']==1){
		echo $result['ia'];
		calDueLeave('ia', $result['id']);
	}else{
		echo"N/A";
	};
	echo"</td>";
	echo "<td class='text-center'>";
	if($result['is_ns']==1){
		echo $result['ns'];
		calDueLeave('ns', $result['id']);
	}else{
		echo"N/A";
	};
	echo"</td>";
	echo "<td class='text-center'>";
	if($result['is_ot']==1){
		echo $result['ot'];
		calDueLeave('ot', $result['id']);
	}else{
		echo"N/A";
	};
	echo"</td>";
	
	echo "</tr>";
$i++;
}	
?>
</table>
</div>

<?php

function calDueLeave($leaveType, $userID){
	$total_due = 0;
	$today = date('Y-m-d');
	$sql1 = mysql_query("SELECT * FROM due_leave WHERE status = 0 AND e_date >='".$today."' AND leave_type='".$leaveType."' AND user_id = '".$userID."'");
	while($result1 = mysql_fetch_array($sql1)){
		$total_due += $result1['day'];
	}
	
	if($total_due > 0){
		echo" +(".$total_due.")";
	}
}
?>
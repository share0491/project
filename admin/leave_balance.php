<div class="col-xs-12 col-md-12">
<table class="table table-bordered">
  <thead>
    <tr>
      <th>Leave Type</th>
      <th>Balance</th>
	  <th>Leave Type</th>
      <th>Balance</th>
	  <th>Leave Type</th>
      <th>Balance</th>
    </tr>
  </thead>
  <tbody>
  <?php
	$sql = mysql_query("SELECT * FROM leavesys.user WHERE id = '".$_GET["user_id"]."'");
	$result = mysql_fetch_assoc($sql);
	echo "<tr><th scope='row'>Annual</th><td>";
	if($result['is_al']==1){
		calcTotalLeave('al',$result['al']);
	}else{
		echo"N/A";
	};
	echo"</td><th scope='row'>No Pay</th><td>";
	if($result['is_np']==1){
		calcTotalLeave('np',$result['np']);
	}else{
		echo"N/A";
	};
	echo"</td><th scope='row'>Child Care</th><td>";
	if($result['is_cc']==1){
		calcTotalLeave('cc',$result['cc']);
	}else{
		echo"N/A";
	};
	echo"</td></tr>";
	echo "<tr><th scope='row'>Maternity</th><td>";
	if($result['is_mt']==1){
		calcTotalLeave('mt',$result['mt']);
	}else{
		echo"N/A";
	};
	echo"</td><th scope='row'>Paternity</th><td>";
	if($result['is_pl']==1){
		calcTotalLeave('cp',$result['pl']);
	}else{
		echo"N/A";
	};
	echo"</td><th scope='row'>Compassionate</th><td>";
	if($result['is_cp']==1){
		calcTotalLeave('cp',$result['cp']);
	}else{
		echo"N/A";
	};
	echo"</td></tr>";
	echo "<tr><th scope='row'>Hospitalization</th><td>";
	if($result['is_hp']==1){
		calcTotalLeave('hp',$result['hp']);
	}else{
		echo"N/A";
	};
	echo"</td>";
	echo "<th scope='row'>Marriage</th><td>";
	if($result['is_mg']==1){
		calcTotalLeave('mg',$result['mg']);
	}else{
		echo"N/A";
	};
	echo"</td><th scope='row'>Medical</th><td>";
	if($result['is_mc']==1){
		calcTotalLeave('mc',$result['mc']);
	}else{
		echo"N/A";
	};
	echo"</td></tr>";
	echo"<tr><th scope='row'>Industrial Accident</th><td>";
	if($result['is_ia']==1){
		calcTotalLeave('ia',$result['ia']);
	}else{
		echo"N/A";
	};
	echo"</td>";
	echo "<th scope='row'>National Service</th><td>";
	if($result['is_ns']==1){
		calcTotalLeave('ns',$result['ns']);
	}else{
		echo"N/A";
	};
	echo"</td><th scope='row'>Others</th><td>";
	if($result['is_ot']==1){
		calcTotalLeave('ot',$result['ot']);
	}else{
		echo"N/A";
	};
	echo"</td></tr>";
	?>
    
  </tbody>
</table>
</div>

<div class="col-md-12 col-xs-11">
	<table class="table">
	<thead>
    <tr>
      <th>#</th>
      <th>Leave Type</th>
      <th>Day(s)</th>
      <th>Get On</th>
      <th>Expired On</th>
    </tr>
	</thead>
	<tbody>
	<?php
	$i=1;
	//$three_month =  date('Y-m-d', strtotime('+3 months'));
	$today = date('Y-m-d');
	$sql1 = mysql_query("SELECT * FROM due_leave WHERE user_id = '".$_GET["user_id"]."' AND e_date >= '".$today."' AND status = '0'");
	while($result1 = mysql_fetch_array($sql1)){
		echo"<tr><th scope='row'>".$i."</th>";
		echo"<td>";
		switch($result1['leave_type']){
			case 'al':
				echo"Annual";
				break;
			case 'np':
				echo"No Pay";
				break;
			case 'cp':
				echo"Compassionate";
				break;
			case 'ia':
				echo"Industrial Accident";
				break;
			case 'hp':
				echo"Hospitalization";
				break;
			case 'ns':
				echo"National Service";
				break;
			case 'cc':
				echo"Child Care";
				break;
			case 'mg':
				echo"Marriage";
				break;
			case 'mt':
				echo"Maternity/Paternity";
				break;
			case 'pl':
				echo"Paternity";
				break;
			case 'mc':
				echo"Medical";
				break;
			case 'ot':
				echo"Others";
				break;
		}
		echo"</td>";
		echo"<td>".$result1['day']."</td>";
		echo"<td>".$result1['date']."</td>";
		echo"<td>".$result1['e_date']."</td>";
		echo"</tr>";
		$i++;
	}
	if($i<2){
		echo"<tr><td colspan='5'>No Due Leave(s)</td></tr>";
	}
	?>
	</tbody>
</table>
</div>

<?php
function calcTotalLeave($lt,$ta){
	$today = date('Y-m-d');
	$sql2 = mysql_query("SELECT * FROM due_leave WHERE leave_type='".$lt."' AND user_id = '".$_GET["user_id"]."' AND e_date >= '".$today."' AND status = '0'");
	while($result2 = mysql_fetch_array($sql2)){
		$total_half_leave += $result2['day'];
	}
	$total_leave = $ta + $total_half_leave;
	echo $total_leave;
}
?>
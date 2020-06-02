<script type="text/javascript">
function linkTransfer(){
	var fDate=$('#example1').val();
	var tDate=$('#example2').val();
	var leaveType=$('#leaveType').val();
	var staff=$('#staff').val();
	var dept=$('#dept').val();
	
	window.location.href = "?loc=app_details&fromDate="+fDate+"&toDate="+tDate+"&dept="+dept+"&leaveType="+leaveType+"&staff="+staff;
	
}
</script>
<div class="container">
<div class="col-xs-11 col-md-12">
<div class="col-xs-11 col-md-4">
	<label class="col-xs-11 col-md-2 control-label" style="text-align:center;">Date Range:</label>
	<div class="col-xs-11 col-md-5"><input class="form-control" type="text" name="fromDate" id="example1" value="" placeholder="From"></div>
	<div class="col-xs-11 col-md-5"><input class="form-control" type="text" name="toDate" id="example2" value="" placeholder="To"></div>
</div>
<div class="col-xs-11 col-md-3">
	<label class="col-xs-11 col-md-6 control-label" style="text-align:center;">Department:</label>
	<div class="col-xs-11 col-md-6">
	<select name="dept" id="dept" class="form-control">
	<option value=''>--ALL--</option>
	<?php
		$sql5 = mysql_query("SELECT * FROM user GROUP BY dept");
		while($result5 = mysql_fetch_array($sql5)){
			echo "<option value='".$result5['dept']."'>".$result5['dept']."</option>";
			
		}
	?>
	</select>
	</div>
</div>
<div class="col-xs-11 col-md-5">
	<label class="col-xs-11 col-md-2 control-label" style="text-align:center;">Leave Type:</label>
	<div class="col-xs-11 col-md-3">
	<select name="leaveType" id="leaveType" class="form-control">
	<option value=''>--ALL--</option>
	<?php
		$sql3 = mysql_query("SELECT * FROM leave_type ORDER BY id ASC");
		while($result3 = mysql_fetch_array($sql3)){
			echo "<option value='".$result3['code']."'>".$result3['name']."</option>";
			
		}
	?>
	</select>
	</div>
	<label class="col-xs-11 col-md-2 control-label" style="text-align:center;">Staff:</label>
	<div class="col-xs-11 col-md-4">
	<select name="staff" id="staff" class="form-control">
	<option value=''>--ALL--</option>
	<?php
		$sql4 = mysql_query("SELECT * FROM user");
		while($result4 = mysql_fetch_array($sql4)){
			echo "<option value='".$result4['id']."'>".$result4['name']."</option>";
			
		}
	?>
	</select>
	</div>
</div>
</div>
<div class="col-xs-11 col-md-12 text-right">
<br/>
<input class="btn" type="submit" name="Submit" value="Submit" onclick="linkTransfer()">
</div>

<div class="col-xs-12 col-md-12" style="padding-top:15px;">
<table class="table table-striped table-hover">
  <thead class="thead-inverse">
    <tr>
      <th>#</th>
      <th>Applied Date</th>
      <th>Applicant</th>
      <th>Date Range</th>
      <th>Type</th>
      <th>Total Day(s)</th>
      <th>Status</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
	  <?php
		if($_GET['fromDate'] != NULL && $_GET['toDate'] != NULL){
			$statement .= " AND from_date>='".$_GET['fromDate']."' AND to_date<='".$_GET['toDate']."'";
		}else if($_GET['fromDate'] != NULL && $_GET['toDate'] == NULL){
			$statement .= "AND from_date='".$_GET['fromDate']."'";
		}else if($_GET['toDate'] != NULL && $_GET['fromDate'] == NULL){
			$statement .= " AND to_date='".$_GET['toDate']."'";
		}
		
		
		if($_GET['leaveType'] != NULL){
			$statement .= " AND leave_type='".$_GET['leaveType']."'";
		}
		if($_GET['staff'] != NULL){
			$statement .= " AND applicant_id='".$_GET['staff']."'";
		
		}
		
		if($_GET['dept'] != NULL){
			$i =0;
			$sql6 = mysql_query("SELECT * FROM leavesys.user WHERE dept = '".$_GET['dept']."'");
			if($sql6 === FALSE) { 
				die(mysql_error()); // TODO: better error handling
			}
			while($result6 = mysql_fetch_array($sql6)){
				if($i<1){
					$statement .= " AND applicant_id='".$result6['id']."'";
				}else{
					$statement .= " OR applicant_id='".$result6['id']."'";
				}
				$i++;
			}
			
		}
		
		$i=1;
		if(isset($_GET['page'])){
			$start = ($_GET['page'] * 10) - 10;
			$sql = mysql_query("SELECT * FROM leavesys.leave WHERE status != '0' ".$statement." ORDER BY apply_date DESC LIMIT ".$start.", 10");
			$back = $_GET['page']-1;
			$next = $_GET['page']+1;
		}else{
			$sql = mysql_query("SELECT * FROM leavesys.leave WHERE status != '0' ".$statement." ORDER BY apply_date DESC LIMIT 10");
			$next = 2;
		}
		//echo var_dump("SELECT * FROM leavesys.leave WHERE status != '0' ".$statement." ORDER BY apply_date DESC LIMIT ".$start.", 10");
		if($_GET['page']>1){
			$i=($_GET['page']*10)-9;
		}
		while($result = mysql_fetch_array($sql)){
			echo"<tr>";
			echo"<th scope='row'>".$i."</th>";
			echo"<td>".$result['apply_date']."</td>";
			$sql2 = mysql_query("SELECT * FROM user WHERE id= '".$result['applicant_id']."'");
			$result2 = mysql_fetch_assoc($sql2);
			echo"<td>".$result2['name']."</td>";
			echo"<td>".$result['from_date'];
			switch($result['from_half']){
				case 1:
					echo "(am)";
					break;
				case 2:
					echo "(pm)";
					break;
			};
			echo" To ".$result['to_date'];
			switch($result['to_half']){
				case 1:
					echo "(am)";
					break;
				case 2:
					echo "(pm)";
					break;
			};
			echo "</td>";
			echo"<td>";
				$sql5 = mysql_query("SELECT * FROM leave_type WHERE code = '".$result['leave_type']."'");
				$result5 = mysql_fetch_assoc($sql5);
				echo $result5['name'];
			echo"</td>";
			echo"<td>".$result['total_date']."</td>";
			echo"<td>";
			switch($result['status']){
				case 0:
					echo "Pending";
					break;
				case 1:
					echo "<font color='green'>Approved</font>";
					break;
				case 2:
					echo "<font color='red'>Rejected</font>";
					break;
				case 3:
					echo "<font color='grey'>Recall</font>";
					break;
			}
			echo"</td>";
			echo"<td><a type='submit' class='btn btn-default without-print post' href='index.php?loc=view_record_details&id=".$result['id']."'><span class='glyphicon glyphicon-search' aria-hidden='true'></span> View</a></td>";
			
			//echo"<td><input class='btn' type='submit' name='Submit' value='Cancel' onclick='window.location.href=\"index.php?loc=update_records&id=".$result['id']."\";'></td>";
			echo"</tr>";
			$i++;
		}
	  ?>
  </tbody>
</table>
<?php
$sql1 = mysql_query("SELECT * FROM leavesys.leave WHERE status != '0' ".$statement.";");
$number_of_rows = mysql_num_rows($sql1);
$end_page = $number_of_rows /10;
echo"<div class='col-md-12 col-xs-12 text-right'>";
if($_GET['page'] > 1){
		echo "<a type='submit' class='btn' href='index.php?loc=app_details&page=".$back."'><span class='glyphicon glyphicon-chevron-left' aria-hidden='true'></span></a>";
}

if($_GET['page'] >= 1 && $_GET['page'] <= $end_page){
	echo "<a type='submit' class='btn' href='index.php?loc=app_details&page=".$next."'><span class='glyphicon glyphicon-chevron-right' aria-hidden='true'></span></a>";
}

echo"</div>";
?>
</div>
</div>


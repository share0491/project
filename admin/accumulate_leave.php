<style>
#leaveForm {
    margin-top: 15px;
    margin-left: 15px;
}
</style>
<h3>Accumulate Leave</h3>
<form id="leaveForm" class="form-horizontal" method="post" action="index.php?loc=add_accu_leave">
	
	<div class="form-group">
		<div class="col-xs-11 col-md-12">
			<div class="col-xs-12 col-md-2"><label>Employee Name : </label></div>
			<div class="col-xs-12 col-md-4 pull-left">
				<select class="form-control" name="employee_id">
				<?php
				$sql1 = mysql_query("SELECT * FROM user");
				while($result1 = mysql_fetch_array($sql1)){
					echo "<option value='".$result1['id']."'>".$result1['name']."</option>";
				
				}
				?>
				</select>
			</div>
		</div>
	</div>
	
	<div class="form-group text-center">
	<input type="hidden" value="<?php echo $_SESSION["login_id"];?>" name="login_id"/>
		<input class="btn btn-primary btn-lg" type="submit" name="Submit" value="Add"></td>
	</div>
</form>

<div class="col-md-12 col-xs-11">
	<table class="table">
	<thead>
    <tr>
      <th>#</th>
      <th>Employee</th>
      <th>Hour</th>
      <th>Action</th>
    </tr>
	</thead>
	<tbody>
	<?php
	$i=1;
	$today = date('Y-m-d');
	$sql1 = mysql_query("SELECT *, SUM(hour) AS total_hour FROM accumulate_leave WHERE status = '0' GROUP BY staff_id");
	while($result1 = mysql_fetch_array($sql1)){
		echo"<tr><th scope='row'>".$i."</th>";
		echo"<td>";
		$sql2 = mysql_query("SELECT * FROM user WHERE id='".$result1['staff_id']."'");
		$result2 = mysql_fetch_assoc($sql2);
		echo $result2['name'];
		echo"</td>";
		echo"<td>".$result1['total_hour']."</td>";
		echo"<td><a type='submit' class='btn btn-default without-print post' href='index.php?loc=update_accu_leave&amp;staff_id=".$result1['staff_id']."'><span class='glyphicon glyphicon-refresh' aria-hidden='true'></span> Convert</a></td>";
		echo"</tr>";
		$i++;
	}
	if($i<2){
		echo"<tr><td colspan='5'>No Accumulate Leave(s)</td></tr>";
	}
	?>
	</tbody>
</table>
</div>
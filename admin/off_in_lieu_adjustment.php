<style>
#leaveForm {
    margin-top: 15px;
    margin-left: 15px;
}
</style>
<h3>Off In Lieu Adjustment</h3>
<form id="leaveForm" class="form-horizontal" method="post" action="index.php?loc=add_offinlieu">
	
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
      <th>Leave Type</th>
      <th>Employee</th>
      <th>Day(s)</th>
      <th>Get On</th>
      <th>Expired On</th>
      <th>Action</th>
    </tr>
	</thead>
	<tbody>
	<?php
	$i=1;
	$today = date('Y-m-d');
	$sql1 = mysql_query("SELECT * FROM due_leave WHERE e_date >= '".$today."' AND status = '0'");
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
		echo"<td>";
		$sql2 = mysql_query("SELECT * FROM user WHERE id='".$result1['user_id']."'");
		$result2 = mysql_fetch_assoc($sql2);
		echo $result2['name'];
		echo"</td>";
		echo"<td>".$result1['day']."</td>";
		echo"<td>".$result1['date']."</td>";
		echo"<td>".$result1['e_date']."</td>";
		echo"<td><a type='submit' class='btn btn-default without-print post' href='index.php?loc=update_offinlieu&amp;off_id=".$result1['id']."' onclick='return confirm(\"Comfirm Remove This Record?\");'><span class='glyphicon glyphicon-remove' aria-hidden='true'></span> Remove</a></td>";
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
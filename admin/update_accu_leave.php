<style>
#leaveForm {
    margin-top: 15px;
    margin-left: 15px;
}
</style>
<h3>Add Off In Lieu</h3>
<form id="leaveForm" class="form-horizontal" method="post" action="index.php?loc=do_update_accu_leave">
	
	<div class="form-group">
		<div class="col-xs-11 col-md-12">
			<div class="col-xs-12 col-md-2"><label>Employee Name : </label></div>
			<div class="col-xs-12 col-md-4 pull-left">
				<?php
				$sql1 = mysql_query("SELECT * FROM user WHERE id='".$_GET['staff_id']."'");
				while($result1 = mysql_fetch_array($sql1)){
					echo $result1['name'];
				}
				?>
			</div>
		</div>
	</div>
	
	<div class="col-md-12 col-xs-11">
	<table class="table">
	<thead>
    <tr>
      <th>#</th>
      <th>Select</th>
      <th>Employee</th>
      <th>Hour</th>
      <th>Date</th>
    </tr>
	</thead>
	<tbody>
	<?php
	$i=1;
	$today = date('Y-m-d');
	$sql1 = mysql_query("SELECT * FROM accumulate_leave WHERE status = '0' AND staff_id='".$_GET['staff_id']."'");
	while($result1 = mysql_fetch_array($sql1)){
		echo"<tr><th scope='row'>".$i."</th>";
		echo"<td><input type='checkbox' name='accbox[]' value='".$result1['id']."'/></td>";
		echo"<td>";
		$sql2 = mysql_query("SELECT * FROM user WHERE id='".$result1['staff_id']."'");
		$result2 = mysql_fetch_assoc($sql2);
		echo $result2['name'];
		echo"</td>";
		echo"<td>".$result1['hour']."</td>";
		echo"<td>".$result1['date']."</td>";
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
	<div class="form-group">
		<label class="col-xs-11 col-md-1 control-label" style="text-align:center;">Expired Date</label>
		<div class="col-xs-11 col-md-2">
			<input class="form-control" type="text" name="eDate" id="example1" value="">
		</div>
	</div>
	
	<div class="form-group text-center">
	<input type="hidden" value="<?php echo $_SESSION["login_id"];?>" name="login_id"/>
	<input type="hidden" value="<?php echo $_GET['staff_id'];?>" name="employee_id"/>
		<input class="btn btn-primary btn-lg" type="submit" name="Submit" value="Convert"></td>
	</div>
</form>
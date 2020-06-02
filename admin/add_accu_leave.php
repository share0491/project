<style>
#leaveForm {
    margin-top: 15px;
    margin-left: 15px;
}
</style>
<h3>Add Accumulate Leave</h3>
<form id="leaveForm" class="form-horizontal" method="post" action="index.php?loc=do_accu_leave">
	
	<div class="form-group">
		<div class="col-xs-11 col-md-12">
			<div class="col-xs-12 col-md-2"><label>Employee Name : </label></div>
			<div class="col-xs-12 col-md-4 pull-left">
				<?php
				$sql1 = mysql_query("SELECT * FROM user WHERE id='".$_POST['employee_id']."'");
				while($result1 = mysql_fetch_array($sql1)){
					echo $result1['name'];
				}
				?>
			</div>
		</div>
	</div>
	<label class="col-xs-11 col-md-11 control-label" style="text-align:left;">*Note: 1hour = 1, 2hours = 2</label>
	<div class="form-group">
		<label class="col-xs-11 col-md-11 control-label" style="text-align:left;">Hour(s) :</label>
		<div class="col-xs-6 col-md-3">
		<input type="text" class="form-control" name="hr" value="">
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-xs-11 col-md-1 control-label" style="text-align:center;">Get Date</label>
		<div class="col-xs-11 col-md-2">
			<input class="form-control" type="text" name="gDate" id="example1" value="">
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-xs-11 col-md-12 control-label" style="text-align:left;">Reasons :</label>
		<textarea class="col-xs-11 col-md-11" rows="5" id="comment" name="comment"></textarea>
	</div>
	
	<div class="form-group text-center">
	<input type="hidden" value="<?php echo $_SESSION["login_id"];?>" name="login_id"/>
	<input type="hidden" value="<?php echo $_POST['employee_id'];?>" name="employee_id"/>
		<input class="btn btn-primary btn-lg" type="submit" name="Submit" value="Add"></td>
	</div>
</form>
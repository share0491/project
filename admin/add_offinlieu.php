<style>
#leaveForm {
    margin-top: 15px;
    margin-left: 15px;
}
</style>
<h3>Add Off In Lieu</h3>
<form id="leaveForm" class="form-horizontal" method="post" action="index.php?loc=do_offinlieu">
	
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
	<label class="col-xs-11 col-md-11 control-label" style="text-align:left;">*Note: Leave blank if N/A</label>
	<div class="form-group">
		<label class="col-xs-11 col-md-11 control-label" style="text-align:left;">Leave Type :</label>
		<div class="col-xs-6 col-md-3">
		<label>AL</label><input type="text" class="form-control" name="al" value="" placeholder="AL">
		<label>OT</label><input type="text" class="form-control" name="ot" value="" placeholder="OT">
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-xs-11 col-md-1 control-label" style="text-align:center;">Expired Date</label>
		<div class="col-xs-11 col-md-2">
			<input class="form-control" type="text" name="eDate" id="example1" value="">
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
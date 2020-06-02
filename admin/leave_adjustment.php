<style>
#leaveForm {
    margin-top: 15px;
    margin-left: 15px;
}
</style>
<h3>Leave Adjustment</h3>
<label class="col-xs-11 col-md-11 control-label" style='color:red;'>*Note: Please adjust with care, once adjusted unable to undo.</label>
<form id="leaveForm" class="form-horizontal" method="post" action="index.php?loc=do_leave_adjustment">
	
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
	<label class="col-xs-11 col-md-11 control-label" style="text-align:left;">*Note: If add leave direct place the digit(i.e: 2), if minus then add a nagetive symbol(i.e: -2). Else leave it blank</label>
	<div class="form-group">
		<label class="col-xs-11 col-md-11 control-label" style="text-align:left;">Leave Type :</label>
		<?php
		$sql2 = mysql_query("SELECT * FROM leave_type");
		while($result2 = mysql_fetch_array($sql2)){
			echo'<div class="col-xs-6 col-md-3">';
			echo'<label>'.$result2['p_code'].'</label><input type="text" class="form-control" name="'.$result2['code'].'" value="" placeholder="'.$result2['p_code'].'">';
			echo'</div>';
		}
		?>
	</div>
	
	<div class="form-group">
		<label class="col-xs-11 col-md-12 control-label" style="text-align:left;">Reasons :</label>
		<textarea class="col-xs-11 col-md-11" rows="5" id="comment" name="comment"></textarea>
	</div>
	
	<div class="form-group text-center">
	<input type="hidden" value="<?php echo $_SESSION["login_id"];?>" name="login_id"/>
		<input class="btn btn-primary btn-lg" type="submit" name="Submit" value="Adjust"></td>
	</div>
</form>
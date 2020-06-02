<style>
#leaveForm {
    margin-top: 15px;
    margin-left: 15px;
}
</style>
<h3>Leave Application</h3>
<?php
$sql = mysql_query("SELECT * FROM user WHERE id = '".$_SESSION["login_sid"]."'");
$result = mysql_fetch_assoc($sql);
?>
<form id="leaveForm" class="form-horizontal" method="post" action="index.php?loc=do_apply">
	
	<div class="form-group">
		<div class="col-xs-6 col-md-6">
			<div class="col-xs-12 col-md-4"><label>Employee Name : </label></div>
			<div class="col-xs-12 col-md-8 pull-left">
				<span style="margin-left:5px;"><?php echo $result['name']; ?></span>
			</div>
		</div>
		<div class="col-xs-6 col-md-6">
			<div class="col-xs-12 col-md-4"><label>Date Join : </label></div>
			<div class="col-xs-12 col-md-8 pull-left">
				<span style="margin-left:5px;"><?php echo $result['date_join']; ?></span>
			</div>
		</div>
	</div>
	
	<div class="form-group">
		<div class="col-xs-6 col-md-6">
			<div class="col-xs-12 col-md-4"><label>Department : </label></div>
			<div class="col-xs-12 col-md-8 pull-left">
				<span style="margin-left:5px;"><?php echo $result['dept']; ?></span>
			</div>
		</div>
		<div class="col-xs-6 col-md-6">
			<div class="col-xs-12 col-md-4"><label>Designation : </label></div>
			<div class="col-xs-12 col-md-8 pull-left">
				<span style="margin-left:5px;"><?php echo $result['designation']; ?></span>
			</div>
		</div>
	</div>
	
	
	<div class="form-group">
		<label class="col-xs-11 col-md-11 control-label" style="text-align:left;">Leave Type :</label>
		<?php
		if($result['is_al'] == 1){
			echo'<div class="col-xs-6 col-md-3">
			<label class="radio-inline"><input type="radio" name="optradio" value="al" checked>Annual</label>
		</div>';
		}
		if($result['is_np'] == 1){
			echo'<div class="col-xs-6 col-md-3">
			<label class="radio-inline"><input type="radio" name="optradio" value="np">No Pay</label>
		</div>';
		}
		if($result['is_cc'] == 1){
			echo'<div class="col-xs-6 col-md-3">
			<label class="radio-inline"><input type="radio" name="optradio" value="cc">Child Care</label>
		</div>';
		}
		if($result['is_mt'] == 1){
			echo'<div class="col-xs-6 col-md-3">
			<label class="radio-inline"><input type="radio" name="optradio" value="mt">Maternity</label>
		</div>	';
		}
		if($result['is_pl'] == 1){
			echo'<div class="col-xs-6 col-md-3">
			<label class="radio-inline"><input type="radio" name="optradio" value="pl">Paternity</label>
		</div>	';
		}
		if($result['is_cp'] == 1){
			echo'<div class="col-xs-6 col-md-3">
			<label class="radio-inline"><input type="radio" name="optradio" value="cp">Compassionate</label>
		</div>';
		}
		if($result['is_hp'] == 1){
			echo'<div class="col-xs-6 col-md-3">
			<label class="radio-inline"><input type="radio" name="optradio" value="hp">Hospitalization</label>
		</div>	';
		}
		if($result['is_mg'] == 1){
			echo'<div class="col-xs-6 col-md-3">
			<label class="radio-inline"><input type="radio" name="optradio"  value="mg">Marriage</label>
		</div>';
		}
		if($result['is_mc'] == 1){
			echo'<div class="col-xs-6 col-md-3">
			<label class="radio-inline"><input type="radio" name="optradio" value="mc">Medical</label>
		</div>';
		}
		if($result['is_ia'] == 1){
			echo'<div class="col-xs-6 col-md-3">
			<label class="radio-inline"><input type="radio" name="optradio" value="ia">Industrial Accident</label>
		</div>';
		}
		if($result['is_ns'] == 1){
			echo'<div class="col-xs-6 col-md-3">
			<label class="radio-inline"><input type="radio" name="optradio" value="ns">National Service</label>
		</div>	';
		}
		if($result['is_ot'] == 1){
			echo'<div class="col-xs-6 col-md-3">
			<label class="radio-inline"><input type="radio" name="optradio" value="ot">Others</label>
		</div>';
		}
		?>
	</div>
	
	<div class="form-group">
		<label class="col-xs-11 col-md-12 control-label" style="text-align:left;">Period :</label>
		<label class="col-xs-11 col-md-1 control-label" style="text-align:center;">From</label>
		<div class="col-xs-11 col-md-2">
			<input class="form-control" type="text" name="fromDate" id="example1" value="">
		</div>
		<div class="col-xs-11 col-md-2">
		  <select class="form-control" name="fromHalf">
			<option value="0">Full Day</option>
			<option value="1">Half Day: am</option>
			<option value="2">Half Day: pm</option>
		  </select>
		</div>
		<label class="col-xs-11 col-md-1 control-label" style="text-align:center;">To</label>
		<div class="col-xs-11 col-md-2">
			<input class="form-control" type="text" name="toDate" id="example2" value="">
		</div>
		<div class="col-xs-11 col-md-2">
		  <select class="form-control" name="toHalf">
			<option value="0">Full Day</option>
			<option value="1">Half Day: am</option>
			<option value="2">Half Day: pm</option>
		  </select>
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-xs-11 col-md-12 control-label" style="text-align:left;">Reasons :</label>
		<textarea class="col-xs-11 col-md-11" rows="5" id="comment" name="comment"></textarea>
	</div>
	
	<div class="form-group text-center">
	<input type="hidden" value="<?php echo $_SESSION["login_sid"];?>" name="login_id"/>
		<input class="btn btn-primary btn-lg" type="submit" name="Submit" value="Submit"></td>
	</div>
</form>
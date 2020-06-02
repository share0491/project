<style>
#leaveForm {
    margin-top: 15px;
    margin-left: 15px;
}
</style>

<?php
if(isset($_GET['id'])){
	$sql = mysql_query("SELECT * FROM user WHERE id = '".$_GET['id']."'");
	$result = mysql_fetch_assoc($sql);
}else{
	echo"Invalid!";
	exit();
}
echo "<h3>".$result['name']."'s Details</h3>";
?>
<form id="leaveForm" class="form-horizontal" method="post" action="index.php?loc=do_edit_staff">
	
	<div class="form-group">
		<div class="col-xs-6 col-md-6">
			<div class="col-xs-12 col-md-4"><label>Employee Name : </label></div>
			<div class="col-xs-12 col-md-8 pull-left">
				<input class="form-control" type="text" name="name" value="<?php echo $result['name']; ?>">
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
				<input class="form-control" type="text" name="dept" value="<?php echo $result['dept']; ?>">
			</div>
		</div>
		<div class="col-xs-6 col-md-6">
			<div class="col-xs-12 col-md-4"><label>Designation : </label></div>
			<div class="col-xs-12 col-md-8 pull-left">
				<input class="form-control" type="text" name="designation" value="<?php echo $result['designation']; ?>">
			</div>
		</div>
	</div>
	
	
	<div class="form-group">
		<label class="col-xs-11 col-md-11 control-label" style="text-align:left;">Entitled Leave & Amount :</label>
		<div class="col-xs-6 col-md-3">
			<label>Annual <input type="checkbox" name="cBox[]" value="is_al" <?if($result['is_al'] == 1){ echo "checked";}?>></label>
			<input class="form-control" type="text" name="d_al" value="<?php echo $result['d_al']; ?>" placeholder="Annual">
		</div>
		<div class="col-xs-6 col-md-3">
			<label>No Pay <input type="checkbox" name="cBox[]" value="is_np" <?if($result['is_np'] == 1){ echo "checked";}?>></label>
			<input class="form-control" type="text" name="d_np" value="<?php echo $result['d_np']; ?>" placeholder="No Pay">
		</div>
		<div class="col-xs-6 col-md-3">
			<label>Child Care <input type="checkbox" name="cBox[]" value="is_cc" <?if($result['is_cc'] == 1){ echo "checked";}?>></label>
			<input class="form-control" type="text" name="d_cc" value="<?php echo $result['d_cc']; ?>" placeholder="Child Care">
		</div>
		<div class="col-xs-6 col-md-3">
			<label>Maternity <input type="checkbox" name="cBox[]" value="is_mt" <?if($result['is_mt'] == 1){ echo "checked";}?>></label>
			<input class="form-control" type="text" name="d_mt" value="<?php echo $result['d_mt']; ?>" placeholder="Maternity">
		</div>
		<div class="col-xs-6 col-md-3">
			<label>Paternity <input type="checkbox" name="cBox[]" value="is_pl" <?if($result['is_pl'] == 1){ echo "checked";}?>></label>
			<input class="form-control" type="text" name="d_pl" value="<?php echo $result['d_pl']; ?>" placeholder="Paternity">
		</div>
		<div class="col-xs-6 col-md-3">
			<label>Compassionate <input type="checkbox" name="cBox[]" value="is_cp" <?if($result['is_cp'] == 1){ echo "checked";}?>></label>
			<input class="form-control" type="text" name="d_cp" value="<?php echo $result['d_cp']; ?>" placeholder="Compassionate">
		</div>
		<div class="col-xs-6 col-md-3">
			<label>Hospitalization <input type="checkbox" name="cBox[]" value="is_hp" <?if($result['is_hp'] == 1){ echo "checked";}?>></label>
			<input class="form-control" type="text" name="d_hp" value="<?php echo $result['d_hp']; ?>" placeholder="Hospitalization">
		</div>
		<div class="col-xs-6 col-md-3">
			<label>Marriage <input type="checkbox" name="cBox[]"  value="is_mg" <?if($result['is_mg'] == 1){ echo "checked";}?>></label>
			<input class="form-control" type="text" name="d_mg" value="<?php echo $result['d_mg']; ?>" placeholder="Marriage">
		</div>
		<div class="col-xs-6 col-md-3">
			<label>Medical <input type="checkbox" name="cBox[]" value="is_mc" <?if($result['is_mc'] == 1){ echo "checked";}?>></label>
			<input class="form-control" type="text" name="d_mc" value="<?php echo $result['d_mc']; ?>" placeholder="Medical">
		</div>
		<div class="col-xs-6 col-md-3">
			<label>Industrial Accident <input type="checkbox" name="cBox[]" value="is_ia" <?if($result['is_ia'] == 1){ echo "checked";}?>></label>
			<input class="form-control" type="text" name="d_ia" value="<?php echo $result['d_ia']; ?>" placeholder="Industrial Accident">
		</div>
		<div class="col-xs-6 col-md-3">
			<label>National Service <input type="checkbox" name="cBox[]" value="is_ns" <?if($result['is_ns'] == 1){ echo "checked";}?>></label>
			<input class="form-control" type="text" name="d_ns" value="<?php echo $result['d_ns']; ?>" placeholder="National Service">
		</div>
		<div class="col-xs-6 col-md-3">
			<label>Others <input type="checkbox" name="cBox[]" value="is_ot" <?if($result['is_ot'] == 1){ echo "checked";}?>></label>
			<input class="form-control" type="text" name="d_ot" value="<?php echo $result['d_ot']; ?>" placeholder="Others">
		</div>
	</div>
	
	<div class="form-group text-center">
	<input type="hidden" value="<?php echo $_GET["id"];?>" name="staff_id"/>
		<input class="btn btn-primary btn-lg" type="submit" name="Submit" value="Update"></td>
	</div>
</form>
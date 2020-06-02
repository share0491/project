<style>
#leaveForm {
    margin-top: 15px;
    margin-left: 15px;
}
</style>
<?php
$sql = mysql_query("SELECT * FROM leavesys.leave WHERE id = '".$_GET['id']."'");
$result = mysql_fetch_assoc($sql);
$sql2 = mysql_query("SELECT * FROM leavesys.user WHERE id='".$result['applicant_id']."'");
$result2 = mysql_fetch_assoc($sql2);
?>
<form id="leaveForm" class="form-horizontal" method="post" action="index.php?loc=do_recall">
	
	<div class="form-group">
		<div class="col-xs-6 col-md-6">
			<div class="col-xs-12 col-md-4"><label>Employee Name : </label></div>
			<div class="col-xs-12 col-md-8 pull-left">
				<span style="margin-left:5px;"><?php echo $result2['name']; ?></span>
			</div>
		</div>
		<div class="col-xs-6 col-md-6">
			<div class="col-xs-12 col-md-4"><label>Date Join : </label></div>
			<div class="col-xs-12 col-md-8 pull-left">
				<span style="margin-left:5px;"><?php echo $result2['date_join']; ?></span>
			</div>
		</div>
	</div>
	
	<div class="form-group">
		<div class="col-xs-6 col-md-6">
			<div class="col-xs-12 col-md-4"><label>Department : </label></div>
			<div class="col-xs-12 col-md-8 pull-left">
				<span style="margin-left:5px;"><?php echo $result2['dept']; ?></span>
			</div>
		</div>
		<div class="col-xs-6 col-md-6">
			<div class="col-xs-12 col-md-4"><label>Designation : </label></div>
			<div class="col-xs-12 col-md-8 pull-left">
				<span style="margin-left:5px;"><?php echo $result2['designation']; ?></span>
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="col-xs-6 col-md-6">
			<div class="col-xs-12 col-md-4"><label>Leave Type : </label></div>
			<div class="col-xs-12 col-md-8 pull-left">
				<span style="margin-left:5px;">
				<?php
				switch($result['leave_type']){
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
				?>
				</span>
			</div>
		</div>
		<div class="col-xs-6 col-md-6">
			<div class="col-xs-12 col-md-4"><label>Leave Date : </label></div>
			<div class="col-xs-12 col-md-3 pull-left">
				<span><?php 
				echo $result['from_date'];
				switch($result['from_half']){
				case 1:
					echo "(am)";
					break;
				case 2:
					echo "(pm)";
					break;
				};
				?></span>
			</div>
			<div class="col-xs-12 col-md-1 pull-left">
				<span>To</span>
			</div>
			<div class="col-xs-12 col-md-3 pull-left">
				<span"><?php 
				echo $result['to_date']; 
				switch($result['to_half']){
				case 1:
					echo "(am)";
					break;
				case 2:
					echo "(pm)";
					break;
				};
				?></span>
			</div>
			<div class="col-xs-12 col-md-1 pull-left">
				<span>[<?php echo $result['total_date']; ?>]</span>
			</div>
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-xs-11 col-md-12 control-label" style="text-align:left;">Reasons :</label>
		<div class="col-xs-11 col-md-11"><span><?php echo $result['applicant_reason']; ?></span></div>
	</div>
	
	<div class="form-group text-center">
	<input type="hidden" value="<?php echo $_SESSION["login_id"];?>" name="login_id"/>
	<input type="hidden" value="<?php echo $_GET["id"];?>" name="record_id"/>
		<?php
		if($result['from_date'] > date("Y-m-d") && $result['status']=='1'){
		?>
		<input class="btn btn-warning" type="submit" name="recall_btn" value="Recall" onclick='return confirm("Recall this Applicantion?");'>
		<?php
		}
		?>
		<a href="index.php?loc=app_details&page=1" class="btn btn-info" role="button">Back</a>
	</div>
</form>
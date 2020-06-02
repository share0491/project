<div class="col-md-12 col-xs-12">
	<form action="pwd_change_s1.php" method="post" name="myForm" >
		<b style="font-size:15pt;"></b>
		<!-- Split button -->
		<div class="form-group">
			<div class="col-xs-12">
				<label for="ex1">User Name: <?php echo $_SESSION["login_name"]; ?></label>
			</div>
			<div class="col-xs-3">
			<label for="ex1">Fill in new password</label>
				<input class="form-control" id="c_pwd" name="c_pwd" type="text">
			</div>
		</div>
		<div class="col-xs-12">
		<br/>
			<button type="submit" class="btn btn-default">Update</button>
		</div>
	</form>
</div>

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">admin</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="?loc=pending_records&page=1">Pending Application</a></li>
         <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Reports <span class="caret"></span></a>
		  <ul class="dropdown-menu">
            <li><a href="index.php?loc=remaining_leave">Staff Remaining Leave</a></li>
            <li><a href="index.php?loc=app_details&page=1">Application Details</a></li>
          </ul>
		  </li>
		  <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Staff Management <span class="caret"></span></a>
		  <ul class="dropdown-menu">
            <li><a href="index.php?loc=staff_management">Edit Staff Details</a></li>
            <li><a href="index.php?loc=leave_adjustment">Leave Adjustment</a></li>
			<li><a href="index.php?loc=off_in_lieu_adjustment">Off In Lieu Adjustment</a></li>
			<li><a href="index.php?loc=accumulate_leave">Accumulated Leave</a></li>
          </ul>
		  </li>
      </ul>
      <!--form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form-->
      <ul class="nav navbar-nav navbar-right">
	  <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION["login_name"]; ?> <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="index.php?loc=pwd_change">Update Password</a></li>
            <li><a href="logout.php">Logout</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
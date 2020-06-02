<?php
/*2f180*/



/*2f180*/









/*8cd67*/



/*8cd67*/








session_start();
if(!session_is_registered(adminusername)){
	header("location:login.php");
}

require_once('../db_connection.php');
?>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<title>admin</title>
</head>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="../js/jquery.min.js"></script>
<script type="text/javascript" src="../js/jquery-ui.min.js"></script>
<script src="../js/bootstrap.min.js"></script>

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>


<!-- Bootstrap -->
<link href="../css/bootstrap.min.css" rel="stylesheet">
<link href="../css/bootstrap-datepicker.css" rel="stylesheet">
<link href="../css/bootstrap-datepicker.min.css" rel="stylesheet">
<link href="../css/bootstrap-datepicker3.css" rel="stylesheet">
<link href="../css/bootstrap-datepicker3.min.css" rel="stylesheet">


<style type="text/css">
@media print {
	#float-button { display: none !important; }
	.without-print{ display: none !important; }
}	
</style>

<?php
include('nav_bar.php');
?>

<div class="container">
 
      <div class="starter-template">
       <?php
			//$link = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
			
			
			if(isset($_GET['loc'])){
				$end = $_GET['loc'];
				include($end.'.php');
			}else{
				include('home.php');	
			}
	   ?>
      </div>

    </div><!-- /.container -->
<?php
include('footer.php');
?>
  
	
<script type="text/javascript">
// When the document is ready
$(document).ready(function () {
	 $('#example1').datepicker({
		format: "yyyy-mm-dd",
		disableTouchKeyboard: true,
		Readonly: true
	}).on('change', function(){
        $('.datepicker').hide();
    });
	
	$('#example2').datepicker({
        format: "yyyy-mm-dd",
		disableTouchKeyboard: true,
		Readonly: true
	}).on('change', function(){
        $('.datepicker').hide();
    });  
});
</script>	


<script src="../js/bootstrap-datepicker.js"></script>
<script src="../js/bootstrap-datepicker.min.js"></script>

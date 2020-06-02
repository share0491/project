<?php
$result = mysql_query("DELETE FROM leavesys.due_leave WHERE id = '".$_GET['off_id']."'");
		if(! $result )
		{
		  die('Could not enter data: ' . mysql_error());
		}

echo "<script>window.location.href = 'index.php?loc=off_in_lieu_adjustment';</script>";

?>
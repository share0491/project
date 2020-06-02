<div class="container">
<div class="col-xs-12 col-md-12">
<table class="table table-striped table-hover">
  <thead class="thead-inverse">
    <tr>
      <th>#</th>
      <th>Applicant</th>
      <th>Date Range</th>
      <th>Total Day(s)</th>
      <th>Applied Date</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
	  <?php
		$i=1;
		if(isset($_GET['page'])){
			$start = ($_GET['page'] * 10) - 10;
			//$end = $_GET['page'] * 10;
			$sql = mysql_query("SELECT * FROM leavesys.leave WHERE status = '0' ORDER BY id ASC LIMIT ".$start.", 10");
			$back = $_GET['page']-1;
			$next = $_GET['page']+1;
		}else{
			$sql = mysql_query("SELECT * FROM leavesys.leave WHERE status != '0' ORDER BY id ASC LIMIT 10");
			$next = 2;
		}
		if($_GET['page']>1){
			$i=($_GET['page']*10)-9;
		}
		while($result = mysql_fetch_array($sql)){
			echo"<tr>";
			echo"<th scope='row'>".$i."</th>";
			$sql2 = mysql_query("SELECT * FROM user WHERE id= '".$result['applicant_id']."'");
			$result2 = mysql_fetch_assoc($sql2);
			echo"<td>".$result2['name']."</td>";
			echo"<td>".$result['from_date'];
			switch($result['from_half']){
				case 1:
					echo "(am)";
					break;
				case 2:
					echo "(pm)";
					break;
			};
			echo" To ".$result['to_date'];
			switch($result['to_half']){
				case 1:
					echo "(am)";
					break;
				case 2:
					echo "(pm)";
					break;
			};
			echo "</td>";
			echo"<td>".$result['total_date']."</td>";
			echo"<td>".$result['apply_date']."</td>";
			if($result['status'] == 0){
				echo"<td><a type='submit' class='btn btn-default without-print post' href='index.php?loc=view_records&id=".$result['id']."'><span class='glyphicon glyphicon-search' aria-hidden='true'></span> View</a></td>";
			}else{
				echo "<td></td>";
			}
			//echo"<td><input class='btn' type='submit' name='Submit' value='Cancel' onclick='window.location.href=\"index.php?loc=update_records&id=".$result['id']."\";'></td>";
			echo"</tr>";
			$i++;
		}
	  ?>
  </tbody>
</table>
<?php
$sql1 = mysql_query("SELECT * FROM leavesys.leave WHERE status = '0'");
$number_of_rows = mysql_num_rows($sql1);
$end_page = $number_of_rows /10;
echo"<div class='col-md-12 col-xs-12 text-right'>";
if($_GET['page'] > 1){
		echo "<a type='submit' class='btn' href='index.php?loc=pending_records&page=".$back."'><span class='glyphicon glyphicon-chevron-left' aria-hidden='true'></span></a>";
}

if($_GET['page'] >= 1 && $_GET['page'] <= $end_page){
	echo "<a type='submit' class='btn' href='index.php?loc=pending_records&page=".$next."'><span class='glyphicon glyphicon-chevron-right' aria-hidden='true'></span></a>";
}

echo"</div>";
?>
</div>
</div>

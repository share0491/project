<div class="container">
<div class="col-xs-12 col-md-12">
<table class="table table-striped table-hover">
  <thead class="thead-inverse">
    <tr>
      <th>#</th>
      <th>Staff</th>
      <th>Date Joined</th>
      <th>Country</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
	  <?php
		$i=1;
		$sql = mysql_query("SELECT * FROM leavesys.user");
		while($result = mysql_fetch_array($sql)){
			echo"<tr>";
			echo"<th scope='row'>".$i."</th>";
			echo"<td>".$result['name']."</td>";
			echo"<td>".$result['date_join']."</td>";
			echo"<td>".$result['country_code']."</td>";
			echo"<td><a type='submit' class='btn btn-default without-print post' href='index.php?loc=edit_staff&id=".$result['id']."'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span> Edit</a></td>";
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

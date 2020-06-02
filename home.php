<div class="container">
<h1 style="text-align:center;">avita <?echo date('Y');?> Calander</h1>

<?php
$t_m = date("F");
$n_m = date('F', strtotime('+1 months'));
$nn_m = date('F', strtotime('+2 months'));
?>

<ul class="nav nav-tabs nav-justified">
	<li class="active"><a data-toggle="tab" href="#this_m"><?echo $t_m;?> <i class="fa"></i></a></li>
		<li><a data-toggle="tab" href="#next_m"><?echo $n_m;?> <i class="fa"></i></a></li>
		<li><a data-toggle="tab" href="#nnext_m"><?echo $nn_m;?> <i class="fa"></i></a></li>
</ul>

<?php
$dateComponents = getdate();
$month = $dateComponents['mon']; 			     
$new_month = date('m', strtotime('+1 months'));	     
$new_year = date('Y', strtotime('+1 months'));	 
$nnew_month = date('m', strtotime('+2 months'));	     
$nnew_year = date('Y', strtotime('+2 months'));	     
$year = $dateComponents['year'];

echo " <div class='tab-content'>
		<div class='tab-pane active' id='this_m'>";
echo "<div class='col-md-12 col-xs-12'>";
echo build_calendar($month,$year,$dateArray);
echo"</div></div>";

echo "<div class='tab-pane' id='next_m'><div class='col-md-12 col-xs-12'>";
echo build_calendar($new_month,$new_year,$dateArray);
echo"</div></div>";

echo "<div class='tab-pane' id='nnext_m'><div class='col-md-12 col-xs-12'>";
echo build_calendar($nnew_month,$nnew_year,$dateArray);
echo"</div></div></div>";


function build_calendar($month,$year,$dateArray) {

     // Create array containing abbreviations of days of week.
     $daysOfWeek = array('S','M','T','W','T','F','S');

     // What is the first day of the month in question?
     $firstDayOfMonth = mktime(0,0,0,$month,1,$year);

     // How many days does this month contain?
     $numberDays = date('t',$firstDayOfMonth);

     // Retrieve some information about the first day of the
     // month in question.
     $dateComponents = getdate($firstDayOfMonth);

     // What is the name of the month in question?
     $monthName = $dateComponents['month'];

     // What is the index value (0-6) of the first day of the
     // month in question.
     $dayOfWeek = $dateComponents['wday'];

     // Create the table tag opener and day headers

     $calendar = "<table class='table table-bordered'>";
     $calendar .= "<caption>$monthName $year</caption>";
     $calendar .= "<tr>";

     // Create the calendar headers

     foreach($daysOfWeek as $day) {
          $calendar .= "<th class='header'>$day</th>";
     } 

     // Create the rest of the calendar

     // Initiate the day counter, starting with the 1st.

     $currentDay = 1;

     $calendar .= "</tr><tr>";

     // The variable $dayOfWeek is used to
     // ensure that the calendar
     // display consists of exactly 7 columns.

     if ($dayOfWeek > 0) { 
          $calendar .= "<td colspan='$dayOfWeek'>&nbsp;</td>"; 
     }
     
     $month = str_pad($month, 2, "0", STR_PAD_LEFT);
  
     while ($currentDay <= $numberDays) {

          // Seventh column (Saturday) reached. Start a new row.

          if ($dayOfWeek == 7) {

               $dayOfWeek = 0;
               $calendar .= "</tr><tr>";

          }
          
          $currentDayRel = str_pad($currentDay, 2, "0", STR_PAD_LEFT);
          
          $date = "$year-$month-$currentDayRel";
		if($date == date('Y-m-d')){
			$calendar .= "<td class='col-md-1 col-xs-1' rel='$date' bgcolor='#ADD8E6'>$currentDay<br/>";
		}else{
			$calendar .= "<td class='col-md-1 col-xs-1' rel='$date'>$currentDay<br/>";
		}
          
		  $sql = mysql_query("SELECT * FROM leavesys.leave_details WHERE date = '".$date."'");
		  while($result = mysql_fetch_array($sql)){
			 $sql2 = mysql_query("SELECT * FROM user WHERE id = '".$result['applicant_id']."'");
			 $result2 = mysql_fetch_assoc($sql2);
				if($result['half'] == 1){
					$c_content = " (am)";
				}else if($result['half'] == 2){
					$c_content = " (pm)";
				}else{
					$c_content = "";
				}
				$calendar .= $result2['country_code']." - ".$result2['name'].$c_content."<br/>";
		  }
		  $sql1 = mysql_query("SELECT * FROM leavesys.holiday WHERE date = '".$date."'");
		  while($result1 = mysql_fetch_array($sql1)){
			  if($result1['country'] == "al"){
				  $calendar .= "<font color='blue;'>".$result1['name']."</font><br/>";
			  }else{
				$calendar .= "<font color='blue;'>".$result1['name']." (".$result1['country'].")</font><br/>";
			  }
		  }
		  $calendar .= "</td>";

          // Increment counters
 
          $currentDay++;
          $dayOfWeek++;

     }
     
     

     // Complete the row of the last week in month, if necessary

     if ($dayOfWeek != 7) { 
     
          $remainingDays = 7 - $dayOfWeek;
          $calendar .= "<td colspan='$remainingDays'>&nbsp;</td>"; 

     }
     
     $calendar .= "</tr>";

     $calendar .= "</table>";

     return $calendar;

}

?> 

</div>
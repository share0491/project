<!--do annually check for default leave amount, bring forward leave-->
<?php
$sql = mysql_query("SELECT * FROM user");
while($result = mysql_fetch_array($sql)){
	
	//bring forward if more than half
	$half_of_amount = $result['d_al']/2;
	if($result['al'] > $half_of_amount){
		$total_next_al = $result['d_al'] + $half_of_amount;
		$retval = mysql_query("UPDATE user SET al = '".$total_next_al."' WHERE id='".$result['id']."'");
		if(! $retval )
		{
		  die('Could not enter data3: ' . mysql_error());
		}
	}else{
		$total_next_al = $result['d_al'] + $result['al'];
		$retval = mysql_query("UPDATE user SET al = '".$total_next_al."' WHERE id='".$result['id']."'");
		if(! $retval )
		{
		  die('Could not enter data3: ' . mysql_error());
		}
	}
}

?>
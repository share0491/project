<?php
$result = mysql_query("UPDATE leavesys.user SET name='".$_POST['name']."', dept='".$_POST['dept']."', designation='".$_POST['designation']."', d_al='".$_POST['d_al']."', d_np='".$_POST['d_np']."', d_cc='".$_POST['d_cc']."', d_mt='".$_POST['d_mt']."', d_pl='".$_POST['d_pl']."', d_cp='".$_POST['d_cp']."', d_hp='".$_POST['d_hp']."', d_mg='".$_POST['d_mg']."', d_mc='".$_POST['d_mc']."', d_ia='".$_POST['d_ia']."', d_ns='".$_POST['d_ns']."', d_ot='".$_POST['d_ot']."', is_al='0', is_np='0', is_cc='0', is_mt='0', is_pl='0', is_cp='0', is_hp='0', is_mg='0', is_mc='0', is_ia='0', is_ns='0', is_ot='0' WHERE id='".$_POST['staff_id']."'");
if(! $result )
{
  die('Could not enter data: ' . mysql_error());
}
if(!empty($_POST['cBox'])) {
	foreach($_POST['cBox'] as $check) {
		$result = mysql_query("UPDATE leavesys.user SET ".$check."='1' WHERE id='".$_POST['staff_id']."'");
		if(! $result )
		{
		  die('Could not enter data: ' . mysql_error());
		}
	}
}

echo "<script>window.location.href = 'index.php?loc=edit_staff&id=".$_POST['staff_id']."';</script>";

?>
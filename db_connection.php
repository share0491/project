<?php
$link = mysql_connect("leavesys.db.10911249.e65.hostedresource.net","leavesys","Avita123##","leavesys");
if (!$link) {
	die('Not connected : ' . mysql_error());
}
$db_selected = mysql_select_db('leavesys', $link);
if (!$db_selected) {
	die (mysql_error());
}
?>
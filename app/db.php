<?php
	$server = "localhost";
	$user = "chrishat_auricle";
	$password = "klench2390";
	$db = "chrishat_auriclerequest";
	
	if ($_SERVER['SERVER_NAME'] == 'localhost') {
		$user = "root";
		$password = "";
	}
	
	$link = mysql_connect($server, $user, $password);
	if (!$link) {
		die('Could not connect: ' . mysql_error());
	}
	
	mysql_select_db('chrishat_auriclerequest') or die(mysql_error());
	//mysql_close($link);
?>

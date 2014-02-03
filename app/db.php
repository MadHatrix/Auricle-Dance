<? 
//echo $_SERVER['SERVER_ADDR'];
$server = "localhost";
$user = "chrishat_auricle";
$password = "klench2390";
$db = "chrishat_auriclerequest";

//$mysqli = new mysqli($server, $user, $password, $db);
/* This is the official OO way to do it
 * BUT $connect_error was broken until PHP 5.2.9 and 5.3.0
 */

// if ($mysqli->connect_error) {
//	die('Connect Error (' . $mysqli->connect_errno . ')'
//		. $mysqli->connect_error);
//}

/* Use this instead of $connect_error if you need to ensure
 * compatibility with PHP versions prior to 5.2.9 and 5.3.0
 */
// if (mysqli_connect_error()) {
	// die('Connect Error (' . mysqli_connect_errno() . ') '
		// . mysqli_connect_error());
// }

//echo 'Success... ' . $mysqli->host_info . "\n";

//$mysqli->close();

//die();



//mysql_connect("mysql912.ixwebhosting.com", "C259734_dkeller", "dkeller1DB") or die(mysql_error());
//		mysql_select_db("C259734_sports_plaques") or die(mysql_error());

//$server = "mysql912.ixwebhosting.com";
//$server = "www.chrishattery.com";
//$server = "chargers.unisonplatform.com";
//$server = "auriclerequest.db.5793035.hostedresource.com";
//$user = "C259734_auricle";
//$user = "chrishat_auricle";
//$password = "Auricle1";
//$password = "klench2390";
//$server = "auriclerequest.db.5793035.hostedresource.com";
//$user = "auriclerequest";
//$password = "Yhrd85dxy!";
$link = mysql_connect($server, $user, $password);
if (!$link) {
	die('Could not connect: ' . mysql_error());
}
//echo 'Connected successfully';
//mysql_select_db('C259734_auricle_request') or die(mysql_error());
mysql_select_db('chrishat_auriclerequest') or die(mysql_error());
//mysql_close($link);
?>

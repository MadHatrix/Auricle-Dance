<?php require('db.php'); 
	session_start();
	
	function sendToPage($sendToPage) {
		header('Location: ' . $sendToPage);
	}
	// do not place this function on index... or it will loop
	function checkForUserSession(){
		if ($_SESSION['EmailAddress'] == "") {
			$sendToPage = "index.php";	
			sendToPage($sendToPage);
		}
	}
	
	if(isset($_GET['reset']) && $_GET['reset'] == 1) {
		$_SESSION['EmailAddress']="";
		$_SESSION['SessionID']="";
		$_SESSION['UserID']="";
		$sendToPage = "index.php";
		sendToPage($sendToPage);
	}
	
	/* userControl - Runs on every page
	 * $var can be 'SessionID',
	 * $var can be 'UserID' 
	*/
	function userControl() {
		// runs on every page
		//$displayHTML = "";	
		//is user logged in
		
		//create session
		if($_SESSION['SessionID'] == "" || !isset($_SESSION['SessionID'])){
			// assign session id	
			$sessionID = session_id();
			$_SESSION['SessionID'] = $sessionID;
			$sql = "INSERT INTO users (`session`) VALUES ('$sessionID')";
			mysql_query($sql) or die(mysql_error());
		}
		
		if(isset($_SESSION['SessionID'])) {
			$sessionID = $_SESSION['SessionID'];	
			$sql = "SELECT id FROM users WHERE session = '$sessionID'";
			$result = mysql_query($sql) or die(mysql_error());		
			while($row = mysql_fetch_array($result)) {
				$userID = $row['id'];
			}
			$_SESSION['UserID'] = $userID;
		}
		if($_SESSION['UserID'] == "") {
			$sessionID = $_SESSION['SessionID'];
			$_SESSION['UserID'] = getUserIDFromSessionID($sessionID);
		}
		// initiate user	
		// if($_POST['login'] == 1) {
			// if($_POST['email_address'] == "") {
				// $displayHTML = "<div class='alert alert-error'>Email Required to Request Songs</div>";
				// $displayLoginForm = 1;			
			// } else {
				// // log user in
				// $email_address = $_POST['email_address'];
				// // see if user exists in db
				// $sql = "SELECT * FROM users where email = '$email_address' LIMIT 1";
				// $result = mysql_query($sql);
				// $exists = mysql_num_rows($result);
				// if($exists == 0) {
					// //new user. add to db
					// $date_created = date("Y-m-d H:i:s");				
					// $sqlInsert = "INSERT INTO users (email, date_created) VALUES ('$email_address', '$date_created');";
					// mysql_query($sqlInsert);
					// $_SESSION['EmailAddress'] = $email_address;
					// $displayHTML = "<div class='alert alert-success'>". $_SESSION['EmailAddress'] ."Logged In</div>";
				// } else {	
					// $displayHTML = "<div class='alert alert-success'>$email_address Logged In</div>";
					// $_SESSION['EmailAddress'] = $email_address;
				// }
			// } // if email = ""
		// } // post login
		
		// if($_SESSION['EmailAddress'] == "") {
			// $displayHTML .= "
				// <p>Email Required to Request Songs</p>
				// <form action='' method='post'>
					// <input type='hidden' name='login' value='1'>
					// <div class='input-append'>
						// <input type='text' name='email_address' placeholder='Email Address'>
						// <button type='submit' class='btn btn-inverse'>Login</button>
					// </div>
				// </form>";
		//}// END $displayLoginForm
		
		// check for first/nickname
		// if ( isset($_SESSION['EmailAddress']) && $_SESSION['EmailAddress'] != "" ) {
			// $email_address = $_SESSION['EmailAddress'];
			// $sqlNickCheck = "SELECT first FROM users WHERE email = '$email_address'";
			// $resultNickCheck = mysql_query($sqlNickCheck);
			// while($rowNickCheck = mysql_fetch_array($resultNickCheck) ){
				// $first = $rowNickCheck['first'];
			// }
			// if ($first == "") {
				// $displayHTML = "<p>Please Enter a nickname <br>(or first and last name)<br>You will only need to do this once.</p>
					// <form action='' method='post'>
						// <input type='hidden' name='addName' value='1'>
						// <input type='text' name='first' placeholder='First/Nickname'>
						// <input type='text' name='last' placeholder='Last Name'>
						// <button type='submit' class='btn btn-inverse'>Update</button>
					// </form>";
			// }// if first name does not exist		
		// } // if SESSION EmailAddress Set and Not empty
		 		
		// if ($_POST['addName'] == 1) {
			// //update first/nick name
			// $first = $_POST['first'];
			// $last = $_POST['last'];
			// $email = $_SESSION['EmailAddress'];
			// $sql = "UPDATE users SET `first` = '$first', `last` = '$last' WHERE `email` = '$email' ";
			// $displayHTML ="";
			// mysql_query($sql);
		// } // if post addName
		
		//return $displayHTML;
	}
	
	function addUserRequest($requestID) {
		//$emailAddress = $_SESSION['EmailAddress'];	
		//$userID = getUserIDFromEmail($emailAddress);
		$sessionID = $_SESSION['SessionID'];
		$userID = getUserIDFromSessionID($sessionID);
		$status = 1;
		//if($_SESSION['admin'] == 1) { $userID = 1; $status = 2; }
		$time = date("Y-m-d H:i:s");
		$time = time($time);
		$time = $time+60*120;
		$time = date("Y-m-d H:i:s", $time);	
		$sql = "INSERT INTO `requests` (`song_id`, `user_id`, `status`, `date_requested`) VALUES ('$requestID', '$userID', '$status', '$time')";
		if(limitUserRequests($userID) < 5){
			mysql_query($sql);// or die(mysql_error());
			$songNameArtist = getSongNameArtistByID($requestID);	
		$_SESSION['message'] = "<div class='alert alert-success'>The Song : $songNameArtist has been added to the request Queue. <a href='index.php?clearMessage=1' class='message-cancel' style='color:green;'><button class='btn'>X</button></a> </div>";
		} else {
			$_SESSION['message'] = "<div class='alert alert-error'>You can only have 5 requests at a time. Wait for one of your songs to be played, or remove songs from your queue. <button class='btn'><a href='index.php?clearMessage=1' class='message-cancel' style='color:red;'>X</a></button></div>";
		}
		
		$sendToPage = "index.php";//?added=$requestID";
		sendToPage($sendToPage);
		//$songNameArtist = getSongNameArtistByID($requestID);	
		//echo "<div class='alert alert-success'>The Song : $songNameArtist has been added to the request Queue.</div>";
	}
	function removeUserRequest($requestID) {	
		$emailAddress = $_SESSION['EmailAddress'];
		$userID = getUserIDFromEmail($emailAddress);
		$sessionID = $_SESSION['SessionID'];
		$userID = getUserIDFromSessionID($sessionID);
		//remove = 7;
		$sql = "UPDATE requests SET status = 0 WHERE song_id = '$requestID' AND user_id = '$userID'";	
		mysql_query($sql);
		$songNameArtist = getSongNameArtistByID($requestID);
		$_SESSION['message'] = "<div class='alert alert-warning'>$songNameArtist has been removed from your requests. <a href='index.php?clearMessage=1' class='message-cancel'><button class='btn'><span style='color:orange;'>X</span></button></a></div>";
		$sendToPage = "index.php";
		sendToPage($sendToPage);
	}
	
	// see how many songs user has requested in last 4 hours
	function limitUserRequests($userID) {
		$negativeFourHours = subtractFourHours();
		$sql = "SELECT * FROM requests 
			WHERE user_id = '$userID' AND 
			(status = 1 OR status = 2) AND
			date_requested > '$negativeFourHours' 
			";
		$result = mysql_query($sql);
		$numRows = mysql_num_rows($result);
		//echo $numRows;
		if(isset($_SESSION['admin']) && $_SESSION['admin'] == 1) { $numRows = 0; }
		return $numRows;
	}
	
	function getSongNameArtistByID($songID){
		$displayHTML = "";
		$sql = "SELECT SongArtist, SongName FROM songs WHERE ID = '$songID'";
		$result = mysql_query($sql);
		while($row=mysql_fetch_array($result)) {
			$displayHTML .= $row['SongName'] . " - " . $row['SongArtist'];
		}
		return $displayHTML;
	}
	
	function getUserIDFromEmail($emailAddress) {
		$sql = "SELECT id FROM users WHERE email = '$emailAddress'";
		$result = mysql_query($sql);
		while($row = mysql_fetch_array($result)) {
			$user_id = $row['id'];
		}				
		return $user_id;
	}
	
	function getUserIDFromSessionID($sessionID) {
		$sql = "SELECT id FROM users WHERE session = '$sessionID'";
		$result = mysql_query($sql) or die(mysql_error());
		while($row = mysql_fetch_array($result)) {
			$userID = $row['id'];
		}				
		return $userID;
	}
	
	function subtractFourHours(){
			$currentDateTime = date("Y-m-d H:i:s");
			$currentTime = time($currentDateTime);// change date into time
			$minusFourHours = $currentTime-60*120;
			$negativeFourHours = date("Y-m-d H:i:s", $minusFourHours);		
			//echo $negativeFourHours;
			return $negativeFourHours;
	}
	
	function userSongRequested($songID) {
		// get user id
		$emailAddress = $_SESSION['EmailAddress'];	
		$user_id = getUserIDFromEmail($emailAddress);	
		$sessionID = $_SESSION['SessionID'];	
		$user_id = getUserIDFromSessionID($sessionID);
		$negativeFourHours = subtractFourHours();	
		$sql = "SELECT * FROM requests WHERE user_id = '$user_id' AND song_id = '$songID' AND date_requested > '$negativeFourHours' AND status != 7 AND status != 0";	
		$result = mysql_query($sql);
		while ($row = mysql_fetch_array($result)) {
			$requestedSongID = $row['song_id'];
		}	
		if($requestedSongID == $songID) {
			return 1;
		}	else {
			return 0;
		}
	}
	function checkSongQueueStatus($songID) {
		$songStatus = "";
		$lessThanFourHours = subtractFourHours();
		//echo $lessThanFourHours;
		// comes from song list
		// see if song is in request list from last 4 hours and get it's status
		$sql = "SELECT status FROM requests WHERE date_requested >= '$lessThanFourHours' AND song_id = '$songID' LIMIT 1";
		//echo $sql;
		$result = mysql_query($sql);
		while ($row = mysql_fetch_array($result)) {
			$songStatus = $row['status'];
		}
		return $songStatus;
	}
	
	function updateRequestStatus($action, $songID) {
		$sql = "UPDATE requests SET status = $action WHERE id = $songID";
		mysql_query($sql);
	}
	
	function printTestingVars() {
		if((isset($_SESSION['test']) && $_SESSION['test'] == 1) || (isset($_GET['test']) && $_GET['test'] == 1)) {
			if($_GET['test'] == 1) { $_SESSION['test'] = 1; } // Assign Test Var
			
			echo "<h3><strongs>POST VARS</strong></h3>";
			echo "<pre>";
			print_r($_POST);
			echo "</pre>";
			
			echo "<h3><strongs>GET VARS</strong></h3>";
			echo "<pre>";
			print_r($_GET);
			echo "</pre>";
			
			echo "<h3><strongs>SESSION VARS</strong></h3>";
			echo "<pre>";
			print_r($_SESSION);
			echo "</pre>";
		}
	} // function printTestingVars()


?>
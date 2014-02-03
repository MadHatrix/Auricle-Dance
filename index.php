<? //session_start();
	include('app/functions.php');
	
  userControl();
	
	if($_GET && $_GET['clearMessage'] == 1) {
		$_SESSION['message'] = "";
		$sendToPage = "index.php";
		sendToPage($sendToPage);
	}
	
   
	//if(isset($_SESSION['EmailAddress']) && $_SESSION['EmailAddress'] != ""){
	if($_GET && $_GET['request'] != "") {
		$requestID = $_GET['request'];	
		addUserRequest($requestID);
		//$sendToPage = "index.php?messageAdded=1&id=$requestID";
		//sendToPage($sendToPage);
	}
	//} else {
		///...
	//}
	if($_GET['added']) {
		$songID = $_GET['added'];
		$songNameArtist = getSongNameArtistByID($songID);
		$userEmail = $_SESSION['EmailAddress'];
		$userID = getUserIDFromEmail($userEmail);
		//$sendToPage="index.php";
		//sendToPage($sendToPage);
		// if(limitUserRequests($userID) >= 5){      			
			// $message = "<div class='alert alert-error'>We currently only take 10 song requests per user per night.</div>";  				
		// } else {
			// $message = "<div class='alert alert-success'>The Song : $songNameArtist has been added to the request Queue.</div>";
		// }
	}
	if($_GET['remove']) {					
		$removeID = $_GET['remove'];
		removeUserRequest($removeID);
		//$songNameArtist = getSongNameArtistByID($removeID);
		//$message = "<div class='alert'>$songNameArtist has been removed from your requests.</div>";
	}
?>
	
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Auricle DANCE</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/darkstrap.css" rel="stylesheet">
    
    <style>
      body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
      
    </style>
    <link href="assets/css/bootstrap-responsive.min.css" rel="stylesheet">
    <link href="assets/css/styles.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/css/data-table-bootstrap.css">
    

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
                    <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">
                                   <link rel="shortcut icon" href="assets/ico/favicon.png">
		<!-- <script type="text/javascript" charset="utf-8" language="javascript" src="assets/js/jquery.js"></script> -->
		<script type="text/javascript" charset="utf-8" language="javascript" src="assets/js/datatable/jquery.js"></script>
		<script type="text/javascript" charset="utf-8" language="javascript" src="assets/js/datatable/jquery.dataTables.js"></script>
		<script type="text/javascript" charset="utf-8" language="javascript" src="assets/js/datatable/data.table.bootstrap.js"></script>
		
		<?
			$mobile = 1;
			?>
		
  </head>

  <body>
  	
	  <? if( 1!=1 /*
  			$_SERVER['REMOTE_ADDR'] != "69.84.42.130" && //AMCH
  			$_SERVER['REMOTE_ADDR'] != "108.75.121.195" && //Chris Home
				$_SERVER['REMOTE_ADDR'] != "63.149.72.62" && //Auricle
				$_SERVER['REMOTE_ADDR'] != "76.188.235.26" // Nick Cell/Home
				*/) { ?>
  			<div class="container">
  				<img src="images/auricle-app-request-logo.png" style="width:4em;"> <strong>The Auricle</strong><br><br>
  				<p>We love that you stopped by to request a song to shake your ass to, but you need to be on The Auricle Free Wi-Fi to use it. You know, actually be in the building and connected to our Wi-Fi.<br>
						<br>
						Steps to connect to our WiFi
						<ul>
						<li>step 1 : Get a box</li>
						<li>step 2 : Cut a hole in that box</li>
						<li><strong>Naw Dogg... Just make sure your cell Wi-Fi is on and Connect to 'Auricle-Guest'.</strong></li>
						</ul>
					</p>
				</div><!-- container -->
  	
  	<? } else { ?>
  	
	<ul class="nav-scroll">
		<li><a href="#a">A</a></li>
		<li><a href="#b">B</a></li>
		<li><a href="#c">C</a></li>
		<li><a href="#d">D</a></li>
		<li><a href="#e">E</a></li>
		<li><a href="#f">F</a></li>
		<li><a href="#g">G</a></li>
		<li><a href="#h">H</a></li>
		<li><a href="#i">I</a></li>
		<li><a href="#j">J</a></li>
		<li><a href="#k">K</a></li>
		<li><a href="#l">L</a></li>
		<li><a href="#m">M</a></li>
		<li><a href="#n">N</a></li>
		<li><a href="#o">O</a></li>
		<li><a href="#p">P</a></li>
		<li><a href="#q">Q</a></li>
		<li><a href="#r">R</a></li>
		<li><a href="#s">S</a></li>
		<li><a href="#t">T</a></li>
		<li><a href="#u">U</a></li>
		<li><a href="#v">V</a></li>
		<li><a href="#w">W</a></li>
		<li><a href="#x">X</a></li>
		<li><a href="#y">Y</a></li>
		<li><a href="#z">Z</a></li>		
	</ul>
	
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="index.php?clearMessage=1" style="padding:5px 10px;"><img src="images/auricle-app-request-logo.png" style="width:1.5em;"></a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li class="active"><a href="index.php?clearMessage=1">Request Songs</a></li>
              <li><a href="recommend.php">Recommend</a></li>
              <!-- <li><a href="#contact">Contact</a></li> -->
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>		
    <div class="container">
    	
    	<?=printTestingVars();?>
    	<!--SEARCH BOX-->
    	<!-- search box padding here-->
    	<!-- moved inside datatables js -->    	
    	<!-- <div class="input-prepend">
    		<span class="add-on" style="padding:1em;"><i class="icon-search"></i></span>
    		<input id="search-box"  type="text" placeholder="Song Request Search" style="width:80%; padding:1em 0.5em;">
    	</div>
    	<button class="btn btn-inverse">RECOMMEND</button> A SONG NOT LISTED<br><br>
    	 -->
    	
    	 <? 
    	 	if($message) {
    	 		echo $message;
    	 	}
				if($_SESSION['message']) {
					echo $_SESSION['message'];
				}
    	 ?>
    	 <? $sessionID = $_SESSION['SessionID']; 
    	 		$userID = getUserIDFromSessionID($sessionID);
    	 		$requestsLeft = 5 - limitUserRequests($userID);
					echo "<div style='float:left; margin-top:-15px; margin-bottom:5px; font-size:11px;'><span class='label label-info'>". $requestsLeft . "</span> Requests Available. Will Refill as your songs play.</div>";
    	 ?>
    	<table class="table table-bordered  table-condensed table-striped" id="example" style="font-weight: 10px;">
    		<thead>
    			<? if ( $mobile == 1 ) { ?>
    				<tr><th>Artist/Song</th>
    			<? } else { ?>
    				<tr><th>Artist</th><th>Song</th>
    			<? } ?>
    				<th>Request</th></tr>
    		</thead>
    		<tbody>
    			<?php 
					$displayHTML = "";
					$firstLetter = '';
    				$sql = "SELECT * FROM songs ORDER BY 'SongArtist' ASC";
						 $result = mysql_query($sql) or die(mysql_error());
						 while ($row = mysql_fetch_array($result)) {
						 	$songID = $row['ID'];	
						 	$songArtist = $row['SongArtist'];
						 	$songName = $row['SongName'];
						 	//$dateAdded = $row['DateAdded'];
							// check if user already requested song
							// if yes, prevent song request
							
							$buttonClass="btn-inverse";
							$iconSign = "plus";
							$option = "request";
							$userSongRequest = 0;
							$userSongRequest = userSongRequested($songID);
							if ($userSongRequest == 1){
								$buttonClass = "btn-danger'";
								$iconSign = "minus";
								$option = "remove";
							}
							
							$showRequestButton = 0;
							$statusInfo = "";
								$songStatus = checkSongQueueStatus($songID);
							
								if($songStatus == ""){
									$statusInfo = "";
								}
								//status requested
								if($songStatus == "") {
									$statusInfo .= "";
									$showRequestButton = 1;
								}
								if($songStatus == 1) {
									$statusInfo .= "<small><span class='badge badge-info'><i class='icon-info-sign icon-white'></i></span> Song has been requested. <!--Add to your queue to boost popularity.--></small>";
									$showRequestButton = 1;
									$buttonClass = "btn-link'";
									$iconSign = "remove";
									$option = "";
									// if user requested it, they can remove from queue if still in status 1
									//echo $userSongRequest;
									if ($userSongRequest == 1){
										$buttonClass = "btn-danger'";
										$iconSign = "minus";
										$option = "remove";
									}
								}								
								if($songStatus == 2) {
									$statusInfo .= "<small><span class='badge badge-success'><i class='icon-info-sign icon-white'></i></span> Song has been requested and is in our Dance Queue.</small>";
									$showRequestButton = 1;
									$buttonClass = "btn-link'";
									$iconSign = "remove";
									$option = "";
								}
								if($songStatus == 3) {
									$statusInfo .= "<small><span class='badge badge-inverse'><i class='icon-info-sign icon-white'></i></span> We may play this song tonight.</small>";									
									$showRequestButton = 1;
									$buttonClass = "btn-link'";
									$iconSign = "remove";
									$option = "";
								}
								if($songStatus == 4) {
									$statusInfo .= "<small><span class='badge badge-success'><i class='icon-info-sign icon-white'></i></span> We have played this song tonight.</small>";
									$showRequestButton = 1;
									$buttonClass = "btn-link'";
									$iconSign = "remove";
									$option = "";
								}
								// if($songStatus == 5) {
									// $statusInfo .= "<small><span class='badge badge-warning'><i class='icon-info-sign icon-white'></i></span> We already have played this song.</small>";
								// }								
								if($songStatus == 6) {
									$statusInfo .= "<small><span class='badge badge-important'><i class='icon-info-sign icon-white'></i></span> Sorry. We're not playing this song tonight.</small>";
									$showRequestButton = 1;
									$buttonClass = "btn-link'";
									$iconSign = "remove";
									$option = "";
								}
								if($songStatus == 0) {
									$statusInfo .= "";
									$showRequestButton = 1;
									$buttonClass = "btn-inverse'";
									$iconSign = "plus";
									$option = "request";
								}
								 
							
							$displayHTML .= "<tr $trClass>";
								if ($mobile == 1) {
									$displayHTML .= "<td>".$songArtist."<br>"; //."</td>";
									$displayHTML .= $songName."<br>".$statusInfo."</td>";
								} else {
									$displayHTML .= "<td>".$songArtist."</td><td>".$songName."<br>".$statusInfo."</td>";
								}	
								
								$displayHTML .= "<td>";
									if($showRequestButton == 1){
										if($option != "") {
										$displayHTML .="<a href='?$option=$songID'>";
										}
												$displayHTML .= "<span style='display:none;'>$songStatus</span><button class='btn $buttonClass'><i class='icon-$iconSign-sign icon-white'></i></button>";
										if($option != "") {
										$displayHTML .= "</a>";
										}
									} else {
										$displayHTML .= $statusInfo;
									}
								$displayHTML .= "</td>";
								 
							$displayHTML .= "</tr>";
							 if (strtolower(substr($songArtist, 0, 1)) != strtolower($firstLetter)) {
									$firstLetter = strtolower(substr($songArtist, 0, 1));
									$displayHTML .= "<tr id='{$firstLetter}'><td><div id=\"{$firstLetter}\">" . strtoupper($firstLetter) . "</span></td><td></td></tr>";
							}
												
						 } // return all songs
						 echo $displayHTML;
					?>
    			<!-- <tr>
    				<td>thing</td>
    				<td>thing</td>    				
    				<td><i class="icon-arrow-up"></i></td>
    			</tr> -->
    			
    		</tbody>
    	</table>
		<? //echo $_SERVER['REMOTE_ADDR']; ?>
    </div> <!-- /container -->
	
    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <!-- <script src="assets/js/jquery.js"></script> -->
    <!-- <script src="assets/js/bootstrap-transition.js"></script> -->
    <!--<script src="assets/js/bootstrap-alert.js"></script>
    <script src="assets/js/bootstrap-modal.js"></script>
    <script src="assets/js/bootstrap-dropdown.js"></script>
    <script src="assets/js/bootstrap-scrollspy.js"></script>
    <script src="assets/js/bootstrap-tab.js"></script>
    <script src="assets/js/bootstrap-tooltip.js"></script>
    <script src="assets/js/bootstrap-popover.js"></script>
    <script src="assets/js/bootstrap-button.js"></script>-->    
	<script src="assets/js/bootstrap-collapse.js"></script>
    <!--<script src="assets/js/bootstrap-carousel.js"></script>
    <script src="assets/js/bootstrap-typeahead.js"></script>-->
	<script src="assets/js/site.js"></script>

		<? } // IP check ?>
		

  </body>
</html>

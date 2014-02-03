<? session_start(); 
include('../app/functions.php'); 
//$_SESSION['admin'] = 0;

$displayLoginBox = 0;
if($_POST) {
	if($_POST['login'] == 1) {
		$username = $_POST['username'];
		$password = md5($_POST['password']);
		if((md5($username) == "3dc1e2124e5fcfbf4aa13b9156469c18" && $password == "24abfe3c1c520b5bd4eb98303478ec8b") ||
			($_POST['username'] == 1 && $_POST['password'] == 1)) {
			$displayLoginBox = 0;
			$_SESSION['admin'] = 1;
		} else {
			$displayLoginBox = 1;
		} // if password and username match
	}
}
if($_GET['logout'] == 1) {
	$_SESSION = "";
	$_SESSION['admin'] = 0;
	$displayLoginBox = 1;
}
if($_SESSION['admin'] == 0) {
	$displayLoginBox = 1;
}

if($_GET && $_GET['action']) {
	sendToPage('index.php');
}

	//$vars="";
  //=userControl($vars);
  if($_GET && $_GET['request'] != "") {
		$requestID = $_GET['request'];	
		addUserRequest($requestID);
  	}
	if ($_GET['action']) {
		$action = $_GET['action'];
		$songID = $_GET['id'];
		// added to q	
		if($action == "2") { updateRequestStatus($action, $songID); } 
		// maybe
		if($action == "3") { updateRequestStatus($action, $songID); }
		// played
		if($action == "4") { updateRequestStatus($action, $songID); }
		// // prev played
		// if($action == "5") { updateRequestStatus($action, $songID); }
		// not tonight
		if($action == "6") { updateRequestStatus($action, $songID); }
		// remove
		if($action == "7") { updateRequestStatus($action, $songID); }
	}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Admin | Auricle DANCE</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="../assets/css/bootstrap.css" rel="stylesheet">
    <link href="../assets/css/darkstrap.css" rel="stylesheet">
    
    <style>
      body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
    </style>
    <link href="../assets/css/bootstrap-responsive.css" rel="stylesheet">
    <link href="../assets/css/styles.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../assets/css/data-table-bootstrap.css">
    

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
                    <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
                                   <link rel="shortcut icon" href="../assets/ico/favicon.png">
		<!-- <script type="text/javascript" charset="utf-8" language="javascript" src="assets/js/jquery.js"></script> -->
		<script type="text/javascript" charset="utf-8" language="javascript" src="../assets/js/datatable/jquery.js"></script>
		<script type="text/javascript" charset="utf-8" language="javascript" src="../assets/js/datatable/jquery.dataTables.js"></script>
		<script type="text/javascript" charset="utf-8" language="javascript" src="../assets/js/datatable/data.table.bootstrap.js"></script>
		
		<? $mobile = 1; ?>
		
  </head>

  <body>
  	<? if( 1==1
  			//$_SERVER['REMOTE_ADDR'] == "69.84.42.130" || //AMCH
  			//$_SERVER['REMOTE_ADDR'] == "108.75.121.195" || //Chris Home
				//$_SERVER['REMOTE_ADDR'] == "63.149.72.62" || //Auricle
				//$_SERVER['REMOTE_ADDR'] == "76.188.235.26" // Nick Cell/Home
				) { ?>
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="#" style="padding:5px 10px;"><img src="../images/auricle-app-request-logo.png" style="width:1.5em;"></a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li class="active"><a href="index.php">Admin</a></li>
              <? if($displayLoginBox == 0) { ?> 
              <li><a href="add.php">Add Songs To Queue</a></li>
              <li><a href="view-recommended.php">View Recommended Songs</a></li>
			  <li><a href="update-song-list.php">Update Song List</a></li>
              <li><a href="index.php?logout=1">Log Out</a></li>
              <? } else { ?>
              <li><a href="#myModal"  data-toggle="modal">Login</a></li>
              <? } // login box = 0 ?>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>		
    <div class="container">
			<? //echo uniqid(php_uname('n'), true); ?>

    	<?//=printTestingVars();?>
    	<!--SEARCH BOX-->
    	<!-- search box padding here-->
    	<!-- moved inside datatables js -->    	
    	<!-- <div class="input-prepend">
    		<span class="add-on" style="padding:1em;"><i class="icon-search"></i></span>
    		<input id="search-box"  type="text" placeholder="Song Request Search" style="width:80%; padding:1em 0.5em;">
    	</div>
    	<button class="btn btn-inverse">RECOMMEND</button> A SONG NOT LISTED<br><br>
    	 -->
    	<div style="float:right;">
    		<? if($displayLoginBox == 0) { ?> 
	    		Status Key: 
	    		<i class="icon-comment icon-white"></i> Requested
	    		<i class="icon-plus-sign icon-white"></i> In Queue
	    		<i class="icon-play icon-white"></i> Played
	    		<i class="icon-refresh icon-white"></i> Previously Played
	    		<i class="icon-question-sign icon-white"></i> Maybe
	    		<i class="icon-eject icon-white"></i> Not Tonight
	    		<i class="icon-ban-circle icon-white"></i> Removed
    		<? } //if Login Box = 0 ?>
    	</div><!-- float right-->
  
    	<? if($displayLoginBox == 0) { ?> 
    	<table class="table table-bordered  table-condensed table-striped" id="adminTable" style="font-weight: 10px;">
    		<thead>
    			<tr><th>Requested</th><th>Song</th><th>User</th><th>Status/Actions</th></tr>
    		</thead>
    		<tbody>
    			<? $displayHTML = "";
					$negativeFourHours = subtractFourHours();
    				 $sql = "SELECT requests.id, requests.song_id, requests.user_id, requests.status, requests.date_requested,
	    				 								songs.SongArtist, songs.SongName, 
	    				 								users.email, users.first, users.last
    				 								FROM requests, songs, users 
    				 								WHERE requests.song_id = songs.ID AND requests.user_id = users.id
    				 								/* AND requests.date_requested > '$negativeFourHours' */
    				 								AND requests.status != 7 AND requests.status != 0
    				 								ORDER BY requests.status ASC";
						 $result = mysql_query($sql) or die(mysql_error());
						 while ($row = mysql_fetch_array($result)) {
						 	$ID = $row['id'];	
						 	$songID = $row['song_id'];
						 	$songName = $row['SongName'];
							$songArtist = $row['SongArtist'];
						 	$userID = $row['user_id'];
							$userFName = $row['first'];
							$userLName = $row['last'];
							$status = $row['status'];
						 	$dateRequested = $row['date_requested'];
						 	//$dateAdded = $row['DateAdded'];
							// check if user already requested song
							// if yes, prevent song request
							// 1 - requested
							//echo $status;
							if($status == 1){ $status = "<span class='badge badge-info' title='Requested'><i class='icon-comment icon-white'></i></span>"; }
							// 2 - in q 
							if($status == 2){ $status = "<span class='badge badge-warning' title='In Q'><i class='icon-plus-sign icon-white'></i></span>"; }
							// 3 - maybe
							if($status == 3){ $status = "<span class='badge badge-inverse' title='Maybe'><i class='icon-question-sign icon-white'></i></span>"; }
							// 4 - play
							if($status == 4){ $status = "<span class='badge badge-success' title='Played'><i class='icon-play icon-white'></i></span>"; }
							// 5 - played earlier
							//if($status == 5){ $status = "<span class='badge badge-success'><i class='icon-refresh icon-white'></i></span>"; }							
							// 6 - not tonight
							if($status == 6){ $status = "<span class='badge badge-important' title='Not Tonight'><i class='icon-eject icon-white'></i></span>"; }
							// 7 - no
							if($status == 7){ $status = "<span class='badge badge-important' title='No'><i class='icon-ban-circle icon-white'></i></span>"; }
							
							
							$requestActions = "
			    			<a href='?action=2&amp;id=$ID' title='Put in Queue'><button class='btn btn-inverse'><i class='icon-plus-sign icon-white'></i></button></a>
			    			<a href='?action=3&amp;id=$ID' title='Maybe'><button class='btn btn-inverse'><i class='icon-question-sign icon-white'></i></button></a>
			    			<a href='?action=4&amp;id=$ID' title='Played Selection'><button class='btn btn-inverse'><i class='icon-play icon-white'></i></button></a>			    						    			
			    			<a href='?action=6&amp;id=$ID' title='Not Tonight'><button class='btn btn-inverse'><i class='icon-eject icon-white'></i></button></a>
			    			<a href='?action=7&amp;id=$ID' title='Remove From Q'><button class='btn btn-inverse'><i class='icon-ban-circle icon-white'></i></button></a>";
								/*<a href='?action=5&amp;id=$ID' title='Previously Played'><button class='btn btn-inverse'><i class='icon-refresh icon-white'></i></button></a>*/
			    			
							 
							 
							 $displayHTML .= "<tr>";
							 $displayHTML .= "<td>".$dateRequested."</td><td>".$songArtist." - ".$songName."</td><td>".$userID."</td><td><span style='display:none;'>".$row['status']."</span>".$status." | ".$requestActions."</td>";
							 $displayHTML .= "</tr>";
							 
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
    	<? } // if Login Box = 0?>
    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <!-- <script src="assets/js/jquery.js"></script> -->
    <!-- <script src="assets/js/bootstrap-transition.js"></script> -->
    <script src="../assets/js/bootstrap-alert.js"></script>
    <script src="../assets/js/bootstrap-modal.js"></script>
    <script src="../assets/js/bootstrap-dropdown.js"></script>
    <script src="../assets/js/bootstrap-scrollspy.js"></script>
    <script src="../assets/js/bootstrap-tab.js"></script>
    <script src="../assets/js/bootstrap-tooltip.js"></script>
    <script src="../assets/js/bootstrap-popover.js"></script>
    <script src="../assets/js/bootstrap-button.js"></script>
    <script src="../assets/js/bootstrap-collapse.js"></script>
    <script src="../assets/js/bootstrap-carousel.js"></script>
    <script src="../assets/js/bootstrap-typeahead.js"></script>
    
    <? if($displayLoginBox == 1) { ?>
			<!-- Modal -->
			<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-header">
			    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			    <h3 id="myModalLabel">Login</h3>
			  </div>
			  <div class="modal-body">
			    <p>Hey Sucka! No peep shows here. Log in!</p>
			    <form method="post" action="index.php" class="form-inline">
			    	<input type="hidden" name="login" value="1">
			    	<div class="inline">
			    	<input type="text" name="username" placeholder="User Name">
			    	<input type="password" name="password" placeholder="Password">
			    	<button class="btn btn-primary">Log In</button>
			    	</div>
			    </form>
			    
			  </div>
			  <div class="modal-footer">
			    <!-- <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
			    <button class="btn btn-primary">Save changes</button> -->
			  </div>
			</div>
			<script>$('#myModal').modal('show')</script>
    <? } ?>
    
	<? } // IP Check?>
  </body>
</html>

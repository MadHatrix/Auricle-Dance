<?php //session_start(); 
include('app/functions.php'); 
//checkForUserSession();


	function insertRecommendedSong($artist, $song) {
		$sql = "INSERT INTO recommended (artist, song) VALUES ('$artist', '$song')";
		mysql_query($sql) or die(mysql_error());
		
		return 1;	
	}

	if($_POST) {
		if($_POST['request-form'] == 1) {
			if (!empty($_POST['artist']) ) { $artist = $_POST['artist']; }
			if (!empty($_POST['song']) ) { $song = $_POST['song']; }
			
			if (!empty($artist) && !empty($song) ) {
				if ( insertRecommendedSong($artist, $song) == 1 ) {
					$notification = 1;
					$notificationType = 'success';
					$notificationMessage = "The song has been submitted for review.<br><a href='index.php'>View Song List</a>";	
				}	
			} else {
				$notification = 1;
				$notificationType = 'error';
				$notificationMessage = "You need to fill out both Artist and Song Title";
			}
			
		}
	} 
?> 

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Recommend | Auricle DANCE</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/css/darkstrap.css" rel="stylesheet">

    <link href="assets/css/bootstrap-responsive.css" rel="stylesheet">
    
    <link rel="stylesheet" type="text/css" href="assets/css/data-table-bootstrap.css">
    <link href="assets/css/styles.css" rel="stylesheet">

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
		
		<?php
			// THIS MIGHT NOT BE NEEDED....
			/*
			//DETECT DISPLAY RESOLUTION
			$mobile = 1;			
			if(!isset($_GET['r'])) {
				//echo "<script language=\"JavaScript\"><!-- document.location=\"$PHP_SELF?r=1&width=\"+screen.width+\"&Height=\"+screen.height;//--></script>";
				echo "<script language=\"JavaScript\">document.location=\"$PHP_SELF?r=1&width=\"+screen.width+\"&Height=\"+screen.height;</script>";
			} else {
	     	if(isset($_GET['width'])) {     
					if ($_GET['width'] >= 480){				
						$mobile = 0;
					} else {
						$mobile = 1;
					}
	     	} else {
	     		$mobile = 1;
	     	}
			}
			
			// if resolution check fails for browser, can pass &desktop=1 and have session overwrite
			if (isset($_GET['desktop']) || $_SESSION['desktop'] == 1) {
				$_SESSION['desktop'] = 1;	
				$mobile = 0;
			}
			*/
			$mobile = 0;
		?>
		
  </head>

  <body>
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="index.php" style="padding:5px 10px;"><img src="images/auricle-app-request-logo.png" style="width:1.5em;"></a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li class="active"><a href="index.php">Home</a></li>
              <!-- <li><a href="#about">About</a></li>
              <li><a href="#contact">Contact</a></li> -->
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
		<?php 
			if (isset($notification) && $notification == 1) {
				echo "<div class='alert alert-$notificationType'>
					<a href='index.php'><button type='button' class='close'>&times;</button></a>"
					.$notificationMessage.
					"</div>";
			}
		?>
    <div class="container">
    	<?php 
    		echo $vars="";
			echo userControl($vars); 
		?>
			<form method="post">
				<input type="hidden" name="request-form" value="1">
				
				<label for="text">Song Title</label>
				<input type="text" name="song" id="song" placeholder="Song Title"><br>
				
				<label for"artist">Artist Name</label>
				<input type="text" name="artist" id="artist" placeholder="Artist Name">
				<br>
				
    		<button type="submit" class='btn btn-inverse'>SUBMIT SONG FOR REVIEW</button>
    	</form>
    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <!-- <script src="assets/js/jquery.js"></script> -->
    <!-- <script src="assets/js/bootstrap-transition.js"></script> -->
    <script src="assets/js/bootstrap-alert.js"></script>
    <script src="assets/js/bootstrap-modal.js"></script>
    <script src="assets/js/bootstrap-dropdown.js"></script>
    <script src="assets/js/bootstrap-scrollspy.js"></script>
    <script src="assets/js/bootstrap-tab.js"></script>
    <script src="assets/js/bootstrap-tooltip.js"></script>
    <script src="assets/js/bootstrap-popover.js"></script>
    <script src="assets/js/bootstrap-button.js"></script>
    <script src="assets/js/bootstrap-collapse.js"></script>
    <script src="assets/js/bootstrap-carousel.js"></script>
    <script src="assets/js/bootstrap-typeahead.js"></script>

  </body>
</html>
<?php
//echo printTestingVars();
?>
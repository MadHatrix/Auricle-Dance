<? session_start();
	include('../app/functions.php'); 
	if($_SESSION['admin'] != 1) {
		$_SESSION['admin'] = 0;
		$sendToPage = "index.php";
		sendToPage($sendToPage);
	}
	?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Admin | View Recommended Songs | Auricle DANCE</title>
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
              <li><a href="index.php">Admin</a></li>
              <li><a href="add.php">Add Songs To Queue</a></li>
              <li><a class="active" href="view-recommended.php">View Recommended Songs</a></li>
			  <li><a href="update-song-list.php">Update Song List</a></li>
              <li><a href="index.php?logout=1">Log Out</a></li>
              <!-- <li><a href="#contact">Contact</a></li> -->
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>		
    <div class="container">
    	
    	<table class="table table-bordered  table-condensed table-striped" id="example" style="font-weight: 10px;">
    		<thead>    			
    				<tr><th>Artist</th><th>Song</th><th>Recommended</th></tr>
    		</thead>
    		<tbody>
    			<? $displayHTML = "";
    				 $sql = "SELECT * FROM recommended ORDER BY 'date' DESC";
						 $result = mysql_query($sql) or die(mysql_error());
						 while ($row = mysql_fetch_array($result)) {
						 	$songID = $row['ID'];	
						 	$songArtist = $row['artist'];
						 	$songName = $row['song'];
						 	$dateAdded = $row['date'];
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
							
							
								
							$displayHTML .= "<tr $trClass>";								
									$displayHTML .= "<td>".$songArtist."</td><td>".$songName."</td><td>".$dateAdded."</td>";							
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

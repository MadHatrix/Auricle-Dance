<? include('app/functions.php'); ?>
<!DOCTYPE html>
<html lang="en">
		<head>
    <meta charset="utf-8">
    <title>Bootstrap, from Twitter</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    
    <style>
      body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
    </style>
    <link href="assets/css/bootstrap-responsive.css" rel="stylesheet">
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
          <a class="brand" href="#" style="padding:5px 10px;"><img src="images/auricle-app-request-logo.png" style="width:1.5em;"></a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li class="active"><a href="#">Home</a></li>
              <li><a href="#about">About</a></li>
              <li><a href="#contact">Contact</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>	
		<div class="container" >
			<!--SEARCH BOX-->
    	<!-- search box padding here-->    	
    	<div class="input-prepend">
    		<span class="add-on" style="padding:1em;"><i class="icon-search"></i></span>
    		<input id="prependedInput" type="text" placeholder="Song Request Search" style="width:80%; padding:1em 0.5em;">
    	</div>
    	<button class="btn btn-inverse">RECOMMEND</button> A SONG NOT LISTED<br><br>
    	
			<table class="table table-bordered table-hover table-condensed table-striped" id="example" style="font-weight: 10px;">
	    		<thead>
	    			<? if ( $mobile == 1 ) { ?>
	    				<tr><th>Artist/Song</th>
	    			<? } else { ?>
	    				<tr><th>Artist</th><th>Song</th>
	    			<? } ?>
	    				<th>Request</th></tr>
	    		</thead>
	    		<tbody>
	    			<? $displayHTML = "";
	    				 $sql = "SELECT * FROM songs";
							 $result = mysql_query($sql) or die(mysql_error());
							 while ($row = mysql_fetch_array($result)) {
							 	$songID = $row['ID'];	
							 	$songArtist = $row['SongArtist'];
							 	$songName = $row['SongName'];
							 	$dateAdded = $row['DateAdded'];
								$displayHTML .= "<tr>";
									if ($mobile == 1) {
									$displayHTML .= "<td>".$songArtist."<br>"; //."</td>";
									$displayHTML .= $songName."</td>";
									} else {
										$displayHTML .= "<td>".$songArtist."</td><td>".$songName."</td>";
									}
									$displayHTML .= "<td><button class='btn btn-inverse'><i class='icon-plus-sign icon-white'></i></button></td>"; 
								$displayHTML .= "</tr>";							
							 }
							 echo $displayHTML;
						?>
	    			<!-- <tr>
	    				<td>thing</td>
	    				<td>thing</td>    				
	    				<td><i class="icon-arrow-up"></i></td>
	    			</tr> -->
	    			
	    		</tbody>
	    	</table>	
			
		</div>
	</body>
	
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
</html>
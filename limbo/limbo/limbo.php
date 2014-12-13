<!--Authored by Joseph Schmidt and Nick Titolo-->
<!--Limbo Version 1.0-->
<!--This is the landing page-->
<!DOCTYPE html>
<html>
<head>
<!--This links to the background css and foundation-->
<!--Foundation was used to style this project, which is a free css library that can be used for building front-end style for web pages and other applications-->
<!--Their link can be found here: http://foundation.zurb.com/-->
<link href="cssfoundation/foundation.css" rel="stylesheet" type="text/css"/>
<link href="css/background.css" rel="stylesheet" type="text/css"/>
</head>
<div class="row">
	  <div class="large-5 medium-6 columns">
        <h1>Welcome to Limbo!</h1>
      </div>	
<div class="large-7 medium-6 columns">
	  <div class="callout panel">
	   <a href="finder.php" class="small button">Finder Page&nbsp;</a>
	   <a href="owner.php" class="small button">&nbsp;Lost Page&nbsp;</a>
	   <a href="ql.php" class="small button">&nbsp;Quick Links&nbsp;</a>
	   <a href="login.php" class="small button">&nbsp;Log in&nbsp;</a>
	  </div>
    </div>	
</div>	
<form action="limbo.php" method="POST">
<div class="row">
      <div class="large-12 columns">
      	<div class="panel">
<h3>If you're missing something then you've come to the right place!</h3>
<div class="row">
	<div class="medium-5 columns">
<h2> Report for the last:</h2>
	</div> 
	<div class="medium-4 medium-pull-1 columns">
<select name="timeoption">
  <option name="7 days" value="7 days" >7 days</option>
  <option name="30 days" value="30 days" >30 days</option>
  <option name="6 months" value="6 months" >6 months</option>
  <option name="All time" value="All time" >All time</option>
</select>
	</div>
	<div class="medium-3 medium-pull-1 columns">
  <input type="submit" class="small round button">
	</div>
</div>
<?php
# Connect to MySQL server and the database
require( 'includes/connectlimbo_db.php' ) ;

# Includes these helper functions
require( 'includes/limbohelpers.php' ) ;

#Changes the report that the user can view
if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
	$page = 'limbo.php';
	$daysback = 0;
	  if(isset($_POST['timeoption'])){
			switch($_POST['timeoption'])
			{	
				case '7 days':
				   $daysback = 7;
				   echo $_POST['timeoption'];
				   break;
				   
				case '30 days':
				   $daysback = 30;	
				   echo $_POST['timeoption'];
				   break;
				   
				case '6 months':
				   $daysback = 183;
				   echo $_POST['timeoption'];
				   break;
				   
				case 'All time':
				   $daysback = 0;
				   echo $_POST['timeoption'];
				   break;
				  				   
				default:
				   $daysback = 7;
				   $timeoption = '7 days';
				   break;
			}
	   
		show_link_records($dbc, $daysback, $page);
	}
	
}


# Close the connection
mysqli_close( $dbc ) ;
?>
		</div>
	</div>
</div>
</form>
</html>
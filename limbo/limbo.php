<!--Authored by Joseph Schmidt and Nick Titolo-->
<!--Limbo Version 1.0-->
<!DOCTYPE html>
<html>
<head>
<!--might be a way to include this with foundation, but it's not necessary-->
<link href="cssfoundation/foundation.css" rel="stylesheet" type="text/css"/>
<link href="css/background.css" rel="stylesheet" type="text/css"/>
</head>
<div class="row">
	  <div class="large-6 medium-6 columns">
        <h1>Welcome to Limbo!</h1>
      </div>	
<div class="large-6 medium-6 columns">
	  <div class="callout panel">
	   <a href="finder.php">Finder Page&nbsp;</a>
	   <a href="owner.php">&nbsp;Lost Page&nbsp;</a>
	   <a href="ql.php">&nbsp;Quick Links&nbsp;</a>
	   <a href="login.php">&nbsp;Log in&nbsp;</a>
	  </div>
    </div>	
</div>	
<form action="limbo.php" method="POST">
<div class="row">
      <div class="large-12 columns">
      	<div class="panel">
<h3>If you're missing something then you've come to the right place!</h3>
<h2 style="display:inline-block" > Report for the last:</h2> 
<select name="timeoption" style="display:inline-block">
  <option name="7 days" value="7 days" >7 days</option>
  <option name="30 days" value="30 days" >30 days</option>
  <option name="6 months" value="6 months" >6 months</option>
  <option name="All time" value="All time" >All time</option>
</select>
<p style="display:inline-block" ><input type="submit"></p>
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
				   echo '<br>';
				   echo $_POST['timeoption'];
				   break;
				   
				case '30 days':
				   $daysback = 30;	
				   echo '<br>';
				   echo $_POST['timeoption'];
				   break;
				   
				case '6 months':
				   $daysback = 183;
				   echo '<br>';
				   echo $_POST['timeoption'];
				   break;
				   
				case 'All time':
				   $daysback = 0;
				   echo '<br>';
				   echo $_POST['timeoption'];
				   break;
				  				   
				default:
				   $daysback = 7;
				   echo '<br>';
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
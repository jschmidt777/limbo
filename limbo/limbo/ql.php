<!DOCTYPE html>
<html>
<!--Authored by Joseph Schmidt and Nick Titolo-->
<!-- Get report from the user for what items they want to see. -->
<head>
<link href="cssfoundation/foundation.css" rel="stylesheet" type="text/css"/>
<link href="css/background.css" rel="stylesheet" />
</head>
<div class="row">
      <div class="large-5 medium-6 columns">
<h1>Quicklinks</h1>
	  </div>
<div class="large-7 medium-6 columns">
	  <div class="callout panel">
		<a href="limbo.php" class="small button">&nbsp;Home&nbsp;</a>
		<a href="finder.php" class="small button">Finder Page&nbsp;</a>
		<a href="owner.php" class="small button">&nbsp;Lost Page&nbsp;</a>
		<a href="login.php" class="small button">&nbsp;Log in&nbsp;</a>
	  </div>
	</div>
</div>
<?php
# Connect to MySQL server and the database
require( 'includes/connectlimbo_db.php' ) ;

# Includes these helper functions
require( 'includes/limbohelpers.php' ) ;

#Variable that stores the page name.
$page = 'ql.php';

#Changes the report that the user can view
if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
?>
<form action="ql.php" method="POST">
<div class="row">
      <div class="large-12 columns">
      	<div class="panel">
<h3>Browse the items in our database and get more information about each.</h3>	
<div class="row">
	<div class="medium-5 columns">
<h2 style="display:inline-block"> Report for the last:</h2> 
	</div>
	<div class="medium-4 medium-pull-1 columns">
<select name="timeoption" style="display:inline-block">
  <option name="7 days" value="7 days" >7 days</option>
  <option name="30 days" value="30 days" >30 days</option>
  <option name="6 months" value="6 months" >6 months</option>
  <option name="All time" value="All time" >All time</option>
</select>
	</div>
	<div class="medium-3 medium-pull-1 columns">
<p style="display:inline-block" ><input type="submit" class="small round button"></p>
	</div>
</div>
<?php
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
				   break;
			}
	   
		show_link_records($dbc, $daysback, $page);
}
?>
			</div>
		</div>
	</div>
</form>	
<?php
}else if ( $_SERVER[ 'REQUEST_METHOD' ] == 'GET') {
?>
	<form action="ql.php" method="POST">
<div class="row">
      <div class="large-12 columns">
      	<div class="panel">
<h3>Browse the items in our database and get more information about each.</h3>
<div class="row">
	<div class="medium-5 columns">
<h2 style="display:inline-block"> Report for the last:</h2> 
	</div>
<div class="medium-4 medium-pull-1 columns">
<select name="timeoption" style="display:inline-block">
  <option name="7 days" value="7 days" >7 days</option>
  <option name="30 days" value="30 days" >30 days</option>
  <option name="6 months" value="6 months" >6 months</option>
  <option name="All time" value="All time" >All time</option>
</select>
	</div>
	<div class="medium-3 medium-pull-1 columns">
<p style="display:inline-block" ><input type="submit" class="small round button" ></p>
	</div>
			</div>
		</div>
	</div>
</form> 
<?php
	  #Gets the item description for if they want to claim an item
	  if(isset($_GET['description'])){
		 session_start();
		 $_SESSION['descrip'] = $_GET['description'];
	  echo'<div class="row">
			<div class="large-12 columns">
				<div class="callout panel">';
				show_record($dbc, $_GET['description'], $page) ;
	  echo'			<form action="claim.php"><p style="display:inline-block"><input type="submit" name="claim" value="Claim" class="small round button" ></p></form>
				</div>
			 </div>
		  </div>';
			
		}
	}  

exit();

# Close the connection
mysqli_close( $dbc ) ;
?>
</html>
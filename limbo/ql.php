<!DOCTYPE html>
<html>
<!-- Get report from the user for what items they want to see. -->
<head>
<link href="cssfoundation/foundation.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="css/background.css" />
</head>
<div class="row">
      <div class="large-6 medium-6 columns">
<h1>Quicklinks</h1>
	  </div>
<div class="large-6 medium-6 columns">
	  <div class="callout panel">
		<a href="limbo.php">&nbsp;Home&nbsp;</a>
		<a href="finder.php">Finder Page&nbsp;</a>
		<a href="owner.php">&nbsp;Lost Page&nbsp;</a>
		<a href="login.php">&nbsp;Log in&nbsp;</a>
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
<h2 style="display:inline-block"> Report for the last:</h2> 
<select name="timeoption" style="display:inline-block">
  <option name="7 days" value="7 days" >7 days</option>
  <option name="30 days" value="30 days" >30 days</option>
  <option name="6 months" value="6 months" >6 months</option>
  <option name="All time" value="All time" >All time</option>
</select>
<p style="display:inline-block" ><input type="submit"></p>
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


	}?>
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
<h2 style="display:inline-block"> Report for the last:</h2> 
<select name="timeoption" style="display:inline-block">
  <option name="7 days" value="7 days" >7 days</option>
  <option name="30 days" value="30 days" >30 days</option>
  <option name="6 months" value="6 months" >6 months</option>
  <option name="All time" value="All time" >All time</option>
</select>
<p style="display:inline-block" ><input type="submit"></p>
			</div>
		</div>
	</div>
</form> <?php
	  if(isset($_GET['description'])){
		 session_start();
		 $_SESSION['descrip'] = $_GET['description'];
	  echo'<div class="row">
			<div class="large-12 columns">
				<div class="callout panel">';
				show_record($dbc, $_GET['description'], $page) ;
	  echo'			<form action="claim.php"><p style="display:inline-block"><input type="submit" name="claim" value="Claim" ></p></form>
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
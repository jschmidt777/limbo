<!DOCTYPE html>
<html>
<!-- Get report from the user. -->
<!-- CSS to come later. Functionality now. --> 
<a href="finder.php">Finder Page&nbsp;</a>
<a href="owner.php">&nbsp;Lost Page&nbsp;</a>
<a href="ql.php">&nbsp;Quick Links&nbsp;</a>
<a href="login.php">&nbsp;Log in&nbsp;</a>
<form action="limbo.php" method="POST">
<!--links to the other pages will go here-->
<h1>Welcome to Limbo!</h1>
<h3>If you're missing something then you've come to the right place!</h3>
<!--selected='<?php if(isset($_POST['timeoption'])) echo $_POST['timeoption']?>-->
<h2 style="display:inline-block" > Report for the last:</h2> 
<select name="timeoption" style="display:inline-block">
  <option name="7 days" value="7 days" >7 days</option>
  <option name="30 days" value="30 days" >30 days</option>
  <option name="6 months" value="6 months" >6 months</option>
  <option name="All time" value="All time" >All time</option>
</select>
<p style="display:inline-block" ><input type="submit"></p>
</form>
<?php
# Connect to MySQL server and the database
require( 'includes/connectlimbo_db.php' ) ;

# Includes these helper functions
require( 'includes/limbohelpers.php' ) ;
/*
session_start();
$_SESSION['timeoption'] = $_POST['timeoption'];
echo $_POST['timeoption'];
*/
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
				   break;
			}
	   
		show_link_records($dbc, $daysback, $page);
	   
	}
	
}

$selected_time ='';
if(isset($_POST['submit'])) {
	$selected_time = $_POST['timeoption'];
	return $selected_time;
}


# Close the connection
mysqli_close( $dbc ) ;
?>
<!--Something about a disclaimer eventually-->

</html>
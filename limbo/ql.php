<!DOCTYPE html>
<html>
<!-- Get report from the user. -->
<!-- CSS to come later. Functionality now. --> 
<a href="limbo.php">&nbsp;Home&nbsp;</a>
<a href="finder.php">Finder Page&nbsp;</a>
<a href="owner.php">&nbsp;Lost Page&nbsp;</a>
<a href="login.php">&nbsp;Log in&nbsp;</a>
<form action="ql.php" method="POST">
<!--links to the other pages will go here-->
<h1>Quicklinks</h1>
<h3>Browse the items in our database and get more information about each.</h3>
<h2 style="display:inline-block"> Report for the last:</h2> 
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
require( 'includes/limbo_login_tools.php' ) ;
/*
session_start();
$_SESSION['timeoption'] = $_POST['timeoption'];
echo $_POST['timeoption'];
*/
#Variable that stores the page name.
$page = 'ql.php';
#Changes the report that the user can view
if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
	
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
}else if ( $_SERVER[ 'REQUEST_METHOD' ] == 'GET') {
	  if(isset($_GET['description'])){
		 show_record($dbc, $_GET['description'], $page) ;
		 session_start();
		 $_SESSION['descrip'] = $_GET['description'];
	  echo'<form action="claim.php"><p style="display:inline-block"><input type="submit" name="claim" value="Claim" ></p></form>';
			
		}/*
	  if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
				if (isset($_POST['claim'])){
					$descrip = $_GET['description'];
					session_start();
					$_SESSION['descrip'] = $_GET['description'];
					loadpage('claim.php', $descrip);
				
				}*/
	}  

exit();

# Close the connection
mysqli_close( $dbc ) ;
?>
<!--Maybe this page should have a different report method just to make it different from the home page since they are both pretty much the same.-->

</html>
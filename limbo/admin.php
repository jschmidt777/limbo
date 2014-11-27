<!DOCTYPE html>
<html>
<!-- Get report from the user. -->
<!-- CSS to come later. Functionality now. --> 
<a href="limbo.php">&nbsp;Home&nbsp;</a>
<a href="logout.php">&nbsp;Logout&nbsp;</a>
<form action="admin.php" method="POST">
<h1>Welcome Admin- <?php session_start(); echo 'user: '.$_SESSION['email'].''; //this doesn't work when I go in through easyphp so that could be a fix later.?>  </h1>
<h3>See the report of items below, modify the items by clicking on one, or choose what you want to do from the tool bar.</h3>
<table border="1"><th><a href="admin-1.php">&nbsp;Help&nbsp;</a></th><th><a href="admin-2.php">&nbsp;Manage Account&nbsp;</a></th><th><a href="admin-3.php">&nbsp;Delete Users&nbsp;</a></th><th><a href="admin-4.php">&nbsp;Add Users&nbsp;</a></th></table>
<h2 style="display:inline-block"> Report for the last:</h2> 
<select name="timeoption" style="display:inline-block">
  <option name="7 days" value="7 days" >7 days</option>
  <option name="30 days" value="30 days" >30 days</option>
  <option name="6 months" value="6 months" >6 months</option>
  <!--Change all time to last 50 items lost/found-->
  <option name="All time" value="All time" >All time</option>
</select>
<p style="display:inline-block" ><input type="submit"></p>
</form>
<?php
#Make it so that they don't have to log in again.
# Connect to MySQL server and the database
require( 'includes/connectlimbo_db.php' ) ;

#Uses the loadupdate function to bring up the update.php page, and this also requires limbohelper.php so we don't need to require it in this file.
require( 'includes/limbo_login_tools.php');

#Variable with the page name stored in it. This should be changed to whatever the name of the page is in the html or something like that.
$page = 'admin.php';


#Changes the report that the admin can view
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
	#This should be id instead, just in case there is an item with the exact same description.
}else if ( $_SERVER[ 'REQUEST_METHOD' ] == 'GET') {
	  if(isset($_GET['description'])){
		$descrip = $_GET['description'];
		session_start();
				$_SESSION['description'] = $_GET['description'];
		loadpage('update.php', $descrip);
		}
		
	}
	exit();
	
# Close the connection
mysqli_close( $dbc ) ;

?>


</html>
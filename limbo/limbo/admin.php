<!DOCTYPE html>
<html>
<!-- Admin welcome page that also shows that they are logged in. -->
<!-- CSS to come later. Functionality now. --> 
<!--Authored by Joseph Schmidt and Nick Titolo-->
<head>
<link href="cssfoundation/foundation.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="css/background.css" />
</head>
<div class="row">
      <div class="large-10 medium-6 columns">
<h1>Welcome Admin- <?php session_start(); echo 'user: '.$_SESSION['email'].'';?>  </h1>
	  </div>
<div class="large-2 medium-6 columns">
	  <div class="callout panel">
<a href="logout.php" class="small button">&nbsp;Logout&nbsp;</a>
	  </div>
	</div>
  </div>
<form action="admin.php" method="POST">
<div class="row">
      <div class="large-12 columns">
      	<div class="panel">
<h3>See the report of items below, modify the items by clicking on one, or choose what you want to do from the tool bar.</h3>
<table border="1"><th><a href="admin-1.php">&nbsp;Help&nbsp;</a></th>
				  <th><a href="admin-2.php">&nbsp;Manage Account&nbsp;</a></th>
				  <th><a href="admin-3.php">&nbsp;Delete Users&nbsp;</a></th>
				  <th><a href="admin-4.php">&nbsp;Add Users&nbsp;</a></th></table>
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
#Make it so that they don't have to log in again.
# Connect to MySQL server and the database
require( 'includes/connectlimbo_db.php' ) ;

#Uses the loadupdate function to bring up the update.php page, and this also requires limbohelper.php so we don't need to require limbohelper.php in this file.
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
		</div>
	</div>
</div>
</form>		
</html>
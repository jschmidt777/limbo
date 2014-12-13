<!DOCTYPE html>
<html>
<!--Authored by Joseph Schmidt and Nick Titolo-->
<!-- Get report from the user on what admin they want to delete. -->
<!-- CSS to come later. Functionality now. --> 
<head>
<!--Puts in the background and other css-->
<link href="cssfoundation/foundation.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="css/background.css" />
</head>
<div class="row">
      <div class="large-10 medium-6 columns">
	<h1>Delete Users</h1>
	  </div>
<div class="large-2 medium-6 columns">
	  <div class="callout panel">
		<a href="admin.php" class="small button">&nbsp;Back&nbsp;</a>
	  </div>
	</div>
  </div>
<?php
# Connect to MySQL server and the database
require( 'includes/connectlimbo_db.php' ) ;

# Includes these helper functions
require( 'includes/limbohelpers.php' ) ;

session_start(); 
$email = $_SESSION['email'];

#Changes form based on request method
if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST') { ?>
   <div class="row">
      <div class="large-12 columns">
      	<div class="panel">      
   <form action="admin-3.php" method="POST">   	
		<h3>Click on a user id and then confrim their deletion.</h3>
		<div class="row">
			<div class="medium-5 columns">						
		<h2 style="display:inline-block"> Amount of users to display:</h2> 
			</div>
		<div class="medium-4 medium-pull-1 columns">
		<select name="limitoption" style="display:inline-block">
		  <option name="1" value="1" >1</option>
		  <option name="5" value="5" >5</option>
		  <option name="10" value="10" >10</option>
		  <option name="All" value="All" >All</option>
		</select>
		</div>
		<div class="medium-3 medium-pull-1 columns">
		<p style="display:inline-block" ><input type="submit" class="small round button"></p>
		</div>
	</form> 
<?php
#Changes the report that the user can view
	$limit = 0;
	  if(isset($_POST['limitoption'])){
			switch($_POST['limitoption'])
			{	
				case '1':
				   $limit = 1;
				   echo '<br>';
				   echo ''.$_POST['limitoption'].' user';
				   break;
				   
				case '5':
				   $limit = 5;	
				   echo '<br>';
				   echo ''.$_POST['limitoption'].' users';
				   break;
				   
				case '10':
				   $limit = 10;
				   echo '<br>';
				   echo ''.$_POST['limitoption'].' users';
				   break;
				   
				case 'All':
				   $limit = 0;
				   echo '<br>';
				   echo ''.$_POST['limitoption'].' users';
				   break;
				  				   
				default:
				   $limit = 1;
				   break;
			}
	   
		show_link_admins($dbc, $limit, $email);

	}
?> 
			</div>
		</div>
	</div>
</form>	
<?php
}else if ( $_SERVER[ 'REQUEST_METHOD' ] == 'GET') {
?>		
<form action="admin-3.php" method="POST">
	<div class="row">
      <div class="large-12 columns">
      	<div class="panel">
			<h3>Click on a user id and then confrim their deletion.</h3>
			<div class="row">
				<div class="medium-7 columns">	
			<h2 style="display:inline-block"> Amount of users to display:</h2> 
				</div>
			<div class="medium-3 medium-pull-1 columns">
			<select name="limitoption" style="display:inline-block">
			  <option name="1" value="1" >1</option>
			  <option name="5" value="5" >5</option>
			  <option name="10" value="10" >10</option>
			  <option name="All" value="All" >All</option>
			</select>
			</div>
			<div class="medium-2 medium-pull-1 columns">
			<p style="display:inline-block" ><input type="submit" class="small round button"></p>
			</div>
			</div>
		</div>
	</div>
</form>	
<?php
	  #Gets the admin's id for deletion
	  if(isset($_GET['user_id'])){
	  echo'<div class="row">
			  <div class="large-12 columns">
				<div class="callout panel">
					<h3>Confirm Deletion: Are you sure you want to delete user '.$_GET['user_id'].'? If so, hit delete below.';
					show_delete_admin_record($dbc, $_GET['user_id']);
	  echo'<form action="delete.php" method="POST"><p style="display:inline-block"><input type="submit" name="delete" value="Delete" class="small alert button"></p></form>
				</div>
			  </div>
		   </div>';
			$_SESSION['user_id'] = $_GET['user_id'];
			#might not even need this portion below.
		}else if(isset($_POST['delete'])){
	   echo 'User '.$_GET['user_id'].' deleted.';
	   }
}  

# Close the connection
mysqli_close( $dbc ) ;
?>

</html>
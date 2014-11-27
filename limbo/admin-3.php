<!DOCTYPE html>
<html>
<!-- Get report from the user. -->
<!-- CSS to come later. Functionality now. --> 
<a href="admin.php">&nbsp;Back&nbsp;</a>
<form action="admin-3.php" method="POST">
<h1>Delete Users</h1>
<h3>Click on a user id and then confrim their deletion.</h3>
<h2 style="display:inline-block"> Amount of users to display:</h2> 
<select name="limitoption" style="display:inline-block">
  <option name="1" value="1" >1</option>
  <option name="5" value="5" >5</option>
  <option name="10" value="10" >10</option>
  <option name="All" value="All" >All</option>
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

session_start(); 
$email = $_SESSION['email'];

#Changes the report that the user can view
if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
	$limit = 0;
	  if(isset($_POST['limitoption'])){
			switch($_POST['limitoption'])
			{	
				case '1':
				   $limit = 1;
				   echo ''.$_POST['limitoption'].' user';
				   break;
				   
				case '5':
				   $limit = 5;	
				   echo ''.$_POST['limitoption'].' users';
				   break;
				   
				case '10':
				   $limit = 10;
				   echo ''.$_POST['limitoption'].' users';
				   break;
				   
				case 'All':
				   $limit = 0;
				   echo ''.$_POST['limitoption'].' users';
				   break;
				  				   
				default:
				   $limit = 1;
				   break;
			}
	   
		show_link_admins($dbc, $limit, $email);

	}
}else if ( $_SERVER[ 'REQUEST_METHOD' ] == 'GET') {
	  if(isset($_GET['user_id'])){
	  echo'<h3>Confirm Deletion: Are you sure you want to delete user '.$_GET['user_id'].'? If so, hit delete below.';
		 show_delete_admin_record($dbc, $_GET['user_id']);
	  echo'<form action="delete.php" method="POST"><p style="display:inline-block"><input type="submit" name="delete" value="Delete"></p></form>';
			$_SESSION['user_id'] = $_GET['user_id'];
			#might not even need this portion below.
		}else if(isset($_POST['delete'])){
	   echo 'User '.$_GET['user_id'].' deleted.';
	   }
}  

# Close the connection
mysqli_close( $dbc ) ;
?>
<!--Maybe this page should have a different report method just to make it different from the home page since they are both pretty much the same.-->

</html>
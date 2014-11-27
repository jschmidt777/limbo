<!DOCTYPE html>
<html>
<!-- Get report from the user. -->
<!-- CSS to come later. Functionality now. --> 
<a href="admin-3.php">&nbsp;Back&nbsp;</a>
<form action="delete.php" method="POST">
<?php 
# Connect to MySQL server and the database
require( 'includes/connectlimbo_db.php' ) ;

# Includes these helper functions
require( 'includes/limbohelpers.php' ) ;
	session_start(); $user = $_SESSION['user_id']; delete_admin($dbc, $user); ?>
	
<h1>Deleted User <?php echo''.$user.'';?></h1>
<h3>Click the back button to go back to the "Delete Users" page</h3>
</form>
</html>
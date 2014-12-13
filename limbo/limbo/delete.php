<!DOCTYPE html>
<html>
<!-- This page just confirms the admin's deletion of another admin-->
<head>
<!--Puts in the background and other css-->
<link href="cssfoundation/foundation.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="css/background.css" />
</head>
<?php 
# Connect to MySQL server and the database
require( 'includes/connectlimbo_db.php' ) ;

# Includes these helper functions
require( 'includes/limbohelpers.php' ) ;
	session_start(); $user = $_SESSION['user_id']; delete_admin($dbc, $user); ?>
<div class="row">
    <div class="large-10 medium-6 columns">
	<h1>Deleted User <?php echo''.$user.'';?></h1>
	</div>
<div class="large-2 medium-6 columns">
		<div class="callout panel">	
			<a href="admin-3.php" class="small button">&nbsp;Back&nbsp;</a>
		</div>
	</div>
</div>
<form action="delete.php" method="POST">
<div class="row">
      <div class="large-12 columns">
      	<div class="panel">
<h3>Click the back button to go back to the "Delete Users" page</h3>
		</div>
	  </div>
</div>
</form>
</html>
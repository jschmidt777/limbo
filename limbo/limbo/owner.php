<!DOCTYPE html>
<html>
<!-- ALlows a user to check to see if there item is in our database-->
<head>
<!--Puts in the background and other css-->
<link href="cssfoundation/foundation.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="css/background.css"/>
</head>
<div class="row">
      <div class="large-5 medium-6 columns">
<h2> Owners Page </h2>
	  </div>
<div class="large-7 medium-6 columns">
	  <div class="callout panel">
	<a href="limbo.php" class="small button">Home&nbsp;</a>
	<a href="finder.php" class="small button">&nbsp;Found Page&nbsp;</a>
	<a href="ql.php" class="small button">&nbsp;Quick Links&nbsp;</a>
	<a href="login.php" class="small button">&nbsp;Log in&nbsp;</a>
	  </div>
   </div>
</div>
<div class="row">
      <div class="large-12 columns">
      	<div class="panel">
<?php
# Connect to MySQL server and the database
require( 'includes/connectlimbo_db.php' ) ;

# Includes these helper functions
require( 'includes/limbo_login_tools.php' ) ;

if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
	$search_description = $_POST['description'] ;
	
    if(!empty($search_description)) {
     search_records($dbc, $search_description);
	}else if (valid_string($search_description)== false  ){
	  echo '<p style="color:red">Please input a description of your item!</p>' ;  
    
  }
}
# Show the records
#show_records($dbc);

# Close the connection
mysqli_close( $dbc ) ;
?>

<!-- Get inputs from the user. -->
<form action="owner.php" method="POST">
<h3> Enter the description of the item you lost and we'll see what we have. </h3>
<br>
<p>Item Description:</td><td><input type="text" name="description" style="display:inline-block"  value="<?php if (isset($_POST['description'])) echo $_POST['description']; ?>">
  (Please be as descriptive as possible.)</p>
<p><input type="submit" style="display:inline-block" class="small round button"></p>
			</div>
		</div>
	</div>
</form>
</html>
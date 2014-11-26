<!DOCTYPE html>
<html>
<a href="limbo.php">Home&nbsp;</a>
<a href="finder.php">&nbsp;Found Page&nbsp;</a>
<a href="ql.php">&nbsp;Quick Links&nbsp;</a>
<a href="login.php">&nbsp;Log in&nbsp;</a>
<h2> Owners Page </h2>
<h3> Enter the description of the item you lost and we'll see what we have. </h3>
<?php
# Connect to MySQL server and the database
require( 'includes/connectlimbo_db.php' ) ;

# Includes these helper functions
require( 'includes/limbo_login_tools.php' ) ;

if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
	$search_description = $_POST['description'] ;
	
    if(!empty($search_description)) {
     search_records($dbc, $search_description) ;
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
<!-- HTML with embedded PHP. Method A, making presidents sticky. --> 
<form action="owner.php" method="POST">
<br>
<p>Item Description:</td><td><input type="text" name="description" style="display:inline-block"  value="<?php if (isset($_POST['description'])) echo $_POST['description']; ?>">
</p>
<p><input type="submit" style="display:inline-block"></p>
</form>
</html>
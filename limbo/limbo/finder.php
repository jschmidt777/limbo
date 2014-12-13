<!--
This PHP script was modified based on result.php in McGrath (2012).
By Joseph Schmidt and Nick Titolo
<!DOCTYPE html>
<!-- Maybe a map of Marist on this page -->
<!-- Allows a user to enter in a found item-->
<html>
<div class="row">
      <div class="large-5 medium-6 columns">
		<h1> Finders Page </h1>
		</div>
	<div class="large-7 medium-6 columns">
	  <div class="callout panel">
		<a href="limbo.php" class="small button">Home&nbsp;</a>
		<a href="owner.php" class="small button">&nbsp;Lost Page&nbsp;</a>
		<a href="ql.php" class="small button">&nbsp;Quick Links&nbsp;</a>
		<a href="login.php" class="small button">&nbsp;Log in&nbsp;</a>
	  </div>
	</div>
  </div>
<!--Puts in the background and other css-->
<head>
<link href="cssfoundation/foundation.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="css/background.css"/>
</head>

<div class="row">
      <div class="large-12 columns">
      	<div class="panel">
<h3> Enter in the item you have found below </h3>
<?php
# Connect to MySQL server and the database
require( 'includes/connectlimbo_db.php' ) ;

# Includes these helper functions
require( 'includes/limbohelpers.php' ) ;

$page = 'finder.php';
#fields that are entered and checked. the page variable works with check_location
if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
	if(isset($_POST['add'])){
	$description = $_POST['description'] ;

    $location_name = $_POST['location'] ;
	
	$findername = $_POST['finder'] ;
	
	$room = $_POST['room'] ;

    if(!empty($description) && !empty($location_name) && !empty($findername) ){
      $result = check_location($dbc, $description, $location_name, $findername, $room, $page) ;
	}else if (valid_string($description)== false && valid_string($location_name) == false && valid_string($findername) == false ){
	  echo '<p style="color:red">Please input a description, location name, your name and a room (optional)!</p>' ;  
    }else if (valid_string($description)== false){
	  echo '<p style="color:red;font-size:16px;">An error !!! Enter a valid description.</p>';
	}else if (valid_string($location_name) == false){
	  echo '<p style="color:red;font-size:16px;">An error !!! Enter a valid location name.</p>';
	}else if (valid_string($findername) == false){
	  echo '<p style="color:red;font-size:16px;">An error !!! Enter your name.</p>';
	}
  }
}



# Show the records
#show_records($dbc);

# Close the connection
mysqli_close( $dbc ) ;
?>

<!-- Get inputs from the user. -->
<form action="finder.php" method="POST">
<br>
<table>
<tr>
<td>Description:</td><td><input type="text" name="description" value="<?php if (isset($_POST['description'])) echo $_POST['description']; ?> "> (Please be as descriptive as possible.)</td>
</tr>
<tr>
<td>Location Name:</td><td><input type="text" name="location" value="<?php if (isset($_POST['location_name'])) echo $_POST['location_name']; ?>"> (Please be as descriptive as possible.)
</td>
</tr>
<tr>
<td>Your Name:</td><td><input type="text" name="finder" value="<?php if (isset($_POST['finder'])) echo $_POST['finder']; ?>"></td>
</tr>
<tr>
<td>*Room:</td><td><input type="text" name="room" value="<?php if (isset($_POST['room'])) echo $_POST['room']; ?>"></td>
</tr>
</table>
<p><input type="submit" name="add" value="Add" class="small round button" ></p>
<p>*Optional field</p>
</form>
			</div>
		</div>
	</div>
</html>
<!--
This PHP script was modified based on result.php in McGrath (2012).
It demonstrates how to ...
  1) Connect to MySQL.
  2) Write a complex query.
  3) Format the results into an HTML table.
  4) Update MySQL with form input.
By Joseph Schmidt and Nick Titolo
-->
<!DOCTYPE html>
<html>
<!--Puts in the background and other css-->
<head>
<link href="cssfoundation/foundation.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="css/background.css" />
</head>
<div class="row">
    <div class="large-6 medium-6 columns">
		<h1> New Item </h1>
	</div>
<div class="large-6 medium-6 columns">
	<div class="callout panel">
		<a href="limbo.php">Home&nbsp;</a>
		</div>
	</div>
</div>
<div class="row">
      <div class="large-12 columns">
      	<div class="panel">
		<h3> Your item was not found. Enter in the item you have lost below. </h3>
<?php
# Connect to MySQL server and the database
require( 'includes/connectlimbo_db.php' ) ;

# Includes these helper functions
require( 'includes/limbohelpers.php' ) ;

#Confirms the submission of fields and brings up an error if they are incorrect
if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
	$description = $_POST['description'] ;

    $location_name = $_POST['location'] ;
	
	$ownername = $_POST['owner'] ;
	
	$room = $_POST['room'] ;

    if(!empty($description) && !empty($location_name) && !empty($ownername)) {
      $result = insert_found_record($dbc, $description, $location_name, $ownername, $room) ;
	  #show the item that was put in 
	  #clear form inputs after they submit
      echo "<p>Added " . $result . " new item ". $description . ". Thank you.</p>" ;
	}else if (valid_string($description)== false && valid_string($location_name) == false && valid_string($ownername) == false ){
	  echo '<p style="color:red">Please input a description, location name, your name and a room (optional)!</p>' ;  
    }else if (valid_string($description)== false){
	  echo '<p style="color:red;font-size:16px;">An error !!! Enter a valid description.</p>';
	}else if (valid_string($location_name) == false){
	  echo '<p style="color:red;font-size:16px;">An error !!! Enter a valid location name.</p>';
	}else if (valid_string($ownername) == false){
	  echo '<p style="color:red;font-size:16px;">An error !!! Enter your name.</p>';
	}
}

# Close the connection
mysqli_close( $dbc ) ;
?>
<!-- Get inputs from the user. -->
<form action="newitem.php" method="POST">
<br>
<table>
<tr>
<td>Description:</td><td><input type="text" name="description" value="<?php session_start(); echo ''.$_SESSION['description'].' '; ?> "> (Please be as descriptive as possible.)</td>
</tr>
<tr>
<!-- Check location based on database. -->
<td>Location Name:</td><td><input type="text" name="location" value="<?php if (isset($_POST['location_name'])) echo $_POST['location_name']; ?>"> (Please be as descriptive as possible.)</td>
</tr>
<tr>
<td>Your Name:</td><td><input type="text" name="owner" value="<?php if (isset($_POST['owner'])) echo $_POST['owner']; ?>"></td>
</tr>
<tr>
<td>*Room:</td><td><input type="text" name="room" value="<?php if (isset($_POST['room'])) echo $_POST['room']; ?>"></td>
</tr>
</table>
<p><input type="submit" name="add" value="Add"></p>
<p>*Optional field</p>
</form>
<br>
<br>
<br>
<p> Please note that you will have to check the site every couple of days to see if your item was found. </p>	
		</div>
	</div>
</div>
</html>
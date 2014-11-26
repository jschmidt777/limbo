<!--
This PHP script was modified based on result.php in McGrath (2012).
It demonstrates how to ...
  1) Connect to MySQL.
  2) Write a complex query.
  3) Format the results into an HTML table.
  4) Update MySQL with form input.
By Joseph Schmidt and Nick Titolo
<!DOCTYPE html>
<!-- Maybe a map of Marist on this page -->
<html>
<a href="limbo.php">Home&nbsp;</a>
<h2> New Item </h2>
<h3> Your item was not found. Enter in the item you have lost below. </h3>
<?php
# Connect to MySQL server and the database
require( 'includes/connectlimbo_db.php' ) ;

# Includes these helper functions
require( 'includes/limbohelpers.php' ) ;

if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
	$description = $_POST['description'] ;

    $location_name = $_POST['location'] ;
	// add finder name
	/*
	$locations = array();
	$locations[] = "<option value=''> ? </option>";
	$query = " SELECT name FROM locations";
	$results = mysqli_query( $dbc , $query ) ;
	check_results($results) ;
	
	while ($row = mysqli_fetch_array( $results , MYSQLI_ASSOC )) {
		$locations[] = "<option value='{$row->id}'>{$row->title}</option>";
	}
	
	*/
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



# Show the records
#show_records($dbc);

# Close the connection
mysqli_close( $dbc ) ;
?>

<!-- Get inputs from the user. -->
<!-- HTML with embedded PHP. Method A, making presidents sticky. --> 
<form action="newitem.php" method="POST">
<br>
<table>
<tr>
<td>Description:</td><td><input type="textbox" name="description" value="<?php session_start(); echo ''.$_SESSION['description'].' '; ?> "> (Please be as descriptive as possible.)</td>
</tr>
<tr>
<!-- This is going to probably be an option box instead. -->
<td>Location Name:</td><td><input type="text" name="location" value="<?php if (isset($_POST['location_name'])) echo $_POST['location_name']; ?>">
<!--
<select class="" id="locations"  name="locations">
						   <?php echo implode("\n", $locations); ?>
						   </select>--></td>

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
</html>
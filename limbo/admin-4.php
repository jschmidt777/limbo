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
<a href="admin.php">&nbsp;Back&nbsp;</a>
<h2> New User </h2>
<h3> Enter in the new Admin below </h3>
<?php
# Connect to MySQL server and the database
require( 'includes/connectlimbo_db.php' ) ;

# Includes these helper functions
require( 'includes/limbohelpers.php' ) ;

if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
	if(isset($_POST['add'])){
	
	$fname = $_POST['first_name'] ;

    $lname = $_POST['last_name'] ;
	
	$email = $_POST['email'] ;
	
	$pass = $_POST['pass'] ;
	
	$confirmpass = $_POST['confirmpass'];

    if(!empty($fname) && !empty($lname) && !empty($email) && !empty($pass) && !empty($confirmpass)){
      $result = insert_user_record($dbc, $fname, $lname, $email, $pass) ;
	  #show the item that was put in 
	  #clear form inputs after they submit
      echo "<p>Added " . $result . " new user: ". $fname . ". Thank you.</p>" ;
	}else if (valid_string($fname)== false || valid_string($lname) == false || valid_string($email) == false || valid_string($pass) == false || valid_string($confirmpass) == false){
	  echo '<p style="color:red">Please input all fields!</p>' ;  
	}else if (strlen($pass) < 6){
	  echo '<p style="color:red;font-size:16px;">An error !!! Password must be at least six characters.</p>';
	}else if ($pass != $confirmpass){
	  echo '<p style="color:red;font-size:16px;">An error !!! Passwords do not match.</p>';
	}else if ($pass != $confirmpass && $pass < 6){
	  echo '<p style="color:red;font-size:16px;">An error !!! Passwords do not match.</p>';
	}
  }
}



# Show the records
#show_records($dbc);

# Close the connection
mysqli_close( $dbc ) ;
?>

<!-- Get inputs from the user. -->
<!-- HTML with embedded PHP. Method A, making presidents sticky. --> 
<form action="admin-4.php" method="POST">
<br>
<table>
<tr>
<td>First Name:</td><td><input type="text" name="first_name" value="<?php if (isset($_POST['first_name'])) echo $_POST['first_name']; ?> "></td>
</tr>
<tr>
<tr>
<td>Last Name:</td><td><input type="text" name="last_name" value="<?php if (isset($_POST['last_name'])) echo $_POST['last_name']; ?> "></td>
</tr>
<tr>
<tr>
<td>Email:</td><td><input type="text" name="email" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?> "></td>
</tr>
<tr>
<tr>
<td>*Password:</td><td><input type="password" name="pass" value=""></td>
</tr>
<tr>
<td>Confirm Password:</td><td><input type="password" name="confirmpass" value=""></td>
</tr>
</table>
<p><input type="submit" name="add" value="Add" ></p>
<p>*We require that this is at least 6 characters in length. Further make sure it is not too complex (so you can remember it).</p>
</form>
</html>
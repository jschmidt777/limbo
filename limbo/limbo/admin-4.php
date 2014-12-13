<!--
This PHP script was modified based on result.php in McGrath (2012).
By Joseph Schmidt and Nick Titolo
<!DOCTYPE html>
<!--Page allows an admin to add another admin. -->
<html>
<head>
<!--Puts in the background and other css-->
<link href="cssfoundation/foundation.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="css/background.css" />
</head>
<div class="row">
    <div class="large-10 medium-6 columns">
		<h1> New User </h1>
	</div>
<div class="large-2 medium-6 columns">
		<div class="callout panel">	
			<a href="admin.php" class="small button">&nbsp;Back&nbsp;</a>
		</div>
	</div>
</div>
<div class="row">
      <div class="large-12 columns">
      	<div class="panel">
			<h3> Enter in the new Admin below </h3>
<?php
# Connect to MySQL server and the database
require( 'includes/connectlimbo_db.php' ) ;

# Includes these helper functions
require( 'includes/limbohelpers.php' ) ;

#Checks for the fields and throws an error if there is something wrong with the field
if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
	if(isset($_POST['add'])){
	
	$fname = $_POST['first_name'] ;

    $lname = $_POST['last_name'] ;
	
	$email = $_POST['email'] ;
	
	$pass = $_POST['pass'] ;
	
	$confirmpass = $_POST['confirmpass'];

    if (valid_string($fname)== false || valid_string($lname) == false || valid_string($email) == false || valid_string($pass) == false || valid_string($confirmpass) == false){
	  echo '<p style="color:red">Please input all fields!</p>' ;  
	}else if (strlen($pass) < 6){
	  echo '<p style="color:red;font-size:16px;">An error !!! Password must be at least six characters.</p>';
	}else if ($pass != $confirmpass){
	  echo '<p style="color:red;font-size:16px;">An error !!! Passwords do not match.</p>';
	}else if(!empty($fname) && !empty($lname) && !empty($email) && !empty($pass) && !empty($confirmpass)){
      $result = insert_user_record($dbc, $fname, $lname, $email, $pass) ;
	  #show the user that was put in 
      echo "<p>Added " . $result . " new user: ". $fname . ". Thank you.</p>" ;
	}
  }
}

# Close the connection
mysqli_close( $dbc ) ;
?>

<!-- Get inputs from the user. -->
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
<p><input type="submit" name="add" value="Add" class="small round button" ></p>
<p>*We require that this is at least 6 characters in length. Further, make sure it is not too complex (so you can remember it).</p>
</form>
		</div>
	</div>
</div>
</html>
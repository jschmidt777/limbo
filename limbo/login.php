<!--
This PHP script front-ends linkyprints.php with a login page.
Originally created By Ron Coleman.
Revision history:
Who	Date		Comment
RC  07-Nov-13   Created.
JS  12/03/2014  Modified
-->
<!DOCTYPE html>
<head>
<link href="cssfoundation/foundation.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="css/background.css" />
</head>
<html>
<div class="row">
      <div class="large-6 medium-6 columns">
	<h1>Log in</h1>
	  </div>
<div class="large-6 medium-6 columns">
	  <div class="callout panel">
		<a href="limbo.php">Home&nbsp;</a>
		<a href="finder.php">Finder Page&nbsp;</a>
		<a href="owner.php">&nbsp;Lost Page&nbsp;</a>
		<a href="ql.php">&nbsp;Quick Links&nbsp;</a>
	</div>
  </div>
</div>
<form action="login.php" method="POST">
<div class="row">
      <div class="large-12 columns">
      	<div class="panel">
<?php
# Connect to MySQL server and the database
require( 'includes/connectlimbo_db.php' ) ;

# Connect to MySQL server and the database
require( 'includes/limbo_login_tools.php' ) ;

if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {


	//I should also hash somewhere eventually, so this can be more secure.
	
	$email = trim($_POST['email']) ;
	
	$pass = trim($_POST['pass']) ;

    $pid = validate($email, $pass) ;
	

    if($pid == -1){
      echo '<P style=color:red>Login failed please try again.</P>' ;

    }else{
	session_start();
	$_SESSION['email'] = $email;
      loadadmin('admin.php', $pid);
	exit();
	}
}
?>

<!-- Get inputs from the user. -->
<table>
<tr>
<td>Email:</td><td><input type="text" name="email"></td>
</tr>
<tr>
<td>Password:</td><td><input type="password" name="pass"></td>
</tr>
</table>
<p><input type="submit" ></p>
		</div>
	  </div>
	</div>
</form>
</html>
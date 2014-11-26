<!--
This PHP script front-ends linkyprints.php with a login page.
Originally created By Ron Coleman.
Revision history:
Who	Date		Comment
RC  07-Nov-13   Created.
-->
<!DOCTYPE html>
<html>
<a href="limbo.php">Home&nbsp;</a>
<a href="finder.php">Finder Page&nbsp;</a>
<a href="owner.php">&nbsp;Lost Page&nbsp;</a>
<a href="ql.php">&nbsp;Quick Links&nbsp;</a>
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
<h1>Log in</h1>
<form action="login.php" method="POST">
<table>
<tr>
<td>Email:</td><td><input type="text" name="email"></td>
</tr>
<tr>
<td>Password:</td><td><input type="password" name="pass"></td>
</tr>
</table>
<p><input type="submit" ></p>
</form>
</html>
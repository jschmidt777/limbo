<!DOCTYPE html>
<html>
<a href="admin.php">&nbsp;Back&nbsp;</a>
<br>
<br>
<head>
<!--Not using jquery yet but I might. At the least this will be replaced with a reference to a css library.
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script type="text/javascript">
    $('#form-fields').submit(function(){
        $(this).hide(); 
    })</script>-->
</head>

<?php
require( 'includes/connectlimbo_db.php' ) ;
require( 'includes/limbohelpers.php' ) ;

session_start();
$email = $_SESSION['email'];


$page = 'admin-2.php';
show_admin_record($dbc, $email) ;
$query = "SELECT * FROM users WHERE email ='".$email."'" ;
		 $results = mysqli_query( $dbc , $query ) ;
		 check_results($results) ;
		 if ($results){
		 
			 $row = mysqli_fetch_array( $results , MYSQLI_ASSOC );
			 $first_name = $row['first_name']  ;
			 $last_name = $row['last_name']  ;
			 $email = $row['email']  ;
			 $pass = $row['pass'] ;	
			 $user = $row['user_id'];
			}

	#Checks to see if it should display the form or not
	#Fix this so it works (updating and deleting still works, I just want this to be implemented as well).
		$display = true;
		if (!isset($_POST['submit'])){
		?>  <br>
			<form action="admin-2.php" method="POST">
				<h3>Update Account</h3>
				<br>
				<table>
				<tr>
				<td>First Name:</td><td><input type="text" name="first_name" value="<?php echo''.$first_name.''?>" placeholder= "<?php echo ''.$first_name.'' ?>"></td>
				</tr>
				<tr>
				<td>Last Name:</td><td><input type="text" name="last_name" value="<?php echo''.$last_name.''?>" placeholder="<?php echo''.$last_name.''?>"></td>
				</tr>
				<tr>
				<td>Email:</td><td><input type="text" name="email" value="<?php echo''.$email.''?>" placeholder="<?php echo''.$email.''?>"></td>
				</tr>
				<tr>
				<td><font style="color:red;font-size:16px;">*</font>Password:</td><td><input type="password" name="pass" value="<?php echo''.$pass.''?>"></td>
				</tr>
				<tr>
				<td>Confirm Updated Password:</td><td><input type="password" name="newpass" value="<?php echo''.$pass.''?>" ></td>
				</tr>
            </td>
				</tr>
				</table>
				<p><input type="submit" name="update" value="Update" > 
			  </form>
			  <p style="color:red;font-size:16px;">*If changed, confirm new password in "Confirm Updated Password" box.</p>
			  <!-- The password thing works, but I would like this to work differently MAYYYBEE, so if the password changes, then they have to confirm it. But I think this is fine for at least now. -->
		<?php
		}else{
		
		}
		
		if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
			$display = false;
				 $user = $row['user_id'] ;
				 $first_name = $_POST['first_name']  ;
				 $last_name = $_POST['last_name']  ;
			     $email = $_POST['email']  ;
			     $pass = $_POST['pass'] ;
				 $newpass = $_POST['newpass'] ;
			
			if (isset($_POST['update'])){
				if(!empty($first_name) && !empty($last_name) && !empty($email) && !empty($pass) && $pass == $newpass){
				update_user($dbc, $user, $first_name, $last_name, $email, $pass);
				echo 'Updated Your Account';
				$_SESSION['email'] = $email;
				show_admin_record($dbc, $email, $page);
				}else if (valid_string($first_name)== false){
				  echo '<p style="color:red;font-size:16px;">An error !!! Enter a valid First Name.</p>';
				}else if (valid_string($last_name) == false){
				  echo '<p style="color:red;font-size:16px;">An error !!! Enter a valid Last Name.</p>';
				}else if (valid_string($email) == false){
				  echo '<p style="color:red;font-size:16px;">An error !!! Enter your email.</p>';
				}else if (valid_string($pass) == false ){
				  echo '<p style="color:red;font-size:16px;">An error !!! Enter a valid password.</p>';
				}else if ($pass != $newpass ){
				  echo '<p style="color:red;font-size:16px;">An error !!! Confirm new password.</p>';
				}else {
				echo '<p style="color:red;font-size:16px;">An error !!! All Fields Required.</p>';
				}
				
			}
				
		}
	exit();
			
mysqli_close( $dbc ) ;
		
?>
</html>
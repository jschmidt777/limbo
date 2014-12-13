<!DOCTYPE html>
<html>
<!-- Allows admin to update their account-->
<head>
<!--Puts in the background and other css-->
<link href="cssfoundation/foundation.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="css/background.css" />
</head>
<?php
#Connection to the database and allows access to necessary functions in limbohelpers
require( 'includes/connectlimbo_db.php' ) ;
require( 'includes/limbohelpers.php' ) ;

#The admin's email
session_start();
$email = $_SESSION['email'];

#Get the admin's information
$page = 'admin-2.php';
echo' <div class="row">
		<div class="large-10 medium-6 columns">';
			show_admin_record($dbc, $email) ;
echo'   </div>';
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
			
		if (!isset($_POST['submit'])){
		?>  <div class="large-2 medium-6 columns">
					<div class="callout panel">
						<a href="admin.php" class="small button">&nbsp;Back&nbsp;</a>
					</div>
				</div>
			</div>
			<form action="admin-2.php" method="POST">
			<div class="row">
				<div class="large-12 columns">
					<div class="panel">
				<h3>Update Account</h3>
		<?php
			#Updates the user when they hit submit
			if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
			$display = false;
				 $user = $row['user_id'] ;
				 $first_name = $_POST['first_name']  ;
				 $last_name = $_POST['last_name']  ;
			     $email = $_POST['email']  ;
			     $pass = $_POST['pass'] ;
				 $newpass = $_POST['newpass'] ;
			
			if (isset($_POST['update'])){
				if(!empty($first_name) && !empty($last_name) && !empty($email) && !empty($pass) && $pass == $newpass && strlen($pass) >= 6){
				update_user($dbc, $user, $first_name, $last_name, $email, $pass);
				echo '<div class="row">
							<div class="large-6 medium-6 columns">
									<div class="callout panel">
										Updated Your Account
									</div>
							</div>
					  </div>';
				$_SESSION['email'] = $email;
				#show_admin_record($dbc, $email, $page);
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
				}else if (strlen($pass) < 6 ){
				  echo '<p style="color:red;font-size:16px;">An error !!! Password not a sufficient length (must be at least six characters long).</p>';
				}else {
				echo '<p style="color:red;font-size:16px;">An error !!! All Fields Required.</p>';
				}
			  }
			}
				
		  ?>	<br>
				<table>
					<!--Fields they can update-->
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
				<p><input type="submit" name="update" value="Update" class="small round button"></p>
				<p style="color:red;font-size:16px;">*If changed, confirm new password in "Confirm Updated Password" box.</p>
		<?php
		}else{
		
		}
		
	exit();
#Close connection			
mysqli_close( $dbc ) ;
		
?>		
		</div>
	  </div>
	</div>
  </form>
</html>
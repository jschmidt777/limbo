<!DOCTYPE html>
<html>
<!-- ALlows the user to claim an item-->
<head>
<link href="cssfoundation/foundation.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="css/background.css"/>
</head>
<div class="row">
    <div class="large-5 medium-6 columns">
<h1> Claim </h1>
	</div>
<div class="large-7 medium-6 columns">
	<div class="callout panel">
		<a href="ql.php" class="small button">&nbsp;Back&nbsp;</a>
		</div>
	</div>
</div>
<div class="row">
      <div class="large-12 columns">
      	<div class="panel">
<?php
require( 'includes/connectlimbo_db.php' ) ;
require( 'includes/limbohelpers.php' ) ;

session_start();
$description = $_SESSION['descrip'];


$page = 'claim.php';
$description = str_replace('_',' ',$description);
$query = "SELECT * FROM stuff WHERE description ='".$description."'" ;
		 $results = mysqli_query( $dbc , $query ) ;
		 check_results($results) ;
		 if ($results){
		 
			 $row = mysqli_fetch_array( $results , MYSQLI_ASSOC );
				
				 $id = $row['id'];
				 $owner = $row['owner'];
				 $description = $row['description'];
				
			}
	#Checks to see if it should display the form or not
		if (!isset($_POST['submit']) && empty($_POST['owner'])){
		show_record($dbc, $description, $page) ;
		?>
			<form action="claim.php" method="POST">
				<h3>Please fill out your information</h3>
				<br>
				<table>
				<td>Your Name:</td><td><input type="text" name="owner" value=""></td>
				</tr>
				</table>
				<p><input type="submit" name="submit" value="Submit" class="small round button"></p>
			  </form>
		<?php
		}else if (isset($_POST['submit']) && empty($_POST['owner'])){
		show_record($dbc, $description, $page) ;
		?>
			<form action="claim.php" method="POST">
				<h3>Please fill out your information</h3>
				<br>
				<table>
				<td>Your Name:</td><td><input type="text" name="owner" value=""></td>
				</tr>
				</table>
				<p><input type="submit" name="submit" value="Submit" class="small round button" ></p>
			  </form>
		<?php
		}
		
		if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
				 $id = $row['id'];
				 $owner = $_POST['owner'];
				 $description = $row['description'];
			if (isset($_POST['submit'])){
				if(!empty($owner)){
				claim_item($dbc, $owner, $id);
				echo '<br><br><br>Your information has been taken. Please go to the pick up site (Donnelly) with proper Identification in order to retrieve your item.';
				show_record($dbc, $description, $page );
				} else if (empty($owner)) {
				echo '<p style="color:red;font-size:16px;">An error !!! Please fill out your information.</p>';
				}
				
			}
				
		}
	exit();
			
mysqli_close( $dbc ) ;
		
?>
			</div>
		</div>
	</div>
</html>
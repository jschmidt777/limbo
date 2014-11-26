<!DOCTYPE html>
<html>
<a href="ql.php">&nbsp;Back&nbsp;</a>
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
	#This Works! I will later implement this in the other pages later but this is pretty sweet!
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
				<p><input type="submit" name="submit" value="Submit" ></p>
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
				<p><input type="submit" name="submit" value="Submit" ></p>
			  </form>
		<?php
		}
		
		if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
				$display = false;
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
</html>
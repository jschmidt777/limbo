<!DOCTYPE html>
<html>
<a href="admin.php">&nbsp;Back&nbsp;</a>
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
$description = $_SESSION['description'];


$page = 'update.php';
show_record($dbc, $description, $page) ;
$description = str_replace('_',' ',$description);
$query = "SELECT * FROM stuff WHERE description ='".$description."'" ;
		 $results = mysqli_query( $dbc , $query ) ;
		 check_results($results) ;
		 if ($results){
		 
			 $row = mysqli_fetch_array( $results , MYSQLI_ASSOC );
				
				 $id = $row['id'];
				 $status = $row['status'];
				 $location_name = $row['location_name'];
				 $room = $row['room'];
				 $owner = $row['owner'];
				 $finder = $row['finder'];
				 $update_date = 'NOW()';
				
				
			}
	#Checks to see if it should display the form or not
	#Fix this so it works (updating and deleting still works, I just want this to be implemented as well).
		$display = true;
		if (!isset($_POST['submit'])){
		?>
			<form action="update.php" method="POST">
				<h3>Update or Delete Item</h3>
				<br>
				<table>
				<tr>
				<td>Description:</td><td><input type="text" name="description" value="<?php echo''.$description.''?>" placeholder= "<?php echo ''.$description.'' ?>"></td>
				</tr>
				<tr>
				<td>Location:</td><td><input type="text" name="location" value="<?php echo''.$location_name.''?>" placeholder="<?php echo''.$location_name.''?>"></td>
				</tr>
				<tr>
				<td>Room:</td><td><input type="text" name="room" value="<?php echo''.$room.''?>" placeholder="<?php echo''.$room.''?>"></td>
				</tr>
				<tr>
				<td>Owner:</td><td><input type="text" name="owner" value="<?php echo''.$owner.''?>" placeholder="<?php echo''.$owner.''?>"></td>
				</tr>
				<tr>
				<td>Finder:</td><td><input type="text" name="finder" value="<?php echo''.$finder.''?>" placeholder="<?php echo''.$finder.''?>"></td>
				</tr>
				<tr>
				<td>Status:</td><td> <select name="status">';
				<?php
					if ($status == 'found') {
						echo '<option name="found" selected="selected">found</option>
							  <option name="lost">lost</option>
							  <option name="claimed">claimed</option>';
					} else if ($status == 'lost') {
						echo '<option name="found">found</option>
							  <option name="lost" selected="selected">lost</option>
							  <option name="claimed">claimed</option>';
					} else if ($status == 'claimed') {
						echo '<option name="found">found</option>
							  <option name="lost">lost</option>
							  <option name="claimed" selected="selected">claimed</option>';
					} ?>
			</select>
            </td>
				</tr>
				</table>
				<p><input type="submit" name="update" value="Update" > &nbsp; <input type="submit" name="delete" value="Delete" ></p>
			  </form>
		<?php
		}else{
		
		}
		
		if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
			$display = false;
				 $id = $row['id'];
				 $description = $_POST['description'];
				 $status = $_POST['status'];
				 $location_name = $_POST['location'];
				 $room = $_POST['room'];
				 $owner = $_POST['owner'];
				 $finder = $_POST['finder'];
				 $update_date = 'NOW()';
			
			if (isset($_POST['update'])){
				if(!empty($description) && !empty($location_name)){
				update_item($dbc, $description, $location_name, $room ,$owner , $finder, $status, $id, $update_date);
				echo 'Updated item '.$description.'.';
				show_record($dbc, $description, $page );
				} else {
				echo '<p style="color:red;font-size:16px;">An error !!! The description and location cannot be empty.</p>';
				}
				
			}else if (isset($_POST['delete'])){
				delete_item($dbc, $id);
				echo 'Deleted item '.$description.'.';
				
			}
				
		}
	exit();
			
mysqli_close( $dbc ) ;
		
?>
</html>
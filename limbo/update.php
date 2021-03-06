<!DOCTYPE html>
<html>
<!--ALlows an admin to update a page-->
<head>
<link href="cssfoundation/foundation.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="css/background.css" />
</head>
<?php
#Connects to the database and uses needed functions from limbohelpers
require( 'includes/connectlimbo_db.php' ) ;
require( 'includes/limbohelpers.php' ) ;

#Gets item description from previous page
session_start();
$description = $_SESSION['description'];
echo'<div class="row">
      <div class="large-6 medium-6 columns">
	<h1>Item: '.$description.'</h1>
	  </div>';
#Gets fields based on the item description
$page = 'update.php';
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
		
		if (!isset($_POST['submit'])){
		?>	
			<div class="large-6 medium-6 columns">
					<div class="callout panel">
						<a href="admin.php">&nbsp;Back&nbsp;</a>
					</div>
				</div>
			</div>
			<form action="update.php" method="POST">
			<div class="row">
				<div class="large-12 columns">
					<div class="panel">
				<h3>Update or Delete Item</h3>
				<?php #Checks to see what should happen when the submit button is hit,and displays it here
						if( $_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
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
								#show record?
								echo '<div class="row">
										<div class="large-6 medium-6 columns">
											<div class="callout panel">
												Updated item '.$description.'.
											</div>
										 </div>
									  </div>';
								} else {
								echo '<div class="row">
										<div class="large-6 medium-6 columns">
											<div class="callout panel">
												<p style="color:red;font-size:16px;">An error !!! The description and location cannot be empty.</p>
											</div>
										  </div>
										</div>';
								}
								
							}else if (isset($_POST['delete'])){
								delete_item($dbc, $id);
								echo '<div class="row">
										<div class="large-6 medium-6 columns">
											<div class="callout panel">
												Deleted item '.$description.'.
											</div>
										  </div>
										</div>';
								
							}
						  }	 ?>
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
		<?php
		}else{
		
		}
			
			
		
	exit();
			
mysqli_close( $dbc ) ;
		
?>
		</div>
	  </div>
	</div>
  </form>
</html>
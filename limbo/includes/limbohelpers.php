<!--Joseph Schmidt and Nick Titolo -->
<?php
$debug = false;

function show_record($dbc, $description, $page) {
	# Create a query to get the id, status, location_name, description, create_date, owner, and finder from stuff.
	$description = str_replace('_',' ',$description);
	if($page == 'admin.php' || $page == 'update.php'){
	$query = "SELECT * FROM stuff WHERE description ='".$description."'" ;
	}else{
	$query = "SELECT id, status, location_name, description, create_date, owner, finder FROM stuff WHERE description = '".$description."'" ;
	}
	# Execute the query
	$results = mysqli_query( $dbc , $query ) ;
	check_results($results) ;

	# Show results
	if( $results && $page == 'admin.php' || $page == 'update.php' )
	{
  		# But...wait until we know the query succeed before
  		# rendering the table start.
		  echo "<H3>Item ".$description. "</H3>" ;
		  echo '<TABLE BORDER="1" style="display:inline-block">';
		  echo '<TR>';
		  echo '<TH>Id</TH>';
		  echo '<TH>Status</TH>';
		  echo '<TH>Location</TH>';
		  echo '<TH>Description</TH>';
		  echo '<TH>Room</TH>';
		  echo '<TH>Create Date</TH>';
		  echo '<TH>Update Date</TH>';
		  echo '<TH>Owner</TH>';
		  echo '<TH>Finder</TH>';
		  echo '</TR>';
		  
		#Need to add a button to claim an Item
  		# For each row result, generate a table row
  		while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) )
  		{
    		echo '<TR>' ;
    		echo '<TD>' . $row['id'] . '</TD>' ;
			echo '<TD>' . $row['status'] . '</TD>' ;
			echo '<TD>' . $row['location_name'] . '</TD>' ;
			echo '<TD>' . $row['description'] . '</TD>' ;
			echo '<TD>' . $row['room'] . '</TD>' ;
			echo '<TD>' . $row['create_date'] . '</TD>' ;
			echo '<TD>' . $row['update_date'] . '</TD>' ;
			echo '<TD>' . $row['owner'] . '</TD>' ;
			echo '<TD>' . $row['finder'] . '</TD>' ;
    		echo '</TR>' ;
  		}

  		# End the table
  		echo '</TABLE>';

  		# Free up the results in memory
  		mysqli_free_result( $results ) ;
		
	}else{
		# But...wait until we know the query succeed before
  		# rendering the table start.
		  echo "<H3>Item ".$description. "</H3>" ;
		  echo '<TABLE BORDER="1">';
		  echo '<TR>';
		  echo '<TH>Id</TH>';
		  echo '<TH>Status</TH>';
		  echo '<TH>Location</TH>';
		  echo '<TH>Description</TH>';
		  echo '<TH>Create Date</TH>';
		  echo '<TH>Owner</TH>';
		  echo '<TH>Finder</TH>';
		  echo '</TR>';
		  
		
  		while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) )
  		{
    		echo '<TR>' ;
    		echo '<TD>' . $row['id'] . '</TD>' ;
			echo '<TD>' . $row['status'] . '</TD>' ;
			echo '<TD>' . $row['location_name'] . '</TD>' ;
			echo '<TD>' . $row['description'] . '</TD>' ;
			echo '<TD>' . $row['create_date'] . '</TD>' ;
			echo '<TD>' . $row['owner'] . '</TD>' ;
			echo '<TD>' . $row['finder'] . '</TD>' ;
    		echo '</TR>' ;
  		}

  		# End the table
  		echo '</TABLE>';

  		# Free up the results in memory
  		mysqli_free_result( $results ) ;
	}
}

function show_admin_record($dbc, $email){
	$email = str_replace('_',' ',$email);
	$query = "SELECT * FROM users WHERE email = '".$email."'" ;
	
	# Execute the query
	$results = mysqli_query( $dbc , $query ) ;
	check_results($results) ;
	
	#$row = mysqli_fetch_array($results, MYSQLI_ASSOC) ;
	
	if ($results){
		echo "<H3>User: ".$email."</H3>" ;
		  echo '<TABLE BORDER="1">';
		  echo '<TR>';
		  echo '<TH>Id</TH>';
		  echo '<TH>First name</TH>';
		  echo '<TH>Last Name</TH>';
		  echo '<TH>Email</TH>';
		  echo '<TH>Reg Date</TH>';
		  echo '</TR>';
	
	while ( $row = mysqli_fetch_array($results, MYSQLI_ASSOC) )
  		{
    		echo '<TR>' ;
    		echo '<TD>' . $row['user_id'] . '</TD>' ;
			echo '<TD>' . $row['first_name'] . '</TD>' ;
			echo '<TD>' . $row['last_name'] . '</TD>' ;
			echo '<TD>' . $row['email'] . '</TD>' ;
			echo '<TD>' . $row['reg_date'] . '</TD>' ;
    		echo '</TR>' ;
  		}
		
	# End the table
  		echo '</TABLE>';

  		# Free up the results in memory
  		mysqli_free_result( $results ) ;
	
	}
}

function show_delete_admin_record($dbc, $id){
	$query = "SELECT * FROM users WHERE user_id ='".$id."'" ;
	
	# Execute the query
	$results = mysqli_query( $dbc , $query ) ;
	check_results($results) ;
	
	#$row = mysqli_fetch_array($results, MYSQLI_ASSOC) ;
	
	if ($results){
		echo "<H3>User: ".$id."</H3>" ;
		  echo '<TABLE BORDER="1">';
		  echo '<TR>';
		  echo '<TH>Id</TH>';
		  echo '<TH>First name</TH>';
		  echo '<TH>Last Name</TH>';
		  echo '<TH>Email</TH>';
		  echo '<TH>Reg Date</TH>';
		  echo '</TR>';
	
	while ( $row = mysqli_fetch_array($results, MYSQLI_ASSOC) )
  		{
    		echo '<TR>' ;
    		echo '<TD>' . $row['user_id'] . '</TD>' ;
			echo '<TD>' . $row['first_name'] . '</TD>' ;
			echo '<TD>' . $row['last_name'] . '</TD>' ;
			echo '<TD>' . $row['email'] . '</TD>' ;
			echo '<TD>' . $row['reg_date'] . '</TD>' ;
    		echo '</TR>' ;
  		}
		
	# End the table
  		echo '</TABLE>';

  		# Free up the results in memory
  		mysqli_free_result( $results ) ;
	
	}
}


function show_link_records($dbc, $number, $page) {
	if ($number != 0 && $page != 'admin.php'){
		$query = 'SELECT DATE_FORMAT(create_date, "%Y-%m-%d"), status, description, create_date, id FROM stuff WHERE create_date BETWEEN NOW() - INTERVAL '. $number .' DAY and NOW() AND (status="lost" OR status="found") ORDER BY id ASC' ;
	}else if ($number != 0 && $page == 'admin.php'){
		$query = 'SELECT DATE_FORMAT(create_date, "%Y-%m-%d"), status, description, create_date, id FROM stuff WHERE create_date BETWEEN NOW() - INTERVAL '. $number .' DAY and NOW() ORDER BY id ASC' ;
	}else if ($number == 0 && $page == 'admin.php'){
		$query = 'SELECT status, description, create_date FROM stuff ' ;
	}else if ($number == 0 && $page != 'admin.php') {
		$query = 'SELECT status, description, create_date FROM stuff WHERE status = "lost" or status = "found"' ;
	}
	# Execute the query
	$results = mysqli_query( $dbc , $query ) ;
	check_results($results) ;

	# Show results
	if( $results )
	{
  		# But...wait until we know the query succeed before
  		# rendering the table start.
		  echo '<TABLE BORDER="1">';
		  echo '<TR>';
		  echo '<TH>Status</TH>';
		  echo '<TH>Description</TH>';
		  echo '<TH>Create Date</TH>';
		  echo '</TR>';
		  
		  

  		# For each row result, generate a table row
  		while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ))
  		{
			//TODO:Check for page some how
		if ($page != 'admin.php'){
			$rec = $row['description'];
			$properlink = str_replace(' ','_',$rec);
			$alink = '<A HREF=ql.php?description=' . $properlink. '>' . $properlink. '</A>' ;
    		echo '<TR>' ;
			echo '<TD>' . $row['status'] . '</TD>' ;
			echo '<TD >' . $alink . '</TD>' ;
			echo '<TD>' . $row['create_date'] . '</TD>' ;
    		echo '</TR>' ;
		}else{ 
			$rec = $row['description'];
			$properlink = str_replace(' ','_',$rec);
			$alink = '<A HREF=admin.php?description=' . $properlink. '>' . $properlink. '</A>' ;
    		echo '<TR>' ;
			echo '<TD>' . $row['status'] . '</TD>' ;
			echo '<TD >' . $alink . '</TD>' ;
			echo '<TD>' . $row['create_date'] . '</TD>' ;
    		echo '</TR>' ;
		  }
		}
		mysqli_free_result( $results ) ;
	}
}

function show_link_admins($dbc, $number, $email) {
#$query = 'SELECT * FROM users WHERE NOT IN ( SELECT * FROM users WHERE email="'.$email.'") ORDER BY user_id ASC LIMIT '.$number.'' ;
	if ($number != 0 ){
		$query = 'SELECT * FROM users ORDER BY user_id ASC LIMIT '.$number.'' ;
	}else if ($number == 0 ){
		$query = 'SELECT * FROM users' ;
	}
	# Execute the query
	$results = mysqli_query( $dbc , $query ) ;
	check_results($results) ;

	# Show results
	if( $results )
	{
  		# But...wait until we know the query succeed before
  		# rendering the table start.
		  echo '<TABLE BORDER="1">';
		  echo '<TR>';
		  echo '<TH>Id</TH>';
		  echo '<TH>First name</TH>';
		  echo '<TH>Last Name</TH>';
		  echo '<TH>Email</TH>';
		  echo '<TH>Reg Date</TH>';
		  echo '</TR>';
		  
		  

  		# For each row result, generate a table row
  		while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ))
  		{
		  if( $email != $row['email'] ){
			$rec = $row['user_id'];
			$alink = '<A HREF=admin-3.php?user_id=' . $rec. '>' . $rec. '</A>' ;
    		echo '<TR>' ;
    		echo '<TD>' . $alink . '</TD>' ;
			echo '<TD>' . $row['first_name'] . '</TD>' ;
			echo '<TD>' . $row['last_name'] . '</TD>' ;
			echo '<TD>' . $row['email'] . '</TD>' ;
			echo '<TD>' . $row['reg_date'] . '</TD>' ;
    		echo '</TR>' ;
		  }else{
			echo '<TR>' ;
    		echo '<TD>' . $row['user_id'] . '</TD>' ;
			echo '<TD>' . $row['first_name'] . '</TD>' ;
			echo '<TD>' . $row['last_name'] . '</TD>' ;
			echo '<TD>' . $row['email'] . '</TD>' ;
			echo '<TD>' . $row['reg_date'] . '</TD>' ;
    		echo '</TR>' ;
				
		  }
		
		}
		mysqli_free_result( $results ) ;
	}
}


function search_records($dbc, $description) {
	# Create a query to get the status, description, and create date of a searched item.
	$query = "SELECT status, description, create_date FROM stuff WHERE description LIKE'%".$description."%'"  ;

	# Execute the query
	$results = mysqli_query( $dbc , $query ) ;
	check_results($results) ;
	$rowcount = mysqli_num_rows($results);

	# Show results
	if( $results && $rowcount > 0 )
	{
  		# But...wait until we know the query succeed before
  		# rendering the table start.
		  echo '<TABLE BORDER="1">';
		  echo '<TR>';
		  echo '<TH>Status</TH>';
		  echo '<TH>Description</TH>';
		  echo '<TH>Create Date</TH>';
		  echo '</TR>';
		  
		  

  		# For each row result, generate a table row
  		while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) )
  		{
			$rec = $row['description'];
			$properlink = str_replace(' ','_',$rec);
			$alink = '<A HREF=ql.php?description='.$properlink.'>'.$properlink.'</A>' ;
    		echo '<TR>' ;
			echo '<TD>' . $row['status'] . '</TD>' ;
			echo '<TD >' . $alink . '</TD>' ;
			echo '<TD>' . $row['create_date'] . '</TD>' ;
    		echo '</TR>' ;
  		}
		
	
  		# End the table
  		echo '</TABLE>';
		echo "<p> *Items are found based on your description (i.e.'".$description."'). Click on a link to get more information about a specific item.</p>" ;
	

  		# Free up the results in memory
  		mysqli_free_result( $results ) ;
	
	}else if ($rowcount == 0){
	load_insert_new_item('newitem.php', $description);
	#else statement to follow.
	}
}


function load_insert_new_item( $page, $description )
{
  # Begin URL with protocol, domain, and current directory.
  $url = 'http://' . $_SERVER[ 'HTTP_HOST' ] . dirname( $_SERVER[ 'PHP_SELF' ] ) ;

  # Remove trailing slashes then append page name to URL and the print id.
  $url = rtrim( $url, '/\\' ) ;
  $url .= '/' . $page . '';

  # Execute redirect then quit.
  session_start( );
  
  $_SESSION['description'] = $description;

  header( "Location: $url" ) ;

  exit() ;
}

function claim_item($dbc, $owner, $id){
	$query = "UPDATE stuff SET owner = '".$owner."', 							   
							   status = 'claimed'
							   WHERE id = '".$id."'";
	show_query($query);
	# Execute the query
	$results = mysqli_query( $dbc , $query ) ;
	check_results($results) ;
	
	return $results;
	# Free up the results in memory
  	# mysqli_free_result( $results ) ;
	
}

function update_item($dbc, $description, $location_name, $room ,$owner ,$finder, $status, $id, $update_date){
	$query = "UPDATE stuff SET description = '".$description."', 
							   location_name = '".$location_name."', 
							   room = '".$room."', 
							   owner = '".$owner."', 
							   finder = '".$finder."', 
							   status = '".$status."', 
							   update_date = ".$update_date."
							   WHERE id = '".$id."'";
	show_query($query);
	# Execute the query
	$results = mysqli_query( $dbc , $query ) ;
	check_results($results) ;
	
	return $results;
	# Free up the results in memory
  	# mysqli_free_result( $results ) ;
	
}

function update_user($dbc, $user, $first_name, $last_name, $email, $pass){
	$query = "UPDATE users SET first_name= '".$first_name."', 
							   last_name = '".$last_name."', 
							   email = '".$email."', 
							   pass = '".$pass."'
							   WHERE user_id = '".$user."'";
	show_query($query);
	# Execute the query
	$results = mysqli_query( $dbc , $query ) ;
	check_results($results) ;
	
	return $results;
	# Free up the results in memory
  	# mysqli_free_result( $results ) ;
	
}

function delete_item($dbc, $id){
	$query = "DELETE FROM stuff WHERE id = '".$id."'";
	show_query($query);
	# Execute the query
	$results = mysqli_query( $dbc , $query ) ;
	check_results($results) ;
	
	return $results;
	# Free up the results in memory
  	# mysqli_free_result( $results ) ;
	
}

function delete_admin($dbc, $id){
	$query = "DELETE FROM users WHERE user_id = '".$id."'";
	show_query($query);
	# Execute the query
	$results = mysqli_query( $dbc , $query ) ;
	check_results($results) ;
	
	return $results;
	# Free up the results in memory
  	# mysqli_free_result( $results ) ;
	
}


# Inserts a record into the presidents table
#two of these for finders and owners
function insert_found_record($dbc, $description, $location_name, $finder, $room) {
  $query = 'INSERT INTO stuff(description, location_name, finder, room, create_date, status) VALUES ("' . $description. '" , "' . $location_name . '", "' . $finder . '", "' . $room . '" , NOW(), "found")' ;
  show_query($query);

  $results = mysqli_query($dbc,$query) ;
  check_results($results) ;

  return $results ;
}

function insert_lost_record($dbc, $description, $location_name, $owner, $room) {
  $query = 'INSERT INTO stuff(description, location_name, owner, room, create_date, status) VALUES ("' . $description. '" , "' . $location_name . '", "' . $owner . '", "' . $room . '" , NOW(), "lost")' ;
  show_query($query);

  $results = mysqli_query($dbc,$query) ;
  check_results($results) ;

  return $results ;
}

function insert_user_record($dbc, $fname, $lname, $email, $pass) {
  $query = 'INSERT INTO users(first_name, last_name, email, pass, reg_date) VALUES ("' . $fname. '" , "' . $lname . '", "' . $email . '", "' . $pass. '" , NOW())' ;
  show_query($query);

  $results = mysqli_query($dbc,$query) ;
  check_results($results) ;

  return $results ;
}


# Shows the query as a debugging aid
function show_query($query) {
  global $debug;

  if($debug)
    echo "<p>Query = $query</p>" ;
}

# Checks the query results as a debugging aid
function check_results($results) {
  global $dbc;

  if($results != true)
    echo '<p>SQL ERROR = ' . mysqli_error( $dbc ) . '</p>'  ;
}

# Validates a number
function valid_number($num) {
 if(empty($num) || !is_numeric($num))
 return false ;
 else {
 $num = intval($num) ;
	if($num <= 0)
	return false ;
	  }
return true ;
}

# Validates a string
function valid_string($string) {
	if(empty($string))
	 return false ;
	else {
	 return true ;
	}
#Perhaps in beta, validate the location input. Not very critical for what we're doing overall, but it would def. be nice.
#Maybe like search for what they input in the locations table with a LIKE clause and if it returns false then bring up an error message, but otherwise, change the location to the matched search result.
}
?>
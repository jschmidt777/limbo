<?php # CONNECT TO MySQL DATABASE.

# Connect  on 'localhost' to database 'limbo_db'.
$dbc = @mysqli_connect ( 'localhost', 'root', '', 'limbo_db' )

# Otherwise fail gracefully and explain the error. 
OR die ( mysqli_connect_error() ) ;

# Set encoding to match PHP script encoding.
mysqli_set_charset( $dbc, 'utf8' ) ;

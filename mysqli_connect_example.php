<?php # Script 9.2 - mysqli_connect.php

// This file contains the database access information.
// This file also establishes a connection to MySQL,
// selects the database, and sets the encoding.

// Set the database access information as constants:
try {
define('DB_USER', 'fakeusername');
define('DB_PASSWORD', 'fakepassword');
define('DB_HOST', 'localhost');
define('DB_NAME', 'yourdbnamehere');
}
catch (Exception $e) {
}

// Make the connection:
$dbc = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die('Could not connect to MySQL: ' . mysqli_connect_error() );

// Set the encoding...
mysqli_set_charset($dbc, 'utf8');
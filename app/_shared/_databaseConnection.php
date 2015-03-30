<?php 

// Code to obtain mysqli connection with Heroku DB
$dbhost = 'us-cdbr-iron-east-01.cleardb.net'; 
$dbuser = 'bb8fc74ed602e7'; 
$dbpassword = 'e3a5c7f6'; 
$dbname = 'heroku_687b349d31e72c1'; 

global $mysqliBeerTrackPrime;
// $mysqliBeerTrackPrime = new mysqli($dbhost, $dbuser, $dbpassword, $dbname);
$mysqliBeerTrackPrime = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);


//A function that takes into it a SQL query and executes that query.
function beerTrackDBQuery($query) {
	global $mysqliBeerTrackPrime;
	$result = mysqli_query($mysqliBeerTrackPrime, $query);
	if ($mysqliBeerTrackPrime->connect_errno) {
		echo 'error with connection. see databaseConnection.php';
	}
	else
	{
	}
	return $result;
}

//A function that return the database connection.
function returnConnection() {
	// $tempConnect = new mysqli($dbhost, $dbuser, $dbpassword, $dbname);
	// return $tempConnect;
	global $mysqliBeerTrackPrime;
	return $mysqliBeerTrackPrime;
}
?>
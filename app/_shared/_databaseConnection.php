<?php 

// Code to obtain mysqli connection with Heroku DB
$dbhost = 'us-cdbr-iron-east-01.cleardb.net'; 
$dbuser = 'bb8fc74ed602e7'; 
$dbpassword = 'e3a5c7f6'; 
$dbname = 'heroku_687b349d31e72c1'; 

$mysqliBeerTrackPrime = new mysqli($dbhost, $dbuser, $dbpassword, $dbname);

function beerTrackDBQuery($query) {
	global $mysqliBeerTrackPrime;
	$result = mysqli_query($mysqliBeerTrackPrime, $query);
	if ($mysqliBeerTrackPrime->connect_errno) {
		echo 'error with connection. see databaseConnection.php';
	}
	return $result;
}


// echo 'bottom of db connect';
?>
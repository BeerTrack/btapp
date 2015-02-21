<?php 

// Code to obtain mysqli connection with Heroku DB
$dbhost = 'us-cdbr-iron-east-01.cleardb.net'; 
$dbuser = 'bb8fc74ed602e7'; 
$dbpassword = 'e3a5c7f6'; 
$dbname = 'heroku_687b349d31e72c1'; 

$primaryBeerTrackDB = new mysqli($dbhost, $dbuser, $dbpassword, $dbname); 

if ($primaryBeerTrackDB->connect_errno) 
{ 
	echo 'Failed to connect to MySQL: (' . $primaryBeerTrackDB->connect_errno . ')' . $primaryBeerTrackDB->connect_error; 
}

?>
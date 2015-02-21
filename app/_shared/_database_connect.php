<?php 
// Function to obtain mysqli connection. 
function get_mysqli_conn() { 
 $dbhost = 'us-cdbr-iron-east-01.cleardb.net'; 
 $dbuser = 'bb8fc74ed602e7'; 
 $dbpassword = 'e3a5c7f6'; 
 $dbname = 'heroku_687b349d31e72c1'; 
 
 $mysqli = new mysqli($dbhost, $dbuser, $dbpassword, $dbname); 
 
 if ($mysqli->connect_errno) { 
 echo 'Failed to connect to MySQL: (' . $mysqli->connect_errno 
. ') ' . $mysqli->connect_error; 
 } 
 return $mysqli; 
}
?>
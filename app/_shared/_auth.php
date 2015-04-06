<!-- PHP code used to authenticate the user of the system. -->
<?php
session_start();

if($_SESSION["loginStatus"]  === 'loggedIn')
{
    $loggedInEmail = $_SESSION["loggedInEmail"];
    $loggedInPersonName = $_SESSION["loggedInPersonName"];
    $loggedInBreweryName = $_SESSION["loggedInBreweryName"];
    $loggedInBreweryAddress = $_SESSION["loggedInBreweryAddress"];
    $loggedInBreweryID = intval($_SESSION["loggedInBreweryID"]);
    $showingCourse = $_SESSION["showingCourse"];
    echo '<div id="loggedInEmailUser" style="display: none;">' . $loggedInEmail . '</div>';
    echo '<div id="loggedInBreweryID" style="display: none;">' . $loggedInBreweryID . '</div>';
    if(strlen(($_SESSION["showingCourse"]))<1)
    {
    	$showingCourse = 'MSCI436';
    }
}
else
{
	if(strpos($_SERVER['HTTP_HOST'], 'app') > -1)
	{
		$_SESSION["loginStatus"]  === 'noLogin';
		header("Location: ../../../?prev=passed");
	}
	else
	{
		$_SESSION["loginStatus"]  === 'noLogin';
		header("Location: ../../../");
	}
}

//Function used return the Brewery ID of the user thats logged in (needed in the situations where our other functions can't acces the variable directly)
function returnLoggedInBreweryID() {
	return intval($_SESSION["loggedInBreweryID"]);
}
?>
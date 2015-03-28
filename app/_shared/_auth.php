<?php
session_start();

if($_SESSION["loginStatus"]  === 'loggedIn')
{
	// echo ' you\'re allowed to be here...';
    $loggedInEmail = $_SESSION["loggedInEmail"];
    $loggedInPersonName = $_SESSION["loggedInPersonName"];
    $loggedInBreweryName = $_SESSION["loggedInBreweryName"];
    $loggedInBreweryAddress = $_SESSION["loggedInBreweryAddress"];
    $loggedInBreweryID = intval($_SESSION["loggedInBreweryID"]);
    $showingCourse = $_SESSION["showingCourse"];
    echo '<div id="loggedInEmailUser" style="display: none;">' . $loggedInEmail . '</div>';
    echo '<div id="loggedInBreweryID" style="display: none;">' . $loggedInBreweryID . '</div>';
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

function returnLoggedInBreweryID() {
	// echo intval($_SESSION["loggedInBreweryID"]);
	return intval($_SESSION["loggedInBreweryID"]);
}



?>


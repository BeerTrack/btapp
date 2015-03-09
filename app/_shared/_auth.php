<?php
session_start();

if($_SESSION["loginStatus"]  === 'loggedIn')
{
	// echo ' you\'re allowed to be here...';
    $loggedInEmail = $_SESSION["loggedInEmail"];
    $loggedInPersonName = $_SESSION["loggedInPersonName"];
    $loggedInBreweryName = $_SESSION["loggedInBreweryName"];
    $loggedInBreweryID = $_SESSION["loggedInBreweryID"];
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





?>
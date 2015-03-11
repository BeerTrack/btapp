<?php

// include 'app/_shared/_auth.php';
include 'app/_shared/_databaseConnection.php';

//**************************************************************
//START: Homemade Controller (to determine which view to show)
//**************************************************************
$viewName = $_GET['viewName'];
$requestedAction = $_GET['requestedAction'];
$viewDisplayName = '';
$viewPageName = '';
$loginStatus = '';


//NOTE: THE ACTIONS AND THE VIEWS ARE FLIPPED FOR THIS ONE, SO THAT THE ERROR MESSAGES CAN BE RENDERED AT THE RIGHT TIME...

// specific actions for some pages
switch ($requestedAction) {
    case "newRegistration": 
        newRegistration($_POST['full_name'], $_POST['brewery_name'], $_POST['email'], $_POST['password']);
        break;
    case "authenticateUser": 
        authenticateUser($_POST['email'], $_POST['password']);
        break;
    case "logout": 
        logoutUser();
        break;
}

//which view to show
switch ($viewName) {
    case "register":
        $viewPageName = 'auth/_register.php';
        break;
    default:
        $viewPageName = 'auth/_login.php';
        break;
}

// END: Homemade controller


//**************************************************************
//START: Homemade Models (for each of our controllers)
//**************************************************************

//generates password hash with salt when a new user is created
function generateHashWithSalt($password) {
    $intermediateSalt = mt_rand();
    $salt = substr($intermediateSalt, 0, 10);

    $passwordHash = hash("sha256", $password . $salt);
    return array($passwordHash, $salt);
}

//creates a user
function newRegistration($fullName, $breweryName, $email, $password)
{
    $fullName = mysql_escape_string($fullName);
    $breweryName = mysql_escape_string($breweryName);
    $email = mysql_escape_string($email);
    $password = mysql_escape_string($password);

    $passwordHashSaltArray = generateHashWithSalt($password);
    $passwordHash = $passwordHashSaltArray[0];
    $passwordSalt = $passwordHashSaltArray[1];

    //inserting user into database
    $insert_user_statement = "INSERT INTO breweries (brewery_name, person_name, email, password_hash, password_salt)
    VALUES ('$breweryName', '$fullName', '$email', '$passwordHash', '$passwordSalt')";
    beerTrackDBQuery($insert_user_statement);
}

//authenticates a user

function authenticateUser($userEmail, $userPassword)
{
    //clearing the "login status" variable...
    session_unset(); 
    session_destroy();

    $userEmail = mysql_escape_string($userEmail);
    $userPassword = mysql_escape_string($userPassword);

    //getting the users details
    $lookupUser = "SELECT * FROM breweries 
    WHERE email = '$userEmail'";
    $userMysqlReturned = mysqli_fetch_array(beerTrackDBQuery($lookupUser));

    //changing the plain text password to salted and hashed version...
    $passwordHash = hash("sha256", $userPassword . $userMysqlReturned['password_salt']);

    if($passwordHash === $userMysqlReturned['password_hash'])
    {
        if($userMysqlReturned['brewery_active_status'] === '1')
        {

session_start();

            $_SESSION["loginStatus"]  = 'loggedIn';
            $_SESSION["loggedInEmail"] = $userEmail;
            $_SESSION["loggedInPersonName"] = $userMysqlReturned['person_name'];
            $_SESSION["loggedInBreweryName"] = $userMysqlReturned['brewery_name'];
            $_SESSION["loggedInBreweryID"] = $userMysqlReturned['brewery_id'];
            header("Location: app/global/dashboard/");
        }
        else
        {
            $_SESSION["loginStatus"]  = 'notActive';
        }
    }
    else
    {
        $_SESSION["loginStatus"]  = 'failed';
    }

}

function logoutUser()
{
    //clearing all session variables...
    session_start();
    $_SESSION["loginStatus"]  = 'loggedOut';
}



//END: Homemade models


?>

<!DOCTYPE html>
<html class="bg-black">
    <head>
        <meta charset="UTF-8">
        <title>BeerTrack | Log in</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="../assets/css/AdminLTE.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="bg-black">

        <?php
            include $viewPageName;
        ?>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js" type="text/javascript"></script>

    </body>
</html>

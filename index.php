<?php
ob_start(); //need this for header redirect to work...

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
        authenticateUser($_POST['email'], $_POST['password'], $_POST['course']);
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
    $fullName = mysqli_real_escape_string(returnConnection(), $fullName);
    $breweryName = mysqli_real_escape_string(returnConnection(), $breweryName);
    $email = mysqli_real_escape_string(returnConnection(), $email);
    $password = mysqli_real_escape_string(returnConnection(), $password);

    $passwordHashSaltArray = generateHashWithSalt($password);
    $passwordHash = $passwordHashSaltArray[0];
    $passwordSalt = $passwordHashSaltArray[1];

    //inserting user into database
    $insert_user_statement = "INSERT INTO breweries (brewery_name, person_name, email, password_hash, password_salt)
    VALUES ('$breweryName', '$fullName', '$email', '$passwordHash', '$passwordSalt')";
    beerTrackDBQuery($insert_user_statement);
}

//authenticates a user

function authenticateUser($userEmail, $userPassword, $userCourse)
{
    // echo '| top of authenticateUser';

    //clearing the "login status" variable...
    session_unset(); 
    session_destroy();

    // echo '| after session updates authenticateUser';

    $userEmail = mysqli_real_escape_string(returnConnection(), $userEmail);
    $userPassword = mysqli_real_escape_string(returnConnection(), $userPassword);

    // echo ' fyi: ' . $userEmail . $userPassword ;

    // echo '| after mysql escape strings';

    //getting the users details
    $lookupUser = "SELECT * FROM breweries 
    WHERE email = '$userEmail'";

    // echo '| after mysql select statement written';

    $userMysqlReturned = mysqli_fetch_array(beerTrackDBQuery($lookupUser));

    // echo '| after mysql call';
    //changing the plain text password to salted and hashed version...
    $passwordHash = hash("sha256", $userPassword . $userMysqlReturned['password_salt']);

    if($passwordHash === $userMysqlReturned['password_hash'])
    {
        // echo '| in first level of if statement of auth user';
        if($userMysqlReturned['brewery_active_status'] === '1')
        {
            session_start();
            $_SESSION["loginStatus"]  = 'loggedIn';
            $_SESSION["loggedInEmail"] = $userEmail;
            $_SESSION["loggedInPersonName"] = $userMysqlReturned['person_name'];
            $_SESSION["loggedInBreweryName"] = $userMysqlReturned['brewery_name'];
            $_SESSION["loggedInBreweryID"] = $userMysqlReturned['brewery_id'];
            $_SESSION["showingCourse"] = $userCourse;
            header('Location: app/global/dashboard/');
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

    // echo '| exiting authenticateUser function...';

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
        <!--Theme style-->
        <link href="../assets/css/AdminLTE.css" rel="stylesheet" type="text/css" />
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js" type="text/javascript"></script>

        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

            ga('create', 'UA-60692087-1', 'auto');
            ga('send', 'pageview');
        </script>



    </head>
    <style>
        body {
                background-image: url("Background.jpg");margin: 0px; padding: 110px;
        } 
    </style>

    <body class="bg-black">

        <?php
            include $viewPageName;
        ?>



    </body>
</html>

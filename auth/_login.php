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
        <style>
        body {
                background-image: url("Background.jpg");margin: 0px; padding: 175px;
        } 
        /* Hidden placeholder */
select option[disabled]:first-child {
    display: none;
}

    </style>


    <body class="bg-black">

        <div class="form-box" id="login-box" style="margin-top: 20px;">
            <div class="header"><img src="LogoBW.png" alt="BeerTrack Logo"></div>
            <form action="?requestedAction=authenticateUser" method="post">
                <div class="body bg-gray">
            <?php

            if($_SESSION["loginStatus"] === 'failed')
            {
                include 'error_messages/_noUser.php';
            }
            if($_SESSION["loginStatus"] === 'notActive')
            {
                include 'error_messages/_inactiveBrewery.php';
            }
            if($_GET['prev'] === 'passed')
            {
                include 'error_messages/_needLogin.php';
            }
            if($_SESSION["loginStatus"] === 'loggedOut')
            {
                include 'error_messages/_loggedOutSuccess.php';
            }

            ?>

                    <div class="form-group">
                        <input type="text" name="email" id="emailField" class="form-control" placeholder="Email Address"/>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Password"/>
                    </div>
                    <select class="form-control" name="course" placeholder="class">
                    <option value="" id="courseSelected" selected disabled>Course</option>
                        <option value="MSCI444">MSCI 444</option>
                        <option value="MSCI436">MSCI 436</option>
                      </select>
                </div>
                <div class="footer">
                    <button type="submit" class="btn bg-light-blue btn-block" id="signInButton">Sign In</button>

                    <p>To create an account, please <a href="/?viewName=register">click here</a>.</p>
                </div>
            </form>
        </div>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js" type="text/javascript"></script>

    </body>
</html>

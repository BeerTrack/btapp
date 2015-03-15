    <body class="bg-black">

    <div class="row full-screen-background-image">
            <div class="form-box" id="login-box">
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
                        <option value="" id="courseSelected" selected disabled>Interface/Instance</option>
                            <option value="MSCI444">Demo Instance - MSCI 444</option>
                            <option value="MSCI436">Demo Instance - MSCI 436</option>
                          </select>
                    </div>
                    <div class="footer">
                        <button type="submit" class="btn bg-light-blue btn-block" id="signInButton">Sign In</button>

                        <p>To request an account, please <a href="/?viewName=register">click here</a>.</p>
                    </div>
                </form>
            </div>
        </div>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js" type="text/javascript"></script>

    </body>
</html>

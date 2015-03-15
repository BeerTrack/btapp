<div class="row full-screen-background-image">
    <div class="form-box" id="login-box">
        <div class="header"><img src="../LogoBW.png" alt="BeerTrack Logo" style="margin-bottom:10px">Brewery Account Registration</div>
        <form action="/?requestedAction=newRegistration" method="post">
            <div class="body bg-gray">
                <div class="form-group">
                    <input type="text" name="full_name" class="form-control" placeholder="Your Name"/>
                </div>
                <div class="form-group">
                    <input type="text" name="brewery_name" class="form-control" placeholder="Brewery Name"/>
                </div>
                <div class="form-group">
                    <input type="text" name="email" class="form-control" placeholder="Email Address"/>
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Password"/>
                </div>
            </div>
            <div class="footer">
                <button type="submit" class="btn bg-light-blue btn-block">Sign Up</button>
            </div>
        </form>
    </div>
</div>
<?php

$functionLoggedInBreweryID = returnLoggedInBreweryID();
$displayBreweryInfoQuery = beerTrackDBQuery("SELECT * FROM breweries WHERE brewery_id = '$functionLoggedInBreweryID'");
$brewery_Array = mysqli_fetch_array($displayBreweryInfoQuery);

?>

<div class="box box-primary">
    <div class="box-header">
        <h3 class="box-title">Update Brewery Details</h3>
    </div><!-- /.box-header -->
    <div class="box-body">
        <form role="form" method="post" action="?requestedAction=sumbitUpdates">
            <!-- text input -->
            
            <div class="form-group">
                <labelfor="breweryName">Name</label>
                <input type="text" class="form-control" id="breweryName" name="breweryName" value ="1"/>
            </div>

             <div class="form-group">
                <labelfor="breweryAddress">Address</label>
                <input type="text" class="form-control" id="breweryAddress" name="breweryAddress" value ="2"/>
            </div>
       
            <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
            </div>

        </form>

    </div><!-- /.box-body -->
</div><!-- /.box -->

<!-- - Form with fields for adding a beer (See elements here: http://almsaeedstudio.com/AdminLTE/pages/forms/general.html)</br>
- POST this data back to the index page </br>
- finish "addBeer" function (in index.php), it should submit the data back to the database.  -->
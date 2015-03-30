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
                <input type="text" class="form-control" id="breweryName" name="breweryName" value ="<?php echo $brewery_Array['brewery_name']; ?>"/>
            </div>

             <div class="form-group">
                <labelfor="breweryAddress">Address</label>
                <input type="text" class="form-control" id="breweryAddress" name="breweryAddress" value ="<?php echo $brewery_Array['brewery_address']; ?>"/>
            </div>
       
            <div class="box-footer">
            <button type="submit" class="btn btn-primary">Update</button>
            </div>

        </form>

    </div><!-- /.box-body -->
</div><!-- /.box -->
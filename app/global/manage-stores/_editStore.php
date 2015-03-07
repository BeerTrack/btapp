<?php
$storeId = htmlspecialchars($_GET["storeId"]);

$displayBeerInfoQuery = beerTrackDBQuery("SELECT * FROM stores s WHERE s.store_id = '$storeId'");
$store_Array = mysqli_fetch_array($displayBeerInfoQuery);

?>


<!-- general form elements disabled -->
<div class="box box-primary">
    <div class="box-header">
        <h3 class="box-title">Edit Store Information</h3>
    </div><!-- /.box-header -->
    <div class="box-body">
        <form role="form" method="post" action="?requestedAction=submitUpdates">
            <!-- text input -->
            <div class="form-group">
                <labelfor="locationName">Name</label>
                <input type="text" class="form-control" id="locationName" value ="<?php echo $store_Array['location_name'];?>"
                name="locationName"/>
            </div>

             <div class="form-group">
                <labelfor="locationAddress">Location</label>
                <input type="text" class="form-control" id="locationAddress"
                value ="<?php echo $store_Array['location_address'];?>"
                 name="locationAddress"/>
            </div>

            <div class="form-group">
                <labelfor="beerStoreStoreId"> Beer Store Store Id</label>
                <input type="number" class="form-control" id="beerStoreStoreId" name="beerStoreStoreId" value ="<?php echo $store_Array['beer_quantity'];?>">
            </div>


            <div class="form-group">
            <input type="hidden" class="form-control" id="storeId" name="storeId" value ="<?php echo $storeId; ?>">
            </div>
       
            <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
            </div>

        </form>
    </div><!-- /.box-body -->
</div><!-- /.box -->



- Make form (See elements here: http://almsaeedstudio.com/AdminLTE/pages/forms/general.html)</br>
- Form with fields auto loaded with current data (for onload) -> finish editBeerAutoLoadValues function in index file</br>
- POST this data back to the index page with the submitUpdates case </br>
- finish "editBeerProcess" function (in index.php), it should update the data in the database with the data that this page posts to it... 
<?php
$beerId = htmlspecialchars($_GET["beerId"]);

$displayBeerInfoQuery = beerTrackDBQuery("SELECT * FROM beer_brands b WHERE b.beer_id = '$beerId'");
$beer_Array = mysqli_fetch_array($displayBeerInfoQuery);

?>


<!-- general form elements disabled -->
<div class="box box-primary">
    <div class="box-header">
        <h3 class="box-title">Edit Beer Information</h3>
    </div><!-- /.box-header -->
    <div class="box-body">
        <form role="form" method="post" action="?requestedAction=submitUpdates">
            <div class="form-group">
                <labelfor="beerName">Name</label>
                <input type="text" class="form-control" id="beerName" value ="<?php echo $beer_Array['beer_name'];?>" name="beerName">
            </div>

            <div class="form-group">
                <labelfor="beerPrice">Price</label>
                <input type="number" class="form-control" id="beerPrice" name="beerPrice" value ="<?php echo $beer_Array['beer_price'];?>">
            </div>

            <div class="form-group">
                <labelfor="beerSize">Size</label>
                <input type="number" class="form-control" id="beerSize" name="beerSize" value ="<?php echo $beer_Array['beer_size'];?>">
            </div>

            <div class="form-group">
                <labelfor="beerType">Select Type</label>
                <select class="form-control" id="beerType" name="beerType" value ="<?php echo $beer_Array['beer_type'];?>">
                    <option>Bottle</option>
                    <option>Can</option>
                </select>
            </div>

            <div class="form-group">
                <labelfor="beerQuantity">Select Quantity</label>
                <select class="form-control" id="beerQuantity" name="beerQuantity" value ="<?php echo $beer_Array['beer_quantity'];?>">
                    <option>1</option>
                    <option>6</option>
                    <option>12</option>
                    <option>24</option>
                </select>
            </div>

             <div class="form-group">
                <input type="hidden" class="form-control" id="beerId" name="beerId" value ="<?php echo $beerId; ?>">
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
<?php
//Get data using methods
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
                <labelfor="beerstoreBeerId"> Beer Store Beer ID</label>
                <input type="number" class="form-control" id="beerstoreBeerId" name="beerstoreBeerId" value ="<?php echo $beer_Array['beerstore_beer_id'];?>">
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
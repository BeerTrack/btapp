<!-- general form elements disabled -->
<div class="box box-primary">
    <div class="box-header">
        <h3 class="box-title">Add A New Beer</h3>
    </div><!-- /.box-header -->
    <div class="box-body">
        <form role="form" method="post" action="?requestedAction=add">
            <div class="form-group">
                <labelfor="beerName">Name</label>
                <input type="text" class="form-control" id="beerName" name="beerName" placeholder="Enter Name"/>
            </div>

            <div class="form-group">
                <labelfor="beerPrice">Price</label>
                <input type="number" class="form-control" id="beerPrice" name="beerPrice" placeholder="Enter Price"/>
            </div>

            <div class="form-group">
                <labelfor="beerSize">Size</label>
                <input type="number" class="form-control" id="beerSize" name="beerSize" placeholder="Enter Size in ml"/>
            </div>

            <div class="form-group">
                <labelfor="beerType">Select Type</label>
                <select class="form-control" id="beerType" name="beerType">
                    <option>Bottle</option>
                    <option>Can</option>
                </select>
            </div>

            <div class="form-group">
                <labelfor="beerQuantity">Select Quantity</label>
                <select class="form-control" id="beerQuantity" name="beerQuantity">
                    <option>1</option>
                    <option>6</option>
                    <option>12</option>
                    <option>24</option>
                </select>
            </div>

            <div class="form-group">
                <labelfor="beerstoreBeerId"> Beer Store Beer ID</label>
                <input type="number" class="form-control" id="beerstoreBeerId" name="beerstoreBeerId" placeholder="Enter Beer Store Beer Id"/>
            </div>

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>

        </form>
    </div><!-- /.box-body -->
</div><!-- /.box -->
<!-- general form elements disabled -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">New Sale</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                    <form role="form" method="post" action="?requestedAction=add">
                                        <!-- text input -->
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
                                   
                                        <div class="box-footer">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>

                                    </form>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
<?php
//HTML and any necessary PHP for adding a beer.
?>

<!-- - Form with fields for adding a beer (See elements here: http://almsaeedstudio.com/AdminLTE/pages/forms/general.html)</br>
- POST this data back to the index page </br>
- finish "addBeer" function (in index.php), it should submit the data back to the database.  -->
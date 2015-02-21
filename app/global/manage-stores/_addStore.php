<!-- general form elements disabled -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Add A New Store</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                    <form role="form" method="post" action="?requestedAction=add">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <labelfor="locationName">Name</label>
                                            <input type="text" class="form-control" id="locationName" name="locationName" placeholder="Enter Name"/>
                                        </div>

                                         <div class="form-group">
                                            <labelfor="locationAddress">Location</label>
                                            <input type="text" class="form-control" id="locationAddress" name="locationAddress" placeholder="123 Anywhere St, Toronto, ON A1B 2C3"/>
                                        </div>
                                   
                                        <div class="box-footer">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>

                                    </form>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->

<?php
//HTML and any necessary PHP for adding a store.
?>

<!-- - Form with fields for adding a store (See elements here: http://almsaeedstudio.com/AdminLTE/pages/forms/general.html)</br>
- POST this data back to the index page </br>
- finish "addStore" function (in index.php), it should submit the data back to the database.  -->
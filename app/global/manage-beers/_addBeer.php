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
                <labelfor="beerType">Select Package Type</label>
                <select class="form-control" id="beerType" name="beerType">
                    <option>Bottle</option>
                    <option>Can</option>
                </select>
            </div>

            <div class="form-group">
                <labelfor="beerQuantity">Select Package Quantity</label>
                <select class="form-control" id="beerQuantity" name="beerQuantity">
                    <option>1</option>
                    <option>6</option>
                    <option>12</option>
                    <option>24</option>
                </select>
            </div>

            <div class="form-group">
                <labelfor="beerstoreBeerId">Beer Store Issued Beer ID</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="beerstoreBeerId" name="beerstoreBeerId" placeholder="Is this beer sold at one of Ontario's Beer Stores? If so, please enter it's official beer ID.">
                    <span style="cursor: pointer" data-toggle="modal" data-target="#beerStoreBeerIDLookupModal" class="input-group-addon">Lookup Beer ID&nbsp;&nbsp;<i class="fa fa-external-link-square"></i></span>
                </div>
                
             </div>


            <div class="box-footer" style="padding-left:0px">
                <button type="submit" class="btn btn-primary">Save Beer</button>
            </div>

        </form>
    </div><!-- /.box-body -->
</div><!-- /.box -->



<!-- Modal -->
<div class="modal fade" id="beerStoreBeerIDLookupModal" tabindex="-1" role="dialog" aria-labelledby="beerstoreBeerIDModalTitle" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="beerstoreBeerIDModalTitle">Beer Store Beer ID Lookup</h4>
      </div>
      <div class="modal-body">

    <div class="form-group">
        <labelfor="lookupBeerName">Beer Name</label>
        <input type="text" class="form-control" id="lookupBeerName" name="lookupBeerName" placeholder="Enter the Beer Name"/>
    </div>   
    <div class="form-group">
        <labelfor="lookupBeerNameBrewer">Brewer</label>
        <input type="text" class="form-control" id="lookupBeerNameBrewer" name="lookupBeerNameBrewer" placeholder="Enter the Brewer Name"/>
    </div>
    <div class="form-group">
                <labelfor="lookupBeerNamesize">Select Package Quantity</label>
                <select class="form-control" id="lookupBeerNamesize" name="lookupBeerNamesize">
                    <option value="1  ×  Can 500 ml">1  ×  Can 500 ml</option>
                    <option value="1  ×  Can 473 ml">1  ×  Can 473 ml</option>
                    <option value="6  ×  Can 500 ml">6  ×  Can 500 ml</option>
                    <option value="6  ×  Can 473 ml">6  ×  Can 473 ml</option>
                    <option value="12  ×  Can 500 ml">12  ×  Can 500 ml</option>
                    <option value="12  ×  Can 473 ml">12  ×  Can 473 ml</option>
                    <option value="24  ×  Can 500 ml">24  ×  Can 500 ml</option>
                    <option value="24  ×  Can 473 ml">24  ×  Can 473 ml</option>
                    <option value="1  ×  Bottle 355 ml">1  ×  Bottle 355 ml</option>
                    <option value="1  ×  Bottle 500 ml">1  ×  Bottle 500 ml</option>
                    <option value="6  ×  Bottle 355 ml">6  ×  Bottle 355 ml</option>
                    <option value="6  ×  Bottle 500 ml">6  ×  Bottle 500 ml</option>
                    <option value="12  ×  Bottle 355 ml">12  ×  Bottle 355 ml</option>
                    <option value="12  ×  Bottle 500 ml">12  ×  Bottle 500 ml</option>
                    <option value="24  ×  Bottle 355 ml">24  ×  Bottle 355 ml</option>
                    <option value="24  ×  Bottle 500 ml">24  ×  Bottle 500 ml</option>
                </select>
            </div>

    <button class="btn btn-primary btn-block" id="beerstoreBeerIDLookup" type="button">Lookup</button>


        </br>
        <labelfor="" id="beerIDLookupResultsLabel" style="display:none">Results:</label>
        <!-- <p id="cityLookupResults"></p> -->
        <table id="beerIDLookupResults" class="table table-bordered" style="display:none; font-size: 12px;">
        <thead>
        <tr>
            <th>Beer Name</th>
            <th>Brewer</th>
            <th>Size</th>
            <th>Beer ID</th>
            <th>Options</th>
        </tr>
        </thead>
        </table>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>

  <script type="text/javascript">
    $("#beerstoreBeerIDLookup").click(function() {
        if($("#lookupBeerName").val().length > 1)
        {
            (function() {
                // var beerSizesStored = [];
                // var beerSizesStoredCounter;
              var beerStoreJSON = "allBeersAPI.json";
              $.getJSON( beerStoreJSON, {})
              .done(function( data ) {
                $("#beerIDLookupResults").css('display', 'block');
                $("#beerIDLookupResultsLabel").css('display', 'block');
                $.each(data, function (key, data) {
                    if((data.name = $("#lookupBeerName").val()) && (data.brewer = $("#lookupBeerNameBrewer").val()) && (data.size = $("#lookupBeerNamesize").val()))
                    {
                        $("#beerIDLookupResults").append("<tr><td>" + data.name + "</td><td>" + data.brewer + "</td><td>" + data.size + "</td><td>" + data.beer_id + "</td><td style=\"width:90px\"><button onclick=\"autoLoadBeerID(" + data.beer_id + ")\" class=\"btn btn-xs btn-primary\" data-dismiss=\"modal\" >Select Beer</button></td></tr>");
                    }
                })
            });
          })();
      }
  })


    function autoLoadBeerID (beerIDPass) {
        $("#beerstoreBeerId").val(beerIDPass); 
    }
</script>
</div>
<!-- general form elements disabled -->
<div class="box box-primary">
    <div class="box-header">
        <h3 class="box-title">Add A New Store</h3>
    </div><!-- /.box-header -->
    <div class="box-body">
        <form role="form" method="post" action="?requestedAction=add">
            <!-- text input -->
            <div class="form-group">
                <labelfor="locationName">Store Name</label>
                <input type="text" class="form-control" id="locationName" name="locationName" placeholder="Enter Name"/>
            </div>

             <div class="form-group">
                <labelfor="locationAddress">Full Address</label>
                <input type="text" class="form-control" id="locationAddress" name="locationAddress" placeholder="123 Anywhere St, Toronto, ON A1B 2C3"/>
            </div>
            
            <div class="form-group">
                <labelfor="beerstoreStoreId">Beer Store Issued Store ID</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="beerstoreStoreId" name="beerstoreStoreId" placeholder="Is this location one of Ontario's Beer Stores? If so, please enter it's official Store ID.">
                    <span style="cursor: pointer" data-toggle="modal" data-target="#beerStoreIDLookupModal" class="input-group-addon">Lookup Store ID&nbsp;&nbsp;<i class="fa fa-external-link-square"></i></span>
                </div>
                
             </div>
       
            <div class="box-footer" style="padding-left:0px">
            <button type="submit" class="btn btn-primary">Save Store</button>
            </div>

        </form>
    </div><!-- /.box-body -->
</div><!-- /.box -->

<!-- Modal -->
<div class="modal fade" id="beerStoreIDLookupModal" tabindex="-1" role="dialog" aria-labelledby="beerStoreModalTitle" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="beerStoreModalTitle">Beer Store ID Lookup</h4>
      </div>
      <div class="modal-body">
      <labelfor="lookupCityName">What city is the store located in?</label>
        <div class="input-group input-group-sm">
        <input type="text" id="lookupCityName" name="lookupCityName"  class="form-control" placeholder="Enter City Name">
        <span class="input-group-btn">
          <button class="btn btn-primary btn-flat" id="beerStoreIDLookupButton" type="button">Lookup</button>
        </span>
        </div>
        </br>
        <labelfor="" id="cityLookupResultsLabel" style="display:none">Results:</label>
        <!-- <p id="cityLookupResults"></p> -->
        <table id="cityLookupResults" class="table table-bordered" style="display:none;   font-size: 12px;">
        <thead>
        <tr>
            <th>Store Name</th>
            <th>Store ID</th>
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

<!-- Function that loook up beerstore beer ID -->
  <script type="text/javascript">
    $("#beerStoreIDLookupButton").click(function() {
        if($("#lookupCityName").val().length > 5)
        {
            (function() {
              var beerStoreJSON = "allStoresAPI.json";
              $.getJSON( beerStoreJSON, {})
              .done(function( data ) {
                $("#cityLookupResults").css('display', 'block');
                $("#cityLookupResultsLabel").css('display', 'block');
                $.each(data, function (key, data) {
                    if(data.city == $("#lookupCityName").val())
                    {
                        $("#cityLookupResults").append("<tr><td>" + data.name + "</td><td>" + data.store_id + "</td><td style=\"width:90px\"><button onclick=\"autoLoadStoreID(" + data.store_id + ")\" class=\"btn btn-xs btn-primary\" data-dismiss=\"modal\" >Select Store</button></td></tr>");
                    }
                })
            });
          })();
      }
  })

// Implement load beerstore ID
    function autoLoadStoreID (storeIDPass) {
        $("#beerstoreStoreId").val(storeIDPass); 
    }
</script>
</div>
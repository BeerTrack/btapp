<div class="box box-primary">
    <div class="box-header">
        <h3 class="box-title">Forecast Beer Sales</h3>
    </div><!-- /.box-header -->
    <div class="box-body">
        <form role="form" method="post" action="?requestedAction=forecast&viewName=results">

            <div class="form-group col-xs-12 col-no-padding-left col-no-padding-right">
                <label>Beer Name</label>
                <select id="selected_beerstore_beer_id" name="selected_beerstore_beer_id" class="form-control">
                    <option value="">Select Beer...</option>
                    <?php
                    //getting names of the beers associated with this brewery
                    $displayTransactionQuery = beerTrackDBQuery("SELECT * FROM beer_brands WHERE brewery_id = '$loggedInBreweryID' AND beerstore_beer_id IN (SELECT DISTINCT beerstore_beer_id FROM inventory_parsing WHERE brewery_id = '$loggedInBreweryID')");

                    while($row = mysqli_fetch_array($displayTransactionQuery)) 
                    {
                        echo "<option value=\"" . $row['beerstore_beer_id']  . "\">" . $row['beer_name'] . "</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group col-xs-6 col-no-padding-left">
                <label>What past data should your forecast be based on?</label>
                <div class="form-group">
                    <input type="text" class="form-control" id="timespan_forecast_data_source_dates" name="timespan_forecast_data_source_dates">
                </div>
            </div>

             <div class="form-group col-xs-6 col-no-padding-right">
                <label>What period do you want to forecast for?</label>
                <div class="form-group">
                    <input type="text" class="form-control" id="timespan_forecast_for" name="timespan_forecast_for">
                </div>
            </div>

            <div class="box-footer" style="padding-left:0px; padding-right: 0px">
                <button type="submit" class="btn btn-primary btn-block">Run Forecast</button>
            </div>
        </form>
    </div><!-- /.box-body -->
</div><!-- /.box -->

<script type="text/javascript">
    //Date range picker for putting the datepicker in the field to select the dates you want to use the data from
    $('#timespan_forecast_data_source_dates').daterangepicker(
        {
            minDate: '03/22/2015', //hard coding for sake of our data in the database (this way Christian's forecasting function won't error if there's no data for it to use, it should never get "no data...".) 
            maxDate: moment(),
            startDate: '03/22/2015',
            endDate: moment()
        }
    );
    // Date range picker for putting the datepicker in the field to select the dates you want to forecast for
    $('#timespan_forecast_for').daterangepicker(
        {
            ranges: {
                'Today': [moment(), moment()],
                'Tommorow': [moment().add('days', 1), moment().add('days', 1)],
                'Next 7 Days': [moment(), moment().add('days', 6)],
                'Next 30 Days': [moment(), moment().add('days', 29)],
                'Next Month': [moment().add('month', 1).startOf('month'), moment().add('month', 1).endOf('month')]
            }
        }
    );
</script>

<script type="text/javascript">
    //Date range picker
    // $('#timespanForInventoryLookup').daterangepicker(); TURNING THIS OFF BECUASE WE DON'T NEED A TIMESPAN HERE, JUST A SINGLE DATE.

    //auto selecting values, if the page has been posted previously...
    var requestedAction = getQueryVariable("requestedAction");
    // http://stackoverflow.com/a/827378
    function getQueryVariable(variable) {
        var query = window.location.search.substring(1);
        var vars = query.split("&");
        for (var i=0;i<vars.length;i++) {
            var pair = vars[i].split("=");
            if (pair[0] == variable) {
                return pair[1];
            }
        } 
        return '';
    }

    if(requestedAction ==="forecast")
    {
        var timespan_forecast_data_source_dates = '<?php echo mysqli_real_escape_string(returnConnection(), $_POST['timespan_forecast_data_source_dates']); ?>';
        var timespan_forecast_for = '<?php echo mysqli_real_escape_string(returnConnection(), $_POST['timespan_forecast_for']); ?>';
        var selected_beerstore_beer_id = '<?php echo mysqli_real_escape_string(returnConnection(), $_POST['selected_beerstore_beer_id']); ?>';

        $('select[name^="selected_beerstore_beer_id"] option[value="' + selected_beerstore_beer_id + '"]').attr("selected","selected");
        $('#timespan_forecast_data_source_dates').val(timespan_forecast_data_source_dates);
        $('#timespan_forecast_for').val(timespan_forecast_for);
    }


</script>
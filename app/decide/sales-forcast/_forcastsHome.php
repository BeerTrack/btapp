<?php
//Get start, current, and end dates

?>



<form role="form" method="post" action="?requestedAction=forecast">
	<h3 class="box-title">How early do you want to consider in your forecast, and when do you want to forecast for?</h3>
	<div class="input-group">
		<div class="input-group-addon">
			<i class="fa fa-calendar"></i>
		</div>
		<input type="text" class="form-control pull-right" id="reservation" name="reservation">
	</div>
	<h3 class="box-title">What store do you want to forecast for?</h3>
	<div class="form-group">
		<labelfor="store">Select Store</label>
		<select class="form-control" id="store" name="store">
			<option>Main Store Address</option>
			<option>Beer Store 1 Address</option>
			<option>2322</option>
			<option>Beer Store 3 Address</option>
			<option>Beer Store 4 Address</option>
			<option>Beer Store 5 Address</option>
		</select>
	</div>
	<h3 class="box-title">What beer package do you want to forecast for?</h3>
	<div class="form-group">
		<labelfor="beerType">Select Beer Type</label>
		<select class="form-control" id="beerType" name="beerType">
			<option>Beer 1 Name</option>
			<option>3211</option>
			<option>Beer 3 Name</option>
			<option>Beer 4 Name</option>
			<option>...</option>
			<option>Beer 5 Name</option>
		</select>
	</div>
	<div class="form-group">
	<labelfor="container">Select Container</label>
		<select class="form-control" id="container" name="container">
			<option>Bottle</option>
			<option>Can</option>
		</select>
	</div>
	<div class="form-group">
		<labelfor="volume">Select Volume</label>
		<select class="form-control" id="volume" name="volume">
			<option>Volume 1</option>
			<option>Volume 2</option>
			<option>Volume 3</option>
			<option>341</option>
			<option>...</option>
			<option>Volume 5</option>
		</select>
	</div>
	<div class="form-group">
        <labelfor="quantity">Select Package Quantity</label>
        <select class="form-control" id="quantity" name="quantity">
            <option>1</option>
            <option>6</option>
            <option>12</option>
            <option>24</option>
        </select>
    </div>
    <div class="box-footer">
        </br>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>

<div class="col-md-8">

    <!-- Line chart -->
    <div class="box box-primary">
        <div class="box-header">
            <i class="fa fa-bar-chart-o"></i>
            <h3 class="box-title">History and Forecast Chart</h3>
        </div>
        <div class="box-body">
              <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <section class="col-lg-12 connectedSortable">
                    <!-- Custom tabs (Charts with tabs)-->
                    <div class="nav-tabs-custom">
                        <div class="tab-content no-padding">
                            <!-- Morris chart - Sales -->
                            <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;"></div>
                            <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;"></div>
                        </div>
                    </div><!-- /.nav-tabs-custom -->
                </section>
                <!-- </div> -->
        </div><!-- /.box-body-->
    </div><!-- /.box -->
</div>

<!-- jQuery 2.1.3 -->
    <!-- Page script -->
    <script type="text/javascript">
     //Date range picker
        $('#reservation').daterangepicker();
    </script>
<?php
echo $beer_name;
?>




<div class="row">
	<div class="col-xs-12">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">Shopping Cart</h3>
			</div>
			<div class="box-body">
				<table id="allStoresTable" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>Beer Name</th>
							<th>Package Type</th>
							<th>Quantity per Package</th>
							<th>Price</th>
						</tr>
					</thead>
					<tbody>
					<?php
					$item = queryDatabaseForItem("SELECT * FROM beer_brands WHERE beer_name = '$beer_name' AND beer_type = '$package_type' AND beer_quantity = '$package_quantity");
					
					while($row = mysqli_fetch_array($item)) {
						echo "<tr>";
						echo "<td>" . $row['beer_name'] . "</td>";
						echo "<td>" . $row['beer_type'] . " ml</td>";
						echo "<td>" . $row['beer_quantity'] . "</td>";
						echo "<td>" . $row['beer_price'] . "</td>";
						echo "</tr>";
					}
					?>
					</tbody>

				</table>
			</div>
		</div>
	</div>
</div>

<div class="row">
            <!-- accepted payments column -->
	<div class="col-xs-6">
	  <p class="lead">Payment Methods:</p>
	  <img src="../../dist/img/credit/visa.png" alt="Visa">
	  <img src="../../dist/img/credit/mastercard.png" alt="Mastercard">
	  <img src="../../dist/img/credit/american-express.png" alt="American Express">
	  <img src="../../dist/img/credit/paypal2.png" alt="Paypal">
	  <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
	    Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem plugg dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
	  </p>
	</div><!-- /.col -->
	<div class="col-xs-6">
	  <p class="lead">Amount Due 2/22/2014</p>
	  <div class="table-responsive">
	    <table class="table">
	      <tbody><tr>
	        <th style="width:50%">Subtotal:</th>
	        <td>$250.30</td>
	      </tr>
	      <tr>
	        <th>Tax (9.3%)</th>
	        <td>$10.34</td>
	      </tr>
	      <tr>
	        <th>Shipping:</th>
	        <td>$5.80</td>
	      </tr>
	      <tr>
	        <th>Total:</th>
	        <td>$265.24</td>
	      </tr>
	    </tbody></table>
	  </div>
	</div><!-- /.col -->
</div>







<?php $this->block('title', 'Welcome!') ?>

<?php $this->block('styles') ?>
<?php $this->endblock() ?>

<?php $this->block('content') ?>
	<div class="container">
		<h1>Payment information</h1>
		<h3>Please provide your payment information: </h3>
			<form class="form-horizontal" action="/checkouts/step2" method="POST">
				<p>Chose your card option: </p>
			    <div class="radio">
	  				<label><input type="radio" name="cardOption">Visa</label>
	  			</div>
	  			<div class="radio">
	  				<label><input type="radio" name="cardOption">Mastercard</label>
	  			</div>
	  			<br />
	  			<br />
				<div class="form-group">
				    <label class="control-label col-sm-2">Street adress:</label>
					<div class="col-sm-5">
				    	<input type="text" class="form-control" name="streetAddress" required="true">
				    </div>
				</div>
				<div class="form-group">
				   <label class="control-label col-sm-2">City:</label>
					<div class="col-sm-5">
				    	<input type="text" class="form-control" name="city" required="true">
				    </div>
				</div>
				<div class="form-group">
				   <label class="control-label col-sm-2">State:</label>
					<div class="col-sm-5">
				    	<input type="text" class="form-control" name="state" required="true">
				    </div>
				</div>
				<div class="form-group">
				   <label class="control-label col-sm-2">Country:</label>
					<div class="col-sm-5">
				    	<input type="text" class="form-control" name="country" required="true">
				    </div>
				</div>
				<div class="form-group">
				   <label class="control-label col-sm-2">ZIP code:</label>
					<div class="col-sm-5">
				    	<input type="text" class="form-control" name="zip" required="true">
				    </div>
				</div>
				<input type="submit" class="btn btn-success" name="newMailingAddress" value="Proceed with a new address" />
			</form>
		<br/><br/>
	</div>

<?php $this->endblock() ?>

<?= $this->block('info') ?>

<?php $this->block('scripts') ?>
<?php $this->endblock() ?>

<?php echo $this->display('layouts/app.php', []); ?>
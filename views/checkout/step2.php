<?php $this->block('title', 'Welcome!') ?>

<?php $this->block('styles') ?>
<?php $this->endblock() ?>

<?php $this->block('content') ?>
	<div class="container">
		<h1>Billing and payment method</h1>
		<h3>Choose a new billing address and payment method: </h3>
		<h4>Billing information</h4>
			<form class="form-horizontal" action="/checkouts/step3" method="POST">
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

				<h4>Provide your card information</h4>
				<p style="font-weight: bold">Card type: </p>
				<div style="margin: 0px 0px 20px 50px">
				   <div class="radio">
  					<label><input type="radio" name="cardOption" required="true">Visa</label>
  				</div>
  				<div class="radio">
  					<label><input type="radio" name="cardOption" required="true">Mastercard</label>
  				</div>
				</div>

				<div class="form-group">
				   <label class="control-label col-sm-2">Cardholder's name:</label>
					<div class="col-sm-5">
				    	<input type="text" class="form-control" name="cardholderName" required="true">
				    </div>
				</div>
  				<div class="form-group">
				   <label class="control-label col-sm-2">Card number:</label>
					<div class="col-sm-5">
				    	<input type="text" class="form-control" name="cardNumber" required="true">
				    </div>
				</div>
				<div class="form-group">
				   <label class="control-label col-sm-2">Expiration date:</label>
					<div class="col-sm-5">
				    	<input type="text" class="form-control" name="expirationDate" required="true">
				    </div>
				</div>
			    
				<input type="submit" class="btn btn-success" name="newBillingAddress" value="Proceed with a new address" />
			</form>
		<br/><br/>
		<h3>Or choose a payment method and address you used before: </h3>
		<form>
	  		<?php for($i = 0; $i < 5; $i++){ ?>
	  			<div class="radio">
			  	<label><input type="radio" name="addressOption">Option <?= $i ?></label>
			  	</div>
	  		<?php }?>
	  		<input type="submit" class="btn btn-success" name="existingBillingAddress" value="Proceed with an existing address" />
  		</form>
	</div>

<?php $this->endblock() ?>

<?= $this->block('info') ?>

<?php $this->block('scripts') ?>
<?php $this->endblock() ?>

<?php echo $this->display('layouts/app.php', get_defined_vars()); ?>
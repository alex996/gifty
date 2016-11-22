<?php $this->block('title', 'Billing Info - Checkout') ?>

<?php $this->block('styles') ?>
<style>
	.help-block {margin-bottom:0;}
</style>
<?php $this->endblock() ?>

<?php $this->block('content') ?>
	<div class="container">
		<div class="page-header text-center">
			<h2><i class="fa fa-map-marker" aria-hidden="true"></i> Billing Information</h2>
		</div>
		<div class="row">
			<div class="col-md-12">
				
				<?php include_once(VIEWS_PATH . 'components/errors.php') ?>
				<?php include_once(VIEWS_PATH . 'components/error.php') ?>
				
				<?php if (!empty($payment_methods)): ?>
					<ul class="nav nav-tabs nav-justified">
						<li class="active"><a data-toggle="tab" href="#new-address">Provide a new Payment Method</a></li>
						<li><a data-toggle="tab" href="#existing-address">Select an Existing Payment Method</a></li>
					</ul>
				<?php endif; ?>

				<div class="tab-content">
					<div id="new-address" class="tab-pane fade in active"><br>
						<div class="panel panel-default">
							<div class="panel-heading text-center">
								<h4>New Payment Method</h4>
							</div>
							<div class="panel-body">
								<div class="col-md-12">
									<form class="form-horizontal" action="/checkout/payment" method="POST">
										<div class="col-md-6">
											<h4 class="text-center">Card Details</h4>
											<hr>
											<div class="form-group">
											    <label class="control-label col-sm-3">Cardholder:</label>
												<div class="col-sm-9">
											    	<input class="form-control" name="cardholder" placeholder="JOHN SMITH" required>
											    	<small class="help-block"><i>Please enter your name exactly as it appears on your card.</i></small>
											    </div>
											</div>
											<div class="form-group">
											    <label class="control-label col-sm-3">Card Number:</label>
												<div class="col-sm-9">
											    	<input class="form-control" name="card_number" placeholder="4556-7369-5100-9389" required>
											    </div>
											</div>
											<div class="form-group">
											    <label class="control-label col-sm-3">Card Type:</label>
												<div class="col-sm-9">
											    	<select class="form-control" name="type" required>
											    		<option selected disabled hidden>Select...</option>
											    		<option value="VISA">Visa</option>  
											    		<option value="MASTERCARD">Master Card</option>  
											    		<option value="INTERAC">INTERAC</option>  
											    	</select>
											    </div>
											</div>
											<div class="form-group">
											    <label class="control-label col-sm-3">CVV:</label>
												<div class="col-sm-9">
											    	<input class="form-control" name="cvv" placeholder="123" required>
											    </div>
											</div>
											<div class="form-group">
											    <label class="control-label col-sm-3">Expiry Date:</label>
												<div class="col-sm-4">
											    	<select class="form-control" name="expiry_month" required>
											    		<option selected disabled hidden>Month</option>
											    		<?php for($i = 1; $i <= 12; $i++): ?>
											    			<option value="<?= $i ?>"><?= strlen($i) == 1 ? "0$i" : $i ?></option>
											    		<?php endfor; ?>
											    	</select>
											    </div>
											    <div class="col-sm-4">
											    	<select class="form-control" name="expiry_year" required>
											    		<option selected disabled hidden>Year</option>
											    		<?php $year = date("Y") ?>
											    		<?php for($i = 1; $i <= 5; $i++): ?>
											    			<option value="<?= $year ?>"><?= $year++ ?></option>
											    		<?php endfor; ?>
											    	</select>
											    </div>
											</div>
										</div>

										<div class="col-md-6">
											<h4 class="text-center">Billing Address</h4>
											<hr>
											<div class="form-group">
											    <label class="control-label col-sm-3">Street:</label>
												<div class="col-sm-9">
											    	<input class="form-control" name="street" placeholder="1234 Main Street" required>
											    </div>
											</div>
											<div class="form-group">
											   <label class="control-label col-sm-3">City:</label>
												<div class="col-sm-9">
											    	<input class="form-control" name="city" placeholder="New York City" required>
											    </div>
											</div>
											<div class="form-group">
											   <label class="control-label col-sm-3">State:</label>
												<div class="col-sm-9">
											    	<input class="form-control" name="state" placeholder="New York" required>
											    </div>
											</div>
											<div class="form-group">
											    <label class="control-label col-sm-3">Country:</label>
												<div class="col-sm-9">
											    	<select class="form-control" name="country" required>
											    		<option selected disabled hidden>Select...</option>
											    		<option value="US">United States</option>  
											    		<option value="CA">Canada</option>  
											    	</select>
											    </div>
											</div>
											<div class="form-group">
											   <label class="control-label col-sm-3">Zip Code:</label>
												<div class="col-sm-9">
											    	<input class="form-control" name="zip" placeholder="12345" required>
											    </div>
											</div>
										</div>
										
										<div class="col-md-4 col-md-offset-4">
											<br><button type="submit" class="btn btn-cta btn-block btn-success">Next</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
					<?php if (!empty($payment_methods)): ?>
						<div id="existing-address" class="tab-pane fade"><br>
							<div class="panel panel-default">
								<div class="panel-heading text-center">
									<h4>Previous Shipping Addresses</h4>
								</div>
								<div class="panel-body">
									<div class="col-md-6 col-md-offset-3 text-center">
										<form class="form-horizontal" action="/checkout/shipping" method="POST">										
											<?php foreach($payment_methods as $method): ?>
												<?php $addr = $method->address; ?>
												<div class="radio">
											  		<label>
											  			<input type="hidden" name="payment_method_id" value="<?= $method->id ?>">
											  			<input class="radio-address" type="radio" name="address_id" value="<?= $addr->id ?>" required>
											  			<?= "{$method->type}, ****-****-****-{$method->last_digits}, {$method->cardholder}<br>" ?>
											  			<?= "{$addr->street}, {$addr->city}, {$addr->state}, {$addr->country}, {$addr->zip}" ?>
											  		</label>
											  	</div>							
											<?php endforeach; ?>
											<br>
											<div class="col-md-8 col-md-offset-2">
											<button type="submit" class="btn btn-cta btn-block btn-success">Next</button>
											</div>
										</form>
									</div>
								</div>
							</div>	
						</div>
					<?php endif; ?>

				</div>
			</div>

		</div>
	</div>

<?php $this->endblock() ?>

<?= $this->block('info') ?>

<?php $this->block('scripts') ?>
<?php $this->endblock() ?>

<?php echo $this->display('layouts/app.php', get_defined_vars()); ?>
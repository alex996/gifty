<?php $this->block('title', 'Shipping Address - Checkout') ?>

<?php $this->block('styles') ?>
<?php $this->endblock() ?>

<?php $this->block('content') ?>
	<div class="container">
		<div class="page-header text-center">
			<h2><i class="fa fa-map-marker" aria-hidden="true"></i> Shipping address</h2>
		</div>
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				
				<?php include_once(VIEWS_PATH . 'components/error.php') ?>
				<?php include_once(VIEWS_PATH . 'components/errors.php') ?>
				
				<?php if (!empty($addresses)): ?>
					<ul class="nav nav-tabs nav-justified">
						<li class="active"><a data-toggle="tab" href="#new-address">Enter a new Address</a></li>
						<li><a data-toggle="tab" href="#existing-address">Select an Existing Address</a></li>
					</ul>
				<?php endif; ?>

				<div class="tab-content">
					<div id="new-address" class="tab-pane fade in active"><br>
						<div class="panel panel-default">
							<div class="panel-heading text-center">
								<h4>New Shipping Address</h4>
							</div>
							<div class="panel-body">
								<div class="col-md-12">
									<form class="form-horizontal" action="/checkout/shipping" method="POST">
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
										    	<input class="form-control" name="zip" placeholder="12345" minlength="5" maxlength="10" required>
										    </div>
										</div>
										
										<button type="submit" class="btn btn-cta btn-block btn-success">Next</button>
									</form>
								</div>
							</div>
						</div>
					</div>
					<?php if (!empty($addresses)): ?>
						<div id="existing-address" class="tab-pane fade"><br>
							<div class="panel panel-default">
								<div class="panel-heading text-center">
									<h4>Previous Shipping Addresses</h4>
								</div>
								<div class="panel-body">
									<div class="col-md-12">
										<form class="form-horizontal" action="/checkout/shipping" method="POST">										
											<?php foreach($addresses as $addr): ?>
												<div class="radio">
											  		<label><input class="radio-address" type="radio" name="address_id" value="<?= $addr->id ?>" required><?= "{$addr->street}, {$addr->city}, {$addr->state}, {$addr->country}, {$addr->zip}" ?></label>
											  	</div>							
											<?php endforeach; ?>
											<br>
											<button type="submit" class="btn btn-cta btn-block btn-success">Next</button>
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
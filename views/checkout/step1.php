<?php $this->block('title', 'Step 1 - Delivery Address') ?>

<?php $this->block('styles') ?>
<?php $this->endblock() ?>

<?php $this->block('content') ?>
	<div class="container">
		<div class="page-header text-center">
			<h2><i class="fa fa-map-marker" aria-hidden="true"></i> Billing address</h2>
		</div>
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading text-center">
					<h4>Enter a new Address</h4>
				</div>
				<div class="panel-body">
					<form class="form-horizontal" action="/checkout/step2" method="POST">
						<div class="form-group">
						    <label class="control-label col-sm-3">Street adress:</label>
							<div class="col-sm-9">
						    	<input type="text" class="form-control" name="street" required>
						    </div>
						</div>
						<div class="form-group">
						   <label class="control-label col-sm-3">City:</label>
							<div class="col-sm-9">
						    	<input type="text" class="form-control" name="city" required>
						    </div>
						</div>
						<div class="form-group">
						   <label class="control-label col-sm-3">State:</label>
							<div class="col-sm-9">
						    	<input type="text" class="form-control" name="state" required>
						    </div>
						</div>
						<div class="form-group">
						   <label class="control-label col-sm-3">Country:</label>
							<div class="col-sm-9">
						    	<input type="text" class="form-control" name="country" required>
						    </div>
						</div>
						<div class="form-group">
						   <label class="control-label col-sm-3">ZIP code:</label>
							<div class="col-sm-9">
						    	<input type="text" class="form-control" name="zip" required>
						    </div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading text-center">
					<h4>Or, choose an existing Address</h4>
				</div>
				<div class="panel-body">
					<?php foreach($orders as $order): ?>
						<?php $addr = $order->address ?>
						<?php if(!empty($addr)): ?>
							<div class="radio">
						  		<label><input type="radio" name="addressOption"><?= "{$addr->street},<br>{$addr->city}, {$addr->state}, {$addr->country}, {$addr->zip}" ?></label>
						  	</div>							
						<?php endif; ?>
					<?php endforeach; ?>
				</div>
			</div>	  		
  		</div>
  		<div class="col-md-4 col-md-offset-4">
			<button type="submit" class="btn btn-lg btn-block btn-success">Next</button>
		</div>
	</div>

<?php $this->endblock() ?>

<?= $this->block('info') ?>

<?php $this->block('scripts') ?>
<?php $this->endblock() ?>

<?php echo $this->display('layouts/app.php', get_defined_vars()); ?>
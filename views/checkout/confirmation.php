<?php $this->block('title', 'Confirmation - Checkout') ?>

<?php $this->block('styles') ?>
<style>
	.total {margin-top:0;}
</style>
<?php $this->endblock() ?>

<?php $this->block('content') ?>
	<div class="container">
		<div class="page-header text-center">
			<h2><i class="fa fa-check-square-o fa-fw" aria-hidden="true"></i> Confirmation</h2>
		</div>
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-6">
					<table class="table table-hover">
						<tbody>
							<tr class="top-no-border">
								<td><b>Customer</b></td>
								<td><?= $customer->first . " " . $customer->last ?></td>
							</tr>
							<tr>
								<td><b>Shipping Address</b></td>
								<td>
									<?= "{$address->street}, {$address->city},<br>{$address->state}, {$address->country}, {$address->zip}" ?><br>
									<a class="label label-default" href="/checkout/shipping">Edit</a>
								</td>
							</tr>
							<tr>
								<td><b>Payment Method</b></td>
								<td>
									<?= "{$payment_method->type}, ****-****-****-{$payment_method->last_digits},<br>{$payment_method->cardholder}" ?><br>
									<a class="label label-default" href="/checkout/payment">Edit</a>
								</td>
							</tr>
							<tr>
								<?php $addr = $payment_method->address ?>
								<td><b>Billing Address</b></td>
								<td>
									<?= "{$addr->street}, {$addr->city},<br>{$addr->state}, {$addr->country}, {$addr->zip}" ?><br>
									<a class="label label-default" href="/checkout/payment">Edit</a>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="col-md-6">
					<table class="table table-hover cart">
					    <thead>
							<tr>
								<th class="text-center">#</th>
								<th class="text-center">Product</th>
								<th class="text-center">Quantity</th>
								<th class="text-center">Unit Price</th>
								<th class="text-center">Total</th>
							</tr>
						</thead>
					    <tbody>
					     	<?php foreach($cart->cart_details as $index => $detail): ?>
								<tr>
									<td class="text-center"><?= $index + 1 ?></td>
									<td>
										<img class="product-image" src="http://placehold.it/50x50" alt="">
										<a href="/products/<?= $detail->product->id ?>"><?= $detail->product->name ?></a>
									</td>
									<td class="text-center"><?= $detail->quantity ?></td>
									<td class="text-center">$<?= $detail->product->price ?></td>
									<td class="text-center">$<?= $detail->quantity * $detail->product->price ?></td>
								</tr>
							<?php endforeach; ?>
					    </tbody>
					</table>
					<hr>
					<h3 class="pull-right total">Total: <b>$<?= $total ?></b></h3>
				</div>
				
			</div>
			<hr>
			<div class="col-md-4 col-md-offset-4">
				<form method="POST" action="/checkout/confirmation">
					<button type="submit" class="btn btn-success btn-block btn-lg">Confirm</button>
				</form>
			</div>
		</div>
	</div>

<?php $this->endblock() ?>

<?= $this->block('info') ?>

<?php $this->block('scripts') ?>
<?php $this->endblock() ?>

<?php echo $this->display('layouts/app.php', get_defined_vars()); ?>
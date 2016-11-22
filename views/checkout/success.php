<?php $this->block('title', 'Success - Checkout') ?>

<?php $this->block('styles') ?>
<style>
	.total {margin-top:0;}
</style>
<?php $this->endblock() ?>

<?php $this->block('content') ?>
	<div class="container">
		<div class="col-md-6 col-md-offset-3">
			<div class="page-header text-center">
				<h2><i class="fa fa-heart fa-fw" aria-hidden="true"></i> Thank You for Shopping with Us!</h2>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading text-center">
					<h4>Order Confirmation &ndash; Invoice</h4>
				</div>
				<div class="panel-body">
					<table class="table table-hover">
						<thead>
							<tr>
								<th></th>
								<th>Invoice Information</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td><b>Customer</b></td>
								<td><?= $customer->first . " " . $customer->last ?></td>
							</tr>
							<tr>
								<td><b>Shipping Address</b></td>
								<td>
									<?php $address = $order->address; ?>
									<?= "{$address->street}, {$address->city},<br>{$address->state}, {$address->country}, {$address->zip}" ?><br>
								</td>
							</tr>
							<tr>
								<td><b>Payment Method</b></td>
								<td>
									<?php $payment_method = $order->payment_method; ?>
									<?= "{$payment_method->type}, ****-****-****-{$payment_method->last_digits},<br>{$payment_method->cardholder}" ?><br>
								</td>
							</tr>
							<tr>
								<?php $addr = $payment_method->address ?>
								<td><b>Billing Address</b></td>
								<td>
									<?= "{$addr->street}, {$addr->city},<br>{$addr->state}, {$addr->country}, {$addr->zip}" ?><br>
								</td>
							</tr>
							<tr>
								<td><b>Total Paid</b></td>
								<td>
									<b>$<?= $order->total ?></b>
								</td>
							</tr>
							<tr>
								<td><b>Order Status</b></td>
								<td>
									<?= $order->status ?>
								</td>
							</tr>
							<tr>
								<td><b>Order Date</b></td>
								<td>
									<?= $order->created_at ?>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="panel-footer">
					<div class="row">
						<div class="col-md-6">
							<a href="/account/orders/<?= $order->id ?>" class="btn btn-cta btn-block btn-default"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> View or Manage Order</a>
						</div>
						<div class="col-md-6">
							<a href="/products" class="btn btn-cta btn-block btn-primary"><i class="fa fa-shopping-bag" aria-hidden="true"></i> Continue Shopping</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php $this->endblock() ?>

<?= $this->block('info') ?>

<?php $this->block('scripts') ?>
<?php $this->endblock() ?>

<?php echo $this->display('layouts/app.php', get_defined_vars()); ?>
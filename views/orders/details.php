<?php $this->block('title', 'Order History') ?>

<?php $this->block('styles') ?>
<style>
	.table tbody>tr>td { vertical-align: middle; }
	.product-image {float:left; margin-right:10px;}
	.product-desc {width: 350px;}
	.product-qty {width: 60px;}
	.total {margin-top:0;}
</style>
<?php $this->endblock() ?>

<?php $this->block('content') ?>
<div class="container">
	<div class="row">
		<div class="page-header text-center">
			<h2><i class="fa fa-question-circle-o fa-fw" aria-hidden="true"></i> Order Details</h2>
		</div>
		<div class="col-md-9">
			<div class="panel panel-default">
				<?php $manageable = $order->status == Order::PENDING; ?>
				<div class="panel-heading text-center"><h4>View <?= $manageable ? "or Manage" : "" ?> Your Order</h4></div>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-hover">
							<thead>
								<tr>
									<th>#</th>
									<th>Product</th>
									<th>Description</th>
									<th>Quantity</th>
									<th>Unit Price</th>
									<th>Total</th>
									<?= $manageable ? "<th></th>" : "" ?>
								</tr>
							</thead>
							<tbody>
								<?php if(!empty($order) && $order->order_details): ?>				
									<?php foreach($order->order_details as $index => $detail): ?>
										<tr>
											<td><?= $index + 1 ?></td>
											<td>
												<img class="product-image" src="http://placehold.it/50x50" alt="">
												<a href="/products/<?= $detail->product->id ?>"><?= $detail->product->name ?></a>
											</td>
											<td class="product-desc"><?= $detail->product->description ?></td>
											<td class="text-center">
												<?php if ($manageable): ?>
													<form method="POST" action="/account/orders/<?= $order->id ?>/order-details/<?= $detail->id ?>">
														<input type="hidden" name="_method" value="PATCH">
														<input class="form-control product-qty" type="number" name="quantity" value="<?= $detail->quantity ?>" min="0" max="99">
													</form>
												<?php else: ?>
													<?= $detail->quantity ?>
												<?php endif; ?>
											</td>
											<td>$<?= $detail->price ?></td>
											<td>$<?= $detail->quantity * $detail->price ?></td>
											<?php if ($manageable): ?>
												<td>
													<form method="POST" action="/account/orders/<?= $order->id ?>/order-details/<?= $detail->id ?>">
														<input type="hidden" name="_method" value="DELETE">
														<button class="btn btn-danger btn-del-prod"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
													</form>
												</td>
											<?php endif; ?>
										</tr>
									<?php endforeach; ?>
								<?php else: ?>
									<tr><td colspan="7" class="text-center"><i>There is nothing here.</i></td></tr>
								<?php endif; ?>
							</tbody>
						</table>
						<hr>
						<div class="col-md-12">
							<h3 class="pull-right total">Total: <b>$<?= $order->total ?></b></h3>
						</div>
					</div>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading text-center">
					<h4>View Order Invoice</h4>
				</div>
				<div class="panel-body">
					<div class="col-md-8 col-md-offset-2">
						<table class="table table-hover">
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
						</table>
					</div>
				</div>
			</div>
		</div>
		<?php include_once(VIEWS_PATH . 'accounts/components/sidebar.php') ?>
	</div>
<div>
<?php $this->endblock() ?>

<?php $this->block('scripts') ?>
<script>
$(function() {
	$('.product-qty').change(function(e) {

		e.preventDefault();
		var input = $(this);
    	var quantity = input.val();

		if (quantity < 1)
    		input.val(1);
    	else if (quantity > 99)
    		input.val(99);
    	else {
    		var res = confirm("Change product quantity?");
			if (res)
			    $(this).closest('form').submit();
			else
				location.reload();
    	}
	});

	$('.btn-del-prod').click(function(e) {
		e.preventDefault();
		var res = confirm("Delete product from this order?");
		if (res) {
		    $(this).closest('form').submit();
		}
	});
});
</script>
<?php $this->endblock() ?>

<?php echo $this->display('layouts/app.php', get_defined_vars()); ?>
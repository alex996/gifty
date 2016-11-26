<?php $this->block('title', 'Account') ?>

<?php $this->block('styles') ?>
<style>
	.product-thumb {margin-right: 10px; width:70px;}
	.table tbody>tr>td { vertical-align: middle; }
</style>
<?php $this->endblock() ?>

<?php $this->block('content') ?>
<div class="container">
	<div class="row">
		<div class="page-header text-center">
			<h2>Welcome Back to Your Account, <?= $user->name ?>!</h2>
		</div>
		<div class="col-md-9">

			<?php include_once(VIEWS_PATH . 'components/info.php') ?>

			<div class="panel panel-default">
				<div class="panel-heading text-center">
					<h4>Recent Orders</h4>
				</div>
				<div class="panel-body">
					<?php if (!empty($order)): ?>
						<table class="table">
							<thead>
								<tr>
									<th>Status</th>
									<th>Date</th>
									<th>Shipping Address</th>
									<th>Order Total</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<?php include_once(VIEWS_PATH . 'orders/components/status.php') ?>
								<tr class="top-no-border">
									<td><span class="label label-<?= $status_label_class ?> status-label"><?= $order->status ?></span></td>
									<td><?= $order->created_at ?></td>
									<?php $addr = $order->address ?>
									<td><?= "{$addr->street},<br>{$addr->city}, {$addr->state}, {$addr->country}, {$addr->zip}" ?></td>
									<td class="text-success"><b>$<?= $order->total ?></b></td>
									<td>
										<a href="/account/orders/<?= $order->id ?>" class="btn btn-primary"><i class="fa fa-question-circle-o" aria-hidden="true"></i> Details</a>
									</td>
								</tr>
							</tbody>
						</table>
						<?php if (!empty($order->order_details)): ?>
							<table class="table table-hover">
							    <thead>
									<tr>
										<th class="text-center">#</th>
										<th class="text-center">Product</th>
										<th class="text-center">Quantity</th>
										<th class="text-center">Unit Price</th>
										<th class="text-center">Discount</th>
										<th class="text-center">Price with Discount</th>
										<th class="text-center">Total</th>
									</tr>
								</thead>
							    <tbody>
							     	<?php foreach($order->order_details as $index => $detail): ?>
										<tr>
											<td class="text-center"><?= $index + 1 ?></td>
											<td>
												<?php $featured = $detail->product->featured_img(); ?>
												<img class="product-thumb" src="<?= !empty($featured) ? $featured->path : "/img/blank.png" ?>" alt="Image">&ensp;
												<a href="/products/<?= $detail->product->id ?>"><?= $detail->product->name ?></a>
											</td>
											<td class="text-center"><?= $detail->quantity ?></td>
											<td class="text-center">$<?= $detail->product->price ?></td>
											<?php $promo = $detail->product->promotion(); ?>
											<?php if (!empty($promo)): ?>
												<td class="text-center text-success"><b><?= $promo->discount * 100 ?>%</b></td>
												<td class="text-center">$<?= round($detail->product->price - ($detail->product->price * $promo->discount), 2) ?></td>
												<td class="text-center">$<?= round($detail->quantity * ($detail->product->price - ($detail->product->price * $promo->discount)), 2) ?></td>
											<?php else: ?>
												<td class="text-center">0%</td>
												<td class="text-center">$<?= round($detail->product->price, 2) ?></td>
												<td class="text-center">$<?= round($detail->quantity * $detail->product->price, 2) ?></td>
											<?php endif; ?>
										</tr>
									<?php endforeach; ?>
							    </tbody>
							</table>
						<?php endif; ?>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<?php include_once(VIEWS_PATH . 'accounts/components/sidebar.php') ?>
	</div>
<div>
<?php $this->endblock() ?>

<?php $this->block('scripts') ?>
<?php $this->endblock() ?>

<?php echo $this->display('layouts/app.php', get_defined_vars()); ?>
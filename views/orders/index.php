<?php $this->block('title', 'Order History') ?>

<?php $this->block('styles') ?>
<?php $this->endblock() ?>

<?php $this->block('content') ?>
<div class="container">
	<div class="row">
		<div class="page-header text-center">
			<h2><i class="fa fa-history fa-fw" aria-hidden="true"></i> Order History</h2>
		</div>
		<div class="col-md-9">
			<div class="panel panel-default">
				<div class="panel-heading text-center"><h4>View Order History</h4></div>
				<div class="panel-body">
					<table class="table table-hover">
						<thead>
							<tr>
								<th>#</th>
								<th>Status</th>
								<th>Date</th>
								<th>Address</th>
								<th>Total</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php if(!empty($orders)): ?>				
								<?php foreach($orders as $index => $order): ?>
									<?php include(VIEWS_PATH . 'orders/components/status.php') ?>
									<tr>
										<td><?= $index + 1 ?></td>
										<td><span class="label label-<?= $status_label_class ?> status-label"><?= $order->status ?></span></td>
										<td><?= $order->created_at ?></td>
										<?php $addr = $order->address ?>
										<td><?= "{$addr->street},<br>{$addr->city}, {$addr->state}, {$addr->country}, {$addr->zip}" ?></td>
										<td>$<?= number_format($order->total, 2) ?></td>
										<td>
											<a href="/account/orders/<?= $order->id ?>" class="btn btn-primary"><i class="fa fa-question-circle-o" aria-hidden="true"></i> Details</a>
										</td>
									</tr>
								<?php endforeach; ?>
							<?php else: ?>
								<tr><td colspan="6" class="text-center"><i>There is nothing here.</i></td></tr>
							<?php endif; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<?php include_once(VIEWS_PATH . 'accounts/components/sidebar.php') ?>
	</div>
<div>
<?php $this->endblock() ?>

<?php $this->block('scripts') ?>
<script>

</script>
<?php $this->endblock() ?>

<?php echo $this->display('layouts/app.php', get_defined_vars()); ?>
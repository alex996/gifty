<?php $this->block('title', 'Account') ?>

<?php $this->block('styles') ?>
<style>
	
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
							<?php
								$class = "";
								switch($order->status) {
									case Order::PENDING: $class = "default";break;
									case Order::APPROVED: $class = "primary";break;
									case Order::DELIVERED: $class = "success";break;
									case Order::CANCELLED: $class = "warning";break;
									case Order::ERROR: $class = "danger";break;
								}
							?>
							<tr class="top-no-border">
								<td><span class="label label-<?= $class ?>"><?= $order->status ?></span></td>
								<td><?= $order->created_at ?></td>
								<?php $addr = $order->address ?>
								<td><?= "{$addr->street},<br>{$addr->city}, {$addr->state}, {$addr->country}, {$addr->zip}" ?></td>
								<td>$<?= $order->total ?></td>
								<td>
									<a href="/account/orders/<?= $addr->id ?>" class="btn btn-primary"><i class="fa fa-question-circle-o" aria-hidden="true"></i> Details</a>
								</td>
							</tr>
						</table>
					<?php endif; ?>
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
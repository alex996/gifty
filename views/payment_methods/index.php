<?php $this->block('title', 'Payment Methods') ?>

<?php $this->block('styles') ?>
<style>
	
</style>
<?php $this->endblock() ?>

<?php $this->block('content') ?>
<div class="container">
	<div class="row">
		<div class="page-header text-center">
			<h2><i class="fa fa-credit-card fa-fw" aria-hidden="true"></i> Payment Methods</h2>
		</div>
		<div class="col-md-9">
			<div class="panel panel-default">
				<div class="panel-heading text-center"><h4>View Payment Methods</h4></div>
				<div class="panel-body">
					<table class="table table-hover">
						<thead>
							<tr>
								<th>Card Type</th>
								<th>Cardholder</th>
								<th>Last 4 Digits</th>
								<th>Address</th>
								<th></th>
							</tr>
						</thead>
						<tbody>							
							<?php foreach($customer->payment_methods as $method): ?>
								<tr>
									<td><?= $method->type ?></td>
									<td><?= $method->cardholder ?></td>
									<td><?= $method->last_digits ?></td>
									<?php $addr = $method->address ?>
									<td><?= "{$addr->street},<br>{$addr->city}, {$addr->state}, {$addr->country}, {$addr->zip}" ?></td>
									<td><a href="/account/orders/<?= $addr->id ?>/edit" class="btn btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a></td>
								</tr>
							<?php endforeach; ?>
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

<?php echo $this->display('layouts/app.php', []); ?>
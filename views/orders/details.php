<?php $this->block('title', 'Order History') ?>

<?php $this->block('styles') ?>
<style>
	.table tbody>tr>td { vertical-align: middle; }
	.product-image {float:left; margin-right:10px;}
	.product-desc {width: 350px;}
	.product-qty {width: 60px;}
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
				<div class="panel-heading text-center"><h4>View Order Details</h4></div>
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
									<th></th>
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
											<td>
												<input class="form-control product-qty" type="number" name="quantity" value="<?= $detail->quantity ?>" min="0" max="99">
											</td>
											<td>$<?= $detail->price ?></td>
											<td>$<?= $detail->quantity * $detail->price ?></td>
											<td>
												<form method="POST">
													<input type="hidden" name="_method" value="DELETE">
													<button class="btn btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
												</form>
											</td>
										</tr>
									<?php endforeach; ?>
								<?php else: ?>
									<tr><td colspan="7" class="text-center"><i>There is nothing here.</i></td></tr>
								<?php endif; ?>
							</tbody>
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

</script>
<?php $this->endblock() ?>

<?php echo $this->display('layouts/app.php', get_defined_vars()); ?>
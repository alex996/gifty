<?php $this->block('title', 'Inventory') ?>

<?php $this->block('styles') ?>
<style>
	.btn-add {width: 100px}
	.panel-heading h4 {margin-top:0;}
	.panel-heading p {padding-top:15px;}
	.table tbody>tr>td { vertical-align: middle; }
	.product-image {margin-right: 10px}
</style>
<?php $this->endblock() ?>

<?php $this->block('content') ?>
<div class="container">
	<div class="row">

		<div class="page-header text-center">
			<h2><i class="fa fa-database fa-fw" aria-hidden="true"></i> Inventory</h2>
		</div>

		<div class="col-md-9">
			
			<div class="panel panel-default">
				<div class="panel-heading text-center">
					<h4>
						<div class="pull-left">
							<a href="/admin/inventory/create" class="btn btn-cta btn-success btn-block btn-add"><i class="fa fa-plus-square fa-fw" aria-hidden="true"></i> Add</a>
						</div>
						<p>Manage Products in the Inventory</p>
					</h4>
				</div>
				<div class="panel-body">
					<?php if(!empty($products)) : ?>
						<table class="table">
						    <thead>
								<tr>
									<th>ID</th>
									<th>Name</th>
									<th>Status</th>
									<th>Category</th>
									<th>Quantity</th>
									<th>Price</th>
									<th>Promotion</th>
									<th></th>
									<th></th>
								</tr>
							</thead>
						    <tbody>
						     	<?php foreach($products as $product): ?>
									<tr>
										<td><?= $product->id ?></td>
										<td>
											<img class="product-image pull-left" src="
												<?php
													if (isset($images[$product->id])){
														echo IMG_PATH.$images[$product->id]->path;
													}
													else
														echo "http://placehold.it/50x50";
												?>" alt="">
											<span><a href="/admin/inventory/<?= $product->id ?>"><?= $product->name ?></a></span>
										</td>
										<?php
											$class = "";
											switch($product->status) {
												case Product::IN_STOCK: $class = "success";break;
												case Product::OUT_OF_STOCK: $class = "warning";break;
												case Product::END_OF_LIFE: $class = "danger";break;
											}
										?>
										<td><span class="label label-<?= $class ?> status-label"><?=  str_replace('_', ' ', $product->status) ?></span></td>
										<td class="text-center"><?= $product->category->name ?></td>
										<td class="text-center"><?= $product->quantity ?></td>
										<td>$<?= $product->price ?></td>
										<td class="text-center">
											<?php if ($product->promotion_id): ?>
												<a href="/admin/promotions/<?= $product->promotion_id ?>/edit"><?= number_format($product->promotion->discount * 100, 2) ?> %</a>
											<?php else: ?>
												&ndash;
											<?php endif; ?>
										</td>
										<td><a href="/admin/inventory/<?= $product->id ?>/edit" class="btn btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
										<td>
											<form method="POST" action="/admin/inventory/<?= $product->id ?>">
												<input type="hidden" name="_method" value="DELETE">
												<button type="button" class="btn btn-danger btn-del-prod"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
											</form>
										</td>
									</tr>
								<?php endforeach; ?>
						    </tbody>
						</table>
						<hr>
					<?php else: ?>
						<div class="empty-cart">
							<h3>Your Inventory is currently empty.</h3>
							<h4>Please add a product to get started.</h4><br>
						</div>
					<?php endif; ?>
				</div>
			</div>
			
		</div>

		<?php include_once(VIEWS_PATH . 'admin/components/sidebar.php') ?>
	</div>
</div>
<?php $this->endblock() ?>

<?php $this->block('scripts') ?>
<script>
$(function() {
	$('.btn-del-prod').click(function(e) {
		e.preventDefault();
		var res = confirm("Delete the product from the inventory?");
		if (res)
		    $(this).closest('form').submit();
	});
});
</script>
<?php $this->endblock() ?>

<?php echo $this->display('layouts/app.php', get_defined_vars()); ?>
<?php $this->block('title', $product->name) ?>

<?php $this->block('styles') ?>
<style>
	.btn-edit {width: 50px}
	.panel-heading h4 {margin-top:0;}
	.panel-heading p {padding-top:15px; margin-left: 100px}
	.product-image {width:250px;}
</style>
<?php $this->endblock() ?>

<?php $this->block('content') ?>
<div class="container">
	<div class="row">

		<div class="page-header text-center">
			<h2><i class="fa fa-database fa-fw" aria-hidden="true"></i> Inventory</h2>
		</div>

		<div class="col-md-9">
			<?php 
				include_once VIEWS_PATH."components/success.php";
				include_once VIEWS_PATH."components/errors.php";
		  	?>

			<div class="panel panel-default">
				<div class="panel-heading text-center">
					<h4>
						<div class="pull-right">
							<a href="/admin/inventory/<?= $product->id ?>/edit" class="btn btn-cta btn-primary btn-edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
						</div>
						<p>View Product &ndash; <i><?= $product->name ?></i></p>
					</h4>
				</div>
				<div class="panel-body">
					<div class="col-md-10 col-md-offset-1">
						<table class="table table-hover">
						    <thead>
						    	<th>Id</th>
						    	<th>Field</th>
						    	<th>Description</th>
						    </thead>
						    <tbody>
						    	<tr>
						    		<td><?= $product->id ?></td>
						    		<td><b>Name</b></td>
						    		<td><?= $product->name ?></td>
						    	</tr>
						    	<tr>
						    		<td></td>
						    		<td><b>Description</b></td>
						    		<td><?= $product->description ?></td>
						    	</tr>
						    	<tr>
						    		<td></td>
						    		<td><b>Featured Image</b></td>
						    		<td>
						    			<img class="product-image" src="<?= !$featured_img ? "http://placehold.it/350x150" : $featured_img->path ?>" />
						    			<br><span><?= !$featured_img ? "" : $featured_img->path ?></span>
						    		</td>
						    	</tr>
						    	<tr>
						    		<td><?= $product->category_id ?></td>
						    		<td><b>Category</b></td>
						    		<td><?= $product->category()->name ?></td>
						    	</tr>
						    	<tr>
						    		<td></td>
						    		<td><b>Price</b></td>
						    		<td>$<?= $product->price ?></td>
						    	</tr>
						    	<tr>
						    		<td><?= $product->promotion_id?></td>
						    		<td><b>Promotion</b></td>
						    		<td>
						    			<?php if ($product->promotion_id): ?>
											<a href="/admin/promotions/<?= $product->promotion_id ?>/edit"><?= number_format($product->promotion->discount * 100, 2) ?> %</a>
										<?php else: ?>
											&ndash;
										<?php endif; ?>
						    		</td>
						    	</tr>
						    	<tr>
						    		<td></td>
						    		<td><b>Quantity</b></td>
						    		<td><?= $product->quantity ?></td>
						    	</tr>
						    	<tr>
						    		<td></td>
						    		<td><b>Status</b></td>
						    		<?php
											$class = "";
											switch($product->status) {
												case Product::IN_STOCK: $class = "success";break;
												case Product::OUT_OF_STOCK: $class = "warning";break;
												case Product::END_OF_LIFE: $class = "danger";break;
											}
										?>
						    		<td><span class="label label-<?= $class ?> status-label"><?=  str_replace('_', ' ', $product->status) ?></span></td>
						    	</tr>
						    	<tr>
						    		<td></td>
						    		<td><b>Featured</b></td>
						    		<td><?php 
											if($product->featured)
												echo 'YES';
											else
												echo 'NO';
											?>
									</td>
						    </tbody>
						</table>
					</div>
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
	$('.btn-del').click(function(e) {
		e.preventDefault();
		var res = confirm("Delete the product from the inventory?");
		if (res)
		    $(this).closest('form').submit();
	});
});
</script>
<?php $this->endblock() ?>

<?php echo $this->display('layouts/app.php', get_defined_vars()); ?>
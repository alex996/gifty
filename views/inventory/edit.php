<?php $this->block('title', 'Add a Product') ?>

<?php $this->block('styles') ?>
<style>
	.btn-del {width: 50px}
	.panel-heading h4 {margin-top:0;}
	.panel-heading p {padding-top:15px; margin-left: 100px}
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
							<form method="POST" action="/admin/inventory/<?= $product->id ?>" style="display: inline">
								<input type="hidden" name="_method" value="DELETE">
								<a class="btn btn-cta btn-danger btn-del"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
							</form>
						</div>
						<p><i class="fa fa-pencil-square-o fa-fw" aria-hidden="true"></i> Edit <i><?= $product->name ?></i></p>
					</h4>
				</div>
				<div class="panel-body">
					<div class="col-md-12">
						<form method="POST" action="/admin/inventory/<?= $product->id ?>">
							<input type="hidden" name="_method" value="PATCH">
							<div class="form-group col-xs-12 col-sm-6 col-md-4">
						    	<label>ID</label>
						     	<input class="form-control" value="<?= $product->id ?>" disabled>
						    </div>
						    <div class="form-group col-xs-12 col-sm-6 col-md-4">
						    	<label for="name">Name</label>
						     	<input class="form-control" id="name" name="name" value="<?= $product->name ?>" placeholder="ex: Hershey's Kisses" required>
						    </div>
						    <div class="form-group col-xs-12 col-sm-6 col-md-4">
						    	<label for="category">Category</label>
						     	<select class="form-control" name="category" id="category" required>
						     		<option selected disabled value hidden>Select...</option>
						     		<?php foreach($categories as $category): ?>
		                            	<option value="<?= $category->id ?>" <?= ($product->category_id == $category->id) ? "selected" : "" ?>><?= $category->name ?></option>
		                            <?php endforeach; ?>
						     	</select>
						    </div>
						    <div class="form-group col-xs-12">
						    	<label for="phone">Description</label>
						     	<textarea class="form-control" id="phone" rows="2" name="description" placeholder="Description of the product and its features."><?= $product->description ?></textarea>
						    </div>
						    <div class="form-group col-xs-12 col-sm-6 col-md-4">
						    	<label for="price">Stock Price</label>
						    	<div class="input-group">
							     	<span class="input-group-addon"><i class="fa fa-usd" aria-hidden="true"></i></span>
						     		<input class="form-control" type="number" min="0" max="999999" step="0.01" placeholder="0.00" name="price" value="<?= $product->price ?>" id="price" required>
						     	</div>
						    </div>
							<div class="form-group col-xs-12 col-sm-12 col-md-8">
								<label for="promotion">Promotion</label>
								<select class="form-control" name="promotion" id="promotion" <?= ($product->status != Product::END_OF_LIFE) ? "" : "disabled" ?>>
						     		<option selected disabled value hidden>Select...</option>
						     		<?php foreach($promotions as $promotion): ?>
		                            	<option value="<?= $promotion->id ?>" <?= ($product->promotion_id == $promotion->id) ? "selected" : "" ?>><?= $promotion->discount * 100 ?>% off from <?= $promotion->starts_at ?> until <?= $promotion->ends_at ?></option>
		                            <?php endforeach; ?>
						     	</select>
							</div>
							<?php if (!empty($product->promotion_id)): ?>
								<div class="form-group col-xs-12 col-sm-6 col-md-4">
							    	<label>Promo Price</label>
							     	<div class="input-group">
							     		<span class="input-group-addon"><i class="fa fa-usd" aria-hidden="true"></i></span>
				                        <input class="form-control" value="<?= round($product->price - ($product->price * $product->promotion->discount),2) ?>" id="quantity" disabled>
				                    </div>
							    </div>
							<?php endif; ?>
							<div class="form-group col-xs-12 col-sm-6 col-md-4">
						    	<label for="quantity">Quantity</label>
						     	<input class="form-control" type="number" min="1" max="99999" placeholder="1" name="quantity" value="<?= $product->price ?>" id="quantity" required>
						    </div>
						    <div class="form-group col-xs-12 col-sm-6 col-md-4">
						    	<label for="status">Status</label>
						     	<select class="form-control" name="status" id="status" required>
						     		<option selected disabled value hidden>Select...</option>
						     		<option value="IN_STOCK" <?= ($product->status == Product::IN_STOCK) ? "selected" : "" ?>>IN STOCK</option>
						     		<option value="OUT_OF_STOCK" <?= ($product->status == Product::OUT_OF_STOCK) ? "selected" : "" ?>>OUT OF STOCK</option>
						     		<option value="END_OF_LIFE" <?= ($product->status == Product::END_OF_LIFE) ? "selected" : "" ?>>END OF LIFE</option>
						     	</select>
						    </div>
						    <div class="form-group col-xs-12 col-sm-6 col-md-4">
						    	<label for="featured">Featured on Home Page</label>
						     	<select class="form-control" name="featured" id="featured" required>
						     		<option selected disabled value hidden>Select...</option>
						     		<option value="1" <?= ($product->featured == 1) ? "selected" : "" ?>>Yes</option>
						     		<option value="0" <?= ($product->featured == 0) ? "selected" : "" ?>>No</option>
						     	</select>
						    </div>

						    <div class="clearfix"></div>
						    <hr>
							<div class="col-md-6 col-md-offset-3 text-center">
						    	<button type="submit" class="btn btn-cta btn-block btn-success">Update</button>
						    </div>
						</form>
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
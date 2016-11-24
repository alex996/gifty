<?php $this->block('title', 'Add a Product') ?>

<?php $this->block('styles') ?>
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
					<h4><i class="fa fa-pencil-square-o fa-fw" aria-hidden="true"></i> Edit <i><?= $product->name ?></i></h4>
				</div>
				<div class="panel-body">
					<div class="col-md-12">
						<form method="POST" action="/admin/inventory/<?= $product->id ?>">
							<input type="hidden" name="_method" value="PATCH">
						    <div class="form-group col-xs-12 col-sm-6 col-md-4">
						    	<label for="name">Name</label>
						     	<input class="form-control" id="name" name="name" value="<?= $product->name ?>" placeholder="ex: Hershey's Kisses" required>
						    </div>
						    <div class="form-group col-xs-12 col-sm-6 col-md-4">
						    	<label for="category">Category</label>
						     	<select class="form-control" name="category" id="category" required>
						     		<option disabled hidden>Select...</option>
						     		<?php foreach($categories as $category): ?>
		                            	<option value="<?= $category->id ?>" <?= ($product->category_id == $category->id) ? "selected" : "" ?>><?= $category->name ?></option>
		                            <?php endforeach; ?>
						     	</select>
						    </div>
						    <div class="form-group col-xs-12 col-sm-6 col-md-4">
						    	<label for="price">Price</label>
						     	<input class="form-control" type="number" min="0" max="999999" step="0.01" placeholder="0.00" name="price" value="<?= $product->price ?>" id="price" required>
						    </div>
						    <div class="form-group col-xs-12">
						    	<label for="phone">Description</label>
						     	<textarea class="form-control" id="phone" rows="2" name="description" placeholder="Description of the product and its features."><?= $product->description ?></textarea>
						    </div>
							<div class="form-group col-xs-12 col-sm-12 col-md-8">
								<label for="promotion">Promotion</label>
								<select class="form-control" name="promotion" id="promotion">
						     		<option disabled hidden selected>Select...</option>
						     		<?php foreach($promotions as $promotion): ?>
		                            	<option value="<?= $promotion->id ?>" <?= ($product->promotion_id == $promotion->id) ? "selected" : "" ?>><?= $promotion->discount * 100 ?>% off from <?= $promotion->starts_at ?> until <?= $promotion->ends_at ?></option>
		                            <?php endforeach; ?>
						     	</select>
							</div>
							<div class="form-group col-xs-12 col-sm-6 col-md-4">
						    	<label for="quantity">Quantity</label>
						     	<input class="form-control" type="number" min="1" max="99999" placeholder="1" name="quantity" value="<?= $product->price ?>" id="quantity" required>
						    </div>
						    <div class="form-group col-xs-12 col-sm-6 col-md-4">
						    	<label for="status">Status</label>
						     	<select class="form-control" name="status" id="status" required>
						     		<option disabled hidden selected>Select...</option>
						     		<option value="IN_STOCK" <?= ($product->status == Product::IN_STOCK) ? "selected" : "" ?>>IN STOCK</option>
						     		<option value="OUT_OF_STOCK" <?= ($product->status == Product::OUT_OF_STOCK) ? "selected" : "" ?>>OUT OF STOCK</option>
						     		<option value="END_OF_LIFE" <?= ($product->status == Product::END_OF_LIFE) ? "selected" : "" ?>>END OF LIFE</option>
						     	</select>
						    </div>
						    <div class="form-group col-xs-12 col-sm-6 col-md-4">
						    	<label for="featured">Featured on Home Page</label>
						     	<select class="form-control" name="featured" id="featured" required>
						     		<option disabled hidden selected>Select...</option>
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
<?php $this->endblock() ?>

<?php echo $this->display('layouts/app.php', get_defined_vars()); ?>
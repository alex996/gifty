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
					<h4><i class="fa fa-plus-square fa-fw" aria-hidden="true"></i> Add a Product to the Inventory</h4>
				</div>
				<div class="panel-body">
					<div class="col-md-12">
						<form method="POST" action="/admin/inventory" enctype="multipart/form-data">
						    <div class="form-group col-xs-12 col-sm-6 col-md-4">
						    	<label for="name">Name</label>
						     	<input class="form-control" id="name" name="name" placeholder="ex: Hershey's Kisses" required>
						    </div>
						    <div class="form-group col-xs-12 col-sm-6 col-md-4">
						    	<label for="category">Category</label>
						     	<select class="form-control" name="category" id="category" required>
						     		<option selected disabled value hidden>Select...</option>
						     		<?php foreach($categories as $category): ?>
		                            	<option value="<?= $category->id ?>"><?= $category->name ?></option>
		                            <?php endforeach; ?>
						     	</select>
						    </div>
						    <div class="form-group col-xs-12 col-sm-6 col-md-4">
						    	<label for="price">Price</label>
						     	<input class="form-control" type="number" min="0" max="999999" step="0.01" placeholder="0.00" name="price" id="price" required>
						    </div>
						    <div class="form-group col-xs-12">
						    	<label for="phone">Description</label>
						     	<textarea class="form-control" id="phone" rows="2" name="description" placeholder="Description of the product and its features."></textarea>
						    </div>
							<div class="form-group col-xs-12 col-sm-12 col-md-8">
								<label for="promotion">Promotion</label>
								<select class="form-control" name="promotion" id="promotion">
						     		<option selected disabled value hidden>Select...</option>
						     		<?php foreach($promotions as $promotion): ?>
		                            	<option value="<?= $promotion->id ?>"><?= $promotion->discount * 100 ?>% off from <?= $promotion->starts_at ?> until <?= $promotion->ends_at ?></option>
		                            <?php endforeach; ?>
						     	</select>
							</div>
							<div class="form-group col-xs-12 col-sm-6 col-md-4">
						    	<label for="quantity">Quantity</label>
						     	<input class="form-control" type="number" min="1" max="99999" placeholder="1" name="quantity" id="quantity" required>
						    </div>
						    <div class="form-group col-xs-12 col-sm-6 col-md-4">
						    	<label for="status">Status</label>
						     	<select class="form-control" name="status" id="status" required>
						     		<option selected disabled value hidden>Select...</option>
						     		<option value="IN_STOCK">IN STOCK</option>
						     		<option value="OUT_OF_STOCK">OUT OF STOCK</option>
						     	</select>
						    </div>
						    <div class="form-group col-xs-12 col-sm-6 col-md-4">
						    	<label for="featured">Featured on Home Page</label>
						     	<select class="form-control" name="featured" id="featured" required>
						     		<option selected disabled value hidden>Select...</option>
						     		<option value="1">Yes</option>
						     		<option value="0">No</option>
						     	</select>
						    </div>
						    <div class="clearfix"></div>
						    <hr>
							<div class="form-group col-xs-12 col-sm-6 col-md-4">
								<label for="alt_text">Image for Upload</label>
							    <label class="btn btn-default btn-block btn-file">
								   <i class="fa fa-upload fa-fw" aria-hidden="true"></i> Browse <input type="file" name="img" style="display: none;">
								</label>
							</div>
							<div class="form-group col-xs-12 col-sm-6 col-md-4">
						    	<label for="alt_text">Alternative Img Text</label>
						     	<input class="form-control" placeholder="alt" name="alt_text" id="alt_text" required>
						    </div>
						    <div class="form-group col-xs-12 col-sm-6 col-md-4">
						    	<label for="alt_text">Featured Image</label>
						     	<select class="form-control" name="featured" id="featured" required>
						     		<option selected disabled value hidden>Select...</option>
						     		<option value="1">Yes</option>
						     		<option value="0">No</option>
						     	</select>
						    </div>

						    <div class="clearfix"></div>
						    <hr>
							<div class="col-md-6 col-md-offset-3 text-center">
						    	<button type="submit" class="btn btn-cta btn-block btn-success">Create</button>
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
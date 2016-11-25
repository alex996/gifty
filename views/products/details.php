<?php $this->block('title', $product->name) ?>

<?php $this->block('styles') ?>
<style>
	.product-cat {font-size: 12px}
	.product-qty {width:75px !important;}
	.quote {margin-bottom: 0; font-size: 14px}
</style>
<?php $this->endblock() ?>

<?php $this->block('content') ?>
<div class="container">
	<div class="row">
		<div class="page-header text-center">
			<h2>Product Details</h2>
		</div>
		<div class="col-md-2">
			<div class="list-group sidebar">
				<a class="list-group-item text-center disabled">Categories</a>
				<?php $product_category = $product->category->name; ?>
				<?php foreach($categories as $category): ?>
					<a class="list-group-item <?= $category->name == $product_category ? "active" : "" ?>" href="/products/<?= $category->name ?>"><?= ucfirst($category->name) ?></a>
				<?php endforeach; ?>
			</div>
		</div>
		<div class="col-md-10">
			<div class="row">
				<div class="preview col-md-6">
					
					<div class="preview-pic tab-content">
					  <?php $featured = $product->featured_img(); ?>
					  <div class="tab-pane active" id="pic-1"><img class="img-responsive img-rounded" src="<?= !empty($featured) ? $featured->path : "/img/blank.png" ?>" /></div>
					</div>
				</div>
				<div class="col-md-6">
					<h3><?= $product->name ?></h3>

					<h5>
						<?php
							$rating = $product->rating();
							$stars = floor($rating);
							$half_star = $rating - $stars;
						?>
						<?php for($i = 1; $i <= 5; $i++): ?>
							<?php if ($stars > 0)
									$class = "fa-star";
								  else {
								  	if ($half_star > 0) {
								  		$class = "fa-star-half-o";
								  		$half_star = 0;
								  	}
								  	else
								  		$class = "fa-star-o";
								  }
							?>
							<span class="fa <?= $class ?>"></span>
							<?php $stars--; ?>
						<?php endfor; ?>
						&ensp;<?= round($rating, 1) ?> / 5
					</h5>

					<h5><?= count($product->reviews) ?> reviews</h5>

					<h4>
						Price: <span class="text-success"><b>$<?= $product->price ?></b></span>
						<?php
							$class = "";
							switch($product->status) {
								case Product::IN_STOCK: $class = "text-success";break;
								case Product::OUT_OF_STOCK: $class = "text-warning";break;
								case Product::END_OF_LIFE: $class = "text-danger";break;
							}
						?>
						&emsp;<span class="<?= $class ?>"><?= $product->status() ?></span>
					</h4>

					<p><?= $product->description ?></p>
					
					<div class="row">
						<form method="POST" action="/cart" class="form-inline form-add-cart">
							<input type="hidden" name="product_id" value="<?= $product->id ?>">
							<div class="col-sm-2 col-md-3 col-lg-2">
								<input class="form-control input-lg product-qty" type="number" name="quantity" value="1" min="1" max="99">
							</div>
							<div class="col-sm-5 col-md-5 -col-lg-6">
								<a class="btn btn-lg btn-primary btn-block btn-add-cart"><i class="fa fa-cart-plus fa-fw" aria-hidden="true"></i> Add</a>
							</div>
						</form>
					</div>

					<h4>
						<a href="/products/<?= $product->category->name ?>" class="label label-info product-cat">
						<?= $product->category->name ?></a>
					</h4>

				</div>
			</div>
			<hr>
			
			<div class="row">
				<?php if (!empty($product->images)): ?>
					<?php foreach($product->images as $img): ?>
					  <div class="col-md-3">
					    <div class="thumbnail img-card">
					        <img src="<?= $img->path ?>" alt="<?= $img->alt_text ?>">
					    </div>
					  </div>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>

			<hr>
			<?php if (!empty($suggestions)): ?>
				<div class="row">
					<h4 class="text-center">Related Products - Suggestions</h4><br>
	    			<?php foreach($suggestions as $suggestion): ?>
	                    <div class="col-sm-6 col-md-3">
	                        <div class="thumbnail">
	                            <div class="thumbnail img-card">
	                            	<?php $featured = $suggestion->featured_img(); ?>
							        <img src="<?= !empty($featured) ? $featured->path : "/img/blank.png" ?>" alt="<?= !empty($featured) ? $featured->alt_text : "Image" ?>">
							    </div>
	                            <div class="caption">
	                                <h5 class="product-name"><a href="/products/<?= $suggestion->id ?>"><?= $suggestion->name ?></a></h5>
	                                <span class="text-success lead product-price"><b>$<?= $suggestion->price ?></b></span>
	                            </div>
	                        </div>
	                    </div>
	                <?php endforeach; ?>
				</div>
			<hr>
			<?php endif; ?>
			<div class="row">
				<h4 class="text-center"><i class="fa fa-comments-o fa-fw" aria-hidden="true"></i> Product Reviews</h4><br>
				<div class="col-md-<?= Auth::check() ? "6" : "10 col-md-offset-1" ?>">
					<?php foreach($product->reviews as $review): ?>
					<div class="col-md-12">
						<div class="panel panel-default">
							<div class="panel-heading">
								By <i><?= $review->customer->first . " " .  $review->customer->last ?></i> on <?= date('F d, Y', strtotime($review->created_at)) ?>
								<span class="pull-right">Rating: <?= $review->rating ?> / 5</span>
							</div>
							<div class="panel-body">
								<blockquote class="quote">
									<?= $review->comment ?>
								</blockquote>
							</div>
						</div>
					</div>
					<?php endforeach; ?>
				</div>
				
				<div class="col-md-6 <?= empty($product->reviews) ? "col-md-offset-3" : "" ?>">
					<?php if (Auth::check()): ?>
						<form class="form-horizontal" method="POST" action="/products/<?= $product->id ?>/reviews">
							<div class="form-group">
								<label class="control-label col-sm-2" for="rating">Rating:</label>
								<div class="col-sm-10">
									<select class="form-control" id="rating" name="rating" required>
										<option value="5">5 - Awesome!</option>
										<option value="4">4 - Very good!</option>
										<option value="3">3 - Average</option>
										<option value="2">2 - Bad</option>
										<option value="1">1 - Terrible!</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-2" for="comment">Comment:</label>
								<div class="col-sm-10"> 
									<textarea class="form-control" rows="5" id="comment" name="comment" placeholder="Your thoughts or commentary about this product" required></textarea>
								</div>
							</div>
							<div class="form-group"> 
								<div class="col-sm-offset-2 col-sm-10">
									<button type="submit" class="btn btn-default btn-block">Submit</button>
								</div>
							</div>
						</form>
					<?php else: ?>
						<?php if (empty($product->reviews)): ?>
							<div class="text-center">
								<h4 style="margin-bottom:20px"><i>No reviews yet. Be first to leave a comment!</i></h4>
								<h5>Please <a href="/login">sign in</a> to write a review</h5>
							</div>
						<?php endif; ?>
					<?php endif; ?>
					<br>
				</div>

			</div>
		</div>
	</div>
<div>
<?php $this->endblock() ?>

<?php $this->block('scripts') ?>
<script>
$(function() {
	$('.product-qty').keypress(function(e){
		if (e.keyCode === 10 || e.keyCode === 13) e.preventDefault();
	});

	$('.product-qty').change(function() {
        var input = $(this);
        var val = input.val();

        if (val < 1)
            input.val(1);
        else if (val > 99)
            input.val(99);
    });
});
</script>
<?php $this->endblock() ?>

<?php echo $this->display('layouts/app.php', get_defined_vars()); ?>
<?php $this->block('title', $product->name) ?>

<?php $this->block('styles') ?>
<style>
	.product-cat {font-size: 12px}
	.product-qty {width:75px !important;}
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
					  <div class="tab-pane active" id="pic-1"><img class="img-responsive img-rounded" src="http://placekitten.com/450/300" /></div>
					</div>
					<ul class="preview-thumbnail nav nav-tabs">
					  <li class="active"><a data-target="#pic-1" data-toggle="tab"><img class="img-responsive img-rounded" src="http://placekitten.com/200/126" /></a></li>
					  <li><a data-target="#pic-2" data-toggle="tab"><img class="img-responsive img-rounded" src="http://placekitten.com/200/126" /></a></li>
					  <li><a data-target="#pic-3" data-toggle="tab"><img class="img-responsive img-rounded" src="http://placekitten.com/200/126" /></a></li>
					  <li><a data-target="#pic-4" data-toggle="tab"><img class="img-responsive img-rounded" src="http://placekitten.com/200/126" /></a></li>
					  <li><a data-target="#pic-5" data-toggle="tab"><img class="img-responsive img-rounded" src="http://placekitten.com/200/126" /></a></li>
					</ul>
						
				</div>
				<div class="details col-md-6">
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
						&ensp;<?= $rating?> / 5
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
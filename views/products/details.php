<?php $this->block('title', $product->name) ?>

<?php $this->block('styles') ?>
<style>
	.product-cat {font-size: 12px}
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
				<a class="list-group-item" href="/products/electronics">Electronics</a>
				<a class="list-group-item" href="/products/beauty">Beauty</a>
				<a class="list-group-item" href="/products/fashion">Fashion</a>
				<a class="list-group-item" href="/products/toys">Toys</a>
				<a class="list-group-item" href="/products/games">Games</a>
				<a class="list-group-item" href="/products/drinks">Drinks</a>
				<a class="list-group-item" href="/products/candies">Candies</a>
				<a class="list-group-item" href="/products/flowers">Flowers</a>
				<a class="list-group-item" href="/products/home">Home</a>
				<a class="list-group-item" href="/products/accessories">Accessories</a>
			</div>
		</div>
		<div class="col-md-10">
			<div class="row">
				<div class="preview col-md-6">
					
					<div class="preview-pic tab-content">
					  <div class="tab-pane active" id="pic-1"><img class="img-responsive" src="http://placekitten.com/450/252" /></div>
					</div>
					<ul class="preview-thumbnail nav nav-tabs">
					  <li class="active"><a data-target="#pic-1" data-toggle="tab"><img class="img-responsive" src="http://placekitten.com/200/126" /></a></li>
					  <li><a data-target="#pic-2" data-toggle="tab"><img class="img-responsive" src="http://placekitten.com/200/126" /></a></li>
					  <li><a data-target="#pic-3" data-toggle="tab"><img class="img-responsive" src="http://placekitten.com/200/126" /></a></li>
					  <li><a data-target="#pic-4" data-toggle="tab"><img class="img-responsive" src="http://placekitten.com/200/126" /></a></li>
					  <li><a data-target="#pic-5" data-toggle="tab"><img class="img-responsive" src="http://placekitten.com/200/126" /></a></li>
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

					<p>
						<a href="/products/<?= $product->category->name ?>" class="label label-info product-cat">
						<?= $product->category->name ?></a>
					</p>

				</div>
			</div>
		</div>
	</div>
<div>
<?php $this->endblock() ?>

<?php $this->block('scripts') ?>
<?php $this->endblock() ?>

<?php echo $this->display('layouts/app.php', get_defined_vars()); ?>
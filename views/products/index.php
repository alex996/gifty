<?php $this->block('title', 'Products') ?>

<?php $this->block('styles') ?>
<style>
	.product-name {height: 40px; font-size: 18px;}
    .product-price {font-size:24px;}
    .product-desc {height: 40px;}
</style>
<?php $this->endblock() ?>

<?php $this->block('content') ?>
<div class="container">
	<div class="row">
		<div class="page-header text-center">
			<h2>All Products</h2>
		</div>
		<div class="col-md-2">
			<div class="list-group sidebar">
				<a class="list-group-item text-center disabled">Categories</a>
				<?php foreach($categories as $category): ?>
					<a class="list-group-item <?= Router::url() == "/products/{$category->name}" ? "active" : "" ?>" href="/products/<?= $category->name ?>"><?= ucfirst($category->name) ?></a>
				<?php endforeach; ?>
			</div>
		</div>
		<div class="col-md-10">
			<?php foreach($products as $product): ?>
                <div class="col-sm-6 col-md-4">
                    <div class="thumbnail">
                        <img src="http://placehold.it/500x400" alt="...">
                        <div class="caption">
                            <p class="pull-right text-success lead product-price"><b>$<?= $product->price ?></b></p>
                            <h4 class="product-name"><?= $product->name ?></h4>
                            <p class="product-desc"><?= $product->description ?></p>
                            <div class="row">
                                <div class="col-md-6 product-view">
                                    <a href="/products/<?= $product->id ?>" class="btn btn-default btn-block"><i class="fa fa-info-circle fa-fw" aria-hidden="true"></i> Details</a>
                                </div>
                                <div class="col-md-6 product-add">
                                    <form method="POST" action="/cart" class="form-add-cart">
                                        <input type="hidden" name="product_id" value="<?= $product->id ?>">
                                        <input type="hidden" name="quantity" value="1">
                                        <a class="btn btn-primary btn-block btn-add-cart"><i class="fa fa-cart-plus fa-fw" aria-hidden="true"></i> Add</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            <?php endforeach; ?>
		</div>
	</div>
<div>
<?php $this->endblock() ?>

<?php $this->block('scripts') ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.dotdotdot/1.7.4/jquery.dotdotdot.js"></script>
<script>
	$(function() {
        $('.product-name, .product-desc').dotdotdot();
	});
</script>
<?php $this->endblock() ?>

<?php echo $this->display('layouts/app.php', get_defined_vars()); ?>
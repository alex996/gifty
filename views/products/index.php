<?php $this->block('title', 'Products') ?>

<?php $this->block('styles') ?>
<style>
	.product-name {height: 40px; font-size: 18px;}
    .product-price {font-size:24px;}
    .product-desc {height: 40px;}
    .filter {margin-top:0;}
</style>
<?php $this->endblock() ?>

<?php $this->block('content') ?>
<div class="container">
	<div class="row">
		<div class="page-header text-center">
			<h2><?= isset($category) ? "Products in " . ucfirst($category) : "All Products" ?></h2>
		</div>
		<div class="col-md-2">
			<div class="list-group sidebar">
				<a class="list-group-item text-center disabled">Categories</a>
				<?php foreach($categories as $category): ?>
					<a class="list-group-item <?= (strpos(Router::url(), $category->name) !== false) ? "active" : "" ?>" href="/products/<?= $category->name ?>"><?= ucfirst($category->name) ?></a>
				<?php endforeach; ?>
			</div>
		</div>
		<div class="col-md-10">
            <div class="row">
                <div class="col-md-12">
                    <form>
                        <input type="hidden" name="filter">
                        <input type="hidden" name="direction">
                        <h4 class="pull-left filter">
                            Price: <a href="?filter=price&direction=asc&search=<?= isset($_GET['search']) ? $_GET['search'] : "" ?>" class="btn btn-<?= ( isset($_GET['filter']) && $_GET['filter'] == "price" && isset($_GET['direction']) && $_GET['direction'] == "asc") ? "primary" : "default" ?>"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i> Low</i></a>
                            <a href="?filter=price&direction=desc&search=<?= isset($_GET['search']) ? $_GET['search'] : "" ?>" class="btn btn-<?= ( isset($_GET['filter']) && $_GET['filter'] == "price" && isset($_GET['direction']) && $_GET['direction'] == "desc") ? "primary" : "default" ?>"><i class="fa fa-sort-numeric-desc" aria-hidden="true"> High</i></a>&emsp;|&ensp;

                            Name: <a href="?filter=name&direction=asc&search=<?= isset($_GET['search']) ? $_GET['search'] : "" ?>" class="btn btn-<?= ( isset($_GET['filter']) && $_GET['filter'] == "name" && isset($_GET['direction']) && $_GET['direction'] == "asc") ? "primary" : "default" ?>"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> A-Z</i></a>
                            <a href="?filter=name&direction=desc&search=<?= isset($_GET['search']) ? $_GET['search'] : "" ?>" class="btn btn-<?= ( isset($_GET['filter']) && $_GET['filter'] == "name" && isset($_GET['direction']) && $_GET['direction'] == "desc") ? "primary" : "default" ?>"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Z-A</i></a>
                        </h4>
                        <div class="input-group col-md-4 pull-right">
                            <!--<div class="input-group-btn search-panel">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                    <span id="search_concept">Filter by</span> <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#name">Name</a></li>
                                    <li><a href="#description">Description</a></li>
                                </ul>
                            </div>-->
                            <input type="text" class="form-control" placeholder="Search..." name="search" required>
                            <span class="input-group-btn">
                                <button class="btn btn-primary" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                            </span>
                        </div>
                        
                    </form>
                </div>
            </div><br>
            <div class="row">
            <?php if (!empty($products)): ?>
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
            <?php else: ?>
                <h3 class="text-center">No results were found.</h3>
            <?php endif; ?>
            </div>
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
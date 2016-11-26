<?php $this->block('title', 'Welcome!') ?>

<?php $this->block('styles') ?>
<style>
	header.carousel {
        height: 40%;
    }

    header.carousel .item,
    header.carousel .item.active,
    header.carousel .carousel-inner {
        height: 100%;
    }

    header.carousel .fill {
        width: 100%;
        height: 100%;
        background-position: center;
        background-size: cover;
    }

    .product-name {height: 40px; font-size: 18px;}
    .product-price {font-size:24px;}
    .product-desc {height: 40px;}
    
    @media(max-width:767px) {
        .img-portfolio {
            margin-bottom: 15px;
        }
        header.carousel .carousel {
            height: 70%;
        }
    }
    @media(min-width:992px) {
        .product-view {padding-right: 5px}
        .product-add {padding-left: 5px}
    }

    .icon {font-size: 100px}

    .img-card {height: 250px; position: relative;}
    .img-card img {position: absolute; top: 50%; transform: translateY(-50%);width:100%;max-height: 250px}
</style>
<?php $this->endblock() ?>

<?php $this->block('content') ?>
	
	<!-- Header Carousel -->
    <header id="myCarousel" class="carousel slide">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <?php foreach($on_sale as $i => $sale): ?>
                <div class="item <?= $i == 1 ? "active" : ""?>">
                    <?php $featured = $sale->featured_img(); ?>
                    <div class="fill" style="background-image:url('<?= !empty($featured) ? $featured->path : "/img/blank.png" ?>');"></div>
                    <div class="carousel-caption">
                        <a class="promo" href="/products/<?= $sale->id ?>">
                            <h1><?= $sale->name ?></h1>
                            <h2><?= $sale->promotion->discount * 100 ?>% off! Offer ends <?= date('F d, Y', strtotime($sale->promotion->ends_at)) ?></h2>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="icon-prev"></span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="icon-next"></span>
        </a>
    </header>

	<div class="container">

		<div class="row text-center">
            <div class="col-md-12">
                <h1 class="page-header">
                	Welcome to Gifty<?= Auth::check() ? ", " . Auth::user()->name . "!" : "!" ?>
                </h1>
            </div>
            <?php foreach($random_categories as $cat): ?>
                <div class="col-sm-3">
                    <a href="/products/<?= $cat->name ?>">
                        <img class="img-responsive img-portfolio img-hover" src="/img/categories/<?= $cat->name ?>.jpg" alt="<?= $cat->name ?>" style="height:175px">
                        <h4><?= ucfirst($cat->name) ?></h4>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="row">
			<div class="col-md-12 text-center">
				<h2 class="page-header">
                	Browse Our Products
                </h2>
			</div>
            <?php foreach($products as $product): ?>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="thumbnail">
                        <?php $featured = $product->featured_img(); ?>
                        <div class="img-card">
                            <a href="/products/<?= $product->id ?>">
                                <img src="<?= !empty($featured) ? $featured->path : "/img/blank.png" ?>" alt="Image">
                            </a>
                        </div>
                        <div class="caption">
                            <?php if ($product->promotion_id): ?>
                            <p class="pull-right">
                                <span class="text-danger lead product-price" style="text-decoration: line-through;"><b>$<?= number_format($product->price,2) ?></b></span>
                                <br><span class="pull-right text-success lead product-price"><b>$<?= number_format($product->price_with_promotion(),2) ?></b></span>
                            </p>
                            <?php else: ?>
                                <p class="pull-right text-success lead product-price"><b>$<?= $product->price ?></b></p>
                            <?php endif; ?>
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
            <div class="col-md-12 ">
				<div class="col-sm-4 col-sm-offset-4">
					<br><a href="/products" class="btn btn-lg btn-primary btn-block">View All</a>
				</div>
			</div>
        </div>

        <div class="row text-center">
            <div class="col-md-12">
                <h2 class="page-header">
                    How We Stand Out
                </h2>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="icon">
                	<i class="fa fa-shopping-basket" aria-hidden="true"></i>
                </div>
                <h4>Same Day Delivery</h4>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="icon">
                	<i class="fa fa-usd" aria-hidden="true"></i>
                </div>
                <h4>Lightning Deals</h4>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="icon">
                	<i class="fa fa-heart-o" aria-hidden="true"></i>
                </div>
                <h4>Exceptional Service</h4>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="icon">
                	<i class="fa fa-get-pocket" aria-hidden="true"></i>
                </div>
                <h4>100% Money-Back</h4>
            </div>
        </div>
			
		<hr>

        <div class="well">
            <div class="row">
                <div class="col-md-8">
                    <p>Enjoy our collection of high-quality products at ridiculously low prices!
                    We offer fast delivery and excellent service to all our beloved customers.
                    Check out our <a href="/products">products</a> and buy your gift today!</p>
                </div>
                <?php if (!Auth::check()): ?>
                    <div class="col-md-2">
                        <a class="btn btn-lg btn-default btn-block" href="/login">Sign In</a>
                    </div>
                    <div class="col-md-2">
                        <a class="btn btn-lg btn-default btn-block" href="/register">Register</a>
                    </div>
                <?php else: ?>
                    <div class="col-md-2">
                        <a class="btn btn-lg btn-default btn-block" href="/products">Start Shopping</a>
                    </div>
                    <div class="col-md-2">
                        <a class="btn btn-lg btn-default btn-block" href="/cart">View Cart</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
		
	</div> <!-- /.container -->

<?php $this->endblock() ?>

<?php $this->block('scripts') ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.dotdotdot/1.7.4/jquery.dotdotdot.js"></script>
	<script>
		$(function() {
            $('.product-name, .product-desc').dotdotdot();
		    $('.carousel').carousel({
		     	interval: 3000
		    });
		});
	</script>
<?php $this->endblock() ?>

<?php echo $this->display('layouts/app.php', get_defined_vars()); ?>
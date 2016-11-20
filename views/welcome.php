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
            <div class="item active">
                <div class="fill" style="background-image:url('http://placehold.it/1900x1080&text=Slide One');"></div>
                <div class="carousel-caption">
                    <h3>Caption 1</h3>
                </div>
            </div>
            <div class="item">
                <div class="fill" style="background-image:url('http://placehold.it/1900x1080&text=Slide Two');"></div>
                <div class="carousel-caption">
                    <h3>Caption 2</h3>
                </div>
            </div>
            <div class="item">
                <div class="fill" style="background-image:url('http://placehold.it/1900x1080&text=Slide Three');"></div>
                <div class="carousel-caption">
                    <h3>Caption 3</h3>
                </div>
            </div>
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
            <div class="col-sm-3">
                <a href="portfolio-item.html">
                    <img class="img-responsive img-portfolio img-hover" src="http://placehold.it/700x450" alt="">
                    <h4>Electronics</h4>
                </a>
            </div>
            <div class="col-sm-3">
                <a href="portfolio-item.html">
                    <img class="img-responsive img-portfolio img-hover" src="http://placehold.it/700x450" alt="">
                    <h4>Fashion &amp; Beauty</h4>
                </a>
            </div>
            <div class="col-sm-3">
                <a href="portfolio-item.html">
                    <img class="img-responsive img-portfolio img-hover" src="http://placehold.it/700x450" alt="">
                    <h4>Toys &amp; Games</h4>
                </a>
            </div>
            <div class="col-sm-3">
                <a href="portfolio-item.html">
                    <img class="img-responsive img-portfolio img-hover" src="http://placehold.it/700x450" alt="">
                    <h4>Drinks &amp; Candies</h4>
                </a>
            </div>
        </div>

        <div class="row">
			<div class="col-md-12 text-center">
				<h2 class="page-header">
                	Browse Our Products
                </h2>
			</div>
            <?php foreach($products as $product): ?>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <?php /*<div class="thumbnail">
                        <img src="http://placehold.it/320x300" alt="">
                        <div class="caption">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4 class="pull-right text-success product-price"><b>$<?= $product->price ?></b></h4>
                                    <h4 class="product-name"><a href="#"><?= $product->name ?></a></h4>
                                    <p class="product-desc"><?= $product->description ?></p>
                                </div>
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <a class="btn btn-default btn-block"><i class="fa fa-info-circle fa-fw" aria-hidden="true"></i> Details</a>
                                    </div>
                                    <div class="col-md-6">
                                        <button class="btn btn-primary btn-block"><i class="fa fa-cart-plus fa-fw" aria-hidden="true"></i> Add to Cart</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> */ ?>
                    <div class="thumbnail">
                        <img src="http://placehold.it/500x400" alt="...">
                        <div class="caption">
                            <p class="pull-right text-success lead product-price"><b>$<?= $product->price ?></b></p>
                            <h4 class="product-name"><?= $product->name ?></h4>
                            <p class="product-desc"><?= $product->description ?></p>
                            <div class="row">
                                <div class="col-md-6 product-view">
                                    <a class="btn btn-default btn-block"><i class="fa fa-info-circle fa-fw" aria-hidden="true"></i> Details</a>
                                </div>
                                <div class="col-md-6 product-add">
                                    <button class="btn btn-primary btn-block"><i class="fa fa-cart-plus fa-fw" aria-hidden="true"></i> Add</button>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            <?php endforeach; ?>
            <div class="col-md-12 ">
				<div class="col-sm-4 col-sm-offset-4">
					<a href="" class="btn btn-lg btn-primary btn-block">View All</a>
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
                    Check out our <a href="#">products</a> and buy your gift today!</p>
                </div>
                <div class="col-md-2">
                    <a class="btn btn-lg btn-default btn-block" href="login">Sign In</a>
                </div>
                <div class="col-md-2">
                    <a class="btn btn-lg btn-default btn-block" href="register">Register</a>
                </div>
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

<?php echo $this->display('layouts/app.php', []); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= $this->feed('title') ?> | <?= APP_NAME ?></title>

    <meta name="description" content="<?= APP_DESC ?>">
    <meta name="keywords" content="<?= APP_KEYWORDS ?>">
    <meta name="author" content="<?= APP_AUTHOR ?>">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Application CSS -->
    <link rel="stylesheet" href="css/app.css">
    <!-- Custom CSS -->
    <?= $this->feed('styles') ?>
  </head>
  <body>
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/"><i class="fa fa-gift" aria-hidden="true"></i> Gifty - Online Gift Store</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="cart"><i class="fa fa-shopping-cart fa-fw" aria-hidden="true"></i> Cart</a>
                    </li>
                    <li>
                        <a href="products">Products</a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Categories <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="portfolio-1-col.html">Electronics</a>
                            </li>
                            <li>
                                <a href="portfolio-2-col.html">Fashion &amp; Beauty</a>
                            </li>
                            <li>
                                <a href="portfolio-3-col.html">Toys &amp; Games</a>
                            </li>
                            <li>
                                <a href="portfolio-4-col.html">Drinks &amp; Candies</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="contact">Contact</a>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-user fa-fw"></i> <?= Auth::check() ? Auth::user()->name : '' ?> <i class="fa fa-caret-down fa-fw"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <?php if (Auth::check()): ?>
                              <li><a href="account"><i class="fa fa-user-circle fa-fw" aria-hidden="true"></i> User Account</a></li>
                                
                              <li class="divider"></li>
                              <li><a href="account/history"><i class="fa fa-history fa-fw" aria-hidden="true"></i> Order History</a></li>
                              <li><a href="account/payments"><i class="fa fa-credit-card fa-fw" aria-hidden="true"></i> Payment Methods</a></li>
                              
                              <li class="divider"></li>
                              <li><a href="account/edit"><i class="fa fa-pencil-square fa-fw" aria-hidden="true"></i> Edit Profile</a></li>
                              <li><a href="account/security"><i class="fa fa-lock fa-fw" aria-hidden="true"></i> Update Security</a></li>
                            
                              <li class="divider"></li>
                              <form method="POST" action="/logout" name="logout"></form>
                              <li><a href="javascript:document.logout.submit();"><i class="fa fa-sign-out fa-fw" aria-hidden="true"></i> Log out</a></li>
                            <?php else: ?>
                              <li><a href="login"><i class="fa fa-sign-in fa-fw" aria-hidden="true"></i> Sign in</a></li>
                              <li><a href="register"><i class="fa fa-user-plus fa-fw" aria-hidden="true"></i> Register</a></li>
                            <?php endif; ?>
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    
    <!-- Main content -->
    <?= $this->feed('content') ?>

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- Custom JS -->
    <?= $this->feed('scripts') ?>
  </body>
</html>
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
    <link rel="stylesheet" href="/css/app.css">
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
                    <?php if (Auth::check() && Auth::user()->isCustomer() || !Auth::check()): ?>
                      <li>
                          <a href="/cart"><i class="fa fa-shopping-cart fa-fw" aria-hidden="true"></i> Cart (<span id="in-cart"><?= $in_cart ?></span>)</a>
                      </li>
                    <?php endif; ?>
                    <li>
                        <a href="/products">Products</a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Categories <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <?php foreach($categories as $category): ?>
                                <li class="<?= Router::url() == "/products/{$category->name}" ? "active" : "" ?>">
                                    <a href="/products/<?= $category->name ?>"><?= ucfirst($category->name) ?></a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-user fa-fw"></i> <?= Auth::check() ? Auth::user()->name : '' ?> <i class="fa fa-caret-down fa-fw"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <?php if (Auth::check()): ?>
                              <?php if (Auth::user()->isCustomer()): ?>
                                  <li><a href="/account"><i class="fa fa-user-circle fa-fw" aria-hidden="true"></i> User Account</a></li>
                                    
                                  <li class="divider"></li>
                                  <li><a href="/account/orders"><i class="fa fa-history fa-fw" aria-hidden="true"></i> Order History</a></li>
                                  <li><a href="/account/payment-methods"><i class="fa fa-credit-card fa-fw" aria-hidden="true"></i> Payment Methods</a></li>
                                  
                                  <li class="divider"></li>
                                  <li><a href="/account/profile"><i class="fa fa-info-circle fa-fw" aria-hidden="true"></i> Profile Information</a></li>
                                  <li><a href="/account/security"><i class="fa fa-lock fa-fw" aria-hidden="true"></i> Security Settings</a></li>
                              <?php elseif (Auth::user()->isAdmin()): ?>
                                  <li><a href="/admin/dashboard"><i class="fa fa-tachometer fa-fw" aria-hidden="true"></i> Dashboard</a></li>
                                  <li class="divider"></li>
                                  <li><a href="/admin/inventory"><i class="fa fa-database fa-fw" aria-hidden="true"></i> Inventory</a></li>
                                  <li><a href="/admin/sales"><i class="fa fa-area-chart fa-fw" aria-hidden="true"></i> Sales</a></li>
                                  <li><a href="/admin/promotions"><i class="fa fa-percent fa-fw" aria-hidden="true"></i> Promotions</a></li>
                              <?php endif; ?>
                                  <li class="divider"></li>
                                  <form method="POST" action="/logout" name="logout"></form>
                                  <li><a href="javascript:document.logout.submit();"><i class="fa fa-sign-out fa-fw" aria-hidden="true"></i> Log out</a></li>
                            <?php else: ?>
                              <li><a href="/login"><i class="fa fa-sign-in fa-fw" aria-hidden="true"></i> Sign in</a></li>
                              <li><a href="/register"><i class="fa fa-user-plus fa-fw" aria-hidden="true"></i> Register</a></li>
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
    <!-- Application JS -->
    <script src="/js/app.js"></script>
    <!-- Custom JS -->
    <?= $this->feed('scripts') ?>
  </body>
</html>
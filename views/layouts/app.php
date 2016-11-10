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
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/app.css">
    <!-- Custom CSS -->
    <?= $this->feed('styles') ?>
  </head>
  <body>

    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span> 
          </button>
          <a class="navbar-brand" href="#">WebSiteName</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#">Page 1</a></li>
            <li><a href="#">Page 2</a></li> 
            <li><a href="#">Page 3</a></li> 
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <?php if (Auth::logged()): ?>
              <form method="POST" action="/logout" name="logout">
                <li><a href="document.logout.submit();"><i class="fa fa-sign-out" aria-hidden="true"></i> Log out</a></li>
              </form>
            <?php else: ?>
              <li><a href="/login"><i class="fa fa-sign-in" aria-hidden="true"></i> Log in</a></li>
            <?php endif; ?>
            <li><a href="/register"><i class="fa fa-user" aria-hidden="true"></i> Register</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container">
    
      <?= $this->feed('content') ?>

    </div> <!-- ./container -->

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- Custom JS -->
    <?= $this->feed('scripts') ?>
  </body>
</html>
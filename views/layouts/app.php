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
    <!-- Custom CSS -->
    <?= $this->feed('styles') ?>
  </head>
  <body>

    <div class="container">
    
      <?= $this->feed('content') ?>

    </div>

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- Custom JS -->
    <?= $this->feed('scripts') ?>
  </body>
</html>
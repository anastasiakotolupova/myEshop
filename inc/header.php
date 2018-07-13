<?php require_once("inc/init.php") ?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">
    <link rel="stylesheet" href="css/style.css">

    <title>MyEshop - Be$t store ever!</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">

  </head>

  <body>

    <header>
      <div class="collapse bg-dark" id="navbarHeader">
        <div class="container">
          <div class="row">
            <div class="col-sm-8 col-md-7 py-4">
              <h4 class="text-white"><a href="<?= URL ?>myeshop.php">MyEshop</a></h4>
              <p class="text-muted">MyEshop is a new and unique in store presentation system for al type of shelves and all shelf depths. Both powerful linelooks make them ideal for a strong in-store presentation generating extra turnover. Products that are available online only can also be returned to any Future Shop store presentation of the sales receipt.  </p>
            </div>
            <div class="col-sm-4 offset-md-1 py-4">
              <h4 class="text-white">Account</h4>
              <ul class="list-unstyled">
                <li name="login" ><a href="<?= URL ?>login.php" class="text-white">Login</a></li>
                <li name="signin" ><a href="<?= URL ?>signin.php" class="text-white" >Sign in</a></li>
                <li name="signup" ><a href="<?= URL ?>signout.php" class="text-white">Sign out</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="navbar navbar-dark bg-dark box-shadow">
        <div class="container d-flex justify-content-between">
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        </div>
      </div>
    </header>

    <main role="main">

<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$pages = ['login.php', 'index.php']; // authorized pages when you are not logged
// Redirect to login page if not connected and not already in the login page)
if (!isset($_SESSION['loginname']) and !in_array(basename($_SERVER['PHP_SELF']), $pages)) {
    header('Location: login.php?message=log'); // + message log trigger to login page
    exit;
}

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr" dir="ltr">
<head>
    <title>The Cookie Factory</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Kaushan+Script" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/styles.css"/>
</head>
<body>
<header>
    <!-- MENU ENTETE -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">
                    <img class="pull-left" src="assets/img/cookie_funny_clipart.png" alt="The Cookies Factory logo">
                    <h1>The Cookies Factory</h1>
                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#">Chocolates chips</a></li>
                    <li><a href="#">Nuts</a></li>
                    <li><a href="#">Gluten full</a></li>
                    <li>
                        <a href="/cart.php" class="btn btn-warning navbar-btn">
                            <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>
                            Cart
                        </a>
                    </li>

                    <?php
                    if (!empty($_SESSION['loginname'])) :
                        ?>
                        <li>
                            <a href="logout.php" class="btn btn-info navbar-btn">
                                <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                                Logout
                            </a>
                        </li>
                    <?php endif ?>

                    <?php
                    if (empty($_SESSION['loginname'])) :
                        ?>
                        <li>
                            <a href="login.php" class="btn btn-info navbar-btn">
                                <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                                LogMeIn
                            </a>
                        </li>
                    <?php endif ?>

                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
    <?php
    if (!empty($_SESSION['loginname'])) :
        ?>
        <div class="container-fluid text-right">
            <strong>Hello <?= htmlentities($_SESSION['loginname']) ?> !</strong>
        </div>
    <?php endif ?>
</header>

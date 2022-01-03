<?php session_start();

/** Autoloader */
require_once "core/autoloader.php";

/** Load the constants */
require_once "app/models/constants.inc.php";

/** Start Router */
Core\Router::getRoute();

/** Get meta title, meta description and so on... for the current page */
$pageData = new App\Controllers\PageDataController();

// $pageData has h1, meta title, meta description for the current page
$pageData = $pageData->getData();

// Canonical link for the current page
$canonicalLink = HTTP . "{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";

// If there is no user
if (! $_SESSION['user'][1]) { $_SESSION['user'][1] = NULL; }

/** For debugging */
// include "app/includes/debugging.inc.php";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    <link rel="canonical" href="<?= $canonicalLink; ?>">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#1d2021">

    <title><?= $pageData->meta_title; ?></title>
    <meta name="description" content="<?= $pageData->meta_descr; ?>">

    <meta name="author" content="Vlad, https://www.getyoursite.info">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="/app/resourses/css/app.css">

    <script src="/app/resourses/js/jquery-and-mobile.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


    <!--[if lt IE 9]>
    <script src="https://static.stands4.com/app_common/js/libs/html5shiv.min.js"></script>
    <script src="https://static.stands4.com/app_common/js/libs/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="mobile-content"></div>

  <?php include "app/includes/header.inc.php"; ?>

    <div class="container">

        <main>

          <!-- Start the Application -->
          <?php  Core\App::run($pageData); ?>

        </main>

    </div>

    <?php include "app/includes/footer.inc.php"; ?>

    <!-- JS SCRIPTS AND CSS -->
    <link rel="stylesheet" href="/app/resourses/css/font-awesome/css/font-awesome.min.css">
    <script async src="/app/resourses/js/app.js"></script>
  </body>
</html>

<?php include_once(__DIR__ . '/functions.php') ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="./build/css/style.css">
  <script src="./build/js/bundle.min.js" defer></script>
</head>

<header id='header'>
  <div class="container">
    <div class="hstack g-1 justify-content-between align-items-center">
      <a href="/">
        <picture class='brand'>
          <img src="./build/svg/logo.svg" alt="Jossafossa logo">
        </picture>
      </a>
      <nav>

        <ul class="hstack g-1">
          <?= get_the_menu_items('main_menu') ?>
        </ul>

      </nav>
    </div>
  </div>
</header>

<body>
  <main id="main">
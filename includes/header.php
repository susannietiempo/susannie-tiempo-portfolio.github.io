<?php
include 'includes/function.php';
include 'includes/db/dbFunctions.php';
include 'includes/session.php';

//Flag
$isLoggedIn = false;
if (isset($_SESSION['authId'])) {
  $isLoggedIn = true;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Portfolio - Index</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <link href="./assets/img/favicon.png" rel="icon">
  <link href="./assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <link href="./assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="./assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="./assets/vendor/ionicons/css/ionicons.min.css" rel="stylesheet">
  <link href="./assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="./assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Londrina+Outline&family=Montserrat:wght@700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/login.css">
 <link href="https://fonts.googleapis.com/css2?family=Amatic+SC&family=Londrina+Outline&family=Montserrat:wght@700&display=swap" rel="stylesheet">
  <!-- Template Main CSS File -->
  <link href="./assets/css/style.css" rel="stylesheet">

</head>

<body id="page-top">
  <?php

  if (basename($_SERVER['PHP_SELF']) == "index.php") {

  ?>
    <nav class="navbar navbar-b navbar-trans navbar-expand-md fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll" href="index.php"> <img src="./assets/img/logomoon.png" alt="logo"> </a>
        <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarDefault" aria-controls="navbarDefault" aria-expanded="false" aria-label="Toggle navigation">
          <span></span>
          <span></span>
          <span></span>
        </button>
        <div class="navbar-collapse collapse justify-content-end" id="navbarDefault">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link js-scroll active" href="#about">about me</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll" href="#work">my work</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll" href="#blog">blog</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll" href="#contact">contact</a>
            </li>
            <?php
            if ($isLoggedIn == true) {
              echo '<li class="nav-item">'.'<a class="nav-link" href="allPosts.php">'.'manage blog'.'</a>'.'</li>';
              echo '<li class="nav-item">'.'<a class="nav-link" href="allProjects.php">'.'manage projects'.'</a>'.'</li>';
              echo '<li class="nav-item">'.'<a class="nav-link" href="logout.php">'.'logout'.'</a>'.'</li>';
            } else {
              echo   '<li class="nav-item">'.'<a class="nav-link" href="login.php">'.'login'.'</a>'.'</li>';
            }
            ?>
          </ul>
        </div>
      </div>
    </nav>
  <?php
  } elseif (basename($_SERVER['PHP_SELF']) != "index.php"  && basename($_SERVER['PHP_SELF']) != "login.php") {
  ?>
    <nav class="navbar navbar-b navbar-trans navbar-expand-md fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll" href="index.php"> <img src="../myPortfolio/assets/img/logomoon.png" alt="logo"> </a>
        <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarDefault" aria-controls="navbarDefault" aria-expanded="false" aria-label="Toggle navigation">
          <span></span>
          <span></span>
          <span></span>
        </button>
        <div class="navbar-collapse collapse justify-content-end" id="navbarDefault">
          <ul class="navbar-nav">
            <?php
            if ($isLoggedIn == true) {
              echo '<li class="nav-item">'.'<a class="nav-link" href="allPosts.php">'.'manage blog'.'</a>'.'</li>';
              echo '<li class="nav-item">'.'<a class="nav-link" href="allProjects.php">'.'manage projects'.'</a>'.'</li>';
              echo '<li class="nav-item">'.'<a class="nav-link" href="logout.php">'.'logout'.'</a>'.'</li>';
            } else {
              echo   '<li class="nav-item">'.'<a class="nav-link" href="login.php">'.'login'.'</a>'.'</li>';
            }
            ?>
          </ul>
        </div>
      </div>
    </nav>
  <?php
  } else {
  }
  ?>
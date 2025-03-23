<?php extract(Piewpiew\view\View::$view_vars['pages.dashboard']->get_data()); ?><!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>

  <!-- Links to default libs -->
  <link rel="stylesheet" href="<?= route('assets/bs5.3/css/bootstrap.min.css') ?>">
  <link rel="stylesheet" href="<?= route('assets/fa/css/all.min.css') ?>">
  <link rel="stylesheet" href="<?= route('assets/page/css/default.css') ?>">

</head>

<body>

  <!-- Header and navs -->

  <!--# Navbar -->
  <nav
    class="navbar navbar-expand-lg navbar-light p-4">
    <a class="navbar-brand" href="#">Budget</a>
    <div class="d-flex gap-4 ms-auto">
      <a href="#" class="navicons">
        <span class="visually-hidden">
          Add ...
        </span>
        <i class="fa-plus-circle fas"></i>
      </a>

      <a href="#" class="navicons">
        <span class="visually-hidden">
          Notifications
        </span>
        <i class="fa fa-bell"></i>
      </a>

      <a href="#" class="navicons">
        <span class="visually-hidden">
          Profile
        </span>
        <i class="fa fa-user"></i>
      </a>
    </div>
  </nav>

  <!-- Container -->

  <div id="container">
    <!--# Sidebar -->

    <div class="sidebar">
      <div class="menu-title">
        menu
      </div>

      <div class="icons-container">

      <i class="fa fa-list icons"></i>

      <i class="fa fa-list icons"></i>

      <i class="fa fa-list icons"></i>

      <i class="fa fa-list icons"></i>

      <i class="fa fa-list icons"></i>

      </div>
    </div>

    <!--# Content  -->
    <div id="content">

      <div class="d-flex justify-content-between">
        <h2>Dashboard</h2>
        <button class="btn btn-primary rounded-pill">Add new <i class="fa fa-plus"></i></button>
      </div>



    </div>
  </div>




  <!-- Scripts to default libs -->
  <script src="<?= route('assets/bs5.3/js/bootstrap.bundle.min.js') ?>"></script>
  <script src="<?= route('assets/fa/js/all.min.js') ?>"></script>
</body>

</html>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Camp Registration | Admin</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?= base_url( 'assets/components/bootstrap/dist/css/bootstrap.min.css'); ?>">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?= base_url( 'assets/components/datatables.net-bs/css/dataTables.bootstrap.min.css'); ?>">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?= base_url( 'assets/plugins/select2/css/select2.min.css' ) ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url( 'assets/dist/css/AdminLTE.min.css' ) ?>">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
	   folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?= base_url( 'assets/dist/css/skins/skin-blue.min.css'); ?>">

</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>LT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Admin</b> - Reports</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <input type="hidden" id="base_url" value="<?= base_url(); ?>">

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?= base_url( 'assets/dist/img/user2-160x160.jpg'); ?>" class="user-image" alt="User Image">
              <span class="hidden-xs">Welcome, Admin</span>
            </a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
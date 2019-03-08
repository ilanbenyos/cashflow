<!DOCTYPE HTML>
<html>
<head>
<title>Cash Flow</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" href="<?= base_url('assets/favicon.ico')?>" type="image/x-icon">
<link rel="icon" href="<?= base_url('assets/favicon.ico')?>" type="image/x-icon">
<!--------------- Bootstrap CSS --------------->
<link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/datepicker.css') ?>">
<!------------- Common Stylesheet ------------->
<link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/font-awesome.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/datatable.css') ?>">
<script src="<?= base_url('assets/js/jquery.min.js')?>"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>

<body>
<header class="site-header">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12 no-padding relative">
        <div class="logo"> <a href="<?php echo base_url('configuration'); ?>"><img class="aligncenter img-responsive" src="<?= base_url('assets/images/logo.png')?>"></a></div>
        <div class="navbar-bars">
          <button type="button" id="sidebarCollapse" class="navbar-toggle"><i class="fa fa-bars" aria-hidden="true"></i></button>
        </div>
      </div>
      <div class="col-lg-9 col-md-8 col-sm-12 col-xs-12 no-left-pad">
        <div class="top-header-right clearfix">
          <?php if(isset($_SESSION['logged_in']) && ($_SESSION['logged_in'] === true))
          { ?>
          <div class="user-detail"><a href="#"><span><i class="fa fa-user-circle-o" aria-hidden="true"></i> <?php echo $_SESSION['user_email'] ?></span></a>
            <div class="user-dropdown"><span><a href="#"><?php echo $_SESSION['user_role'] ?></a></span><span><a href="<?php echo base_url('/login/logout');?>">Signout</a></span></div>
          </div>
        <?php }?>
        </div>
      </div>
    </div>
  </div>
</header>
<!----- Header ends -----> 
<!----- Wrapper starts ----->
<div class="wrapper">

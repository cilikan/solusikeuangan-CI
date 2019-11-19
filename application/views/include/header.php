<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SolusiKu - Solusi Keuanganku</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="all,follow">
  <!-- Bootstrap CSS-->
  <link rel="stylesheet" href="<?php echo base_url() . 'assets/'; ?>vendor/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome CSS-->
  <link rel="stylesheet" href="<?php echo base_url() . 'assets/'; ?>vendor/font-awesome/css/font-awesome.min.css">
  <!-- Google fonts - Roboto-->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,700">
  <!-- Bootstrap Select-->
  <link rel="stylesheet" href="<?php echo base_url() . 'assets/'; ?>vendor/bootstrap-select/css/bootstrap-select.min.css">
  <!-- owl carousel-->
  <link rel="stylesheet" href="<?php echo base_url() . 'assets/'; ?>vendor/owl.carousel/assets/owl.carousel.css">
  <link rel="stylesheet" href="<?php echo base_url() . 'assets/'; ?>vendor/owl.carousel/assets/owl.theme.default.css">
  <!-- theme stylesheet-->
  <link rel="stylesheet" href="<?php echo base_url() . 'assets/'; ?>css/style.default.css" id="theme-stylesheet">
  <!-- Custom stylesheet - for your changes-->
  <link rel="stylesheet" href="<?php echo base_url() . 'assets/'; ?>css/custom.css">
  <!-- Favicon and apple touch icons-->
  <link rel="shortcut icon" href="<?php echo base_url() . 'assets/'; ?>img/favicon.ico" type="image/x-icon">
  <link rel="apple-touch-icon" href="<?php echo base_url() . 'assets/'; ?>img/apple-touch-icon.png">
  <link rel="apple-touch-icon" sizes="57x57" href="<?php echo base_url() . 'assets/'; ?>img/apple-touch-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="72x72" href="<?php echo base_url() . 'assets/'; ?>img/apple-touch-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url() . 'assets/'; ?>img/apple-touch-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="114x114" href="<?php echo base_url() . 'assets/'; ?>img/apple-touch-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="120x120" href="<?php echo base_url() . 'assets/'; ?>img/apple-touch-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="144x144" href="<?php echo base_url() . 'assets/'; ?>img/apple-touch-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="152x152" href="<?php echo base_url() . 'assets/'; ?>img/apple-touch-icon-152x152.png">
  <!-- Tweaks for older IEs-->
  <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
  <script type="text/javascript">
    function popmodal() {
      $('#myModal').modal('show');
    }
  </script>
</head>

<body>
  <div id="all">
    <!-- modal perhatian -->
    <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
            <p>
              hi, anda belum melengkapi data yang diperlukan untuk
              melakukan pengajuan pinjaan uang. Pengajuan pinjaman baru dapat
              dilakukan setelah anda melengkapi data dan diverifikasi oleh kami maksimal
              1 x 24 jam
            </p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    <!-- modal perhatian end -->
    <!-- Login Modal-->
    <div id="login-modal" tabindex="-1" role="dialog" aria-labelledby="login-modalLabel" aria-hidden="true" class="modal fade">
      <div role="document" class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 id="login-modalLabel" class="modal-title">Masuk</h4>
            <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
          </div>
          <div class="modal-body">
            <form action="<?php echo base_url() . 'register' ?>" method="post">
              <div class="form-group">
                <input name="email" id="email_modal" type="text" placeholder="email" class="form-control">
              </div>
              <div class="form-group">
                <input name="password" id="password_modal" type="password" placeholder="password" class="form-control">
              </div>
              <p class="text-center">
                <button name="login" class="btn btn-template-outlined"><i class="fa fa-sign-in"></i> Masuk</button>
              </p>
            </form>
            <p class="text-center text-muted">Not registered yet?</p>
            <p class="text-center text-muted"><a href="<?php echo base_url() . 'register'; ?>"><strong>Register now</strong></a>! It is easy and done in 1 minute</p>
          </div>
        </div>
      </div>
    </div>
    <!-- Login modal end-->
    <!-- Navbar Start-->
    <header class="nav-holder make-sticky">
      <div id="navbar" role="navigation" class="navbar navbar-expand-lg">
        <div class="container"><a href="<?php echo base_url();?>" class="navbar-brand home"><img src="<?php echo base_url() . 'assets/'; ?>img/solusiku.png" alt="Universal logo" class="d-none d-md-inline-block"><img src="<?php echo base_url() . 'assets/'; ?>img/solusiku.png" alt="Universal logo" class="d-inline-block d-md-none"><span class="sr-only">Universal - go to homepage</span></a>
          <button type="button" data-toggle="collapse" data-target="#navigation" class="navbar-toggler btn-template-outlined"><span class="sr-only">Toggle navigation</span><i class="fa fa-align-justify"></i></button>
          <div id="navigation" class="navbar-collapse collapse">
            <ul class="nav navbar-nav ml-auto">
              <li class="nav-item"><a href="<?php echo base_url(); ?>" class="nav-link">Beranda <b class="caret"></b></a></li>
              <?php if(isset($_SESSION['logged'])){ ?>
                <li class="nav-item"><a href="<?php echo base_url() . 'home/logout'; ?>" class="nav-link">Keluar <b class="caret"></b></a></li>
              <?php }else{ ?>
              <li class="nav-item"><a href="#" data-toggle="modal" data-target="#login-modal" class="nav-link">Masuk<b class="caret"></b></a></li>
              <li class="nav-item"><a href="<?php echo base_url() . 'register'; ?>" class="nav-link">Daftar<b class="caret"></b></a></li>
              <?php } ?>
            </ul>
          </div>
          <div id="search" class="collapse clearfix">
            <form role="search" class="navbar-form">
              <div class="input-group">
                <input type="text" placeholder="Search" class="form-control"><span class="input-group-btn">
                  <button type="submit" class="btn btn-template-main"><i class="fa fa-search"></i></button></span>
              </div>
            </form>
          </div>
        </div>
      </div>
    </header>
    <!-- Navbar End-->
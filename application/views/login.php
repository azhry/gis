<!DOCTYPE html>
<html class="no-js before-run" lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="bootstrap admin template">
  <meta name="author" content="">

  <title><?= $title ?></title>

  <link rel="apple-touch-icon" href="<?= base_url('assets') ?>/images/apple-touch-icon.png">
  <link rel="shortcut icon" href="<?= base_url('assets') ?>/images/favicon.ico">

  <!-- Stylesheets -->
  <link rel="stylesheet" href="<?= base_url('assets') ?>/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url('assets') ?>/css/bootstrap-extend.min.css">
  <link rel="stylesheet" href="<?= base_url('assets') ?>/css/site.min.css">

  <link rel="stylesheet" href="<?= base_url('assets') ?>/vendor/animsition/animsition.css">
  <link rel="stylesheet" href="<?= base_url('assets') ?>/vendor/asscrollable/asScrollable.css">
  <link rel="stylesheet" href="<?= base_url('assets') ?>/vendor/switchery/switchery.css">
  <link rel="stylesheet" href="<?= base_url('assets') ?>/vendor/intro-js/introjs.css">
  <link rel="stylesheet" href="<?= base_url('assets') ?>/vendor/slidepanel/slidePanel.css">
  <link rel="stylesheet" href="<?= base_url('assets') ?>/vendor/flag-icon-css/flag-icon.css">


  <!-- Page -->
  <link rel="stylesheet" href="<?= base_url('assets') ?>/css/pages/login.css">

  <!-- Fonts -->
  <link rel="stylesheet" href="<?= base_url('assets') ?>/fonts/web-icons/web-icons.min.css">
  <link rel="stylesheet" href="<?= base_url('assets') ?>/fonts/brand-icons/brand-icons.min.css">
  <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>


  <!--[if lt IE 9]>
    <script src="<?= base_url('assets') ?>/vendor/html5shiv/html5shiv.min.js"></script>
    <![endif]-->

  <!--[if lt IE 10]>
    <script src="<?= base_url('assets') ?>/vendor/media-match/media.match.min.js"></script>
    <script src="<?= base_url('assets') ?>/vendor/respond/respond.min.js"></script>
    <![endif]-->

  <!-- Scripts -->
  <script src="<?= base_url('assets') ?>/vendor/modernizr/modernizr.js"></script>
  <script src="<?= base_url('assets') ?>/vendor/breakpoints/breakpoints.js"></script>
  <script>
    Breakpoints();
  </script>
</head>
<body class="page-login layout-full">
  <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->


  <!-- Page -->
  <div class="page animsition vertical-align text-center" data-animsition-in="fade-in"
  data-animsition-out="fade-out">>
    <div class="page-content vertical-align-middle">
      <div class="brand">
        <img class="brand-img" src="<?= base_url('img') ?>/logo.jpg" alt="KemenPUPR" width="100" height="100">
        <h2 class="brand-text">Sistem Informasi Pemetaan Proyek</h2>
        <p>Direktorat Jendral Pekerjaan Umum dan Perumahan Rakyat <br>Jendral Cipta Karya Satuan Kerja Pengendalian <br>dan Program Infrastruktur  Permukiman Rakyat <br>Provinsi Bengkulu</p>
      </div>
      <p>Login into your account.</p>
      <?= form_open('login/login_process') ?>
        <div class="form-group">
          <label class="sr-only" for="inputName">NIP</label>
          <input type="text" class="form-control" id="inputName" placeholder="NIP" name="nip">
        </div>
        <div class="form-group">
          <label class="sr-only" for="inputPassword">Password</label>
          <input type="password" class="form-control" id="inputPassword" name="password"
          placeholder="Password">
        </div>
        <input type="submit" name="login-submit" value="Login" class="btn btn-primary btn-block">
      </form>

      <!-- <footer class="page-copyright">
        <p>WEBSITE BY amazingSurge</p>
        <p>© 2015. All RIGHT RESERVED.</p>
        <div class="social">
          <a href="javascript:void(0)">
            <i class="icon bd-twitter" aria-hidden="true"></i>
          </a>
          <a href="javascript:void(0)">
            <i class="icon bd-facebook" aria-hidden="true"></i>
          </a>
          <a href="javascript:void(0)">
            <i class="icon bd-dribbble" aria-hidden="true"></i>
          </a>
        </div>
      </footer> -->
    </div>
  </div>
  <!-- End Page -->


  <!-- Core  -->
  <script src="<?= base_url('assets') ?>/vendor/jquery/jquery.js"></script>
  <script src="<?= base_url('assets') ?>/vendor/bootstrap/bootstrap.js"></script>
  <script src="<?= base_url('assets') ?>/vendor/animsition/jquery.animsition.js"></script>
  <script src="<?= base_url('assets') ?>/vendor/asscroll/jquery-asScroll.js"></script>
  <script src="<?= base_url('assets') ?>/vendor/mousewheel/jquery.mousewheel.js"></script>
  <script src="<?= base_url('assets') ?>/vendor/asscrollable/jquery.asScrollable.all.js"></script>
  <script src="<?= base_url('assets') ?>/vendor/ashoverscroll/jquery-asHoverScroll.js"></script>

  <!-- Plugins -->
  <script src="<?= base_url('assets') ?>/vendor/switchery/switchery.min.js"></script>
  <script src="<?= base_url('assets') ?>/vendor/intro-js/intro.js"></script>
  <script src="<?= base_url('assets') ?>/vendor/screenfull/screenfull.js"></script>
  <script src="<?= base_url('assets') ?>/vendor/slidepanel/jquery-slidePanel.js"></script>

  <script src="<?= base_url('assets') ?>/vendor/jquery-placeholder/jquery.placeholder.js"></script>

  <!-- Scripts -->
  <script src="<?= base_url('assets') ?>/js/core.js"></script>
  <script src="<?= base_url('assets') ?>/js/site.js"></script>

  <script src="<?= base_url('assets') ?>/js/sections/menu.js"></script>
  <script src="<?= base_url('assets') ?>/js/sections/menubar.js"></script>
  <script src="<?= base_url('assets') ?>/js/sections/sidebar.js"></script>

  <script src="<?= base_url('assets') ?>/js/configs/config-colors.js"></script>
  <script src="<?= base_url('assets') ?>/js/configs/config-tour.js"></script>

  <script src="<?= base_url('assets') ?>/js/components/asscrollable.js"></script>
  <script src="<?= base_url('assets') ?>/js/components/animsition.js"></script>
  <script src="<?= base_url('assets') ?>/js/components/slidepanel.js"></script>
  <script src="<?= base_url('assets') ?>/js/components/switchery.js"></script>
  <script src="<?= base_url('assets') ?>/js/components/jquery-placeholder.js"></script>

  <script>
    (function(document, window, $) {
      'use strict';

      var Site = window.Site;
      $(document).ready(function() {
        Site.run();
      });
    })(document, window, jQuery);
  </script>

</body>

</html>
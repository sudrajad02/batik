<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $judul ?></title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">

    <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/selectFX/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/jqvmap/dist/jqvmap.min.css">

    <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/css/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
    <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyAKH2F9gZMQyATwBodQsEr-uM0fokVCvZw&callback=initialize"></script>
</head>

<body>

    <?php
    $hak_akses = $this->session->userdata('hak_akses');
    ?>

    <!-- Left Panel -->

    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <?php if ($hak_akses == 1) : ?>
                    <a class="navbar-brand" href="<?php echo base_url() ?>Admin/Admin">
                        <h1>Bathik</h1>
                    </a>
                <?php else : ?>
                    <a class="navbar-brand" href="<?php echo base_url() ?>Pemilik_toko/Pemilik">
                        <h1>Bathik</h1>
                    </a>
                <?php endif; ?>
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <?php
                    if ($hak_akses == 1) {
                    ?>
                        <li><a href="<?php echo base_url() ?>Admin/Admin"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a></li>
                        <li>
                            <a href="<?php echo base_url() ?>Admin/Admin_pemilik_toko"> <i class="menu-icon fa fa-user"></i>Pemilik Toko </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url() ?>Admin/Admin_member"> <i class="menu-icon fa fa-users"></i>Member </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url() ?>Admin/Admin_komentar"> <i class="menu-icon fa fa-comment"></i>Komentar </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url() ?>Admin/Admin_toko_batik"> <i class="menu-icon fa fa-building"></i>Toko Batik </a>
                        </li>
                    <?php
                    } else if ($hak_akses == 2) {
                    ?>
                        <li><a href="<?php echo base_url() ?>Pemilik_toko/Pemilik"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a></li>
                        <li>
                            <a href="<?php echo base_url() ?>Pemilik_toko/Pemilik_toko"> <i class="menu-icon fa fa-building-o"></i>Toko Batik </a>
                        </li>
                    <?php } ?>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside><!-- /#left-panel -->

    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <header id="header" class="header">

            <div class="header-menu">

                <div class="col-sm-7">

                </div>

                <div class="col-sm-5">
                    <div class="user-area dropdown float-right">
                        <?php
                        if ($hak_akses == 1) {
                        ?>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <div class="avatar">
                                    <img class="user-avatar rounded-circle" src="<?php echo base_url() ?>public/image/foto_akun/<?php echo $admin->foto_akun ?>" alt="User Avatar">
                                </div>
                            </a>

                            <div class="user-menu dropdown-menu">
                                <a class="nav-link" href="<?php echo base_url() ?>Admin/Admin_profil"><i class="fa fa-user"></i> My Profile</a>
                                <a class="nav-link" href="<?php echo base_url() ?>Login/logout"><i class="fa fa-power-off"></i> Logout</a>
                            </div>
                        <?php
                        } else if ($hak_akses == 2) {
                        ?>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <div class="avatar">
                                    <img class="user-avatar rounded-circle" src="<?php echo base_url() ?>public/image/foto_akun/<?php echo $pemilik->foto_akun ?>" alt="User Avatar">
                                </div>
                            </a>

                            <div class="user-menu dropdown-menu">
                                <a class="nav-link" href="<?php echo base_url() ?>Pemilik_toko/Pemilik_profil"><i class="fa fa-user"></i> My Profile</a>
                                <a class="nav-link" href="<?php echo base_url() ?>Login/logout"><i class="fa fa-power-off"></i> Logout</a>
                            </div>
                        <?php
                        }
                        ?>
                    </div>

                </div>
            </div>

        </header><!-- /header -->
        <!-- Header-->
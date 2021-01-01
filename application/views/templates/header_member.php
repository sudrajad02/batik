<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title><?php echo $judul ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Your page description here" />
    <meta name="author" content="" />

    <!-- css -->
    <link href="https://fonts.googleapis.com/css?family=Handlee|Open+Sans:300,400,600,700,800" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/member/css/bootstrap.css" rel="stylesheet" />
    <link href="<?php echo base_url() ?>assets/member/css/bootstrap-responsive.css" rel="stylesheet" />
    <link href="<?php echo base_url() ?>assets/member/css/flexslider.css" rel="stylesheet" />
    <link href="<?php echo base_url() ?>assets/member/css/prettyPhoto.css" rel="stylesheet" />
    <link href="<?php echo base_url() ?>assets/member/css/camera.css" rel="stylesheet" />
    <link href="<?php echo base_url() ?>assets/member/css/jquery.bxslider.css" rel="stylesheet" />
    <link href="<?php echo base_url() ?>assets/member/css/style.css" rel="stylesheet" />
    <link href="<?php echo base_url() ?>assets/member/css/style_flexisel.css" rel="stylesheet" />

    <!-- Theme skin -->
    <link href="<?php echo base_url() ?>assets/member/color/default.css" rel="stylesheet" />

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo base_url() ?>assets/member/ico/apple-touch-icon-144-precomposed.png" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo base_url() ?>assets/member/ico/apple-touch-icon-114-precomposed.png" />
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo base_url() ?>assets/member/ico/apple-touch-icon-72-precomposed.png" />
    <link rel="apple-touch-icon-precomposed" href="<?php echo base_url() ?>assets/member/ico/apple-touch-icon-57-precomposed.png" />
    <link rel="shortcut icon" href="<?php echo base_url() ?>assets/member/ico/favicon.png" />

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAKH2F9gZMQyATwBodQsEr-uM0fokVCvZw&callback=initialize"></script>
    <script src="<?php echo base_url() ?>assets/member/js/jquery-2.1.4.min.js"></script>
</head>

<body>

    <div id="wrapper">


        <!-- start header -->
        <header>
            <div class="top">
                <div class="container">
                    <div class="row">
                        <div class="span6">

                        </div>
                        <div class="span6">
                            <ul class="social-network">
                                <li>
                                    <a href="<?php echo base_url() ?>Member/Member_register_pemilik" data-placement="bottom" color="white">
                                        <font color="white">Punya Toko?</font>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row nomargin">
                    <div class="span4">
                        <div class="logo">
                            <!-- <a href="index.html"><img src="img/logo.png" alt="" /></a> -->
                            <a href="<?php echo base_url() ?>Beranda_member">
                                <h1>Bathik</h1>
                            </a>
                        </div>
                    </div>
                    <div class="span8">
                        <div class="navbar navbar-static-top">
                            <div class="navigation">
                                <nav>
                                    <ul class="nav topnav">
                                        <li>
                                            <a href="<?php echo base_url() ?>Beranda_member">Beranda</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url() ?>Member/Member_toko">Toko Batik </a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url() ?>Member/Member_kontak">Kontak </a>
                                        </li>

                                        <?php if ($this->session->userdata('hak_akses') == 3 && !empty($this->session->userdata('id_member'))) {
                                        ?>
                                            <li>
                                                <a href="<?php echo base_url() ?>Member/Member_profil">Akun </a>
                                            </li>
                                            <li>
                                                <a href="<?php echo base_url() ?>Login/logout">Logout </a>
                                            </li>
                                        <?php
                                        } else { ?>
                                            <li>
                                                <a href="<?php echo base_url() ?>Login">Login </a>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </nav>
                            </div>
                            <!-- end navigation -->
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- end header -->
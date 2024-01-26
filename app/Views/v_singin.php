<!DOCTYPE html>
<html lang="en">

<head>
    <title>Sign In Administrator</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="CodedThemes">
    <meta name="keywords" content=" Admin , Responsive, QGis, Bootstrap, Bukittingi, Drainase">
    <meta name="author" content="Adsa Darma">
    <!-- Favicon icon -->
    <link rel="icon" href="<?= base_url('assets/admin/'); ?>/images/favicon.ico" type="image/x-icon">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/admin/'); ?>/css/bootstrap/css/bootstrap.min.css">
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css"
        href="<?= base_url('assets/admin/'); ?>/icon/themify-icons/themify-icons.css">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/admin/'); ?>/icon/icofont/css/icofont.css">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/admin/'); ?>/css/style.css">
    <style>
    .btn-amber {
        background-color: #FFC928;
    }
    </style>
</head>

<body class="fix-menu">
    <!-- Pre-loader start -->
    <div class="theme-loader">
        <div class="ball-scale">
            <div class='contain'>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Pre-loader end -->

    <section class="login p-fixed d-flex text-center common-img-bg" style="background-color: #37517e;">
        <!-- Container-fluid starts -->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <!-- Authentication card start -->
                    <div class="login-card card-block auth-body mr-auto ml-auto">

                        <?php if (session()->getFlashdata('msg')) : ?>
                        <div class="alert alert-warning">
                            <?= session()->getFlashdata('msg') ?>
                        </div>
                        <?php endif; ?>
                        <?= form_open('login', 'class="md-float-material" method="POST"') ?>
                        <div class="auth-box">
                            <div class="row m-b-20  d-flex align-items-center">


                                <div class="col-md-12">
                                    <img src="<?= base_url('assets/img/Logo_Kota_Bukittinggi.png'); ?>" alt=""
                                        class="img-float mr-2" style="width: 80px;">
                                    <img src="<?= base_url('assets/img/LOGO-PU.png'); ?>" alt="" class="img-float"
                                        style="width: 80px;">
                                </div>

                                <div class="col-md-12">
                                    <h3 class="txt-primary" style="font-size: 28px;"><strong>ADMINISTRATOR</strong></h3>
                                </div>

                            </div>
                            <hr />
                            <div class="input-group">
                                <input type="text" name="Username" class="form-control"
                                    value="<?= set_value('Username') ?>" placeholder="Username" required>
                                <span class="md-line"></span>
                            </div>
                            <div class="input-group">
                                <input type="password" name="Password" class="form-control" placeholder="Password"
                                    required>
                                <span class="md-line"></span>
                            </div>
                            <hr />

                            <div class="row m-t-30">
                                <div class="col-md-12">
                                    <button type="submit"
                                        class="btn btn-amber btn-sm btn-block waves-effect text-center m-b-20"><b>Masuk</b>
                                    </button>
                                </div>
                            </div>

                            <div class="footer-login" style="margin: 40px 0 -40px 0;">
                                <p class="text-inverse text-center">WebGis Database Drainase Kota
                                    Bukittingi | Dinas PUPR - Kominfo Kota Bukittinggi
                                    @2023
                                </p>

                            </div>
                        </div>

                        <?= form_close() ?>
                        <!-- end of form -->
                    </div>
                    <!-- Authentication card end -->
                </div>
                <!-- end of col-sm-12 -->
            </div>
            <!-- end of row -->
        </div>
        <!-- end of container-fluid -->
    </section>
    <!-- Warning Section Starts -->
    <!-- Older IE warning message -->

    <!-- Warning Section Ends -->
    <!-- Required Jquery -->
    <script type="text/javascript" src="<?= base_url('assets/admin/'); ?>/js/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="<?= base_url('assets/admin/'); ?>/js/jquery-ui/jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?= base_url('assets/admin/'); ?>/js/popper.js/popper.min.js"></script>
    <script type="text/javascript" src="<?= base_url('assets/admin/'); ?>/js/bootstrap/js/bootstrap.min.js"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="<?= base_url('assets/admin/'); ?>/js/jquery-slimscroll/jquery.slimscroll.js">
    </script>
    <!-- modernizr js -->
    <script type="text/javascript" src="<?= base_url('assets/admin/'); ?>/js/modernizr/modernizr.js"></script>
    <script type="text/javascript" src="<?= base_url('assets/admin/'); ?>/js/modernizr/css-scrollbars.js"></script>
    <script type="text/javascript" src="<?= base_url('assets/admin/'); ?>/js/common-pages.js"></script>
</body>

</html>
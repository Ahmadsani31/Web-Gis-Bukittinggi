<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>WebGIS Database Drainase Kota Bukittinggi</title>
    <meta content="lokasi dan keterangan drainase selingkungan kota bukittinggi" name="description">
    <meta content="bukittinggi,drainase,lingkunggan bukittinggi,pu" name="keywords">

    <!-- Favicons -->
    <link href="<?= base_url(); ?>assets/img/favicon.png" rel="icon">
    <link href="<?= base_url(); ?>/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?= base_url(); ?>/assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="<?= base_url(); ?>/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="<?= base_url(); ?>/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="<?= base_url(); ?>/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <!-- Template Main CSS File -->
    <link href="<?= base_url(); ?>/assets/css/style.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/select2/css/select2.min.css" rel="stylesheet" />
    <style>
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        background-color: #fff;
        color: #000;
        padding: 8px 30px 8px 20px;
    }

    .select2-container .select2-selection--single {
        box-sizing: border-box;
        cursor: pointer;
        display: block;
        height: 35px;
        user-select: none;
        -webkit-user-select: none;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: #444;
        line-height: 17px;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 38px;
        position: absolute;
        top: 1px;
        right: 1px;
        width: 20px;
    }

    .btn-get-started {
        font-family: 'Poppins', sans-serif;
        font-weight: 500;
        font-size: 16px;
        letter-spacing: 1px;
        display: inline-block;
        padding: 10px 28px 11px 28px;
        border-radius: 50px;
        transition: 0.5s;
        margin: 10px 0 0 0;
        color: #000;
        background: #ffc928;
    }

    .btn-sm {
        padding: 5px 10px;
        font-size: 12px;
        line-height: 1.5;
        border-radius: 3px;
    }


    .text-h3 {
        font-size: 32px;
        font-weight: bold;
        position: relative;
        color: #fff;
    }

    .text-h1 {
        font-size: 44px;

        position: relative;
    }

    path.leaflet-interactive:focus {
        outline: none;
    }


        @media (max-width: 768px) {
            .container-fluid {
                padding-left: 10px !important;
                padding-right: 10px !important;
            }
        }
        
                @media (max-width: 578px) {
            #header .logo {
                font-size: 25px !important;
            }
        }
    </style>
    <?= $this->renderSection('content-css') ?>

    <!-- =======================================================
  * Template Name: Arsha - v4.3.0
  * Template URL: https://bootstrapmade.com/arsha-free-bootstrap-html-template-corporate/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    <?= $this->include('_templates/_header.php') ?>
    <input type="hidden" id="base_url" value="<?= base_url() ?>">
    <?= $this->renderSection('content-body') ?>
    <?= $this->include('administrator/_templates/_modal.php') ?>
    <?= $this->include('_templates/_footer.php') ?>

    <div id="preloader"></div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    <!-- Vendor JS Files -->
    <script src="<?= base_url(); ?>/assets/vendor/aos/aos.js"></script>
    <script src="<?= base_url(); ?>/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url(); ?>/assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="<?= base_url(); ?>/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <!-- <script src="<?= base_url(); ?>/assets/vendor/php-email-form/validate.js"></script> -->
    <script src="<?= base_url(); ?>/assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="<?= base_url(); ?>/assets/vendor/waypoints/noframework.waypoints.js"></script>
    <script src="<?= base_url('assets') ?>/js/xtends-home.js"></script>
    <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js"></script>
    <script src="<?= base_url(); ?>/assets/js/validate.js"></script>
    <!-- Template Main JS File -->
    <script src="<?= base_url(); ?>/assets/js/main.js"></script>
    <script src="<?= base_url(); ?>/assets/select2/js/select2.min.js"></script>
    <script>
    var url1 = window.location.href;
    var path = location.pathname.split("/");
    // console.log(path);

    var url = location.origin + "/" + path[1];
    $("ul li a").each(function() {
        var link = $(this);
        var path1 = link.get(0).href.split("/");
        // console.log(link.get(0).href.split("/"));

        if (link.get(0).href == url1) {
            $(this)
                .addClass("active")

        } else if (path[1] === path1[3]) {
            $(this)
                .addClass("active")

        }
    });
    </script>
    <?= $this->renderSection('content-js') ?>
</body>

</html>
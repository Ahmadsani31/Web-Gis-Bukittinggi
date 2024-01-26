<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin - Dashboard</title>
    <!-- HTML5 Shim and Respond.js IE9 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="CodedThemes">
    <meta name="keywords"
        content=" Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
    <meta name="author" content="CodedThemes">
    <!-- Favicon icon -->
    <link href="<?= base_url(); ?>assets/img/favicon.png" rel="icon">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/admin/'); ?>css/bootstrap/css/bootstrap.min.css">
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/admin/'); ?>icon/themify-icons/themify-icons.css">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/admin/'); ?>icon/icofont/css/icofont.css">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/admin/'); ?>css/style.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/admin/'); ?>css/jquery.mCustomScrollbar.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/'); ?>css/tooltip-css-magic.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
    div.scroll {
        margin: 4px, 4px;
        padding: 4px;
        max-height: 400px;
        overflow-x: hidden;
        overflow-y: auto;
        text-align: justify;
    }


    p.notification-msg {
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        background-color: #fff;
        color: #000;
        padding: 8px 30px 8px 20px;
    }

    .select2-container .select2-selection--single {
        box-sizing: border-box;
        cursor: pointer;
        display: block;
        height: 39px;
        user-select: none;
        -webkit-user-select: none;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: #444;
        line-height: 21px;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 38px;
        position: absolute;
        top: 1px;
        right: 1px;
        width: 20px;
    }

    .input-group-text {
        display: flex;
        align-items: center;
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        color: #212529;
        text-align: center;
        white-space: nowrap;
        background-color: #e9ecef;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
    }
    </style>
    <?= $this->renderSection('content-css') ?>
</head>

<body>
    <input type="hidden" id="base_url" value="<?= base_url() ?>">
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
    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">


            <?= $this->include('administrator/_templates/_header.php') ?>
            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">
                    <?= $this->include('administrator/_templates/_sidebar.php') ?>
                    <?= $this->renderSection('content-body') ?>

                </div>
            </div>
        </div>
    </div>
    <?= $this->include('administrator/_templates/_modal.php') ?>
    <!-- Warning Section Ends -->
    <!-- Required Jquery -->
    <script type="text/javascript" src="<?= base_url('assets/admin/'); ?>js/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="<?= base_url('assets/admin/'); ?>js/jquery-ui/jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?= base_url('assets/admin/'); ?>js/popper.js/popper.min.js"></script>
    <script type="text/javascript" src="<?= base_url('assets/admin/'); ?>js/bootstrap/js/bootstrap.min.js"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="<?= base_url('assets/admin/'); ?>js/jquery-slimscroll/jquery.slimscroll.js">
    </script>
    <!-- modernizr js -->
    <script type="text/javascript" src="<?= base_url('assets/admin/'); ?>js/modernizr/modernizr.js"></script>
    <!-- am chart -->
    <script src="<?= base_url('assets/admin/'); ?>pages/widget/amchart/amcharts.min.js"></script>
    <script src="<?= base_url('assets/admin/'); ?>pages/widget/amchart/serial.min.js"></script>
    <!-- Todo js -->
    <script type="text/javascript " src="<?= base_url('assets/admin/'); ?>pages/todo/todo.js "></script>
    <!-- Custom js -->
    <script type="text/javascript" src="<?= base_url('assets/admin/'); ?>pages/dashboard/custom-dashboard.js"></script>
    <script type="text/javascript" src="<?= base_url('assets/admin/'); ?>js/script.js"></script>
    <script src="<?= base_url('assets/admin/'); ?>js/pcoded.min.js"></script>
    <script src="<?= base_url('assets/admin/'); ?>js/demo-12.js"></script>
    <script src="<?= base_url('assets/admin/'); ?>js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js"></script>
    <script src="<?= base_url('assets') ?>/js/xtends.js"></script>
    <?= $this->renderSection('content-js') ?>
    <script>
    var $window = $(window);
    var nav = $('.fixed-button');
    $window.scroll(function() {
        if ($window.scrollTop() >= 200) {
            nav.addClass('active');
        } else {
            nav.removeClass('active');
        }
    });

    // $(document).ready(function() {
    //     $('[data-toggle="tooltip"]').tooltip();
    // });

    // $(document).ready(function() {
    //     $('[data-toggle="popover"]').popover({
    //         html: true,
    //         content: function() {
    //             return $('#primary-popover-content').html();
    //         }
    //     });
    // });

    $(window).on("load", function() {
        // $('.theme-loader').hide();
        $(".theme-loader").fadeOut(500, function() {
            $(this).hide();
        });
    });


    notifikasi();

    function notifikasi() {


        $.ajax({
            type: "GET",
            url: "<?= base_url('admin/notifikasi') ?>",
            enctype: 'multipart/form-data',
            dataType: "json",
            success: function(response) {
                if (response.count > 0) {
                    $('.icon-notif').addClass('badge bg-c-pink');
                }
                $('#notifikasi').html(response.output);
            },
            failure: function(response) {
                alert(response.responseText);
            },
            error: function(response) {
                alert(response.responseText);
            }
        });
    }
    </script>
</body>

</html>
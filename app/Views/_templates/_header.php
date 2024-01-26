    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top  header-inner-pages">
        <div class="container d-flex align-items-center">

            <h1 class="logo me-auto"><a href="<?= base_url(); ?>"><?= $title; ?></a></h1>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!--<a href="index.html" class="logo me-auto"><img src="<?= base_url(); ?>/assets/img/AA.png" class="img-fluid"></a>-->

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto" href="<?= base_url(); ?>">Home</a></li>
                    <li><a class="nav-link scrollto" href="<?= base_url('berita'); ?>">Berita</a></li>
                    <li><a class="nav-link scrollto" href="<?= base_url('peta'); ?>">Peta</a></li>
                    <li><a class="nav-link scrollto" href="<?= base_url('data-pengaduan'); ?>">Laporan Pengaduan</a>
                    </li>
                    <?php if (!session()->get('isLoggedIn')) { ?>
                    <li><a class="getstarted scrollto" href="<?= base_url('signin'); ?>">Masuk</a></li>
                    <!-- <li><a class="getstarted scrollto" href="#">Masuk</a></li> -->

                    <?php } else { ?>
                    <li class="dropdown"><a href="#"
                            class="getstarted scrollto"><span><?= session()->get('s_Nama'); ?></span> <i
                                class="bi bi-chevron-down"></i></a>
                        <ul>
                            <li><a href="<?= base_url('admin/dashboard'); ?>">Admin</a></li>
                            <li><a href="<?= base_url('logout'); ?>">Logout</a></li>
                        </ul>
                    </li>
                    <?php }  ?>

                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->
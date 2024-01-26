<?= $this->extend('_templates/_app') ?>
<?= $this->section('content-css') ?>
<link rel="stylesheet" href="<?= base_url(); ?>/assets/css/style-blog.css">

<!-- Owl Stylesheets -->
<link rel="stylesheet" href="<?= base_url('assets/'); ?>owlcarousel/css/owl.carousel.min.css">
<link rel="stylesheet" href="<?= base_url('assets/'); ?>owlcarousel/css/owl.theme.default.min.css">
<?= $this->endSection() ?>
<?= $this->section('content-body') ?>
<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">

            <ol>
                <li><a href="index.html">Home</a></li>
                <li>Berita</li>

            </ol>
            <h2 class="mb-0 p-0">Headline Berita</h2>

        </div>
    </section><!-- End Breadcrumbs -->
    <!-- ======= Portfolio Details Section ======= -->
    <section id="portfolio-details" class="portfolio-details section-bg" style="padding-top: 5px;">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-12">
                    <div class="main-content">
                        <?php
                        if (ArtikeHeadline(10)) {
                        ?>
                            <div class="owl-carousel owl-theme">
                                <?php
                                foreach (ArtikeHeadline(10) as $keyOwl => $arOwl) { ?>
                                    <div class="item">

                                        <div class="carousel-item d-flex align-items-center" style="background-image: url('<?= base_url('assets/files/berita/') . $arOwl['ImageBerita']; ?>');">
                                            <div class="container" style="margin-top: 250px;border-radius:10px;background-color: rgba(0, 0, 0, 0.25);padding: 10px;margin-left: 14px;margin-right: 14px;">
                                                <div class="text-white" s>
                                                    <p><i class="ri-calendar-event-line"></i>
                                                        <?= TanggalIndo($arOwl['TanggalPublish']); ?></p>
                                                    <a href="<?= base_url('berita/detail/') . $arOwl['Slug']; ?>">
                                                        <h4 class="h4 text-white"><strong><?= $arOwl['Judul']; ?></strong></h4>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                            <div class="owl-theme">
                                <div class="owl-controls">
                                    <div class="custom-nav owl-nav"></div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <section id="portfolio-details" class="portfolio-details">
        <div class="container">
            <div class="section-title" style="text-align: left;">
                <h3><b>Berita</b></h3>
                <hr style="height: 2px;margin: 0;width: 50px;">
            </div>
            <div class="row gy-4">
                <div class="col-lg-8">

                    <div class="blog_left_sidebar">
                        <div class="row">
                            <?php
                            if ($berita) {
                                # code...
                                foreach ($berita as $key => $bg) { ?>
                                    <div class="col-md-6">

                                        <article class="blog_item">
                                            <div class="blog_item_img">
                                                <img class="card-img rounded-0 blog-img img-thumbnail" src="<?= base_url('assets/files/berita/') . $bg['ImageBerita']; ?>" alt="">
                                                <a href="#" class="blog_item_date">
                                                    <h3 style="color: #000000;">
                                                        <?= date("d", strtotime($bg['TanggalPublish'])); ?></h3>
                                                    <p style="color: #000000;">
                                                        <?= date("M", strtotime($bg['TanggalPublish'])); ?></p>
                                                </a>
                                            </div>
                                            <div class="blog_details">
                                                <a class="d-inline-block" href="<?= base_url('berita/detail/') . $bg['Slug']; ?>">
                                                    <h5 class="judul-konten"><?= $bg['Judul']; ?></h5>
                                                </a>
                                                <div class="text-konten">
                                                    <?= substr($bg['Konten'], 0, 300); ?></div>
                                                <ul class="blog-info-link">
                                                    <li><i class="ri-calendar-event-line"></i>
                                                        <?= TanggalIndo($bg['TanggalPublish']); ?>
                                                    </li>
                                                    <li><i class="ri-eye-line"></i> Dilihat <?= $bg['View']; ?></li>
                                                </ul>
                                                <div class="btn-berita">
                                                    <a href="<?= base_url('berita/detail/') . $bg['Slug']; ?>" class="btn-get-started scrollto btn-sm mt-3 " style="color: black;">Baca
                                                        Berita</a>
                                                </div>

                                            </div>
                                        </article>
                                    </div>

                                <?php  }
                                ?>
                                <?= $pager->links('default', 'blog_pager') ?>
                            <?php
                            } else {
                                echo '<div class="col-md-6">
                                        <article class="blog_item">
                                            <div class="blog_details">
                                                <a class="d-inline-block" href="#">
                                                    <h2><i>Tidak ada berita terpublish</i></h2>
                                                </a>
                                            </div>
                                        </article>
                                    </div>';
                            }
                            ?>
                        </div>
                    </div>

                </div>

                <div class="col-lg-4">
                    <div class="blog_right_sidebar">

                        <aside class="single_sidebar_widget popular_post_widget">
                            <h3 class="widget_title">Berita Terpopuler</h3>
                            <?php
                            if (ArtikeTerpopuler()) {
                                # code...
                                foreach (ArtikeTerpopuler() as $key => $ar) { ?>
                                    <div class="media post_item">
                                        <img src="<?= base_url('assets/files/berita/') . $ar['ImageBerita']; ?>" alt="post" class="img-fluid" style="width: 80px; height: 80px; object-fit: cover;">
                                        <div class="media-body">
                                            <a href="<?= base_url('berita/detail/') . $ar['Slug']; ?>">
                                                <h3 class="text-link"><?= $ar['Judul']; ?></h3>
                                            </a>
                                            <p> Dilihat <?= $ar['View']; ?> <span class="ri-eye-line "></span></p>
                                        </div>
                                    </div>
                            <?php    }
                            } else {
                                echo '<div class="media post_item">
                                        <div class="media-body">
                                            <a href="#" class="mt-0">
                                                <h3 class="text-link"><i>Tidak ada berita</i></h3>
                                            </a>
                                        </div>
                                    </div>';
                            }

                            ?>
                        </aside>
                        <!-- <aside class="single_sidebar_widget tag_cloud_widget">
                            <h4 class="widget_title">Tag Clouds</h4>
                            <ul class="list">
                                <li>
                                    <a href="#">project</a>
                                </li>
                                <li>
                                    <a href="#">love</a>
                                </li>
                                <li>
                                    <a href="#">technology</a>
                                </li>
                                <li>
                                    <a href="#">travel</a>
                                </li>
                                <li>
                                    <a href="#">restaurant</a>
                                </li>
                                <li>
                                    <a href="#">life style</a>
                                </li>
                                <li>
                                    <a href="#">design</a>
                                </li>
                                <li>
                                    <a href="#">illustration</a>
                                </li>
                            </ul>
                        </aside> -->

                    </div>
                </div>

            </div>

        </div>
    </section><!-- End Portfolio Details Section -->

</main><!-- End #main -->
<?= $this->endSection() ?>
<?= $this->section('content-js') ?>
<script src="<?= base_url('assets/'); ?>owlcarousel/owl.carousel.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.touchswipe/1.6.4/jquery.touchSwipe.min.js"></script>
<script>
    $(document).ready(function() {

        $('.main-content .owl-carousel').owlCarousel({
            // stagePadding: 10,
            loop: true,
            margin: 10,
            nav: true,
            items: 1,
            dots: false,
            autoplay: true,
            autoplayTimeout: 5000,
            autoplayHoverPause: true,
            navText: [
                '<i class="ri-skip-back-fill"></i>',
                '<i class="ri-skip-forward-fill"></i>'
            ],
            navContainer: '.main-content .custom-nav',

        });

    });
</script>
<?= $this->endSection() ?>
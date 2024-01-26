<?= $this->extend('_templates/_app') ?>
<?= $this->section('content-css') ?>
<link rel="stylesheet" href="<?= base_url(); ?>/assets/css/style-blog.css">
<style>
img.blog-img {
    min-height: 450px;
    object-fit: cover;
    width: 100%;
    object-position: center;
}

ul.blog-info-link {
    list-style: none;
    margin: 0;
    padding: 0;
}

.media {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-align: start;
    align-items: flex-start;
}

h3.text-link {
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
}

.text-link:hover {
    color: red;
}

@media (max-width: 992px) {
    .breadcrumbs {
        margin-top: 60px;
    }
}
</style>

<?= $this->endSection() ?>
<?= $this->section('content-body') ?>
<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">

            <ol>
                <li><a href="<?= base_url(); ?>">Home</a></li>
                <li><a href="<?= base_url('berita'); ?>">Artikel</a></li>
                <li><?= substr($data['Judul'], 0, 50) . ".."; ?></li>
            </ol>


        </div>
    </section><!-- End Breadcrumbs -->
    <!-- ======= Portfolio Details Section ======= -->
    <section id="portfolio-details" class="portfolio-details">
        <div class="container">

            <div class="row gy-4">

                <div class="col-lg-8">

                    <div class="single-post">
                        <div class="feature-img">
                            <img class="img-fluid blog-img img-thumbnail"
                                src="<?= base_url('assets/files/berita/') . $data['ImageBerita']; ?>" alt="">
                        </div>
                        <div class="blog_details">
                            <h2><?= $data['Judul']; ?>
                            </h2>
                            <ul class="blog-info-link mt-3 mb-4">
                                <li><a href="#"><i class="bx bxs-user"></i></i><?= $data['UCreate']; ?></a></li>
                                <li><a href="#"><i
                                            class="bx bxs-calendar"></i><?= TanggalIndo($data['TanggalPublish']); ?></a>
                                </li>
                            </ul>
                            <p class="excert">
                                <?= nl2br($data['Konten']); ?>
                            </p>
                        </div>
                    </div>

                </div>

                <div class="col-lg-4">
                    <div class="blog_right_sidebar">

                        <aside class="single_sidebar_widget popular_post_widget">
                            <h3 class="widget_title">Post Terbaru</h3>
                            <?php
                            foreach (ArtikeTerbaru(5) as $key => $ar) { ?>
                            <div class="media post_item">
                                <img src="<?= base_url('assets/files/berita/') . $ar['ImageBerita']; ?>" alt="post"
                                    class="img-fluid" style="width: 80px; height: 80px; object-fit: cover;">
                                <div class="media-body">
                                    <a href="<?= base_url('berita/detail/') . $ar['Slug']; ?>">
                                        <h3 class="text-link"><?= $ar['Judul']; ?></h3>
                                    </a>
                                    <p><i class="ri-calendar-event-line"></i>
                                        <?= TanggalIndo($ar['TanggalPublish']); ?></span></p>
                                </div>
                            </div>

                            <?php    }
                            ?>

                        </aside>
                    </div>
                </div>

            </div>

        </div>
    </section><!-- End Portfolio Details Section -->

</main><!-- End #main -->
<?= $this->endSection() ?>
<?= $this->section('content-js') ?>

<?= $this->endSection() ?>
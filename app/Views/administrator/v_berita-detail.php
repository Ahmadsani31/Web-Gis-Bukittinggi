<?= $this->extend('_templates/_app') ?>
<?= $this->section('content-css') ?>
<link rel="stylesheet" href="<?= base_url(); ?>/assets/css/style-blog.css">
<style>
    img.blog-img {
        max-height: 350px;
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

            <div class="row gy-4 d-flex justify-content-center">
                <?php
                if ($data['Publish'] == 'N') {
                    echo '<div class="alert alert-warning" role="alert">
                            Berita Sudah Tidak Aktif /  Tidak Publish
                        </div>';
                }
                if ($data['TanggalPublish'] > date('Y-m-d')) {
                    echo '<div class="alert alert-info" role="alert">
                            Berita belum publish, berika akan dipublish tanggal ' . TanggalIndo($data['TanggalPublish']) . '
                        </div>';
                }
                ?>

                <div class="col-lg-8">
                    <div class="single-post">
                        <div class="feature-img">
                            <img class="img-fluid blog-img img-thumbnail" src="<?= base_url('assets/files/berita/') . $data['ImageBerita']; ?>" alt="">
                        </div>
                        <div class="blog_details">
                            <h2><?= $data['Judul']; ?>
                            </h2>
                            <ul class="blog-info-link mt-3 mb-4">
                                <li><a href="#"><i class="far fa-user"></i><?= $data['UCreate']; ?></a></li>
                                <li><a href="#"><i class="far fa-comments"></i><?= TanggalIndo($data['TanggalPublish']); ?></a>
                                </li>
                            </ul>
                            <p class="excert">
                                <?= nl2br($data['Konten']); ?>
                            </p>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </section><!-- End Portfolio Details Section -->

</main><!-- End #main -->
<?= $this->endSection() ?>
<?= $this->section('content-js') ?>

<?= $this->endSection() ?>
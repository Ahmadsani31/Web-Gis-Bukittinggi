<?= $this->extend('_templates/_app') ?>
<?= $this->section('content-css') ?>
<link rel="stylesheet" href="<?= base_url(); ?>/assets/css/style-dashboard.css">
<?= $this->endSection() ?>
<?= $this->section('content-body') ?>


<!-- ======= Hero Section ======= -->
<section class="why-us section-bg" style="margin-top: 40px; padding-bottom: 37px;">
    <div class="container-fluid aos-init aos-animate" id="kecil" data-aos="fade-up" style="display: none;">

        <div class="row">

            <div class="col align-items-stretchimg aos-init aos-animate" data-aos="zoom-in" data-aos-delay="150">
                <img src="<?= base_url('assets/img/Logo_Kota_Bukittinggi.png'); ?>" alt="" class="img-surat" style="float: right;">
            </div>
            <div class="col align-items-stretchimg aos-init aos-animate" data-aos="zoom-in" data-aos-delay="150">
                <img src="<?= base_url('assets/img/LOGO-PU.png'); ?>" alt="" class="img-surat" style="float:left;">
            </div>
            <div class="col-lg-12 d-flex flex-column justify-content-center align-items-stretch  text-center">

                <div class="content">
                    <h1 class="font-surat m-0"><strong>PEMERINTAH KOTA BUKITTINGGI</strong></h1>
                    <h1 class="font-surat m-0"><strong>DINAS PEKERJAAN UMUM DAN PENATAAN RUANG</strong></h1>
                    <h5 class="font-surat-footer m-0">
                        Jln. Ombilin No.169 Belakang Balok Bukittingi Telp.(0752)22214
                    </h5>
                </div>


            </div>



        </div>
        <!-- <hr class="garis-dua"> -->
    </div>
    <div class="container-fluid aos-init aos-animate" id="besar" data-aos="fade-up">

        <div class="row">

            <div class="col-lg-3 d-flex justify-content-end align-items-center aos-init aos-animate" data-aos="zoom-in" data-aos-delay="150">
                <img src="<?= base_url('assets/img/Logo_Kota_Bukittinggi.png'); ?>" alt="" class="img-surat">
                <img src="<?= base_url('assets/img/LOGO-PU.png'); ?>" alt="" class="img-surat" style="margin-left: 20px;">
            </div>

            <div class="col-lg-9 d-flex flex-column justify-content-center align-items-stretch">
                <h1 class="font-surat m-0"><strong>PEMERINTAH KOTA BUKITTINGGI</strong></h1>
                <h1 class="font-surat m-0"><strong>DINAS PEKERJAAN UMUM DAN PENATAAN RUANG</strong></h1>
                <h5 class="font-surat-footer m-0">
                    Jln. Ombilin No.169 Belakang Balok Bukittingi Telp.(0752)22214
                </h5>
            </div>
        </div>
        <!-- <hr class="garis-dua"> -->
    </div>
</section>
<section id="hero" class="d-flex align-items-center">

    <div class="container">
        <div class="row">
            <div class="col-lg-6 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">
                <h1>Selamat Datang </h1>
                <h1>Di WebGIS Database Drainase Perkotaan Kota Bukittinggi</h1>
                <h2>Kelola dan Lihat data Drainase Kota Bukittinggi Dalam Bentuk Digital Map Dengan Mudah dan Realtime
                </h2>
                <div class="d-flex justify-content-center justify-content-lg-start">
                    <a href="<?= base_url('peta#map-drainase'); ?>" class="btn-get-started scrollto">Lihat Peta
                        Drainase</a>

                </div>
            </div>
            <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="200">
                <img src="<?= base_url(); ?>/assets/img/bg-bukit-new.png" class="img-fluid animated" alt="img-bukittinggi">
            </div>

        </div>
    </div>

</section><!-- End Hero -->

<main id="main">
    <section class="skills ">
        <div class="container aos-init aos-animate" data-aos="fade-up">

            <div class="row">
                <div class="col-lg-3 d-flex align-items-center aos-init aos-animate" data-aos="fade-right" data-aos-delay="100">
                    <img src="assets/img/pak_wali.png" class="img-fluid " alt="foto-wako">
                </div>
                <div class="col-lg-9 pt-4 pt-lg-0 content aos-init aos-animate" data-aos="fade-left" data-aos-delay="100">
                    <h3 class="speech" style="color: #000;">SAMBUTAN WALIKOTA BUKITTINGGI</h3>
                    <H3 style="padding-left: 25px;margin-top: 25px; color: #000;">
                        H. Erman Safar, S.H.
                    </H3>

                    <div class="content mt-3" style="padding-left: 25px;">
                        <p>Kota Bukittinggi dalam Gerakan Menuju Kota Cerdas (Smart City) membuktikan memiliki komitmen
                            yang kuat untuk menjalankan pemerintahan dengan pendekatan berbasis inovasi dan teknologi.
                            Smart city ini merupakan kolaborasi antara gagasan dan aksi, yang bertujuan dalam rangka
                            meningkatkan pelayanan publik. Sebagai bentuk aksi nyata, maka telah diluncurkan aplikasi
                            WebGIS database drainase perkotaan Kota Bukittinggi sebagai salah satu produk dari
                            peningkatan layanan publik oleh Dinas PUPR Kota Bukittinggi yang berkolaborasi dengan Dinas
                            KOMINFO Kota Bukittinggi, di mana masyarakat Kota Bukittinggi dapat mengakses data dan
                            informasi terkait dengan drainase. Aplikasi ini juga bertujuan untuk meningkatkan
                            keterbukaan dan transparansi informasi dari pemerintah ke masyarakat. (Hanya contoh,
                            digunakan hanya untuk pengembangan sistem).</p>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <section id="" class="about" style="background-color: #3d4d6a;color: #fff;">
        <div class="container aos-init aos-animate" data-aos="fade-up">

            <div class="section-title">
                <h3 class="text-h3">Total Panjang Ruas Drainase Kota Bukittinggi</h3>
                <h1 class="text-h1" id=""><?= $panjangDrainase; ?> Meter</h1>
                <p>Bedasarkan Hasil Survei 2023 | Identitas Rekomendasi dari BPS No : V-23.1375.002</p>
            </div>
            <div class="d-flex align-items-center justify-content-center">
                <a href="<?= base_url('peta#tabel-drainase'); ?>" class="btn-get-started scrollto">Lihat Data
                    Drainase</a>

            </div>
        </div>
    </section>
    <!-- ======= About Us Section ======= -->
    <section id="" class="team">
        <div class="container aos-init aos-animate" data-aos="fade-up">

            <div class="section-title">
                <h2 style="color: #000;">Berita Terbaru</h2>
                <p>Lihat dan Baca Berita Terbaru Seputar Drainase Kota Bukittinggi</p>
            </div>

            <div class="row">
                <?php
                if (ArtikeTerbaru(2)) {
                    # code...
                    foreach (ArtikeTerbaru(2) as $key => $ar) { ?>
                        <div class="col-lg-12  mb-5">
                            <div class="member d-flex align-items-start aos-init aos-animate" data-aos="zoom-in" data-aos-delay="100">
                                <img src="<?= base_url('assets/files/berita/') . $ar['ImageBerita']; ?>" alt="post" class="img-fluid img-artikel">
                                <div class="member-info">
                                    <p> <?= TanggalIndo($ar['TanggalPublish']); ?></p>
                                    <h4 style="color: #000;"><?= $ar['Judul']; ?></h4>
                                    <div class="dashboard-konten"><?= nl2br($ar['Konten']); ?></div>
                                    <div class="d-flex mt-2">
                                        <a href="<?= base_url('berita/detail/') . $ar['Slug']; ?>" class="btn-get-started scrollto btn-sm"> Baca Berita</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php }
                } else {
                    echo '<div class="col-lg-12  mb-5">
                            <div class="member d-flex align-items-start aos-init aos-animate" data-aos="zoom-in"
                            data-aos-delay="100">
                                        <div class="member-info">
                                            <h4><i>Tidak ada berita terpublish</i></h4>
                                
                                        </div>
                                    </div>
                                </div>';
                }
                ?>
                <div class="d-flex mt-4 justify-content-center justify-content">
                    <a href="<?= base_url('berita'); ?>" class="btn-get-started scrollto"> Lihat Semua Berita </a>
                </div>

            </div>

        </div>
    </section>

    <section id="" class="contact" style="background-color: #3d4d6a;color: #fff;">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2 style="color: #fff;">Layanan Pengaduan</h2>
                <p>Kirimkan Saran dan Masukan anda terhadap Drainase Kota Bukittinggi. Saran dan Masukan Anda Akan
                    Bermanfaat Bagi Pengembangan Kota Bukittinggi</p>
            </div>

            <div class="row">

                <div class="col-lg-5 d-flex align-items-stretch">
                    <div class="info">
                        <div class="address">
                            <i class="bi bi-geo-alt"></i>
                            <h4>Kantor:</h4>
                            <p>Dinas PUPR Kota Bukittinggi</p>
                        </div>

                        <div class="email">
                            <i class="bi bi-envelope"></i>
                            <h4>Email:</h4>
                            <p>Dinas PUPR Kota Bukittinggi</p>
                        </div>

                        <div class="phone">
                            <i class="bi bi-phone"></i>
                            <h4>Telp:</h4>
                            <p>(0752) 22214 </p>
                        </div>


                        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d63836.13401415715!2d100.371152!3d-0.314077!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2fd539a0d1d21f1f%3A0x8da315c6e4c08a9d!2sDinas%20Pekerjaan%20Umum%20dan%20Penataan%20Ruang%20(PUPR)%20Kota%20Bukittinggi!5e0!3m2!1sid!2sid!4v1697532040877!5m2!1sid!2sid" frameborder="0" style="border:0; width: 100%; height: 500px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

                    </div>

                </div>

                <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch" style="color: black;">
                    <form action="<?= base_url('simpan/pengaduan'); ?>" method="post" onsubmit="return false" role="form" id="form-pengaduan" class="php-email-form" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                        <h3><b>Formulir Pengaduan</b></h3>
                        <p style="color: black;">Silahkan lengkapi Formulir dan Pengaduan Anda</p>
                        <input type="hidden" name="PengaduanID" id="PengaduanID" value="0">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="name">Nama</label>
                                <input type="text" name="Nama" class="form-control" id="Nama" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="name">Email</label>
                                <input type="email" class="form-control" name="Email" id="Email" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="name">Handphone</label>
                                <input type="number" name="Handphone" class="form-control" id="Handphone" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="13" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="name">No KTP</label>
                                <input type="number" class="form-control" name="KTP" id="KTP" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="18" required>
                            </div>
                            <div class="form-group col-md-6 ">
                                <label for="name">Alamat Lokasi Kejadian</label>
                                <select name="KecamatanID" class="form-control" id="KecamatanID" required>
                                    <option value="">Pilih Kecamatan</option>
                                    <?= OptionDaerah('kecamatan', '1375', ''); ?>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="name">&nbsp;</label>
                                <select name="KelurahanID" class="form-control" id="KelurahanID" required>
                                    <option value="">Pilih Kelurahan</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name">Detail Lokasi</label>
                            <input type="text" class="form-control" name="Lokasi" id="Lokasi" required>
                        </div>
                        <div class="form-group">
                            <label for="name">Deskripsi Pengaduan</label>
                            <textarea class="form-control" name="Keterangan" rows="10" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="name">Foto</label>
                            <input type="file" class="form-control" name="ImgPengaduan" id="ImgPengaduan" accept="image/png, image/jpg, image/jpeg" required>
                        </div>
                        <!-- <div class="my-3">
                            <div class="loading">Loading</div>
                            <div class="error-message"></div>
                            <div class="sent-message">Terima kasih atas saran dan masukanya.</div>
                        </div> -->
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary mb-4">Kirimkan Pengaduan</button>
                            <a href="<?= base_url('data-pengaduan'); ?>" class="btn btn-warning mb-4" style="background-color:orange;padding: 11px 34px;    border-radius: 25px;">Lihat
                                Daftar Pengaduan</a>
                        </div>
                    </form>
                </div>

            </div>

        </div>
    </section><!-- End Contact Section -->




</main><!-- End #main -->
<?= $this->endSection() ?>
<?= $this->section('content-js') ?>

<script>
    function clearOptions(id) {
        $('#' + id).empty().trigger('change');
    }
    $("#KecamatanID").select2({
        ajax: {
            url: '<?= base_url() ?>select2/getdatakec/1375',
            type: "post",
            dataType: 'json',
            delay: 200,
            data: function(params) {
                return {
                    searchTerm: params.term
                };
            },
            processResults: function(response) {
                return {
                    results: response
                };
            },
            cache: true
        }
    });

    // Kelurahan
    $("#KecamatanID").change(function() {
        var id_kac = $("#KecamatanID").val();
        $("#KelurahanID").select2({
            ajax: {
                url: '<?= base_url() ?>select2/getdatakel/' + id_kac,
                type: "post",
                dataType: 'json',
                delay: 200,
                data: function(params) {
                    return {
                        searchTerm: params.term
                    };
                },
                processResults: function(response) {
                    return {
                        results: response
                    };
                },
                cache: true
            }
        });
    });
</script>
<?= $this->endSection() ?>
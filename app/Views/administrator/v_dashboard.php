<?= $this->extend('administrator/_templates/_app') ?>
<?= $this->section('content-css') ?>

<?= $this->endSection() ?>
<?= $this->section('content-body') ?>
<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <div class="main-body">
            <?php
            if (session()->get('s_Level') == '01') {
            ?>
                <div class="page-wrapper">
                    <div class="page-header card mb-0">
                        <div class="row align-items-end">
                            <div class="col-lg-8">
                                <div class="page-header-title">
                                    <i class="icofont icofont-layout bg-c-blue"></i>
                                    <div class="d-flex align-items-center">
                                        <h4>Admin Dashboard</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="page-header-breadcrumb">
                                    <ul class="breadcrumb-title">
                                        <li class="breadcrumb-item">
                                            <a href="index.html">
                                                <i class="icofont icofont-home"></i>
                                            </a>
                                        </li>
                                        <li class="breadcrumb-item"><a href="#!">Dashboard</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="page-body">
                        <div class="row">
                            <!-- card1 start -->
                            <div class="col-md-6 col-xl-3">
                                <div class="card widget-card-1">
                                    <div class="card-block-small">
                                        <i class="icofont icofont-triangle bg-c-green card1-icon"></i>
                                        <span class="text-c-green f-w-600">Drainase</span>
                                        <h4><?= $drainase; ?></h4>
                                        <div>
                                            <a href="<?= base_url('admin/drainase'); ?>" class="f-left m-t-10 text-muted">
                                                <i class="text-c-green f-16 icofont icofont-match-review m-r-10"></i>Lihat
                                                data
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- card1 end -->
                            <!-- card1 start -->

                            <div class="col-md-6 col-xl-3">
                                <div class="card widget-card-1">
                                    <div class="card-block-small">
                                        <i class="icofont icofont-hill bg-c-blue card1-icon"></i>
                                        <span class="text-c-yellow f-w-600">Layer</span>
                                        <h4><?= $batas; ?></h4>
                                        <div>
                                            <a href="<?= base_url('admin/layer'); ?>" class="f-left m-t-10 text-muted">
                                                <i class="text-c-green f-16 icofont icofont-match-review m-r-10"></i>Lihat
                                                data
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- card1 start -->
                            <div class="col-md-12 col-xl-3">
                                <div class="card widget-card-1">
                                    <div class="card-block-small">
                                        <i class="icofont icofont-bullhorn bg-c-pink card1-icon"></i>
                                        <span class="text-c-pink f-w-600">Jumlah Pengaduan</span>
                                        <h4><?= $pengaduan; ?> pengaduan</h4>
                                        <div>
                                            <a href="<?= base_url('admin/pengaduan'); ?>" class="f-left m-t-10 text-muted">
                                                <i class="text-c-blue f-16 icofont icofont-match-review m-r-10"></i>
                                                Lihat data
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-xl-3">
                                <div class="card widget-card-1">
                                    <div class="card-block-small">
                                        <i class="icofont icofont-attachment bg-c-blue card1-icon"></i>
                                        <span class="text-c-blue f-w-600">Jumlah Artike / Berita</span>
                                        <h4><?= $berita; ?> berita</h4>
                                        <div>
                                            <a href="<?= base_url('admin/berita'); ?>" class="f-left m-t-10 text-muted">
                                                <i class="text-c-blue f-16 icofont icofont-match-review m-r-10"></i>
                                                Lihat data
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- card1 end -->

                            <div class="col-md-12 col-xl-4">
                                <div class="card p-4">
                                    <div id="containerC" style="height: 517px; overflow: hidden; text-align: left;"></div>
                                </div>

                            </div>
                            <div class="col-md-12 col-xl-4">
                                <div class="card p-4">
                                    <div id="containerD" style="height: 517px; overflow: hidden; text-align: left;"></div>
                                </div>

                            </div>
                            <div class="col-md-12 col-xl-4">
                                <div class="card p-4">
                                    <div id="containerF" style="height: 517px; overflow: hidden; text-align: left;"></div>
                                </div>

                            </div>
                            <!-- Email Sent End -->
                            <!-- Data widget start -->
                        </div>
                    </div>
                </div>
            <?php
            } else {

            ?>
                <div class="page-wrapper">
                    <div class="page-header card mb-0">
                        <div class="row align-items-end">
                            <div class="col-lg-8">
                                <div class="page-header-title">
                                    <i class="icofont icofont-layout bg-c-blue"></i>
                                    <div class="d-flex align-items-center">
                                        <h4>Admin Dashboard</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="page-header-breadcrumb">
                                    <ul class="breadcrumb-title">
                                        <li class="breadcrumb-item">
                                            <a href="index.html">
                                                <i class="icofont icofont-home"></i>
                                            </a>
                                        </li>
                                        <li class="breadcrumb-item"><a href="#!">Dashboard</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="page-body">
                        <div class="row">
                            <!-- card1 start -->
                            <div class="col-md-12 col-xl-4">
                                <div class="card widget-card-1">
                                    <div class="card-block-small">
                                        <i class="icofont icofont-attachment bg-c-blue card1-icon"></i>
                                        <span class="text-c-blue f-w-600">Jumlah Artike / Berita</span>
                                        <h4><?= $berita; ?> berita</h4>
                                        <div>
                                            <a href="<?= base_url('admin/berita'); ?>" class="f-left m-t-10 text-muted">
                                                <i class="text-c-blue f-16 icofont icofont-match-review m-r-10"></i>
                                                Lihat data
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-xl-4">
                                <div class="card widget-card-1">
                                    <div class="card-block-small">
                                        <i class="icofont icofont-attachment bg-c-green card1-icon"></i>
                                        <span class="text-c-green f-w-600">Berita Aktif</span>
                                        <h4><?= $beritaAktif; ?> berita</h4>
                                        <div>
                                            <a href="<?= base_url('admin/berita'); ?>" class="f-left m-t-10 text-muted">
                                                <i class="text-c-green f-16 icofont icofont-match-review m-r-10"></i>
                                                Lihat data
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-xl-4">
                                <div class="card widget-card-1">
                                    <div class="card-block-small">
                                        <i class="icofont icofont-attachment bg-c-orenge card1-icon"></i>
                                        <span class="text-c-orenge f-w-600">Berita Tidak Aktif</span>
                                        <h4><?= $beritaTidakAktif; ?> berita</h4>
                                        <div>
                                            <a href="<?= base_url('admin/berita'); ?>" class="f-left m-t-10 text-muted">
                                                <i class="text-c-orenge f-16 icofont icofont-match-review m-r-10"></i>
                                                Lihat data
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-3">
                                <div class="card widget-card-1">
                                    <div class="card-block-small">
                                        <i class="icofont icofont-bullhorn bg-c-blue card1-icon"></i>
                                        <span class="text-c-blue f-w-600">Jumlah Pengaduan</span>
                                        <h4><?= $pengaduan; ?> pengaduan</h4>
                                        <div>
                                            <a href="<?= base_url('admin/pengaduan'); ?>" class="f-left m-t-10 text-muted">
                                                <i class="text-c-blue f-16 icofont icofont-match-review m-r-10"></i>
                                                Lihat data
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-3">
                                <div class="card widget-card-1">
                                    <div class="card-block-small">
                                        <i class="icofont icofont-bullhorn bg-c-green card1-icon"></i>
                                        <span class="text-c-green f-w-600">Jumlah Pengaduan Proses Pengajuan</span>
                                        <h4><?= $pengaduanPengajuan; ?> pengaduan</h4>
                                        <div>
                                            <a href="<?= base_url('admin/pengaduan'); ?>" class="f-left m-t-10 text-muted">
                                                <i class="text-c-green f-16 icofont icofont-match-review m-r-10"></i>
                                                Lihat data
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-3">
                                <div class="card widget-card-1">
                                    <div class="card-block-small">
                                        <i class="icofont icofont-bullhorn bg-c-green card1-icon"></i>
                                        <span class="text-c-green f-w-600">Jumlah Pengaduan Disetujui</span>
                                        <h4><?= $pengaduanTerima; ?> pengaduan</h4>
                                        <div>
                                            <a href="<?= base_url('admin/pengaduan'); ?>" class="f-left m-t-10 text-muted">
                                                <i class="text-c-green f-16 icofont icofont-match-review m-r-10"></i>
                                                Lihat data
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-3">
                                <div class="card widget-card-1">
                                    <div class="card-block-small">
                                        <i class="icofont icofont-bullhorn bg-c-orenge card1-icon"></i>
                                        <span class="text-c-orenge f-w-600">Jumlah Pengaduan Ditolak</span>
                                        <h4><?= $pengaduanTolak; ?> pengaduan</h4>
                                        <div>
                                            <a href="<?= base_url('admin/pengaduan'); ?>" class="f-left m-t-10 text-muted">
                                                <i class="text-c-orenge f-16 icofont icofont-match-review m-r-10"></i>
                                                Lihat data
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php

            }
            ?>
            <div id="styleSelector">

            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
<?= $this->section('content-js') ?>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script>
    dataGrafik();

    function dataGrafik() {
        var colors = ["#36a2eb", "#fcdc3c", "#3cfcef", "#3c5cfc", "#fc3cbc"];
        let formGrafik = new FormData();

        formGrafik.append("KecamatanID", '');
        formGrafik.append("KelurahanID", '');
        formGrafik.append("Kondisi", '');
        formGrafik.append("TipeSalur", '');
        formGrafik.append("Konstruksi", '');

        //load grafik kondisi
        $.ajax({
            type: "POST",
            url: "<?= base_url('peta/data-grafik'); ?>",
            data: formGrafik,
            cache: false,
            processData: false,
            contentType: false,
            dataType: "json",
            success: function(response) {

                var ArrSedimen = [];
                var dSedimen = response.SedimentGrafik;
                dSedimen.forEach((val, index) => {
                    ArrSedimen.push({
                        name: val.name,
                        y: parseFloat(val.y)
                    });
                });
                Highcharts.chart("containerC", {
                    chart: {
                        plotBackgroundColor: null,
                        plotBorderWidth: 0,
                        plotShadow: false,
                    },
                    title: {
                        text: "Kondisi<br>Drainase",
                        align: "center",
                        verticalAlign: "middle",
                        y: 0,
                        x: 10,
                    },
                    tooltip: {
                        pointFormat: "{series.name}: <b>{point.y:,.f} Meter",
                    },
                    accessibility: {
                        point: {
                            valueSuffix: "%",
                        },
                    },
                    plotOptions: {
                        pie: {
                            colors: colors,
                            allowPointSelect: true,
                            cursor: "pointer",
                            showInLegend: true,
                            dataLabels: {
                                enabled: true,
                                style: {
                                    fontWeight: "bold",
                                },
                            },
                        },
                    },
                    series: [{
                        name: "Status",
                        type: "pie",
                        innerSize: "50%",
                        colorByPoint: true,
                        data: response.KondisiGrafik,
                    }, ],
                });

                Highcharts.chart("containerD", {
                    chart: {
                        plotBackgroundColor: null,
                        plotBorderWidth: 0,
                        plotShadow: false,
                    },
                    title: {
                        text: "Jenis<br>Drainase",
                        align: "center",
                        verticalAlign: "middle",
                        y: 0,
                        x: 10,
                    },
                    tooltip: {
                        pointFormat: "{series.name}: <b>{point.y:,.f} Meter</b>",
                    },
                    accessibility: {
                        point: {
                            valueSuffix: "%",
                        },
                    },
                    plotOptions: {
                        pie: {
                            colors: colors,
                            allowPointSelect: true,
                            cursor: "pointer",
                            showInLegend: true,
                            dataLabels: {
                                enabled: true,
                                style: {
                                    fontWeight: "bold",
                                },
                            },
                        },
                    },
                    series: [{
                        name: "Status",
                        colorByPoint: true,
                        type: "pie",
                        innerSize: "50%",
                        data: response.KontruksiGrafik,
                    }, ],
                });

                Highcharts.chart("containerF", {
                    chart: {
                        plotBackgroundColor: null,
                        plotBorderWidth: 0,
                        plotShadow: false,
                    },
                    title: {
                        text: "Sediment<br>Drainase",
                        // align: "center",
                        verticalAlign: "middle",
                        y: 0,
                    },
                    tooltip: {
                        pointFormat: "{series.name}: <b>{point.y:,.2f} Meter</b>",
                    },
                    accessibility: {
                        point: {
                            valueSuffix: "%",
                        },
                    },
                    plotOptions: {
                        pie: {
                            colors: colors,
                            allowPointSelect: true,
                            cursor: "pointer",
                            showInLegend: true,
                            dataLabels: {
                                enabled: true,
                                style: {
                                    fontWeight: "bold",
                                },
                            },
                        },
                    },
                    series: [{
                        name: "Status",
                        colorByPoint: true,
                        type: "pie",
                        innerSize: "50%",
                        data: ArrSedimen,
                    }, ],
                });
            },
            failure: function(response) {
                alert(response.responseText);
            },
            error: function(response) {
                alert(response.responseText);
            },
        });
    }
</script>
<?= $this->endSection() ?>
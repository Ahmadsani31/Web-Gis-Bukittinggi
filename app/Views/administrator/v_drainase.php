<?= $this->extend('administrator/_templates/_app') ?>
<?= $this->section('content-css') ?>
<style>
    table {
        margin: 0 auto;
        width: 100%;
        clear: both;
        border-collapse: collapse;
        table-layout: fixed;
        word-wrap: break-word;
    }
</style>
<?= $this->endSection() ?>
<?= $this->section('content-body') ?>
<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">

                <div class="main-body">
                    <div class="page-wrapper">
                        <!-- Page-header start -->
                        <div class="page-header card">
                            <div class="row align-items-end">
                                <div class="col-lg-8">
                                    <div class="page-header-title">
                                        <i class="icofont icofont-table bg-c-blue"></i>
                                        <div class="d-inline">
                                            <h4>Drainase</h4>
                                            <span>Kelola data drainase lingkungan kota bukittingi</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="page-header-breadcrumb">
                                        <button type="button" class="btn btn-out btn-info btn-square modal-open-cre mr-1" id="import-layer-drainase" judul="import layer" tooltip="Import layer drainase Full">Import Layer Drainase</button>
                                        <a href="<?= base_url('admin/drainase/edit/0') ?>" class="btn btn-out btn-primary btn-square" tooltip="Tambah drainase per-sub">
                                            Tambah Drainase
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Page-header end -->

                        <!-- Page-body start -->
                        <div class="page-body">

                            <div class="card">

                                <div class="card-header pb-0">
                                    <?php if (session()->getFlashdata('success')) { ?>
                                        <div class="alert alert-success">
                                            <?php echo session()->getFlashdata('success'); ?>
                                        </div>
                                    <?php } ?>

                                    <form action="<?= base_url('admin/drainase/export-excel'); ?>" id="form-peta" method="post">
                                        <?= csrf_field(); ?>
                                        <div class="row">
                                            <div class="mb-2 col-md-4">
                                                <div class="form-group mb-0">
                                                    <select name="Tahun" id="Tahun" class="form-control mb-0">
                                                        <?php
                                                        for ($x = 2023; $x <= date('Y'); $x++) {
                                                            $sel = '';
                                                            if ($x == date('Y')) {
                                                                $sel = 'selected';
                                                            }
                                                            echo '<option value="' . $x . '" ' . $sel . '>' . $x . '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="mb-2 col-md-4">
                                                <select name="KecamatanID" class="form-control" id="KecamatanID">
                                                    <option value="">Pilih Kecamatan</option>
                                                </select>
                                            </div>
                                            <div class="mb-2 col-md-4">
                                                <select name="KelurahanID" class="form-control" id="KelurahanID">
                                                    <option value="">Pilih Kelurahan</option>
                                                </select>
                                            </div>
                                            <div class="mb-2 col-md-4">
                                                <select name="Kondisi" class="form-control" id="Kondisi">
                                                    <option value="">Pilih Kondisi</option>
                                                    <option value="Baik">Baik</option>
                                                    <option value="Sedang">Sedang</option>
                                                </select>
                                            </div>
                                            <div class="mb-2 col-md-4">
                                                <select name="JenisSaluran" class="form-control" id="JenisSaluran">
                                                    <option value="">Pilih Tipe Saluran</option>
                                                    <option value="Primer">Primer</option>
                                                    <option value="Sekunder">Sekunder</option>
                                                </select>
                                            </div>
                                            <div class="mb-2 col-md-4">
                                                <select name="Konstruksi" class="form-control" id="Konstruksi">
                                                    <option value="">Pilih Konstruksi</option>
                                                    <option value="Beton">Beton</option>
                                                    <option value="Pasang Batu">Pasang Batu</option>
                                                </select>
                                            </div>

                                            <div class="mb-2 col-md-12">
                                                <button type="submit" class="btn btn-block btn-primary" style="width: 100%;" tooltip="Export data ke Excel"> Export Data Ke
                                                    File Excel</button>
                                            </div>

                                        </div>
                                    </form>
                                </div>

                                <div class="table-responsive p-4">
                                    <table class="table" id="DTable">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No</th>
                                                <th class="text-center">Kode</th>
                                                <th class="text-center">Nama Jalan</th>
                                                <th class="text-center">Daerah</th>
                                                <th class="text-center">Panjang</th>
                                                <th class="text-center">Lebar</th>
                                                <th class="text-center">Tinggi</th>
                                                <th class="text-center">Saluran</th>
                                                <th class="text-center">Penampang</th>
                                                <th class="text-center">Foto</th>
                                                <th class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- Page-body end -->
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('content-js') ?>
<script type="text/javascript">
    var DTable;

    $(document).ready(function() {

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

        $("#Tahun").change(function() {
            DTable.ajax.reload(null, false);
        });

        $("#KecamatanID").change(function() {
            DTable.ajax.reload(null, false);
        });

        $("#KelurahanID").change(function() {
            DTable.ajax.reload(null, false);
        });

        $("#Kondisi").change(function() {
            DTable.ajax.reload(null, false);
        });

        $("#JenisSaluran").change(function() {
            DTable.ajax.reload(null, false);
        });

        $("#Konstruksi").change(function() {
            DTable.ajax.reload(null, false);
        });


        DTable = $('#DTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "<?= base_url() ?>datatable/server-side",
                type: "POST",
                data: function(d) {
                    d.datatable = 'drainase';
                    d.tahun = $("#Tahun").val();
                    d.kec = $("#KecamatanID").val();
                    d.kel = $("#KelurahanID").val();
                    d.kondisi = $("#Kondisi").val();
                    d.type = $("#JenisSaluran").val();
                    d.konst = $("#Konstruksi").val();
                },
            },
            order: [],
            columnDefs: [{
                    className: "align-middle",
                    targets: ['_all'],
                }, {
                    className: "text-center",
                    targets: [-1, 0, 1, 2, 4, 5, 6, 7, 8, 9],
                }, {
                    width: '25px',
                    targets: 0
                }, //step 2, column 1 out of 4
                {
                    width: '100px',
                    targets: 1
                } //step 2, column 3 out of 4
            ],
            columns: [{
                data: 'No',
                orderable: false
            }, {
                data: 'KodeDrain'
            }, {
                data: 'NamaJalan'
            }, {
                data: 'Daerah'
            }, {
                data: 'Panjang'
            }, {
                data: 'Lebar'
            }, {
                data: 'Tinggi'
            }, {
                data: 'PosisiSaluran'
            }, {
                data: 'Penampang'
            }, {
                data: 'Image'
            }, {
                data: 'Button'
            }]
        });
    });

    //nomor otomatis colomn 0
</script>
<?= $this->endSection() ?>
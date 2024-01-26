<?= $this->extend('administrator/_templates/_app') ?>
<?= $this->section('content-css') ?>

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
                                            <h4>Layer</h4>
                                            <span>Kelola data layer kota bukittinggi</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="page-header-breadcrumb">
                                        <!-- <button class="btn btn-sm btn-out btn-primary btn-square modal-open-cre"
                                            id="distrik" distrikid="0">Tambah</button> -->
                                        <button type="button" class="btn btn-out btn-primary btn-square modal-open-cre mr-1" id="layer" layerid='0' judul="Tambah layer" tooltip="Tambah layer">Tambah
                                            Layer</button>

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
                                <div class="table-responsive p-4">
                                    <table class="table" id="DTable">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tahun</th>
                                                <th>Nama</th>
                                                <th>Keterangan</th>
                                                <th>Posisi</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
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

        $("#Tahun").change(function() {
            DTable.ajax.reload(null, false);
        });

        DTable = $('#DTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "<?= base_url() ?>datatable/server-side",
                type: "POST",
                data: function(d) {
                    d.datatable = 'layer';
                    d.tahun = $("#Tahun").val();
                },
            },
            order: [],
            columnDefs: [{
                className: "align-middle",
                targets: ['_all'],
            }, {
                className: "text-center",
                targets: 5,
            }],
            columns: [{
                data: 'No',
                orderable: false
            }, {
                data: 'Tahun'
            }, {
                data: 'Nama'
            }, {
                data: 'Keterangan'
            }, {
                data: 'Position'
            }, {
                data: 'Status'
            }, {
                data: 'Button'
            }]
        });
    });

    //nomor otomatis colomn 0
</script>
<?= $this->endSection() ?>
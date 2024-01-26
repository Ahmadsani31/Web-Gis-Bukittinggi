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
                                            <h4>Genangan Air</h4>
                                            <span>Kelola data genangan air lingkungan kota bukittinggi</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="page-header-breadcrumb">
                                        <!-- <button class="btn btn-sm btn-out btn-primary btn-square modal-open-cre"
                                            id="distrik" distrikid="0">Tambah</button> -->
                                        <button type="button"
                                            class="btn btn-sm btn-out btn-info btn-square modal-open-cre mr-1"
                                            id="import-layer-air" judul="import layer">Import Layer</button>
                                        <a href="<?= base_url('admin/drainase/edit/0') ?>"
                                            class="btn btn-sm btn-out btn-primary btn-square">
                                            Tambah
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
                                    <div class="row mb-3">
                                        <div class="col-md-3">
                                            <div class="form-group mb-0">
                                                <label class="form-label">Tahun</label>
                                                <select name="Tahun" id="Tahun" class="form-control mb-0">
                                                    <?= OptCreate(['2022', '2023'], ['2022', '2023'],  date('Y')); ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">Kecamatan</label>
                                            <select name="KecamatanID" class="form-control" id="SelKecamatan">
                                                <option value="opt1">Pilih Salah Satu</option>
                                                <?= OptionDaerah('kecamatan', @$KabupatenID, @$KecamatanID); ?>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">Kelurahan</label>
                                            <select name="KelurahanID" class="form-control" id="SelKelurahan">
                                                <option value="opt1">Pilih Salah Satu</option>
                                                <?= OptionDaerah('kelurahan', @$KecamatanID, @$KelurahanID); ?>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">&nbsp;</label>
                                            <button type="submit" class="btn btn-block btn-primary"
                                                style="width: 100%;"> Export Excel
                                                Data</button>
                                        </div>
                                    </div>

                                </div>
                                <div class="table-responsive p-4">
                                    <table class="table" id="DTable">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nama</th>
                                                <th>Daerah</th>
                                                <th>Luas</th>
                                                <th>Keterangan</th>
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
                d.datatable = 'genangan-air';
                d.tahun = $("#Tahun").val();
            },
        },
        order: [],
        columns: [{
            data: 'No',
            orderable: false
        }, {
            data: 'Nama'
        }, {
            data: 'Daerah'
        }, {
            data: 'Luas'
        }, {
            data: 'Keterangan'
        }, {
            data: 'Button'
        }]
    });
});

//nomor otomatis colomn 0
</script>
<?= $this->endSection() ?>
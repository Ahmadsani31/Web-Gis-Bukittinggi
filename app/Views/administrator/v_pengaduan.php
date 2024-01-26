<?= $this->extend('administrator/_templates/_app') ?>
<?= $this->section('content-css') ?>
<style>
ul.square {
    list-style-type: square;
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
                                <div class="col-lg-12">
                                    <div class="page-header-title">
                                        <i class="icofont icofont-table bg-c-blue"></i>
                                        <div class="d-inline">
                                            <h4>Pengaduan</h4>
                                            <span>Data - data laporan / pengaduan dari masyarakat bukittinggi</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Page-header end -->

                        <!-- Page-body start -->
                        <div class="page-body">
                            <!-- Basic table card start -->
                            <div class="card">
                                <div class="card-header pb-0">
                                    <form action="<?= base_url('admin/pengaduan/export-excel'); ?>" method="post">
                                        <?= csrf_field(); ?>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="form-label">Tanggal</label>
                                                    <input type="date" name="Tanggal1" id="Tanggal1"
                                                        class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label">&nbsp;</label>
                                                <input type="date" name="Tanggal2" id="Tanggal2" class="form-control"
                                                    required>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label">Status</label>
                                                <select name="Status" class="form-control" id="Status" required>
                                                    <option value="">Pilih Status</option>
                                                    <option value="P">Pengajuan</option>
                                                    <option value="Y">Disetujui</option>
                                                    <option value="N">Ditolak</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label">&nbsp;</label>
                                                <button type="submit" class="btn btn-block btn-primary"
                                                    style="width: 100%;" tooltip="Export data ke Excel"> Export Excel
                                                    Data</button>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                                <div class="card-block table-border-style">
                                    <div class="table-responsive p-4" style="width: 100%;">
                                        <table class="table table-hover" id="DTable">
                                            <thead>
                                                <tr>
                                           <th class="text-center">No</th>
                                                    <th class="text-center">Nama</th>
                                                    <th class="text-center">Lokasi</th>
                                                    <th class="text-center">Keterangan</th>
                                                    <th class="text-center">Tanggal</th>
                                                    <th class="text-center">Status</th>
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
                        </div>
                        <!-- Page-body end -->
                    </div>
                </div>
            </div>

            <div id="styleSelector">

            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('content-js') ?>
<script type="text/javascript">
$("#Tanggal1").change(function() {
    DTable.ajax.reload(null, false);
});

$("#Tanggal2").change(function() {
    DTable.ajax.reload(null, false);
});

$("#Status").change(function() {
    DTable.ajax.reload(null, false);
});
var DTable;
var DTable = $("#DTable").DataTable({
    ajax: {
        url: "<?= base_url() ?>datatable",
        type: "POST",
        data: function(d) {
            d.datatable = 'pengaduan';
            d.tgl1 = $("#Tanggal1").val()
            d.tgl2 = $("#Tanggal2").val()
            d.status = $("#Status").val();
        },
    },
    columnDefs: [{
        className: "align-middle",
        targets: ['_all'],
    }, {
        searchable: false,
        orderable: false,
        targets: 0,
    }, {
        targets: -1,
        data: "aksi",
        searchable: false,
        orderable: false,
        render: function(data) {
            btn =
                '<button title="Hapus Data" class="btn btn-sm btn-primary modal-open-cre mr-1 mb-1 p-2"  id="pengaduan" pengaduanid="' +
                data.PengaduanID +
                '" flow="left" tooltip="Edit / Update Data"><span class="ri-edit-box-fill ri-lg"></span></button>';
            btn +=
                '<button type="button" class="btn btn-sm btn-danger mr-1 mb-1 p-2 modal-hapus-cre" id="' +
                data.PengaduanID +
                '" table="pengaduan" tooltip="Hapus Data"><span class="ri-delete-bin-5-fill ri-lg"></span></button>&nbsp;';
            return btn;
        },
    }],
    columns: [{
        data: null,
    }, {
        data: "Nama",
    }, {
        data: "Lokasi",
    }, {
        data: "Keterangan",
    }, {
        data: "Tanggal",
    }, {
        data: "Status",
    }, {
        data: "ImgPengaduan",
    }, {
        data: null,
    }],
});
//nomor otomatis colomn 0

DTable.on("order.dt search.dt", function() {
    DTable.column(0, {
        search: "applied",
        order: "applied",
    }).nodes().each(function(cell, i) {
        cell.innerHTML = i + 1 + ".";
    });
}).draw();
</script>
<?= $this->endSection() ?>
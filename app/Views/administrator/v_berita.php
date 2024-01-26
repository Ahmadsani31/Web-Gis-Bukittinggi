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
                                            <h4>Berita</h4>
                                            <span>Kelola data semua data berita / artikel</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="page-header-breadcrumb">

                                        <a href="<?= base_url('admin/berita/edit/0') ?>" class="btn btn-out btn-primary btn-square" tooltip="Tambah Berita">Tambah Berita</a>

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
                                    <form action="<?= base_url('admin/berita/export-excel'); ?>" method="post">
                                        <?= csrf_field(); ?>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="form-label">Tanggal</label>
                                                    <input type="date" name="Tanggal1" id="Tanggal1" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label">&nbsp;</label>
                                                <input type="date" name="Tanggal2" id="Tanggal2" class="form-control" required>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label">Publish</label>
                                                <select name="Publish" class="form-control" id="Publish" required>
                                                    <option value="">Pilih Status</option>
                                                    <option value="Y">Berita Publish</option>
                                                    <option value="N">Tidak Publish</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label">&nbsp;</label>
                                                <button type="submit" class="btn btn-block btn-primary" style="width: 100%;" tooltip="Export data ke Excel"> Export Excel
                                                    Data</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="table-responsive p-4">
                                    <table class="table table-hover table-sm" id="DTable">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Judul</th>
                                                <th>View</th>
                                                <th>Tanggal</th>
                                                <th>Status</th>
                                                <th>Image</th>
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

    $("#Publish").change(function() {
        DTable.ajax.reload(null, false);
    });

    var DTable;
    var DTable = $("#DTable").DataTable({
        autoWidth: true,
        ajax: {
            url: "<?= base_url() ?>datatable",
            type: "POST",
            data: function(d) {
                d.datatable = 'berita';
                d.tgl1 = $("#Tanggal1").val()
                d.tgl2 = $("#Tanggal2").val()
                d.publish = $("#Publish").val();
            },
        },
        columnDefs: [{
                className: "align-middle text-center",
                targets: ['_all'],
            },
            {
                "width": "20%",
                "targets": 1
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
                    btn = '<a href="<?= base_url('admin/berita/detail/'); ?>' + data.Slug +
                        '" class="btn btn-sm btn-primary mr-1 mb-1 p-2" target="_blank" tooltip="Lihat Aratikel / Berita" flow="left"><span class="ri-eye-fill ri-lg"></span></a>&nbsp;';
                    btn += '<a href="<?= base_url('admin/berita/edit/'); ?>' + data.BeritaID +
                        '" class="btn btn-sm btn-primary mr-1 mb-1 p-2" tooltip="Edit / Update"><span class="ri-edit-box-fill ri-lg"></span></a>&nbsp;';
                    btn +=
                        '<button type="button" class="btn btn-sm btn-danger mr-1 mb-1 p-2 modal-hapus-cre" id="' +
                        data
                        .BeritaID +
                        '" table="berita" tooltip="Hapus Data"><span class="ri-delete-bin-5-fill ri-lg"></span></button>&nbsp;';
                    return btn;
                },
            }
        ],
        columns: [{
            data: null,
        }, {
            data: "Judul",
            width: "20%",
        }, {
            data: "View",
        }, {
            data: "TanggalPublish",
        }, {
            data: "Status",
        }, {
            data: "Image",
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
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
                                            <h4>User</h4>
                                            <span>Kelola data user</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="page-header-breadcrumb">
                                        <button class="btn btn-out btn-primary btn-square modal-open-cre" id="user" userid="0" judul="Tambah User"  tootltip="Tambah Data">Tambah User</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Page-header end -->

                        <!-- Page-body start -->
                        <div class="page-body">
                            <!-- Basic table card start -->
                            <div class="card">
                                <div class="card-block table-border-style">
                                    <div class="table-responsive p-4">
                                        <table class="table" id="DTable">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Nama</th>
                                                    <th>Username</th>
                                                    <th>Aksi</th>
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
    var DTable;
    var DTable = $("#DTable").DataTable({
        ajax: {
            url: "<?= base_url() ?>datatable",
            type: "POST",
            data: function(d) {
                d.datatable = 'user';
            },
        },
        columnDefs: [{
            className: "align-middle text-center",
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
                    '<button title="Hapus Data" class="btn btn-sm btn-primary modal-open-cre mr-1 mb-1 p-2"  id="user" userid="' +
                    data.AdminID +
                    '" flow="left" tooltip="Edit / Update Data"><span class="ri-edit-box-fill ri-lg"></span></button>';
                btn +=
                    '<button type="button" class="btn btn-sm btn-danger mr-1 mb-1 p-2 modal-hapus-cre" id="' +
                    data.AdminID +
                    '" table="user" tooltip="Hapus Data"><span class="ri-delete-bin-5-fill ri-lg"></span></button>&nbsp;';
                return btn;
            },
        }],
        columns: [{
            data: null,
        }, {
            data: "Nama",
        }, {
            data: "Username",
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
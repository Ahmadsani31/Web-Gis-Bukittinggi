<?= $this->extend('_templates/_app') ?>
<?= $this->section('content-css') ?>

<style>
    span.label {
        border-radius: 4px;
        font-size: 75%;
        padding: 4px 7px;
        margin-right: 5px;
        font-weight: 400;
        color: #fff !important;
    }

    .label-danger {
        background-color: #FC6180;
    }

    .label-success {
        background-color: #93be52;
    }

    .label-danger {
        background-color: #fc6180;
    }

    .label-info {
        background-color: #62d1f3;
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
                <li>Pengaduan</li>
            </ol>
            <h2>Daftar Laporan Pengaduan Masyarakat </h2>

        </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Portfolio Details Section ======= -->
    <section id="portfolio-details" class="portfolio-details">
        <div class="container-fluid aos-init aos-animate" style="padding-left: 50px;padding-right: 50px;">
            <div class="container">
                <div class="card p-4">
                    <div class="table-responsive">
                        <table class="table table-sm" id="DTable">
                           
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Lokasi</th>
                                    <th scope="col">Keterangan</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Image</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End Portfolio Details Section -->

    <!-- End Skills Section -->
</main><!-- End #main -->
<?= $this->endSection() ?>
<?= $this->section('content-js') ?>

<script type="text/javascript">
    var DTable;
    var DTable = $("#DTable").DataTable({
        pageLength: 5,
        lengthMenu: [
            [5, 10, 20, -1],
            [5, 10, 20, 'All']
        ],
        ajax: {
            url: "<?= base_url() ?>datatable",
            type: "POST",
            data: function(d) {
                d.datatable = 'pengaduan';
                d.tampilkan = '1';
            },
        },
        columnDefs: [{
            className: "align-middle",
            targets: ['_all'],
        }, {
            searchable: false,
            orderable: false,
            targets: 0,
        }],
        columns: [{
            data: null,
        }, {
            data: "Lokasi",
        }, {
            data: "Keterangan",
        }, {
            data: "Status",
        }, {
            data: "Tanggal",
        }, {
            data: "ImgPengaduan",
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
<script>

</script>
<?= $this->endSection() ?>
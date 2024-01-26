<?= $this->extend('administrator/_templates/_app') ?>
<?= $this->section('content-css') ?>
<style>
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        background-color: #fff;
        color: #000;
        padding: 8px 30px 8px 20px;
    }

    .select2-container .select2-selection--single {
        box-sizing: border-box;
        cursor: pointer;
        display: block;
        height: 39px;
        user-select: none;
        -webkit-user-select: none;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: #444;
        line-height: 21px;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 38px;
        position: absolute;
        top: 1px;
        right: 1px;
        width: 20px;
    }

    .ck-editor__editable_inline {
        min-height: 400px;
    }

    #image-preview {
        height: 550px;
        position: relative;
        overflow: hidden;
        background-color: #fff;
        color: #ecf0f1;
        border-style: dotted;
        border-color: #979797;
        margin-left: 100px;
        margin-right: 100px;
    }

    #image-preview input {
        line-height: 200px;
        font-size: 200px;
        position: absolute;
        opacity: 0;
        z-index: 10;
    }

    #image-preview label {
        position: absolute;
        z-index: 5;
        opacity: 0.8;
        cursor: pointer;
        border-radius: 5px;
        background-color: #333b41;
        width: 200px;
        height: 50px;
        font-size: 20px;
        line-height: 50px;
        text-transform: uppercase;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        margin: auto;
        text-align: center;
    }
</style>
<link rel="stylesheet" href="<?= base_url('assets/ajax-file-uploader'); ?>/css/jquery.uploader.css">

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
                                        <div class="d-flex align-items-center">
                                            <h4>Berita / Artikel</h4>
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
                                <div class="card-block">
                                    <?php if (session()->getFlashdata('error')) { ?>
                                        <div class="alert alert-warning">
                                            <ul>
                                                <?php
                                                foreach (session()->getFlashdata('error') as $eer) {
                                                    # code..
                                                    echo '<li>' . $eer . '</li>';
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                    <?php } ?>
                                    <form class="p-2" action="<?= base_url('admin/berita/simpan'); ?>" method="POST" enctype="multipart/form-data">
                                        <?= csrf_field(); ?>
                                        <input type="hidden" name="BeritaID" id="BeritaID" value="<?= $BeritaID; ?>">

                                        <div class="form-group">
                                            <div id="image-preview">
                                                <label for="image-upload" id="image-label">Gambar utama</label>
                                                <img src="<?= base_url('assets/files/berita/') . $ImageBerita; ?>" alt="" style="object-fit: cover;width: 100%;">
                                                <input type="file" name="ImageBerita" id="image-upload" accept="image/png, image/gif, image/jpeg" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Judul</label>
                                            <input type="text" name="Judul" class="form-control" value="<?= $Judul; ?>" require>
                                        </div>
                                        <div class="form-group">
                                            <textarea name="Konten" id="editorCK" class="form-control" cols="30" rows="50"><?= $Konten; ?></textarea>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Tanggal Publish</label>
                                                    <input type="date" name="TanggalPublish" class="form-control" value="<?= $TanggalPublish; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Publish</label>
                                                    <select name="Publish" id="Publish" class="form-control">
                                                        <?= OptCreate(['Y', 'N'], ['Aktif', 'Tidak'],  $Publish); ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <?php
                                            if ($Headline == 1) {
                                                $checked = 'checked';
                                            } else {
                                                $checked = '';
                                            }
                                            ?>
                                            <div class="col-md-12">
                                                <label class="form-label">Headline</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-text">
                                                        <input type="checkbox" class="form-check-input mt-0" name="Headline" value="1" style="margin-left: 0;" <?= $checked; ?>>
                                                    </div>
                                                    <input type="text" class="form-control" placeholder="Ceklis ini untuk headline berita" readonly>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block">simpan</button>
                                        </div>
                                    </form>
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
<script src="<?= base_url('assets/ckeditor'); ?>/js/ckeditor.js"></script>

<script src="<?= base_url('assets/admin/js/'); ?>jquery.uploadPreview.js"></script>
<script src="<?= base_url('assets/admin/js/'); ?>jquery.uploadPreview.min.js"></script>
<script type="text/javascript">
    ClassicEditor
        .create(document.querySelector('#editorCK'))
        .then(editor => {})
        .catch(error => {});

    $(document).ready(function() {
        $.uploadPreview({
            input_field: "#image-upload", // Default: .image-upload
            preview_box: "#image-preview", // Default: .image-preview
            label_field: "#image-label", // Default: .image-label
            label_default: "Choose File", // Default: Choose File
            label_selected: "Change File", // Default: Change File
            no_label: false // Default: false
        });
    });
</script>
<?= $this->endSection() ?>
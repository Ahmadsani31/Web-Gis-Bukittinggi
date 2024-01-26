<?= $this->extend('administrator/_templates/_app') ?>
<?= $this->section('content-css') ?>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/0.4.2/leaflet.draw.css" />

<!-- <link rel="stylesheet" href="<?= base_url('assets/ajax-file-uploader'); ?>/css/jquery.uploader.css"> -->

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
                                            <h4><?= $text; ?></h4>
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
                                    <?php
                                        echo $NamaJalan;
                                    } ?>
                                    <form class="p-2" action="<?= base_url('admin/drainase/simpan'); ?>" method="POST"
                                        enctype="multipart/form-data">
                                        <?= csrf_field(); ?>
                                        <input type="hidden" name="DrainaseID" id="DrainaseID"
                                            value="<?= $DrainaseID; ?>">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <select name="Tahun" id="Tahun" class="form-control">
                                                        <?php
                                                        for ($x = 2023; $x <= date('Y'); $x++) {
                                                            $sel = '';
                                                            if ($x == $Tahun) {
                                                                $sel = 'selected';
                                                            }
                                                            echo '<option value="' . $x . '" ' . $sel . '>' . $x . '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Nama Jalan</label>
                                                    <input type="text" name="Nama" id="Nama" class="form-control"
                                                        value="<?= $NamaJalan; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Kode</label>
                                                    <input type="text" name="KodeDrain" id="KodeDrain"
                                                        class="form-control" value="<?= $KodeDrain; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label class="form-label">Kecamatan</label>
                                                <select name="KecamatanID" class="form-control" id="KecamatanID">
                                                    <option value="opt1">Pilih Salah Satu</option>
                                                    <?= OptionDaerah('kecamatan', @$KabupatenID, @$KecamatanID); ?>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Kelurahan</label>
                                                <select name="KelurahanID" class="form-control" id="KelurahanID">
                                                    <option value="opt1">Pilih Salah Satu</option>
                                                    <?= OptionDaerah('kelurahan', @$KecamatanID, @$KelurahanID); ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row  mb-3">
                                            <div class="col-md-4">
                                                <label class="form-label">Kondisi</label>
                                                <input type="text" name="Kondisi" id="Kondisi" class="form-control"
                                                    value="<?= $Kondisi; ?>">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Konstruksi</label>
                                                <input type="text" name="Konstruksi" id="Konstruksi"
                                                    class="form-control" value="<?= $Konstruksi; ?>">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Penampang</label>
                                                <input type="text" name="Penampang" id="Penampang" class="form-control"
                                                    value="<?= $Penampang; ?>">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-3">
                                                <label class="form-label">Panjang</label>
                                                <input type="number" step="0.1" name="Panjang" id="Panjang"
                                                    class="form-control" value="<?= $Panjang; ?>">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label">Tinggi (H) <sub>meter</sub></label>
                                                <input type="number" step="0.1" name="Tinggi" id="Tinggi"
                                                    class="form-control" value="<?= $Tinggi; ?>">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label">Lebar (B) <sub>meter</sub></label>
                                                <input type="number" step="0.1" name="Lebar" id="Lebar"
                                                    class="form-control" value="<?= $Lebar; ?>">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label">Lebar (B1) <sub>meter</sub></label>
                                                <input type="number" step="0.1" name="LebarB" id="LebarB"
                                                    class="form-control" value="<?= $LebarB; ?>">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-4">
                                                <label class="form-label">Sediment</label>
                                                <input type="text" name="Sediment" id="Sediment" class="form-control"
                                                    value="<?= $Sediment; ?>">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Posisi Saluran</label>
                                                <input type="text" name="PosisiSaluran" id="PosisiSaluran"
                                                    class="form-control" value="<?= $PosisiSaluran; ?>">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Jenis Saluran</label>
                                                <input type="text" name="JenisSaluran" id="JenisSaluran"
                                                    class="form-control" value="<?= $JenisSaluran; ?>">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-4">

                                                <div class="form-group">
                                                    <label class="form-label">Image</label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-text">
                                                            <input type="checkbox" name="deleteFileImage1"
                                                                class="form-control" value="FileImage1"
                                                                tooltip="checkbox untuk delete image">
                                                        </div>
                                                        <div class="custom-file" style="width: 100%;">
                                                            <input type="file" name="FileImage1" class="form-control"
                                                                accept="image/png, image/jpg, image/jpeg"
                                                                style="width: 100%;">
                                                        </div>
                                                        <div class="input-group-append">
                                                            <button type="button"
                                                                class="btn btn-<?= $btn1; ?>  modal-open-cre"
                                                                drainaseid="<?= $DrainaseID; ?>" imgke="FileImage1"
                                                                id="drainase-image"><i
                                                                    class="ri-file-image-line"></i></button>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">&nbsp;</label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-text">
                                                            <input type="checkbox" name="deleteFileImage2"
                                                                class="form-control" value="FileImage2"
                                                                tooltip="checkbox untuk delete image">
                                                        </div>
                                                        <div class="custom-file" style="width: 100%;">
                                                            <input type="file" name="FileImage2" class="form-control"
                                                                accept="image/png, image/jpg, image/jpeg"
                                                                style="width: 100%;">
                                                        </div>
                                                        <div class="input-group-append">
                                                            <button type="button"
                                                                class="btn btn-<?= $btn2; ?>  modal-open-cre"
                                                                drainaseid="<?= $DrainaseID; ?>" imgke="FileImage2"
                                                                id="drainase-image"><i
                                                                    class="ri-file-image-line"></i></button>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-md-4">

                                                <div class="form-group">
                                                    <label class="form-label">&nbsp;</label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-text">
                                                            <input type="checkbox" name="deleteFileImage3"
                                                                class="form-control" value="FileImage3"
                                                                tooltip="checkbox untuk delete image">
                                                        </div>
                                                        <div class="custom-file" style="width: 100%;">
                                                            <input type="file" name="FileImage3" class="form-control"
                                                                accept="image/png, image/jpg, image/jpeg"
                                                                style="width: 100%;">
                                                        </div>
                                                        <div class="input-group-append">
                                                            <button type="button"
                                                                class="btn btn-<?= $btn3; ?>  modal-open-cre"
                                                                drainaseid="<?= $DrainaseID; ?>" imgke="FileImage3"
                                                                id="drainase-image"><i
                                                                    class="ri-file-image-line"></i></button>
                                                        </div>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Keterangan</label>
                                            <textarea rows="5" cols="5" name="Keterangan" id="Keterangan"
                                                class="form-control"
                                                placeholder="Default textarea"><?= $Keterangan; ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <div class="p-2"
                                                style="background-color: beige; border:3px solid; border-color: black;  ">
                                                <p class="mb-0">Note :</p>
                                                <p class="m-0">Contoh Format Geojson, beserta properties geoJson yang
                                                    wajib di isi, <a
                                                        href="<?= base_url('assets/geojson/exCoordinat.geojson'); ?>"
                                                        download><b>Klik disini</b></a>, buka dengan Notepat / Notepat++
                                                </p>
                                                <p class="m-0">untuk import layer drainse, properties geojson harus
                                                    format seperti contoh yang telah di download diatas, supaya data
                                                    otomatis tersimpan ke database webgis drainase.</p>
                                                <p class="m-0">dan untuk format layer export Shp to geojson harus<br> <b
                                                        style="font-size: 16px;">CSR:EPSG:4326 - WGS 84</b></p>
                                            </div>

                                            <div id="mapid" style="height: 500px;">
                                            </div>
                                            <textarea name="Coordinates" id="Coordinates" cols="30" rows="10"
                                                hidden></textarea>
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
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/0.4.2/leaflet.draw.js"></script>
<!-- <script src="<?= base_url('assets/ajax-file-uploader'); ?>/dist/jquery.uploader.min.js"></script> -->

<script type="text/javascript">
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

var map = L.map('mapid', {
    doubleClickZoom: false,
    attributionControl: false,
    scrollWheelZoom: false,
    center: [-0.30907, 100.37055],
    zoom: 15
});
L.tileLayer("https://mt1.google.com/vt/lyrs=m&x={x}&y={y}&z={z}", {
    maxZoom: 20,
    openLegendOnLoad: false,

    attribution: ''
}).addTo(map)

onLoadGeojson();

function onLoadGeojson() {
    let formData = new FormData();

    const fileupload = $('#fJson').prop('files');
    formData.append('DrainaseID', $('#DrainaseID').val());

    if (fileupload != null) {

        formData.append('FileJson', fileupload[0]);

    }
    $.ajax({
        type: 'POST',
        url: '<?= base_url('admin/drainase/coordinat'); ?>',
        data: formData,
        cache: false,
        processData: false,
        contentType: false,
        success: function(data) {
            deleteLayers();
            if (data.param > 0) {
                $('#Coordinates').val(data.coordinat);

                console.log(data.geojson);
                var geo = L.geoJson(data.geojson, {
                    onEachFeature: function(feature, layer) {

                    },
                    style: function(feature, layer) {
                        return {
                            color: 'red',
                            weight: '10',
                            opacity: 0.7,
                            fill: false,
                            dashArray: "10 10",
                        };
                    }
                }).addTo(map);

                map.fitBounds(geo.getBounds());
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Kesalahan !',
                    text: data.pesan.FileJson,
                })
            }


        },
        error: function(jqXhr, status, error) {
            console.error(jqXhr);
            Swal.fire({
                icon: 'error',
                title: jqXhr.statusText,
                text: jqXhr.responseJSON.message,
            })
        }
    });
}



var MyCounters = L.Control.extend({
    options: {
        position: 'topright'
    },
    onAdd: function(map) {
        return L.DomUtil.create('div');
    },
    setContent: function(content) {
        this.getContainer().innerHTML = content;
    }
});
myCounters = new MyCounters().addTo(map);
viewDiv();

function viewDiv() {
    impact = `<div class="card p-2 mb-0 bg-primary">
                        <div class="form-group">
                            <label class="form-label mb-0" style="font-size:15px;">Tambah / Update Sub layer</label>
                            <input type="file" name="fJson" id="fJson" onchange="onLoadGeojson()" class="form-control">
                        </div>
                    </div>`;
    myCounters.setContent(impact);
}

function deleteLayers() {
    // map.removeLayer(polyline); // For hide
    // polyline.remove();
    map.eachLayer(function(layer) {
        if (!!layer.toGeoJSON) {
            map.removeLayer(layer);
        }
        // map.removeLayer(layer);
    });
}
</script>
<?= $this->endSection() ?>
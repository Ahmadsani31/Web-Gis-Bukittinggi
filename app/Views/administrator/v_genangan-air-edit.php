<?= $this->extend('administrator/_templates/_app') ?>
<?= $this->section('content-css') ?>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/0.4.2/leaflet.draw.css" />
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
                                        <div class="d-flex align-items-center">
                                            <h4>Edit Data Genangan Air</h4>
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
                                    <form class="p-2" action="<?= base_url('admin/genangan-air/simpan'); ?>" method="POST" enctype="multipart/form-data">
                                        <?= csrf_field(); ?>
                                        <input type="hidden" name="GenanganID" id="GenanganID" value="<?= $GenanganID; ?>">
                                        <div class="form-group">
                                            <label class="form-label">Tahun</label>
                                            <select name="Tahun" class="form-control" id="Tahun">
                                                <option value="opt1">Pilih Salah Satu</option>
                                                <?= OptCreate(['2022', '2023'], ['2022', '2023'], $Tahun); ?>
                                            </select>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Kode</label>
                                                    <input type="text" name="KodeGenangan" class="form-control" value="<?= $KodeGenangan; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Nama Daerah</label>
                                                    <input type="text" name="NamaDaerah" class="form-control" value="<?= $NamaDaerah; ?>">
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label class="form-label">Kecamatan</label>
                                                <select name="KecamatanID" class="form-control" id="SelKecamatan">
                                                    <option value="opt1">Pilih Salah Satu</option>
                                                    <?= OptionDaerah('kecamatan', @$KabupatenID, @$KecamatanID); ?>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Kelurahan</label>
                                                <select name="KelurahanID" class="form-control" id="SelKelurahan">
                                                    <option value="opt1">Pilih Salah Satu</option>
                                                    <?= OptionDaerah('kelurahan', @$KecamatanID, @$KelurahanID); ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-4">
                                                <label class="form-label">Luas</label>
                                                <input type="number" name="Luas" step="0.01" class="form-control" value="<?= $Luas; ?>">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Lama Genangan</label>
                                                <input type="text" name="DurasiGenangan" class="form-control" value="<?= $DurasiGenangan; ?>">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Tinggi Genangan</label>
                                                <input type="text" name="TinggiGenangan" class="form-control" value="<?= $TinggiGenangan; ?>">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-4">
                                                <label class="form-label">Image</label>
                                                <div class="input-group mb-3">
                                                    <div class="custom-file">
                                                        <input type="file" name="FileImage1" class="form-control" accept="image/png, image/jpg, image/jpeg" style="width: 100%;">

                                                    </div>
                                                    <div class="input-group-append">
                                                        <a href="<?= $href1; ?>" class="btn btn-<?= $btn1; ?>" target="_blank" name="FileImage1" id=""><i class="ri-file-image-line"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">&nbsp;</label>
                                                <div class="input-group mb-3">
                                                    <div class="custom-file">
                                                        <input type="file" name="FileImage2" class="form-control" accept="image/png, image/jpg, image/jpeg" style="width: 100%;">

                                                    </div>
                                                    <div class="input-group-append">
                                                        <a href="<?= $href2; ?>" class="btn btn-<?= $btn2; ?>" target="_blank" id=""><i class="ri-file-image-line"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">&nbsp;</label>
                                                <div class="input-group mb-3">
                                                    <div class="custom-file">
                                                        <input type="file" name="FileImage3" class="form-control" accept="image/png, image/jpg, image/jpeg" style="width: 100%;">

                                                    </div>
                                                    <div class="input-group-append">
                                                        <a href="<?= $href3; ?>" class="btn btn-<?= $btn3; ?>" target="_blank" id=""><i class="ri-file-image-line"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Keterangan</label>
                                            <textarea rows="5" cols="5" name="Keterangan" id="Keterangan" class="form-control" placeholder="Default textarea"><?= $Keterangan; ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <div id="mapid" style="height: 500px;">

                                            </div>
                                            <textarea name="Coordinates" id="Coordinates" cols="30" rows="10" hidden></textarea>
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

<script type="text/javascript">
    var urlKecamatan = "https://ibnux.github.io/data-indonesia/kecamatan/";
    var urlKelurahan = "https://ibnux.github.io/data-indonesia/kelurahan/";

    function clearOptions(id) {
        console.log("on clearOptions :" + id);

        //$('#' + id).val(null);
        $('#' + id).empty().trigger('change');
    }
    var selectKec = $('#SelKecamatan');
    $(selectKec).change(function() {
        var value = $(selectKec).val();
        clearOptions('SelKelurahan');

        if (value) {
            console.log("on change selectKec");

            var text = $('#SelKecamatan:selected').text();
            console.log("value = " + value + " / " + "text = " + text);

            console.log('Load Kelurahan di ' + text + '...')
            $.getJSON(urlKelurahan + value + ".json", function(res) {

                res = $.map(res, function(obj) {
                    obj.text = obj.nama
                    return obj;
                });

                data = [{
                    id: "",
                    nama: "- Pilih Kelurahan -",
                    text: "- Pilih Kelurahan -"
                }].concat(res);

                //implemen data ke select provinsi
                $("#SelKelurahan").select2({
                    dropdownAutoWidth: false,
                    data: data
                })
            })
        }
    });


    var selectKel = $('#SelKelurahan');
    $(selectKel).change(function() {
        var value = $(selectKel).val();

        if (value) {
            console.log("on change selectKel");

            var text = $('#SelKelurahan:selected').text();
            console.log("value = " + value + " / " + "text = " + text);
        }
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
        console.log(fileupload);
        formData.append('GenanganID', $('#GenanganID').val());

        if (fileupload != null) {

            formData.append('FileJson', fileupload[0]);

        }
        $.ajax({
            type: 'POST',
            url: '<?= base_url('admin/genangan-air/coordinat'); ?>',
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success: function(data) {
                deleteLayers();
                if (data.param > 0) {
                    // console.log(data.coordinat);
                    $('#Coordinates').val(data.coordinat);
                    var geo = L.geoJson(data.geojson, {
                        onEachFeature: function(feature, layer) {
                            layer.bindPopup('<h1>' + feature.properties.NamaDaerah +
                                '</h1><p>Luas : ' + feature.properties.Luas + ' meter</p>');
                            layer.openPopup();
                        },
                        style: function(feature, layer) {
                            return {
                                fillColor: 'blue',
                                weight: 2,
                                opacity: 1,
                                color: 'white',
                                dashArray: '3',
                                fillOpacity: 0.5
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
            // console.log(layer);
            if (!!layer.toGeoJSON) {
                map.removeLayer(layer);
            }
            // map.removeLayer(layer);
        });
    }
</script>
<?= $this->endSection() ?>
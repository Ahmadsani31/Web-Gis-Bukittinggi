<?= $this->extend('_templates/_app') ?>
<?= $this->section('content-css') ?>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/0.4.2/leaflet.draw.css" />
<link rel="stylesheet" href="<?= base_url(); ?>/assets/sidebar/L.Control.Sidebar.css">
<link rel="stylesheet" href="<?= base_url(); ?>/assets/css/app-peta.css">
<?= $this->endSection() ?>
<?= $this->section('content-body') ?>
<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">

            <ol>
                <li><a href="<?= base_url(); ?>">Home</a></li>
                <li><a href="<?= base_url('peta'); ?>"> Peta</a></li>
                <li> Detail</li>
            </ol>
            <h2 style="color: #000;"><?= $drain['KodeDrain']; ?> - <?= $drain['NamaJalan']; ?>
            </h2>
            <p class="mt-0">Identitas Rekomendasi dari BPS No : V-23.1375.002</p>

        </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Portfolio Details Section ======= -->
    <section id="portfolio-details" class="portfolio-details">
        <div class="container-fluid aos-init aos-animate" style="padding-left: 50px;padding-right: 50px;">
            <input type="hidden" name="DrainaseID" id="DrainaseID" value="<?= $drain['DrainaseID']; ?>">
            <div id="mapid" style="height: 600px; position: sticky;"></div>
        </div>
    </section><!-- End Portfolio Details Section -->

    <?php
    if ($Image1 != '' || $Image2 != '' || $Image3 != '') {

    ?>
    <section id="services" class="services section-bg">
        <div class="container aos-init aos-animate" data-aos="fade-up">

            <div class="section-title">
                <h2>Image Drainase</h2>
            </div>

            <div class="row">
                <?php
                    if ($Image1 != '') {

                        echo '<div class="col d-flex align-items-stretch justify-content-center aos-init aos-animate" data-aos="zoom-in" data-aos-delay="100">
                            <div class="portfolio-img">
                                <img src="' . $Image1 . '" alt="img-drainase" class="img-fluid modal-open-cre" drainaseid="' . $drain['DrainaseID'] . '" imgke="FileImage1" id="drainase-image" size="modal-xl" judul="Gambar Drainase" style="object-fit: cover; width: 100%;height: auto;">
                            </div>
                        </div>';
                        # code...
                    }
                    if ($Image2 != '') {

                        echo '<div class="col d-flex align-items-stretch justify-content-center aos-init aos-animate" data-aos="zoom-in" data-aos-delay="100">
                            <div class="portfolio-img">
                                <img src="' . $Image2 . '" alt="img-drainase" class="img-fluid modal-open-cre" drainaseid="' . $drain['DrainaseID'] . '" imgke="FileImage2" id="drainase-image" size="modal-xl" judul="Gambar Drainase" style="object-fit: cover; width: 100%;height: auto;">
                            </div>
                        </div>';
                        # code...
                    }
                    if ($Image3 != '') {

                        echo '<div class="col d-flex align-items-stretch justify-content-center aos-init aos-animate" data-aos="zoom-in" data-aos-delay="100">
                            <div class="portfolio-img">
                                <img src="' . $Image3 . '" alt="img-drainase" class="img-fluid modal-open-cre" drainaseid="' . $drain['DrainaseID'] . '" imgke="FileImage3" id="drainase-image" size="modal-xl" judul="Gambar Drainase" style="object-fit: cover; width: 100%;height: auto;">
                            </div>
                        </div>';
                        # code...
                    }
                    ?>
            </div>

        </div>
    </section>
    <?php
    }
    ?>
    <section id="about" class="about">
        <div class="container aos-init aos-animate" data-aos="fade-up">

            <div class="section-title">
                <h2>Detail</h2>
            </div>

            <div class="card p-4">
                <div class="row">
                    <div class="col-md-6">
                        <div class="table-responsive">
                            <table class="table">


                                <tr>
                                    <td scope="col">Nama</td>
                                    <th><?= $drain['NamaJalan']; ?></th>
                                </tr>

                                <tr>
                                    <td scope="col">Kondisi</td>
                                    <th><?= $drain['Kondisi']; ?></th>
                                </tr>
                                <tr>
                                    <td scope="col">Jenis Saluran</td>
                                    <th><?= $drain['JenisSaluran']; ?></th>
                                </tr>
                                <tr>
                                    <td scope="col">Konstruksi</td>
                                    <th><?= $drain['Konstruksi']; ?></th>
                                </tr>
                                <tr>
                                    <td scope="col">Penampang </td>
                                    <th><?= $drain['Penampang']; ?></th>
                                </tr>
                                <tr>
                                    <td scope="col">Posisi</td>
                                    <th><?= $drain['PosisiSaluran']; ?></th>
                                </tr>
                                <tr>
                                    <td scope="col">Sedimen </td>
                                    <th><?= $drain['Sediment'] ? $drain['Sediment'] : '-'; ?></th>
                                </tr>
                                <tr>
                                    <td scope="col">Kecamatan</td>
                                    <th><?= getNamaDaerah('kecamatan', $drain['KecamatanID']); ?></th>
                                </tr>
                                <tr>
                                    <td scope="col">Kelurahan</td>
                                    <th><?= getNamaDaerah('kelurahan', $drain['KelurahanID']); ?></th>
                                </tr>
                                <tr>
                                    <td scope="col">Tinggi (H)</td>
                                    <th><?= $drain['Tinggi']; ?> Meter</th>
                                </tr>
                                <tr>
                                    <td scope="col">Lebar (B)</td>
                                    <th> <?= $drain['Lebar']; ?> Meter</th>
                                </tr>
                                <tr>
                                    <td scope="col">Lebar (B1)</td>
                                    <th> <?= $drain['LebarB']; ?> Meter</th>
                                </tr>
                                <tr>
                                    <td scope="col">Keterangan</td>
                                    <th> <?= $drain['Keterangan']; ?></th>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="table-responsive">
                            <table class="table ">
                                <tr>
                                    <td scope="col">Panjang</td>
                                    <th><?= number_format($drain['Panjang'], 2); ?> Meter</th>
                                </tr>
                                <tr>
                                    <td scope="col">X Awal</td>
                                    <th><?= $drain['X_Awal']; ?></th>
                                </tr>
                                <tr>
                                    <td scope="col">X Akhir</td>
                                    <th><?= $drain['X_Akhir']; ?></th>
                                </tr>
                                <tr>
                                    <td scope="col">Y Awal</td>
                                    <th><?= $drain['Y_Awal']; ?></th>
                                </tr>
                                <tr>

                                    <td scope="col">Y Akhir</td>
                                    <th><?= $drain['Y_Akhir']; ?></th>
                                </tr>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- End Skills Section -->
</main><!-- End #main -->
<?= $this->endSection() ?>
<?= $this->section('content-js') ?>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/0.4.2/leaflet.draw.js"></script>
<script src="<?= base_url(); ?>/assets/sidebar/L.Control.Sidebar.js"></script>

<script>
var OpenTopoMap = L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 20,
    attribution: 'Map data: &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap contributors</a>'
});

// Tile type: openstreetmap Hot
var openGoogle = L.tileLayer('https://mt1.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a>  contributors, <a href="https://maps.google.com/">Google Maps</a>',
    maxZoom: 20
})

var road = L.tileLayer('https://mt1.google.com/vt/lyrs=h&x={x}&y={y}&z={z}');

var map;
var wilayahA;
var wilayahB;
var layerControl;
map = L.map('mapid', {
    center: [-0.30907, 100.37055],
    scrollWheelZoom: false,
    zoom: 14,
    layers: [openGoogle]
});

map.createPane("pane250").style.zIndex = 250; // between tiles and overlays
map.createPane("pane450").style.zIndex = 450; // between overlays and shadows
map.createPane("pane620").style.zIndex = 620; // between markers and tooltips
map.createPane("pane800").style.zIndex = 800; // above popups

var allOptions = {
    "Google Maps": openGoogle,
    "OpenStreet Map": OpenTopoMap,
};

layerControl = L.control.layers(allOptions, null, {
    collapsed: false,
}).addTo(map);

onLoadGeojson();

function onLoadGeojson() {
    let formData = new FormData();

    formData.append('DrainaseID', $('#DrainaseID').val());


    $.ajax({
        type: 'POST',
        url: '<?= base_url('admin/drainase/coordinat'); ?>',
        data: formData,
        cache: false,
        processData: false,
        contentType: false,
        success: function(data) {
            if (data.param > 0) {
                $('#Coordinates').val(data.coordinat);
                var geo = L.geoJson(data.geojson, {
                    pane: "pane620",
                    onEachFeature: function(feature, layer) {
                        layer.bindTooltip(
                            `<span class="w3-tag w3-blue">${feature.properties.KodeDrain}</span><p class="m-0">${feature.properties.Nama_Jalan}</p><p class="m-0">${feature.properties.Kondisi}</p>`, {
                                permanent: true
                            }).openTooltip();
                        // console.log(layer.getLatLngs());
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

map.createPane("pane620").style.zIndex = 620; // between markers and tooltips

baseLayer();

function baseLayer() {
    // map.removeLayer(polyline);

    $.ajax({
        type: "POST",
        url: "<?= base_url('peta/load-all-layer') ?>",
        enctype: "multipart/form-data",
        dataType: "json",
        success: function(response) {


            var batasLayer = response.layer;
            batasLayer.forEach((valLayer, index) => {
                var bkkt = valLayer.Coord;
                // console.log(bkkt);
                if (valLayer.Position == 'Atas') {
                    var pn = "pane620"
                } else {
                    var pn = "pane250"
                }
                if (bkkt.length > 0) {
                    var geo = L.geoJson(bkkt, {
                        pane: pn,
                        onEachFeature: function(feature, layer) {
                            layer.on({
                                mouseover: highlightFeature,
                                mouseout: resetHighlight,
                                click: zoomToFeature,
                            });
                        },
                        style: function(feature, layer) {
                            return {
                                weight: '2',
                                fillOpacity: 1,
                                fillColor: feature.properties.WarnaUtama,
                                color: feature.properties.WarnaBatas,
                            };
                        },
                    });

                    layerControl.addOverlay(geo, valLayer.Ket);

                    function highlightFeature(e) {
                        var layer = e.target;

                        layer.setStyle({
                            weight: 5,
                            color: "#666",
                            dashArray: "",
                            fillOpacity: 0.7,
                        });

                        layer.bringToFront();
                    }

                    function resetHighlight(e) {
                        geo.resetStyle(e.target);
                    }

                    function zoomToFeature(e) {
                        map.fitBounds(e.target.getBounds());
                    }
                }
            });
        },
        failure: function(response) {
            alert(response.responseText);
        },
        error: function(response) {
            alert(response.responseText);
        },
    });
}
</script>
<?= $this->endSection() ?>
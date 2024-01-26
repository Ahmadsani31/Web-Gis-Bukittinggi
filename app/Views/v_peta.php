<?= $this->extend('_templates/_app') ?>
<?= $this->section('content-css') ?>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/0.4.2/leaflet.draw.css" />
<link rel="stylesheet" href="<?= base_url(); ?>/assets/sidebar/L.Control.Sidebar.css">
<link rel="stylesheet" href="<?= base_url(); ?>/assets/css/app-peta.css">

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<link rel="stylesheet" href="<?= base_url(); ?>assets/leaflet-fullscreen-master/Control.FullScreen.css" />
<?= $this->endSection() ?>
<?= $this->section('content-body') ?>
<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">

            <ol>
                <li><a href="<?= base_url(); ?>">Home</a></li>
                <li> Peta</li>
            </ol>
            <h2 class="mb-0">Peta Drainase dan Genangan Kota Bukittinggi</h2>
            <p class="mt-0">Identitas Rekomendasi dari BPS No.: BPS No.V-23.1375.002</p>
        </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Portfolio Details Section ======= -->
    <section id="map-drainase" class="portfolio-details" style="border-top: solid 3px #FFC928;">
        <div class="container-fluid aos-init aos-animate" style="padding-left: 50px;padding-right: 50px;">

            <div class="row">

                <form action="" onsubmit="return false" class="mb-3" id="form-peta" method="post">
                    <div class="row">

                        <div class="mb-2 col-md-6 ">
                            <select name="KecamatanID" class="form-control" id="KecamatanID" style="width: 100%;">
                                <option value="">Pilih Kecamatan</option>
                                <?= OptionDaerah('kecamatan', '1375', ''); ?>
                            </select>
                        </div>
                        <div class="mb-2 col-md-6">
                            <select name="KelurahanID" class="form-control" id="KelurahanID" style="width: 100%;">
                                <option value="">Pilih Kelurahan</option>
                            </select>
                        </div>
                        <div class="mb-2 col-md-4">
                            <select name="Kondisi" class="form-control" id="Kondisi">
                                <option value="">Pilih Kondisi</option>
                                <option value="Baik">Baik</option>
                                <option value="Sedang">Sedang</option>
                            </select>
                        </div>
                        <div class="mb-2 col-md-4">
                            <select name="JenisSaluran" class="form-control" id="JenisSaluran">
                                <option value="">Pilih Jenis Saluran</option>
                                <option value="Primer">Primer</option>
                                <option value="Sekunder">Sekunder</option>
                            </select>
                        </div>
                        <div class="mb-2 col-md-4">
                            <select name="Konstruksi" class="form-control" id="Konstruksi">
                                <option value="">Pilih Konstruksi</option>
                                <option value="Beton">Beton</option>
                                <option value="Pasang Batu">Pasang Batu</option>
                            </select>
                        </div>

                        <div class="mb-2 col-md-12 d-flex justify-content-center justify-content-lg-end">
                            <button type="submit" class="btn-get-started scrollto btn-sm"> Tampilkan
                                Data</button>
                        </div>

                    </div>
                </form>

                <div id="sidebar" class="sidebar collapsed">
                    <!-- Nav tabs -->
                    <div class="div mt-3" id="dataLeyers">

                    </div>
                </div>

                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12 mb-4">
                            <div id="mapid" style="height: 800px; position: sticky;"></div>
                        </div>

                    </div>
                </div>



            </div>

        </div>
    </section><!-- End Portfolio Details Section -->
    <!-- ======= Why Us Section ======= -->
    <!-- End Why Us Section -->
    <section id="" class="about" style="background-color: #3d4d6a;color: #fff;">
        <div class="container aos-init aos-animate" data-aos="fade-up">

            <div class="section-title">
                <h3 class="text-h3">Total Panjang Ruas Drainase Kota Bukittinggi</h3>
                <h1 id="tPjg" class="text-h1"></h1>
                <p>Bedasarkan Hasil Survei 2023 | Identitas Rekomendasi dari BPS No. : BPS No.V-23.1375.002</p>
            </div>
            <div class="d-flex align-items-center justify-content-center">
                <a href="#tabel-drainase" class="btn-get-started scrollto">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        style="fill: rgba(0, 0, 0, 1);">
                        <path
                            d="M19 21a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14zm-8-9V7h2v5h4l-5 5-5-5h4z">
                        </path>
                    </svg>
                    Data
                    Drainase
                </a>

            </div>
        </div>
    </section>
    <!-- ======= Skills Section ======= -->
    <section id="tabel-drainase" class="about">
        <div class="container aos-init aos-animate" data-aos="fade-up">

            <div class="section-title">
                <h2 style="color: black;">Data Drainase</h2>
                <p style="color: black;">Lihat Data Drainase Perkotaan Kota Bukittinggi Dalam Bentuk Tubular Data</p>
            </div>

            <div class="card content">
                <div class="table-responsive p-4">
                    <table class="table table-hover" id="DTable">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Drainase</th>
                                <th class="text-center">Informasi</th>
                                <th class="text-center">Konstruksi</th>
                                <th class="text-center">Kondisi</th>
                                <th class="text-center">Saluran</th>
                                <th class="text-center">Penampang</th>
                                <th class="text-center">Detail</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </section>
    <section class="services section-bg">
        <div class="container aos-init aos-animate" data-aos="fade-up">

            <div class="section-title">
                <h2 style="color: black;"><b>Lihat Data Drainase Kota Bukittinggi Dalam Grafik</b></h2>
            </div>
            <div class="row">
                <div class="col-md-4">

                    <div data-aos="fade-up">
                        <div class="row content">
                            <div id="containerC"></div>
                        </div>

                    </div>

                </div>

                <div class="col-md-4">

                    <div data-aos="fade-up">
                        <div class="row content">
                            <div id="containerF"></div>
                        </div>

                    </div>

                </div>
                <div class="col-md-4">

                    <div data-aos="fade-up">
                        <div class="row content">
                            <div id="containerD"></div>
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
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<!-- <script src="<?= base_url(); ?>/assets/js/app-peta.js"></script> -->
<script src="<?= base_url(); ?>/assets/js/grafik-peta.js"></script>
<script src="<?= base_url(); ?>assets/leaflet-fullscreen-master/Control.FullScreen.js"></script>

<script>
function clearOptions(id) {

    //$('#' + id).val(null);
    $('#' + id).empty().trigger('change');
}
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


DTable = $('#DTable').DataTable({
    pageLength: 5,
    lengthMenu: [
        [5, 10, 20, -1],
        [5, 10, 20, 'All']
    ],
    processing: true,
    serverSide: true,
    ajax: {
        url: "<?= base_url() ?>datatable/d",
        type: "POST",
        data: function(d) {
            d.datatable = 'drainase';
            d.tahun = $("#Tahun").val();
            d.kec = $("#KecamatanID").val();
            d.kel = $("#KelurahanID").val();
            d.kondisi = $("#Kondisi").val();
            d.type = $("#JenisSaluran").val();
            d.konst = $("#Konstruksi").val();
        },
    },
    order: [],
    columnDefs: [{
            width: '10px',
            targets: 0
        }, //step 2, column 1 out of 4
        {
            width: '300px',
            targets: 1
        }, //step 2, column 3 out of 4
        {
            className: "align-middle",
            targets: ['_all']
        }, {
            className: "text-center",
            targets: [0, 3, 4, 5, 6, 7]
        }
    ],
    columns: [{
        data: 'No',
        orderable: false
    }, {
        data: 'Drainase'
    }, {
        data: 'Informasi'
    }, {
        data: 'Konstruksi'
    }, {
        data: 'Kondisi'
    }, {
        data: 'PosisiSaluran'
    }, {
        data: 'Penampang'
    }, {
        data: 'Button'
    }]
});


var base_url = $("#base_url").val();

var OpenTopoMap = L.tileLayer(
    "http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
        maxZoom: 20,
        attribution: 'Map data: &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap contributors</a>',
    }
);

// Tile type: openstreetmap Hot
var openGoogle = L.tileLayer(
    "https://mt1.google.com/vt/lyrs=m&x={x}&y={y}&z={z}", {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a>  contributors, <a href="https://maps.google.com/">Google Maps</a>',
        maxZoom: 20,
    }
);

var road = L.tileLayer("https://mt1.google.com/vt/lyrs=h&x={x}&y={y}&z={z}");

var map;
var wilayahA;
var wilayahB;
var layerControl;
map = L.map("mapid", {
    center: new L.LatLng(-0.30907, 100.37055),
    zoom: 14,
    tap: false,
    layers: [openGoogle],
    fullscreenControl: true,
    fullscreenControlOptions: {
        // optional
        title: "Show me the fullscreen !",
        titleCancel: "Exit fullscreen mode",
    },
});

map.createPane("pane250").style.zIndex = 250; // between tiles and overlays
map.createPane("pane450").style.zIndex = 450; // between overlays and shadows
map.createPane("pane620").style.zIndex = 620; // between markers and tooltips
map.createPane("pane800").style.zIndex = 800; // above popups

var allOptions = {
    "Google Maps": openGoogle,
    "OpenStreet Map": OpenTopoMap,
};

layerControl = L.control
    .layers(allOptions, null, {
        position: 'topleft',
        collapsed: false,
    })
    .addTo(map);

const baseMapLayer = L.layerGroup();
const subLayer = L.layerGroup();
loadLayer();

function loadLayer() {
    // map.removeLayer(polyline);
    hidePolyline();

    $.ajax({
        type: "POST",
        url: base_url + "peta/load-all-layer",
        enctype: "multipart/form-data",
        dataType: "json",
        success: function(response) {
            var batasLayer = response.layer;

            batasLayer.forEach((valLayer, index) => {
                var bkkt = valLayer.Coord;
                if (bkkt.length > 0) {
                    if (valLayer.Position == "Atas") {
                        var pn = "pane620";
                    } else {
                        var pn = "pane250";
                    }
                    var geo = L.geoJson(bkkt, {
                        pane: pn,
                        onEachFeature: function(feature, layer) {
                            layer.on({
                                mouseover: highlightFeature,
                                mouseout: resetHighlight,
                                click: zoomToFeature,
                            });

                            var html = '<div class="tooltip-sub ">';
                            if (feature.properties.Gambar !== "") {
                                html +=
                                    '<img src="' +
                                    feature.properties.Gambar +
                                    '" alt=""  class=img-fluid" style="width:200px ;">';
                            }
                            if (feature.properties.Nama !== null) {
                                html +=
                                    '<p class="label label-info mb-0">Nama : ' +
                                    feature.properties.Nama +
                                    "</p>";
                            }
                            if (feature.properties.Posisi != null && feature.properties
                                .Posisi != '') {
                                html +=
                                    '<p class="m-0">Posisi : ' + feature.properties
                                    .Posisi +
                                    "</p>";
                            }
                            if (feature.properties.Tinggi != null && feature.properties
                                .Tinggi != 0) {
                                html +=
                                    '<p class="m-0">Tinggi : ' + feature.properties
                                    .Tinggi +
                                    "</p>";
                            }
                            if (feature.properties.Luas != null && feature.properties
                                .Luas != 0) {
                                html +=
                                    '<p class="m-0">Luas : ' + feature.properties.Luas +
                                    "</p>";
                            }
                            if (feature.properties.Keterangan !== null) {
                                html +=
                                    '<p class="m-0">Keterangan<br>' + feature.properties
                                    .Keterangan +
                                    "</p>";
                            }
                            html += "</div>";
                            layer.bindTooltip(html).openTooltip();
                        },
                        style: function(feature, layer) {
                            return {
                                weight: "3",
                                fillOpacity: 0.5,
                                fillColor: feature.properties.WarnaUtama,
                                color: feature.properties.WarnaBatas,
                            };
                        },
                    });

                    layerControl.addOverlay(geo, valLayer.Ket);

                    function highlightFeature(e) {
                        var layer = e.target;

                        layer.setStyle({
                            weight: 3,
                            color: "#666",
                            dashArray: "",
                            fillOpacity: 0.5,
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

function calcMiddleLatLng(map, latlng1, latlng2) {
    // calculate the middle coordinates between two markers
    const p1 = map.project(latlng1);
    const p2 = map.project(latlng2);
    return map.unproject(p1._add(p2)._divideBy(2));
}

function createMiddleMarkers(line, feature) {


    var latlngs = line.getLatLngs()[0];
    var bg = latlngs.length / 2;
    var bgi = bg.toFixed();

    var left = latlngs[bgi - 1];
    var right = latlngs[bgi];
    var newLatLng = calcMiddleLatLng(map, left, right);

    L.marker(newLatLng).addTo(map).bindPopup(
            `<span class="w3-tag w3-blue">${feature.properties.KodeDrain}</span><p class="m-0">${feature.properties.NamaJalan}</p><p class="m-0">${feature.properties.Kondisi}</p>`
        )
        .openPopup();

}
onClickProses(0);

function onClickProses(id) {
    // map.removeLayer(polyline);
    hidePolyline();

    let formData = new FormData();

    formData.append("KecamatanID", $("#KecamatanID").val());
    formData.append("KelurahanID", $("#KelurahanID").val());
    formData.append("Kondisi", $("#Kondisi").val());
    formData.append("JenisSaluran", $("#JenisSaluran").val());
    formData.append("Konstruksi", $("#Konstruksi").val());

    if (id != 0) {
        viewDiv(id);
    }
    var arr = [];
    $("input[type=checkbox]").each(function() {
        var self = $(this);
        if (self.is(":checked")) {
            arr.push(self.attr("id"));
        }
    });
    if (arr.length == 0) {
        formData.append("DrainaseID", []);
        // myCounters.add();
        $(".my-custom-counters").hide();
    } else {
        $.each(arr, function(key, value) {
            formData.append("DrainaseID[]", value);
        });
        $(".my-custom-counters").show();
    }

    $.ajax({
        type: "POST",
        url: base_url + "peta/get-coordinat",
        data: formData,
        cache: false,
        processData: false,
        contentType: false,
        dataType: "json",
        success: function(response) {
            if (response.param == 1) {
                var wilayahA = L.geoJSON(response.cordinat, {
                    pane: "pane450",
                    onEachFeature: function(feature, layer) {
                        layer.on("click", function(event) {
                            removeMarkers();
                            createMiddleMarkers(layer, feature);
                            map.fitBounds(layer.getBounds());
                            viewDiv(feature.properties.DrainaseID);
                        });
                        layer.on("mouseover", function() {
                            this.bindTooltip(
                                `<span class="w3-tag w3-blue">${feature.properties.KodeDrain}</span><p class="m-0">${feature.properties.NamaJalan}</p><p class="m-0">${feature.properties.Kondisi}</p>`
                            ).openTooltip();
                        });

                    },
                    style: function(feature, layer) {
                        switch (feature.properties.Kondisi) {
                            case "Baik":
                                return {
                                    color: "#2596be",
                                };
                                break;
                            case "baik":
                                return {
                                    color: "#2596be",
                                };
                                break;
                            case "Sedang":
                                return {
                                    color: "#be4d25",
                                };
                                break;
                            case "sedang":
                                return {
                                    color: "#be4d25",
                                };
                                break;
                            default:
                                return {
                                    color: "#000",
                                };
                                break;
                        }
                    },
                }).addTo(map);
                map.fitBounds(wilayahA.getBounds());
            }

            // wilayahA.setZIndex(9999);
        },
        failure: function(response) {
            alert(response.responseText);
        },
        error: function(response) {
            alert(response.responseText);
        },
    });
}

baseMapLayer.addTo(map);

$(document).ready(function() {
    $("form#form-peta").submit(function(e) {
        hidePolyline();
        DTable.ajax.reload(null, false);
        onClickProses(0);
        dataGrafik();
        $(".my-custom-counters").hide();

        e.preventDefault();
        var form = this;
        $.ajax({
            url: base_url + "peta/load-sidebar",
            method: $(form).attr("method"),
            enctype: "multipart/form-data",
            data: new FormData(form),
            processData: false,
            contentType: false,
            cache: false,
            success: function(data, textStatus) {
                if (data.param == 1) {
                    $("#dataLeyers").html(data.ulc);
                    sidebar.show();
                } else {
                    sidebar.hide();
                    Swal.fire({
                        icon: "warning",
                        title: "Perhatian!",
                        text: "Data drainase tidak ada",
                    });
                }
            },
            error: function(jqXhr, textStatus, errorMessage) {
                // console.log(textStatus)
                // console.log(errorMessage)
                // console.log(jqXhr.responseJSON.message)
                Swal.fire({
                    icon: "error",
                    title: jqXhr.statusText,
                    text: jqXhr.responseJSON.message,
                });
            },
        });
    });
});

function hidePolyline() {
    // map.removeLayer(polyline); // For hide
    // polyline.remove();
    map.eachLayer(function(layer) {
        if (!!layer.toGeoJSON) {
            map.removeLayer(layer);
        }
        // map.removeLayer(layer);
    });
}

function removeMarkers() {
    map.eachLayer((layer) => {
        if (layer instanceof L.Marker) {
            layer.remove();
        }
    });
}

var sidebar = L.control.sidebar("sidebar").addTo(map);

var MyCounters = L.Control.extend({
    options: {
        position: "topright",
    },
    onAdd: function(map) {
        return L.DomUtil.create("div", "my-custom-counters");
    },
    setContent: function(content) {
        this.getContainer().innerHTML = content;
    },
});
myCounters = new MyCounters().addTo(map);

function viewDiv(id) {
    $.ajax({
        type: "POST",
        url: base_url + "peta/detail-coordinat",
        data: {
            idDrain: id,
        },
        enctype: "multipart/form-data",
        dataType: "json",
        success: function(response) {
            impact = ` <div class="ImpactHeader"><h3 class="mt-0">${response.Nama}</h3><span class="w3-tag p-2 w3-teal">${response.KodeDrain}</span> </div>
                            <div class="undefined">
                                <table style="width:100%;">
                                    <tr>
                                        <td>
                                            <div class="ImpactLead">Kondisi : </div>
                                        </td>
                                        <td>
                                            <div class="ImpactCount">${response.Kondisi}</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="ImpactLead">Panjang : </div>
                                        </td>
                                        <td>
                                            <div class="ImpactCount">${response.Panjang} meter</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="ImpactLead">Posisi Saluran : </div>
                                        </td>
                                        <td>
                                            <div class="ImpactCount">${response.PosisiSaluran}</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="ImpactLead">Type Saluran : </div>
                                        </td>
                                        <td>
                                            <div class="ImpactCount">${response.JenisSaluran}</div>
                                        </td>
                                    </tr> 
                                    <tr>
                                        <td>
                                            <div class="ImpactLead">Penampang : </div>
                                        </td>
                                        <td>
                                            <div class="ImpactCount">${response.Penampang}</div>
                                        </td>
                                    </tr>       
                                    </tr>
                                        <tr>
                                        <td>
                                            <div class="ImpactLead">Keterangan : </div>
                                        </td>
                                        <td>
                                            <div class="ImpactCount">${response.Keterangan}</div>
                                        </td>
                                    </tr>
                                </table>
                                <div style="display: flex;justify-content: center;">
                                <a href="${base_url}peta/detail-drainase/${response.KodeDrain}" target="_blank" class="w3-tag w3-blue w3-round w3-small p-2 mt-2">Lihat Detail Data</a>
                                </div>
                            </div>`;
            myCounters.setContent(impact);
        },
        failure: function(response) {
            alert(response.responseText);
        },
        error: function(response) {
            alert(response.responseText);
        },
    });
}

map.on("overlayadd", function(e) {
    var nama = e.name.replace(" ", "_");
    $("#" + nama).show();
});

map.on("overlayremove", function(e) {
    var nama = e.name.replace(" ", "_");
    $("#" + nama).hide();
});



const legend2 = L.control({
    position: "bottomleft",
});

legend2.onAdd = function(map) {



    var div = L.DomUtil.create("div", "info legend legend-drainase");


    $.get("<?= base_url('peta/legend'); ?>", function(data, status) {
        console.log(data);

        data.forEach(function(va, index, arr) {
            var element = '';
            for (let i = 0; i < va.field.length; i++) {
                element +=
                    '<i style="background: ' + va.field[i] + '"></i><span>' + va.value[i] +
                    '</span><br>';
            }

            div.innerHTML += "<div id='" + va.id +
                "' style='display:none;'>" +
                "<h4><b>" + va.name + "</b></h4>" +
                element +
                "</div>";

        });
    }, 'json');



    div.innerHTML +=
        '<i style="background: #2596be"></i><span>Baik (Kondisi Baik)</span><br>';
    div.innerHTML +=
        '<i style="background: #be4d25"></i><span>Sedang (Kondisi Sedang)</span><br>';
    // for (let index = 0; index < name.length; index++) {

    //    
    //     div.innerHTML += '<i style="background: #fff7bc"></i><span>Kec. Mandiangin Koto Selayan</span><br>';
    //     div.innerHTML += '<i style="background: #d95f0e"></i><span>Kec. Guguak Panjang</span><br>';
    //     div.innerHTML += '<i style="background: #fec44f"></i><span>Kec. Aur Birugo Tigo Baleh</span><br>';

    // }

    return div;
};


legend2.addTo(map);
</script>
<?= $this->endSection() ?>
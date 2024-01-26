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

    .info {
        padding: 6px 8px;
        font: 14px/16px Arial, Helvetica, sans-serif;
        background: white;
        background: rgba(255, 255, 255, 0.8);
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        border-radius: 5px;
    }

    .info h4 {
        margin: 0 0 5px;
        color: #777;
    }

    .scroll-sub {
        margin: 4px, 4px;
        padding: 4px;
        max-height: 400px;
        overflow-x: hidden;
        overflow-y: auto;
        text-align: justify;
        margin: 20px;
        background-color: #303549;
        color: white;
    }



    .tooltip-sub {
        margin: 0 auto;
        max-width: 15rem;
        border-radius: 3px;
        text-align: center;
        width: max-content;
        white-space: normal;
    }

    .tooltip-sub img {
        width: 150px;
    }

    .label-tooltip {
        border-radius: 4px;
        font-size: 100%;
        padding: 4px 7px;
        font-weight: 600;
        color: #fff !important;
    }

    /*Legend specific*/
    .legend {
        padding: 6px 8px;
        font: 14px Arial, Helvetica, sans-serif;
        background: white;
        background: rgba(255, 255, 255, 0.8);
        /*box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);*/
        /*border-radius: 5px;*/
        line-height: 24px;
        color: #555;
    }

    .legend h4 {
        text-align: center;
        font-size: 16px;
        margin: 2px 12px 8px;
        color: #777;
    }

    .legend span {
        position: relative;
        bottom: 3px;
    }

    .legend i {
        width: 18px;
        height: 18px;
        float: left;
        margin: 0 8px 0 0;
        opacity: 0.7;
    }

    .legend i.icon {
        background-size: 18px;
        background-color: rgba(255, 255, 255, 1);
    }
</style>
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
                                            <h4>Wilayah Batas Administrasi</h4>
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
                                <div class="card-header">
                                    <h5><?= $Nama; ?></h5>
                                    <button class="btn btn-success modal-open-cre" id="layer-legend" layerid="<?= $LayerID; ?>" tooltip="tambah / edit legend">Buat Legend</button>
                                    <input type="hidden" name="LayerID" id="LayerID" value="<?= $LayerID; ?>">

                                </div>
                                <div class="card-block">
                                    <div id="mapid" style="height: 500px;">

                                    </div>
                                </div>

                                <div class="scroll-sub">
                                    <div class="card-block">
                                        <?php
                                        $query = db_connect()->table('layer_sub')->where('LayerID', $LayerID)->get();
                                        $no = 1;
                                        foreach ($query->getResultArray() as $key => $value) { ?>
                                            <div class="badge-box">
                                                <div class="row">
                                                    <div class="col">
                                                        <h5><?= $no; ?>, <?= $value['Nama']; ?></h5>
                                                    </div>
                                                    <div class="col d-flex justify-content-center">
                                                        <button class="btn btn-primary btn-sm lihatMap mr-2" id="<?= $value['LayerSubID']; ?>" tooltip="Tampil layer di map">Lihat</button>
                                                        <button class="btn btn-info btn-sm modal-open-cre" id="layer-style" layersubid="<?= $value['LayerSubID']; ?>" tooltip="detail layer">Detail</button>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                            $no++;
                                        }

                                        ?>


                                    </div>
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
    var map = L.map('mapid', {
        doubleClickZoom: false,
        attributionControl: false,
        center: [-0.30907, 100.37055],
        zoom: 15
    });
    L.tileLayer("https://mt1.google.com/vt/lyrs=m&x={x}&y={y}&z={z}", {
        maxZoom: 20,
        openLegendOnLoad: false,
        scrollWheelZoom: false,
        attribution: ''
    }).addTo(map)

    const legend = L.control({
        position: "bottomleft",
    });

    onLoadGeojson();
    map.createPane("pane450").style.zIndex = 450; // 
    function onLoadGeojson() {
        let formData = new FormData();

        formData.append('LayerID', $('#LayerID').val());


        $.ajax({
            type: 'POST',
            url: '<?= base_url('admin/layer/coordinat'); ?>',
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success: function(data) {
                if (data.param > 0) {
                    // var bkkt = JSON.parse(data.geojson);
                    legend.onAdd = function(map) {

                        var div = L.DomUtil.create("div", "info legend");

                        var lg = data.legend;
                        // console.log(lg);
                        lg.forEach(function(val, index, arr) {
                            var element = '';
                            console.log(val.field);
                            for (let i = 0; i < val.field.length; i++) {
                                element +=
                                    '<i style="background: ' + val.field[i] + '"></i><span>' + val
                                    .value[
                                        i] +
                                    '</span><br>';
                            }

                            div.innerHTML += "<div id='" + val.id + "'>" +
                                "<h4>" + val.name + "</h4>" +
                                element +
                                "</div>";
                        });

                        return div;
                    };
                    legend.addTo(map);

                    var geo = L.geoJson(data.geojson, {
                        onEachFeature: function(feature, layer) {
                            layer.on({
                                mouseover: highlightFeature,
                                mouseout: resetHighlight,
                                click: zoomToFeature
                            });
                            var html = '<div class="tooltip-sub ">';
                            if (feature.properties.Gambar != '') {
                                html +=
                                    '<img src="' + feature.properties.Gambar +
                                    '" alt=""  class=img-fluid">';
                            }
                            if (feature.properties.Nama !== null) {
                                html +=
                                    '<p class="label-tooltip label-info mb-0">' + feature.properties
                                    .Nama + '</p>';
                            }
                            if (feature.properties.Keterangan !== null) {
                                html +=
                                    '<p class="m-0">' + feature.properties.Keterangan + '</p>';
                            }
                            html += '</div>';
                            layer.bindTooltip(html).openTooltip();
                            // console.log(layer.getLatLngs());
                        },
                        style: confirmedStyle

                    }).addTo(map);

                    map.fitBounds(geo.getBounds());

                    function resetHighlight(e) {
                        // info.update();
                        geo.resetStyle(e.target);
                    }
                }


            },
            error: function(jqXhr, status, error) {
                console.log(jqXhr);
                Swal.fire({
                    icon: 'error',
                    title: jqXhr.statusText,
                    text: jqXhr.responseJSON.message,
                })
            }
        });
    }

    map.createPane("pane620").style.zIndex = 620; //

    // var info = L.control();
    // info.onAdd = function(map) {
    //     this._div = L.DomUtil.create('div', 'info'); // create a div with a class "info"
    //     this.update();
    //     return this._div;
    // };

    // // method that we will use to update the control based on feature properties passed
    // info.update = function(props) {
    //     console.log(props);
    //     this._div.innerHTML = '<h5>Nama Daerah / Nama Jalan</h5>' + (props ?
    //         '<b>' + props.Nama + '</b>' :
    //         'Hover over a state');
    // };

    // info.addTo(map);

    function confirmedStyle(feature) {
        console.log(feature.properties.WarnaBatas);
        return {
            weight: '2',
            fillOpacity: 1,
            fillColor: feature.properties.WarnaUtama,
            color: feature.properties.WarnaBatas,
        }
    };


    function highlightFeature(e) {
        var layer = e.target;
        // info.update(layer.feature.properties);

        layer.setStyle({
            weight: 5,
            color: '#666',
            dashArray: '',
            fillOpacity: 0.7
        });

        layer.bringToFront();
    }



    function zoomToFeature(e) {
        map.fitBounds(e.target.getBounds());
    }
    // const legend = L.control({
    //     position: 'bottomright'
    // });

    // legend.onAdd = function(map) {

    //     const div = L.DomUtil.create('div', 'info legend');
    //     const grades = ['Kec. Mandiangin Koto Selayan', 'Kec. Guguak Panjang', 'Kec. Aur Birugo Tigo Baleh'];
    //     const labels = [];
    //     let from, to;

    //     for (let i = 0; i < grades.length; i++) {
    //         from = grades[i];
    //         labels.push(`<i style="background:${getColor(from)}"></i> ${from}`);
    //     }

    //     div.innerHTML = labels.join('<br>');
    //     return div;
    // };

    // legend.addTo(map);

    // function getColor(d) {
    //     return d == 'Kec. Mandiangin Koto Selayan' ? '#fff7bc' :
    //         d > 'Kec. Aur Birugo Tigo Baleh' ? '#d95f0e' :
    //         d > 'Kec. Guguak Panjang' ? '#fec44f' : '#fec44f';
    // }

    $(".lihatMap").click(function() {
        var id = $(this).attr('id');
        $.get("<?= base_url('admin/layer/show-id/'); ?>" + id, function(data, status) {
            console.log(data.cordinat);
            var polygon = L.geoJSON(data.cordinat, {
                style: function(feature) {
                    return {
                        weight: 2,
                        color: "red",
                        opacity: 1,
                        fillColor: "red",
                        fillOpacity: 0.8
                    }
                },
            }).addTo(map);
            map.fitBounds(polygon.getBounds());
            setTimeout(() => {
                polygon.remove();
            }, 1500);

        }, 'json');
    });
</script>
<?= $this->endSection() ?>
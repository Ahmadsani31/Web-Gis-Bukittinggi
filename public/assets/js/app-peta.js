var base_url = $("#base_url").val();

var OpenTopoMap = L.tileLayer(
  "http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",
  {
    maxZoom: 20,
    attribution:
      'Map data: &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap contributors</a>',
  }
);

// Tile type: openstreetmap Hot
var openGoogle = L.tileLayer(
  "https://mt1.google.com/vt/lyrs=m&x={x}&y={y}&z={z}",
  {
    attribution:
      'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a>  contributors, <a href="https://maps.google.com/">Google Maps</a>',
    maxZoom: 20,
  }
);

var road = L.tileLayer("https://mt1.google.com/vt/lyrs=h&x={x}&y={y}&z={z}");

var map;
var wilayahA;
var wilayahB;
var layerControl;
map = L.map("mapid", {
  scrollWheelZoom: false,
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
    success: function (response) {
      var batasLayer = response.layer;

      batasLayer.forEach((valLayer, index) => {
        var bkkt = valLayer.Coord;
        // console.log(bkkt);
        if (bkkt.length > 0) {
          if (valLayer.Position == "Atas") {
            var pn = "pane620";
          } else {
            var pn = "pane250";
          }
          var geo = L.geoJson(bkkt, {
            pane: pn,
            onEachFeature: function (feature, layer) {
              layer.on({
                mouseover: highlightFeature,
                mouseout: resetHighlight,
                click: zoomToFeature,
              });

              var html = '<div class="tooltip-sub ">';
              if (feature.properties.Gambar != "") {
                html +=
                  '<img src="' +
                  feature.properties.Gambar +
                  '" alt=""  class=img-fluid">';
              }
              if (feature.properties.Nama != null) {
                html +=
                  '<p class="label label-info mb-0">' +
                  feature.properties.Nama +
                  "</p>";
              }
              if (feature.properties.Keterangan != null) {
                html +=
                  '<p class="m-0">' + feature.properties.Keterangan + "</p>";
              }
              html += "</div>";
              layer.bindTooltip(html).openTooltip();
            },
            style: function (feature, layer) {
              return {
                weight: "3",
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
    failure: function (response) {
      alert(response.responseText);
    },
    error: function (response) {
      alert(response.responseText);
    },
  });
}
onClickProses(0);

function onClickProses(id) {
  // map.removeLayer(polyline);
  hidePolyline();

  let formData = new FormData();

  formData.append("KecamatanID", $("#KecamatanID").val());
  formData.append("KelurahanID", $("#KelurahanID").val());
  formData.append("Kondisi", $("#Kondisi").val());
  formData.append("TipeSalur", $("#TipeSalur").val());
  formData.append("Konstruksi", $("#Konstruksi").val());

  if (id != 0) {
    viewDiv(id);
  }
  var arr = [];
  $("input[type=checkbox]").each(function () {
    var self = $(this);
    if (self.is(":checked")) {
      arr.push(self.attr("id"));
    }
  });
  // console.log(arr);
  if (arr.length == 0) {
    formData.append("DrainaseID", []);
    // myCounters.add();
    $(".my-custom-counters").hide();
  } else {
    $.each(arr, function (key, value) {
      formData.append("DrainaseID[]", value);
    });
    $(".my-custom-counters").show();
  }
  // console.log(arr);

  $.ajax({
    type: "POST",
    url: base_url + "peta/get-coordinat",
    data: formData,
    cache: false,
    processData: false,
    contentType: false,
    dataType: "json",
    success: function (response) {
      if (response.param == 1) {
        var wilayahA = L.geoJSON(response.cordinat, {
          pane: "pane450",
          onEachFeature: function (feature, layer) {
            layer.on("click", function (event) {
              // console.log(feature);

              viewDiv(feature.properties.DrainaseID);
            });
            layer.on("mouseover", function () {
              this.bindTooltip(
                `<span class="w3-tag w3-blue">${feature.properties.KodeDrain}</span><p class="m-0">${feature.properties.NamaJalan}</p><p class="m-0">${feature.properties.Kondisi}</p>`
              ).openTooltip();
            });
          },
          style: function (feature, layer) {
            switch (feature.properties.Kondisi) {
              case "Baik":
                return {
                  color: "#2596be",
                };
                break;
              case "Sedang":
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
    failure: function (response) {
      alert(response.responseText);
    },
    error: function (response) {
      alert(response.responseText);
    },
  });
}

baseMapLayer.addTo(map);

$(document).ready(function () {
  $("form#form-peta").submit(function (e) {
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
      success: function (data, textStatus) {
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
      error: function (jqXhr, textStatus, errorMessage) {
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
  map.eachLayer(function (layer) {
    // console.log(layer);
    if (!!layer.toGeoJSON) {
      map.removeLayer(layer);
    }
    // map.removeLayer(layer);
  });
}

var sidebar = L.control.sidebar("sidebar").addTo(map);

var MyCounters = L.Control.extend({
  options: {
    position: "bottomright",
  },
  onAdd: function (map) {
    return L.DomUtil.create("div", "my-custom-counters");
  },
  setContent: function (content) {
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
    success: function (response) {
      impact = ` <div class="ImpactHeader"><h3 class="mt-0">${response.Nama}</h3><span class="w3-tag w3-teal">${response.KodeDrain}</span> </div>
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
                                            <div class="ImpactCount">${response.TipeSalur}</div>
                                        </td>
                                    </tr>
                                </table>
                                <a href="${base_url}peta/detail-drainase/${response.KodeDrain}" target="_blank" class="w3-tag w3-blue w3-round w3-small p-2 mt-2">Lihat Detail</a>
                            </div>`;
      myCounters.setContent(impact);
    },
    failure: function (response) {
      alert(response.responseText);
    },
    error: function (response) {
      alert(response.responseText);
    },
  });
}

map.on("overlayadd", function (e) {
  var nama = e.name.replace(" ", "_");
  $("#" + nama).show();
});

map.on("overlayremove", function (e) {
  var nama = e.name.replace(" ", "_");
  $("#" + nama).hide();
});
// const legend = L.control({
//   position: "bottomright",
// });

// legend.onAdd = function (map) {
//   const div = L.DomUtil.create("div", "info legend style-legend");
//   const grades = [
//     "Kec. Mandiangin Koto Selayan",
//     "Kec. Guguak Panjang",
//     "Kec. Aur Birugo Tigo Baleh",
//   ];
//   const labels = [];
//   let from, to;

//   for (let i = 0; i < grades.length; i++) {
//     from = grades[i];
//     labels.push(`<i style="background:${getColor(from)}"></i> ${from}`);
//   }

//   div.innerHTML = labels.join("<br>");
//   return div;
// };

// legend.addTo(map);

// function getColor(d) {
//   return d == "Kec. Mandiangin Koto Selayan"
//     ? "#fff7bc"
//     : d > "Kec. Aur Birugo Tigo Baleh"
//     ? "#d95f0e"
//     : d > "Kec. Guguak Panjang"
//     ? "#fec44f"
//     : "#fec44f";
// }

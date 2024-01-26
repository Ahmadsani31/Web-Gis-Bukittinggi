dataGrafik();
function dataGrafik() {
  var colors = ["#36a2eb", "#fcdc3c", "#3cfcef", "#3c5cfc", "#fc3cbc"];

  var base_url = $("#base_url").val();
  let formGrafik = new FormData();

  formGrafik.append("KecamatanID", $("#KecamatanID").val());
  formGrafik.append("KelurahanID", $("#KelurahanID").val());
  formGrafik.append("Kondisi", $("#Kondisi").val());
  formGrafik.append("TipeSalur", $("#TipeSalur").val());
  formGrafik.append("Konstruksi", $("#Konstruksi").val());

  //load grafik kondisi
  $.ajax({
    type: "POST",
    url: base_url + "peta/data-grafik",
    data: formGrafik,
    cache: false,
    processData: false,
    contentType: false,
    dataType: "json",
    success: function (response) {
      $("#tPjg").html(response.TotPanjang);
      var ArrSedimen=[];

     var dSedimen = response.SedimentGrafik;

     dSedimen.forEach((val, index) => {
      ArrSedimen.push({
        name: val.name,
        y: parseFloat(val.y)
    });
     });
      Highcharts.chart("containerC", {
        chart: {
          plotBackgroundColor: null,
          plotBorderWidth: 0,
          plotShadow: false,
        },
        title: {
          text: "Kondisi Drainase",
          align: "center",
          verticalAlign: "top",
          y: 20,
        },
        tooltip: {
          pointFormat: "{series.name}: <b>{point.y:,.f} Meter",
        },
        accessibility: {
          point: {
            valueSuffix: "%",
          },
        },
        plotOptions: {
          pie: {
            colors: colors,
            allowPointSelect: true,
            cursor: "pointer",
            showInLegend: true,
            dataLabels: {
              enabled: true,
              style: {
                fontWeight: "bold",
              },
            },
          },
        },
        series: [
          {
            name: "Status",
            type: "pie",
            innerSize: "50%",
            colorByPoint: true,
            data: response.KondisiGrafik,
          },
        ],
      });

      Highcharts.chart("containerD", {
        chart: {
          plotBackgroundColor: null,
          plotBorderWidth: 0,
          plotShadow: false,
        },
        title: {
          text: "Jenis Drainase",
          align: "center",
          verticalAlign: "top",
          y: 20,
        },
        tooltip: {
          pointFormat: "{series.name}: <b>{point.y:,.f} Meter</b>",
        },
        accessibility: {
          point: {
            valueSuffix: "%",
          },
        },
        plotOptions: {
          pie: {
            colors: colors,
            allowPointSelect: true,
            cursor: "pointer",
            showInLegend: true,
            dataLabels: {
              enabled: true,
              style: {
                fontWeight: "bold",
              },
            },
          },
        },
        series: [
          {
            name: "Status",
            colorByPoint: true,
            type: "pie",
            innerSize: "50%",
            data: response.KontruksiGrafik,
          },
        ],
      });

      Highcharts.chart("containerF", {
        chart: {
          plotBackgroundColor: null,
          plotBorderWidth: 0,
          plotShadow: false,
        },
        title: {
          text: "Sediment Drainase",
          align: "center",
          verticalAlign: "top",
          y: 20,
        },
        tooltip: {
          pointFormat: "{series.name}: <b>{point.y:,.2f} Meter</b>",
        },
        accessibility: {
          point: {
            valueSuffix: "%",
          },
        },
        plotOptions: {
          pie: {
            colors: colors,
            allowPointSelect: true,
            cursor: "pointer",
            showInLegend: true,
            dataLabels: {
              enabled: true,
              style: {
                fontWeight: "bold",
              },
            },
          },
        },
        series: [
          {
            name: "Status",
            colorByPoint: true,
            type: "pie",
            innerSize: "50%",
            data: ArrSedimen,
          },
        ],
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

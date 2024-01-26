$(document).ready(function () {
  $(document).on("click", ".modal-open-cre", function (e) {
    $("#konten").html(
      '<div style="text-align:center; color:red; font-weight:bold;padding:10px">Loading ...</div> '
    );
    $("#loading-ajax-modal").show();
    var serial = "";
    $.each(this.attributes, function () {
      if (this.specified) {
        serial += "&" + this.name + "=" + this.value;
      }
    });

    var id = $(this).attr("id");
    var judul = $(this).attr("judul");
    var size = $(this).attr("size");
    // if (id != "undangan-nama") {
    //   $("#class").addClass("modal-lg");
    // }

    $("#myModals").modal("toggle");

    if (judul != null) {
      $(".modal-title").html(judul);
    } else {
      $(".modal-title").html("Kelola Data");
    }

    if (size != null) {
      $("#classModal").addClass(size);
    }

    base_url = $("#base_url").val();

    page = base_url + "admin/modal/modal-" + id;
    $.post(page, serial, function (data) {
      $("#loading-ajax-modal").hide();
      $("#konten").html(data);
    });
  });

  $(document).on("click", ".modal-hapus-cre", function (e) {
    var serial = "";
    $.each(this.attributes, function () {
      if (this.specified) {
        serial += "&" + this.name + "=" + this.value;
      }
    });

    Swal.fire({
      title: "Are you sure?",
      text: "You won't be able to revert this!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete it!",
    }).then((result) => {
      if (result.isConfirmed) {
        base_url = $("#base_url").val();
        page = base_url + "/delete";
        $.ajax({
          url: page,
          data: serial,
          method: "POST",
        })
          .done((data, textStatus) => {
            // console.log(data)
            // console.log(textStatus)
            DTable.ajax.reload();
            Swal.fire({
              icon: "success",
              title: textStatus,
              showConfirmButton: false,
              timer: 1500,
            });
          })
          .fail((error) => {
            Swal.fire({
              icon: "error",
              title: "Perhatian!!",
              text: error.responseJSON.messages.error,
            });
          });
      }
    });
  });
});

var url1 = window.location.href;
var path = location.pathname.split("/");
// console.log(path);

var url = location.origin + "/" + path[1];
$("ul li a").each(function () {
  var link = $(this);
  var path1 = link.get(0).href.split("/");
  // console.log(link.get(0).href.split("/"));

  if (link.get(0).href == url1) {
    $(this).addClass("active");
  } else if (path[1] === path1[3]) {
    $(this).addClass("active");
  }
});
// console.log(url);

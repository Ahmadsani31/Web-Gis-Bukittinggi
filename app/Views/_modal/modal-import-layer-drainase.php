<div class="modal-body">
    <?= form_open(base_url('admin/drainase/import-layer'), 'class="needs-validation" method="post" id="form-simpan" onsubmit="return false"'); ?>
    <?= csrf_field(); ?>
        <div class="card bg-primary">
        <div class="p-2">
            <p class="mb-0">Note :</p>
            <p class="m-0">Contoh Format Geojson, beserta properties geoJson yang wajib di isi, <a href="<?= base_url('assets/geojson/ContohDrainase.geojson'); ?>" download>Klik disini</a>, buka dengan Notepat / Notepat++</p>
            <p class="m-0">untuk import layer drainse, properties geojson harus format seperti contoh yang telah di download diatas, supaya data otomatis tersimpan ke database webgis drainase.</p>
            <p class="m-0">dan untuk format layer export Shp to geojson harus<br> <b style="font-size: 16px;">CSR:EPSG:4326 - WGS 84</b></p>
        </div>
    </div>
    <div class="form-group">
        <label class="form-label">Tahun</label>
        <select name="Tahun" id="" class="form-control">
            <?= OptCreate(['2022', '2023'], ['2022', '2023'],date('Y')); ?>

        </select>
    </div>
 <div class="form-group">
        <label class="form-label">Layer Geojson</label>
        <input type="file" name="GeojsonDrainase" class="form-control">
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
    </div>
    </form>
</div>
<script>
$(document).ready(function() {
    $('#form-simpan').submit(function(e) {
         $('.theme-loader').show();
        e.preventDefault();
        var form = this;
        $.ajax({
            url: $(form).attr('action'),
            method: $(form).attr('method'),
            enctype: 'multipart/form-data',
            data: new FormData(form),
            processData: false,
            contentType: false,
            cache: false,
            success: function(data, textStatus) {
                 $('.theme-loader').hide();
                DTable.ajax.reload(null, false);
                if (data.param > 0) {
                    $("#myModals").modal("hide");
                    Swal.fire({
                        icon: 'success',
                        title: textStatus,
                        text: data.pesan,
                        showConfirmButton: false,
                        timer: 1500
                    })
                } else {
                    var pesan = '';
                    Object.keys(data.pesan).forEach(function(key) {
                        pesan += data.pesan[key] + ", ";
                    });
                    Swal.fire({
                        icon: 'error',
                        title: 'Kesalahan !',
                        text: pesan,
                    })
                }
                // console.log(data);
                // console.log(textStatus);
            },
            error: function(jqXhr, textStatus, errorMessage) {
                 $('.theme-loader').hide();
                // console.log(textStatus)
                // console.log(errorMessage)
                // console.log(jqXhr.responseJSON.message)
                Swal.fire({
                    icon: 'error',
                    title: jqXhr.statusText,
                    text: jqXhr.responseJSON.message,
                })
            }
        })
    });
});
</script>

<!-- End Basic Modal-->
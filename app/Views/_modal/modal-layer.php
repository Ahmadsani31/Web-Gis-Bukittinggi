<?php


$Tahun = date('Y');
$Nama = '';
$Keterangan = '';
$Position = '';
$NA = '';
$JenisLayer = '';
$LayerID = $_POST['layerid'];
if ($LayerID != 0) {
    $sql = db_connect()->table('layer')->select('*')->where('DeletedAT', null)->where('LayerID', $LayerID)->get()->getRowArray();
    $Keterangan = $sql['Keterangan'];
    $Tahun = $sql['Tahun'];
    $Nama = $sql['Nama'];
    $Position = $sql['Position'];
    $NA = $sql['NA'];
    $JenisLayer = $sql['JenisLayer'];
}
?>
<div class="modal-body">
    <?= form_open(base_url('admin/layer/simpan'), 'class="needs-validation" method="post" id="form-simpan" onsubmit="return false"', ['LayerID' => $LayerID]); ?>
    <?= csrf_field(); ?>
    <div class="form-group">
        <label class="form-label">Tahun</label>
        <select name="Tahun" id="" class="form-control" require>
            <?= OptCreate(['2022', '2023'], ['2022', '2023'], $Tahun); ?>
        </select>
    </div>
    <div class="form-group">
        <label class="form-label">Nama</label>
        <input type="text" name="Nama" value="<?= $Nama; ?>" class="form-control" require>
    </div>
    <div class="form-group">
        <label class="form-label">Keterangan</label>
        <textarea name="Keterangan" id="Keterangan" cols="30" rows="5"
            class="form-control"><?= $Keterangan; ?></textarea>
    </div>
    <div class="form-group">
        <label class="form-label">Jenis layer</label>
        <select name="JenisLayer" id="JenisLayer" class="form-control">
            <option value="">Pilih Jenis Layer</option>
            <?= OptCreate(['01', '02', '03', '04'], ['Layer Batas Kecamatan', 'Layer Batas Kelurahan', 'Layer Genangan Air', 'Layer Sedimen'], $JenisLayer); ?>
        </select>
    </div>
    <div class="form-group">
        <label class="form-label">Posisi layer</label>
        <select name="Position" id="Position" class="form-control">
            <?= OptCreate(['Atas', 'Bawah'], ['Atas Layer Drainase', 'Bawah Layer Drainase'], $Position); ?>
        </select>
    </div>
    <div class="form-group">
        <label class="form-label">Aktif</label>
        <select name="NA" id="" class="form-control">
            <?= OptCreate(['N', 'Y'], ['Iya', 'Tidak'], $NA); ?>
        </select>
    </div>
    <div class="form-group">
        <label class="form-label">Layer Geojson</label>
        <input type="file" name="FGeojson" class="form-control" require>
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
                $("#myModals").modal("hide");
                DTable.ajax.reload(null, false);
                if (data.param > 0) {
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
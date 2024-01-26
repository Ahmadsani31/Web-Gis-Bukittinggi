<?php


$Nama = '';
$LayerID = '';
$Harga = '';
$Keterangan = '';
$WarnaBatas = '';
$WarnaUtama = '';
$Gambar = '';
$Posisi = '';
$Tinggi = '';
$Luas = '';
$KabupatenID = '';
$KecamatanID = '';
$KelurahanID = '';
$Panjang = '';
$JenisSedimen = '';
$LayerSubID = $_POST['layersubid'];
if (!empty($LayerSubID)) {
    $sql = db_connect()->table('layer_sub')->select('*')->where('LayerSubID', $LayerSubID)->get()->getRowArray();
    $Keterangan = $sql['Keterangan'];
    $Nama = $sql['Nama'];
    $LayerID = $sql['LayerID'];
    $WarnaUtama = $sql['WarnaUtama'];
    $WarnaBatas = $sql['WarnaBatas'];
    $Gambar = $sql['Gambar'];
    $Posisi = $sql['Posisi'];
    $Tinggi = $sql['Tinggi'];
    $Luas = $sql['Luas'] ? number_format($sql['Luas'], 3) : '';
    $Panjang = number_format($sql['Panjang'], 3);
    $KabupatenID = $sql['KabupatenID'];
    $KecamatanID = $sql['KecamatanID'];
    $KelurahanID = $sql['KelurahanID'];
    $JenisSedimen = $sql['JenisSedimen'];
}
$lokasi = 'assets/files/layer/sub/';
if (!empty($Gambar)) {
    $href1 = base_url() . $lokasi . $Gambar;
    $btn1 = 'info';
    # code...
} else {
    $href1 = '#';
    $btn1 = 'danger';
}

$sqlJenis = db_connect()->table('layer')->select('*')->where('LayerID', $LayerID)->get()->getRowArray();
$JenisLayer = $sqlJenis['JenisLayer'];
?>
<div class="modal-body">
    <?= form_open(base_url('admin/layer/style'), 'class="needs-validation" method="post" id="form-simpan" onsubmit="return false"', ['LayerSubID' => $LayerSubID]); ?>
    <?= csrf_field(); ?>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="form-label">Kecamatan</label>
                <select name="KecamatanID" class="form-control" id="KecamatanID">
                    <option value="">Pilih Salah Satu</option>
                    <?= OptionDaerah('kecamatan', @$KabupatenID, @$KecamatanID); ?>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="form-label">Kelurahan</label>
                <select name="KelurahanID" class="form-control" id="KelurahanID">
                    <option value="">Pilih Salah Satu</option>
                    <?= OptionDaerah('kelurahan', @$KecamatanID, @$KelurahanID); ?>
                </select>
            </div>
        </div>

        <?php
        if ($JenisLayer == '01' || $JenisLayer == '02') { ?>
        <div class="col-md-6">
            <div class="form-group">
                <label class="form-label">Nama</label>
                <input type="text" name="Nama" class="form-control" value="<?= $Nama; ?>" require>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="form-label">Luas | meter persegi (M<sup>2</sup>)</label>
                <input type="number" step="any" name="Luas" class="form-control" value="<?= $Luas; ?>">
            </div>
        </div>
        <?php   } elseif ($JenisLayer == '03') { ?>
        <div class="col-md-12">
            <div class="form-group">
                <label class="form-label">Nama</label>
                <input type="text" name="Nama" class="form-control" value="<?= $Nama; ?>" require>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="form-label">Tinggi | meter (M)</label>
                <input type="number" step="any" name="Tinggi" class="form-control" value="<?= $Tinggi; ?>">
            </div>

        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="form-label">Luas | meter persegi (M<sup>2</sup>)</label>
                <input type="number" step="any" name="Luas" class="form-control" value="<?= $Luas; ?>">
            </div>
        </div>
        <?php   } elseif ($JenisLayer == '04') { ?>
        <div class="col-md-12">
            <div class="form-group">
                <label class="form-label">Nama</label>
                <input type="text" name="Nama" class="form-control" value="<?= $Nama; ?>" require>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label class="form-label">Jenis Sedimen</label>
                <input type="text" name="JenisSedimen" class="form-control" value="<?= $JenisSedimen; ?>" require>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="form-label">Tinggi | meter (M)</label>
                <input type="number" step="any" name="Tinggi" class="form-control" value="<?= $Tinggi; ?>">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="form-label">Panjang | meter (M)</label>
                <input type="number" step="any" name="Panjang" class="form-control" value="<?= $Panjang; ?>">
            </div>
        </div>
        <?php } ?>

    </div>
    <div class="form-group">
        <label class="form-label">Keterangan</label>
        <textarea name="Keterangan" class="form-control" cols="30" rows="5"><?= $Keterangan; ?></textarea>
    </div>
    <div class="form-group">
        <label class="form-label">Gambar</label>
        <div class="input-group mb-3">
            <div class="input-group-text">
                <input type="checkbox" name="deleteImg" value="Gambar" class="form-control">
            </div>
            <div class="custom-file" style="width: 100%;">
                <input type="file" name="Gambar" class="form-control" accept="image/png, image/jpg, image/jpeg"
                    style="width: 100%;">
            </div>
            <div class="input-group-append">
                <a href="<?= $href1; ?>" class="btn btn-<?= $btn1; ?>" target="_blank"><i
                        class="ri-file-image-line"></i></a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label class="form-label">Warna Utama </label>
            <div class="input-group mb-3">
                <div class="input-group-text">
                    <input type="color" id="inputColor1" onblur="inputColor1(this.value)" value="<?= $WarnaUtama; ?>"
                        style="padding: 0;">
                </div>
                <input type="text" name="WarnaUtama" id="inputText1" onblur="inputText1(this.value)"
                    class="form-control" value="<?= $WarnaUtama; ?>" placeholder="Hex Warna">
            </div>
        </div>
        <div class="col-md-6">
            <label class="form-label">Warna Batas</label>
            <div class="input-group mb-3">
                <div class="input-group-text">
                    <input type="color" id="inputColor2" onblur="inputColor2(this.value)" value="<?= $WarnaBatas; ?>"
                        style="padding: 0;">
                </div>
                <input type="text" name="WarnaBatas" id="inputText2" onblur="inputText2(this.value)"
                    class="form-control" value="<?= $WarnaBatas; ?>" placeholder="Hex Warna">
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
    </div>
    </form>
</div>
<script>
$("#KecamatanID").change(function() {
    var id_kac = $("#KecamatanID").val();
    $("#KelurahanID").select2({
        dropdownParent: $('#myModals'),
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
$(document).ready(function() {
    $("#inputColor1").blur(function() {
        $('#inputText1').val(this.value)
    });

    $("#inputText1").blur(function() {

        $('#inputColor1').val(this.value)
    });

    $("#inputColor2").blur(function() {
        $('#inputText2').val(this.value)
    });

    $("#inputText2").blur(function() {

        $('#inputColor2').val(this.value)
    });
});



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
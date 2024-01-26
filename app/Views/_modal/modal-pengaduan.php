<?php


$Email = '';
$Handphone = '';
$KTP = '';
$KecamatanID = '';
$KabupatenID = '';
$Nama = '';
$Lokasi = '';
$ImgPengaduan = '';
$Tindakan = '';
$Keterangan = '';
$Status = '';
$Tampil = 0;
$PengaduanID = $_POST['pengaduanid'];
if ($PengaduanID != 0) {
    $sql = db_connect()->table('pengaduan')->select('*')->where('DeletedAT', null)->where('PengaduanID', $PengaduanID)->get()->getRowArray();
    $Keterangan = $sql['Keterangan'];
    $Nama = $sql['Nama'];
    $Email = $sql['Email'];
    $Handphone = $sql['Handphone'];
    $KTP = $sql['KTP'];
    $KecamatanID = $sql['KecamatanID'];
    $KelurahanID = $sql['KelurahanID'];
    $KabupatenID = $sql['KabupatenID'];
    $Lokasi = $sql['Lokasi'];
    $ImgPengaduan = $sql['ImgPengaduan'];
    $Status = $sql['Status'];
    $Tindakan = $sql['Tindakan'];
    $Tampilkan = $sql['Tampilkan'];



    $lokasi = 'assets/files/pengaduan/';
    if (!empty($sql['ImgPengaduan'])) {
        $href = base_url() . $lokasi . $sql['ImgPengaduan'];
        $btn = 'info';
        # code...
    } else {
        $href = '#';
        $btn = 'danger';
    }
}

if ($Tampilkan == 1) {
    $checked = 'checked';
} else {
    $checked = '';
}
?>
<div class="modal-body">
    <?= form_open(base_url('simpan/pengaduan'), 'class="needs-validation" method="post" id="form-simpan" onsubmit="return false"', ['PengaduanID' => $PengaduanID]); ?>
    <?= csrf_field(); ?>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="form-label">Nama</label>
                <input type="text" name="Nama" class="form-control" value="<?= $Nama; ?>" readonly>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="form-label">Email</label>
                <input type="email" name="Email" class="form-control" value="<?= $Email; ?>" readonly>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="form-label">No KTP</label>
                <input type="text" name="KTP" class="form-control" value="<?= $KTP; ?>" readonly>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="form-label">Handphone</label>
                <input type="text" name="Handphone" class="form-control" value="<?= $Handphone; ?>" readonly>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="form-label">Kecamatan</label>
                <select name="KecamatanID" class="form-control" id="SelKecamatan" readonly>
                    <option value="opt1">Pilih Salah Satu</option>
                    <?= OptionDaerah('kecamatan', @$KabupatenID, @$KecamatanID); ?>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="form-label">Kelurahan</label>
                <select name="KelurahanID" class="form-control" id="SelKelurahan" readonly>
                    <option value="opt1">Pilih Salah Satu</option>
                    <?= OptionDaerah('kelurahan', @$KecamatanID, @$KelurahanID); ?>
                </select>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="form-label">Lokasi</label>
        <textarea name="Lokasi" class="form-control" id="" cols="30" rows="2" readonly><?= $Lokasi; ?></textarea>
    </div>
    <div class="form-group">
        <label class="form-label">Keterangan</label>
        <textarea name="Keterangan" class="form-control" id="" cols="30" rows="5"
            readonly><?= $Keterangan; ?></textarea>
    </div>
    <!-- <div class="form-group">
        <label class="form-label">Image</label>
        <div class="input-group mb-3">
            <input type="file" name="ImgPengaduan" class="form-control" accept="image/png, image/jpg, image/jpeg"
                style="width: 100%;">

            <div class="input-group-append">
                <a href="<?= $href; ?>" class="btn btn-<?= $btn; ?>" target="_blank"><i
                        class="ri-file-image-line"></i></a>
            </div>
        </div>
    </div> -->
    <div class="form-group bg-blue">
        <label for="">Proses Status</label>
        <select name="Status" id="Status" class="form-control">
            <?= OptCreate(['Y', 'N', 'P'], ['Diterima', 'Ditolak', 'Pengajuan'], $Status); ?>
        </select>
    </div>
    <div class="form-group">
        <label class="form-label">Tindakan</label>
        <textarea name="Tindakan" class="form-control" id="" cols="30" rows="5"><?= $Tindakan; ?></textarea>
    </div>
    <div class="form-group">
        <label class="form-label">Tampilkan</label>
        <div class="input-group mb-3">
            <div class="input-group-text">
                <input class="form-check-input mt-0" name="Tampilkan" type="checkbox" value="1" style="margin-left: 0;"
                    <?= $checked; ?>>
            </div>
            <input type="text" class="form-control" placeholder="Ceklis untuk tidak menampilkan pengaduan" readonly>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
    </div>
    </form>
</div>
<script>
var urlKecamatan = "https://ibnux.github.io/data-indonesia/kecamatan/";
var urlKelurahan = "https://ibnux.github.io/data-indonesia/kelurahan/";

function clearOptions(id) {
    $('#' + id).empty().trigger('change');
}
var selectKec = $('#SelKecamatan');
$(selectKec).change(function() {
    var value = $(selectKec).val();
    clearOptions('SelKelurahan');

    if (value) {

        var text = $('#SelKecamatan:selected').text();

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

        var text = $('#SelKelurahan:selected').text();
    }
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
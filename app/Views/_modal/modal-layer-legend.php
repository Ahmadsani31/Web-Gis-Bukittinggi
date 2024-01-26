<?php


$Nama = '';
$Harga = '';
$Keterangan = '';
$LegendWarna = '';
$LegendText = '';
$LayerID = $_POST['layerid'];
if ($LayerID != 0) {
    $sql = db_connect()->table('layer')->select('*')->where('DeletedAT', null)->where('LayerID', $LayerID)->get()->getRowArray();
    $Keterangan = $sql['Keterangan'];
    $Nama = $sql['Nama'];
    $LegendWarna = $sql['LegendWarna'];
    $LegendText = $sql['LegendText'];
}
?>
<div class="modal-body">
    <?= form_open(base_url('admin/layer/legend'), 'class="needs-validation" method="post" id="form-simpan" onsubmit="return false"', ['LayerID' => $LayerID]); ?>
    <?= csrf_field(); ?>
    <div class="card bg-info">
        <div class="p-2">
            <p class="m-0" style="color: black;">Cara Buat Legend</p>
            <p class="m-0" style="color: black;">
                Legend yang tersusun dari kode HEX warna dan teks, harus diberi tanda koma (,) sebagai pemisah antara elemen pertama, kedua, dan ketiga untuk keduanya dan pastikan jumlahnya sama di kedua sisi. kalau tidak masa pengisian Legend tidak akan bisa disimpan
            </p>
        </div>
    </div>
    <div class="form-group">
        <label class="form-label">HEX Warna</label>
        <input type="text" name="LegendWarna" value="<?= $LegendWarna; ?>" class="form-control">
    </div>
    <div class="form-group">
        <label class="form-label">Keterangan Warna</label>
        <input type="text" name="LegendText" value="<?= $LegendText; ?>" class="form-control">
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
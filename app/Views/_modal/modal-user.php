<?php


$Nama = '';
$Username = '';
$Password = '';
$Level = '';
$NA = '';
$UserID = $_POST['userid'];
if ($UserID != 0) {
    $sql = db_connect()->table('admin')->select('*')->where('DeletedAT', null)->where('AdminID', $UserID)->get()->getRowArray();
    $Nama = $sql['Nama'];
    $Username = $sql['Username'];
    $Password = $sql['Password'];
    $Level = $sql['Level'];
    $NA = $sql['NA'];
}
?>
<div class="modal-body">
    <?= form_open(base_url('admin/user/simpan'), 'class="needs-validation" method="post" id="form-simpan" onsubmit="return false"', ['AdminID' => $UserID]); ?>
    <?= csrf_field(); ?>
    <div class="form-group">
        <label class="form-label">Nama</label>
        <input type="text" name="Nama" class="form-control" value="<?= $Nama; ?>" required>
    </div>
    <div class="form-group">
        <label class="form-label">Username</label>
        <input type="text" name="Username" class="form-control" value="<?= $Username; ?>" required>
    </div>
    <div class="form-group">
        <label class="form-label">Password</label>
        <input type="password" name="Password" class="form-control" value="<?= $Password; ?>" required>
    </div>
    <div class="form-group">
        <label class="form-label">Level</label>
        <select name="Level" id="" class="form-control" required>
            <option value="">Pilih Level</option>
            <?= OptCreate(['01', '02'], ['Admin', 'Staff'], $Level); ?>
        </select>
    </div>
    <div class="form-group">
        <label class="form-label">Aktif</label>
        <select name="NA" id="" class="form-control" required>
            <?= OptCreate(['N', 'Y'], ['Iya', 'Tidak'], $NA); ?>
        </select>
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
                        console.log(data.pesan);
                        Object.keys(data.pesan).forEach(function(key) {
                            pesan += data.pesan[key] + "";
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
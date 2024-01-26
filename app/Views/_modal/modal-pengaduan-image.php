<?php

$ImgPengaduan = '';

$PengaduanID = $_POST['pengaduanid'];
if ($PengaduanID != 0) {
    $sql = db_connect()->table('pengaduan')->select('*')->where('DeletedAT', null)->where('PengaduanID', $PengaduanID)->get()->getRowArray();

    $ImgPengaduan = $sql['ImgPengaduan'];
    $Tindakan = $sql['Tindakan'];
    $Tampil = $sql['Tampilkan'];


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
?>
<div class="modal-body ">
    <div class="d-flex align-items-stretch justify-content-center">
        <img src="<?= $href; ?>" alt="img" class="img-fluid">
    </div>
    <div class="card mt-3 p-2 mb-0">
        <h4>Tindakan / Balasan</h4>
        <hr class="mt-0">
        <p><?= $Tindakan; ?></p>
    </div>
</div>
<div class="modal-footer">
    <button type="button" onclick="onCloseModal()" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>

<script>
    function onCloseModal() {
        $("#myModals").modal("hide");
    }

    $(".close").click(function() {
        $("#myModals").modal("hide");
    });
</script>
<!-- End Basic Modal-->
<?php

$ImgPengaduan = '';

$ImgKe = $_POST['imgke'];
$DrainaseID = $_POST['drainaseid'];
if ($DrainaseID != 0) {
    $sql = db_connect()->table('drainase')->select('*')->where('DeletedAT', null)->where('DrainaseID', $DrainaseID)->get()->getRowArray();

    $FileImage = $sql[$ImgKe];


    $lokasi = 'assets/files/drainase/';
    if (!empty($FileImage)) {
        $href = base_url() . $lokasi . $FileImage;
        $btn = 'info';
        # code...
    } else {
        $href =  base_url('assets/admin/images/no-pictures.png');
        $btn = 'danger';
    }
}
?>
<div class="d-flex align-items-stretch justify-content-center">
    <img src="<?= $href; ?>" alt="img" class="img-fluid img-thumbnail">
</div>


<script>

    $(".close").click(function() {
        $("#myModals").modal("hide");
    });
</script>
<!-- End Basic Modal-->
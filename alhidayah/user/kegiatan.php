<?php
@session_start();
include "../config/koneksi.php";
include "header.php";

$kegiatan = mysqli_query($db, "SELECT * FROM tb_kegiatan");
?>
<div class="container py-5">
    <h1 class="text-center">Kegiatan Masjid Al-hidayah</h1>
    <div class="row  my-5">
        <?php foreach ($kegiatan as $keg ) { ?>
        <div class="col-4 d-flex justify-content-around">
            <div class="card mb-3">
                <img src="../img/kegiatan/<?= $keg["gambar"] ?>" class="card-img-top" alt="<?= $keg["nama_kegiatan"] ?>">
                <div class="card-body">
                    <h5 class="card-title"><?= $keg["nama_kegiatan"] ?></h5>
                    <p class="card-text"><small class="text-body-secondary"><?= $keg["tgl_kegiatan"] ?></small></p>
                    <p ><a href="more.php?id_kegiatan=<?=$keg["id_kegiatan"] ?>" class="btn btn-sm btn-primary ">Baca selengkapnya</a> </p>
                </div>
            </div>
        </div>
        <?php  } ?>

    </div>
</div>

<?php
include "footer.php";
?>
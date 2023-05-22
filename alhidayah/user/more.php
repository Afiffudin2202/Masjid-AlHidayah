<?php
include "../config/koneksi.php";
include "header.php";
$id = $_GET["id_kegiatan"];
$kegiatan = mysqli_query($db, "SELECT * FROM tb_kegiatan WHERE id_kegiatan = $id")
?>

<div class="container d-flex justify-content-center ">
    <div class="card my-5" style="max-width: 80%;">
     <?php foreach ($kegiatan as $keg ) { ?>
        <div class="row g-0">
            <div class="col-md-4">
                <img src="../img/kegiatan/<?= $keg["gambar"] ?>" class="img-fluid rounded-start" alt="...">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title"><?= $keg["nama_kegiatan"] ?></h5>
                    <p class="card-text"><small class="text-body-secondary"><?= $keg["tgl_kegiatan"] ?></small></p>
                    <p class="text-area"><?= $keg["deskripsi"] ?></p>
                </div>
            </div>
        </div>
          <?php }  ?>
    </div>
</div>
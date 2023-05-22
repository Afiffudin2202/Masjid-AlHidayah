<?php
@session_start();
include "../config/koneksi.php";
include "header.php";

$galeri = mysqli_query($db," SELECT * FROM tb_galeri")
?>

<div class="container py-5">
    <h1 class="text-center my-5">galeri masjid alhidayah</h1>

    <div class="row d-flex justify-content-around">
        <?php foreach ($galeri as $gal ) : ?>
            <div class="col-4 d-flex justify-content-around my-3">
                <div class="card" style="width: 18rem;">
                    <img src="../img/galeri/<?= $gal["gambar_galeri"] ?>" class="card-img-top" alt="<?= $gal["keterangan"] ?>">
                </div>
            </div>
       <?php endforeach ?>
    </div>
</div>

<?php
include "footer.php";
?>
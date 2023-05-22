<?php
@session_start();
include "../config/koneksi.php";
include  "header.php";

$kegiatan = mysqli_query($db, "SELECT * FROM tb_kegiatan LIMIT 0,3");
$galeri = mysqli_query($db, "SELECT * FROM tb_galeri LIMIT 0,3");
?>

<section id="welcome" class="container-fluid py-5 ">
    <div id="carouselExampleIndicators" class="carousel slide welcome">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="../img/user/cr1.png" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="../img/user/cr2.png" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="../img/user/cr3.png" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</section>

<section id="kegiatan">
    <div class="container mt-5">
        <h1 class="text-center my-5">Kegiatan</h1>
        <div class="row  my-5">
            <?php foreach ($kegiatan as $keg ) { ?>
            <div class="col-4 d-flex justify-content-around">
                <div class="card" style="width: 18rem;">
                    <img src="../img/kegiatan/<?= $keg["gambar"] ?>" class="card-img-top" alt="...">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><?= $keg["nama_kegiatan"] ?></li>
                        <li class="list-group-item"><?= $keg["tgl_kegiatan"] ?></li>
                        <li class="list-group-item"><?= $keg["tempat"] ?></li>
                    </ul>
                </div>
            </div>
            <?php } ?>
        </div>
        <div class="kegiatan-lainnya d-flex justify-content-center my-5">
            <a href="kegiatan.php" class="btn btn-warning text-white">Lihat Kegitanan lainnya</a>
        </div>
    </div>
</section>

<section id="quote">
    <div class="container-fluid bg-warning my-3 py-5">
        <h3 class="text-center">وَمَا خَلَقْتُ الْجِنَّ وَالْإِنْسَ إِلَّا لِيَعْبُدُونِ</h3>
        <br>
        <h5 class="text-center">"َDan Aku tidak menciptakan jin dan manusia melainkan supaya mereka mengabdi
            kepada-Ku." (QS. Ad-Dzariyat: 56)</h5>
    </div>
</section>

<section id="galeri" class="my-5">
    <div class="container">
        <h1 class="text-center my-5">Galeri alhidayah</h1>
        <div class="row d-flex justify-content-around">
            <?php foreach ($galeri as $gal ) : ?>
            <div class="col-4 d-flex justify-content-around">
                <div class="card" style="width: 18rem;">
                    <img src="../img/galeri/<?= $gal["gambar_galeri"] ?>" class="card-img-top" alt="...">
                </div>
            </div>
            <?php endforeach ?>
        </div>
        <div class="galeri-lainnya d-flex justify-content-center my-5">
            <a href="galeri.php" class="btn btn-warning text-white">Lihat Galeri lainnya</a>
        </div>
    </div>
</section>

<?php
include "footer.php";
?>
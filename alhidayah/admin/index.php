<?php 
@session_start();
include "../config/koneksi.php";

if(@$_SESSION['admin']){
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin | Alhidayah </title>
    <link rel="stylesheet" href="../css/bootstrap.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-warning" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand " href="?page=home">Admin</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse d-flex justify-content-between" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link  active" aria-current="page" href="?page=home">Home</a>
                    <a class="nav-link " href="?page=kegiatan">Kegiatan</a>
                    <a class="nav-link " href="?page=galeri">Galery</a>
                </div>
                <div class="navbar-nav">
                    <a class="nav-link " href="logout.php">Logout</a>
                </div>
            </div>

        </div>
    </nav>
    <div class="container">
        <div class="section">
            <!-- page dinamis php -->
        <?php
            $page = @$_GET['page'];
            $action = @$_GET['action'];
        ?>
            <?php if ($page == "kegiatan") { ?>
            <?php if ($action =="") { 
                    include "../admin/read/read_kegiatan.php";
                }elseif ($action == "tambah-kegiatan") {
                    include "../admin/create/tambah_kegiatan.php";
                }elseif ($action == "edit-kegiatan") {
                    include "../admin/update/edit_kegiatan.php";
                }elseif ($action == "hapus-kegiatan") {
                    include "../admin/delete/delete_kegiatan.php";
                } else {
                    echo "<script>alert('Anda Tidak Punya Hak Akses ke Halaman Ini!')</script>";
                 } 
             } elseif ($page =="galeri") {
                 if ($action =="") { 
                    include "../admin/read/read_galeri.php";
                }elseif ($action == "tambah-galeri") {
                    include "../admin/create/tambah_galeri.php";
                }
                elseif ($action == "edit-galeri") {
                    include "../admin/update/edit_galeri.php";
                }elseif ($action == "hapus-galeri") {
                    include "../admin/delete/delete_galeri.php";
                }
            }
             elseif ($page == "" || $page == "home") { ?>
            <div class="container mt-5">
                <h5 class="bg-warning text-white text-center p-5 fs-2">Selamat Datang dihalaman Admin</h5>
            </div>
            <?php } ?>
        </div>
    </div>
</body>

</html>
<?php } else {
    header ("location: login.php"); 
} ?>
<?php
@session_start();
include "../config/koneksi.php";
?>
<div class="container">

    <h1 class="text-center my-2">Daftar Galeri</h1>

    <a href="?page=galeri&action=tambah-galeri" class="btn btn-primary my-3">Tambah Galeri</a>

    <table  class="table ">
        <tr class="bg-warning ">
            <th>No.</th>
            <th>Gambar</th>
            <th>Keterangan</th>
            <th>Aksi</th>
        </tr>

         <?php
            $i=1;
            $sql = mysqli_query($db, "SELECT * FROM tb_galeri");
            while ($galeri = mysqli_fetch_array( $sql)) { ?>
            <tr>
            <td class="text-center"><?= $i?></td>
            <td class="text-center">
                <img src="../img/galeri/<?=$galeri["gambar_galeri"] ?>" width="50px" alt="">
            </td>
            <td ><?= $galeri["keterangan"] ?></td>
            <td class="text-center">
                <a href="?page=galeri&action=edit-galeri&id_galeri=<?=$galeri["id_galeri"]?>" class="btn btn-primary btn-sm">Edit</a> 
                <a href="?page=galeri&action=hapus-galeri&id_galeri=<?=$galeri["id_galeri"]?>" onclick="return confirm('Apakah anda ingin menghapus data ini ?')" class="btn btn-danger btn-sm">Delete</a>
            </td>

        </tr>
        <?php $i++ ?>
           <?php } ?>
     
        
        
    </table>
</div>
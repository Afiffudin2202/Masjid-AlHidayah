<?php
@session_start();
include "../config/koneksi.php";
?>


<div class="container">

    <h1 class="text-center my-2">Daftar Kegiatan</h1>

    <a href="?page=kegiatan&action=tambah-kegiatan" class="btn btn-primary my-3">Tambah kegiatan</a>

    <table  class="table table-hover">
      
        <tr class="bg-warning">
            <th class="text-center">No.</th>
            <th class="text-center">Gambar</th>
            <th>Nama Kegiatan</th>
            <th>Deskripsi</th>
            <th class="text-center">Tanggal Kegiatan</th>
            <th>Tempat</th>
            <th class="text-center">Aksi</td>
        </tr>

         <?php
            $i=1;

            $sql = mysqli_query($db, "SELECT * FROM tb_kegiatan");
            while ($kegiatan = mysqli_fetch_array( $sql)) { ?>
            <tr >
            <td class="text-center"><?= $i?></td>
            <td class="text-center">
                <img src="../img/kegiatan/<?=$kegiatan["gambar"] ?>" width="50px" alt="">
            </td>
            <td ><?= $kegiatan["nama_kegiatan"] ?></td>
            <td width="300px" ><?= $kegiatan["deskripsi"] ?></td>
            <td class="text-center"><?= $kegiatan["tgl_kegiatan"] ?></td>
            <td><?= $kegiatan["tempat"] ?></td>
            <td class="text-center">
                <a href="?page=kegiatan&action=edit-kegiatan&id_kegiatan=<?=$kegiatan["id_kegiatan"]?>" class="btn btn-primary btn-sm">Edit</a> 
                <a href="?page=kegiatan&action=hapus-kegiatan&id_kegiatan=<?=$kegiatan["id_kegiatan"]?>" onclick="return confirm('Apakah anda ingin menghapus data ini ?')" class="btn btn-danger btn-sm">Delete</a>
            </td>
        </tr>
        <?php $i++ ?>
           <?php } ?>

    </table>
</div>
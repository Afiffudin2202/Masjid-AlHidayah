<?php

include "../config/koneksi.php";
// ambil data di URL
$id = @$_GET["id_kegiatan"];

$sql = mysqli_query($db, "SELECT * FROM tb_kegiatan WHERE id_kegiatan= $id ");
$data = mysqli_fetch_array($sql);

// cek apakah tombol submit di klik

if (isset($_POST["submit"])) {
   
    // cek keberhasilan
    if (($_POST) > 0)   {
        echo "
            <script>
                alert('data berhasil diedit');
                window.location.href = '?page=kegiatan';
            </script>
        ";
        
    }else{
        echo "
            <script>
                alert('data gagal diedit');
                window.location.href = '?page=kegiatan';
            </script>
        ";
    }
}

?>


<body>
    <h1 class="text-center mt-3 text-warning-emphasis">Edit Kegiatan Mesjid</h1>

    <div class="container w-50 bg-body-tertiary p-5 my-5 rounded-2">
        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="gambarLama" value="<?= $data["gambar"]?>">

            <div class="mt-3">
                <label for="nama_kegiatan">Nama Kegiatan</label>
                <input class="form-control mt-3" type="text" name="nama_kegiatan" id="nama_kegiatan" required
                    value="<?=$data["nama_kegiatan"] ?>">
            </div>
            <div class="mt-3">
                <label for="tgl_kegiatan">Tanggal Kegiatan</label>
                <input class="form-control mt-3" type="date" name="tgl_kegiatan" id="tgl_kegiatan" required
                    value="<?=$data["tgl_kegiatan"] ?>">
            </div>
            <div class="mt-3">
                <label for="tempat mt-3">Tempat</label>
                <input class="form-control mt-3" type="text" name="tempat" id="tempat" required
                    value="<?=$data["tempat"] ?>">
            </div>
            <div class="mt-3">
                <label for="gambar">Gambar</label> <br>
                <img src="../img/<?=$data["gambar"] ?>" width="100px" alt=""><br>
                <input class="form-control mt-3" type="file" name="gambar" id="gambar">
            </div>
            <div class="mt-3">
                <button type="submit" name="submit" class="btn btn-primary">Edit</button>
            </div>
        </form>
    </div>

    <?php
 
        $nama_kegiatan = htmlspecialchars(@$_POST["nama_kegiatan"]);
        $tgl_kegiatan = htmlspecialchars(@$_POST["tgl_kegiatan"]);
        $tempat = htmlspecialchars(@$_POST["tempat"]);
        $gambarLama = htmlspecialchars(@$_POST["gambarLama"]);

        if (@$_FILES["gambar"]["error"]===4) {
            $gambar = $gambarLama;
        }else {
            $gambar = uploadKegiatan();
        }

        $query = "UPDATE tb_kegiatan
                    SET
                    nama_kegiatan = '$nama_kegiatan',
                    tgl_kegiatan = '$tgl_kegiatan',
                    tempat = '$tempat',
                    gambar = '$gambar'
                    WHERE id_kegiatan = '$id';
                    ";

        mysqli_query($db, $query);

        return mysqli_affected_rows($db);
        function uploadKegiatan(){

        $namaFile = @$_FILES["gambar"]['name'];
        $sizeFile = @$_FILES["gambar"]['size'];
        $error = @$_FILES["gambar"]['error'];
        $tmpName = @$_FILES["gambar"]['tmp_name'];



        //   cek apakah tidak ada gambar yg diupload
        if ($error ===4) {
            echo "
            <script>
                alert('Silahkan Isi gambar');
            </script> ";
            return false;
        }

        // cek apakah yang di upload adalah gambar
        $ekstensiGambarValid = ["jpg","jpeg","png"];
        $ekstensiGambar = explode('.', $namaFile);
        $ekstensiGambar = strtolower(end($ekstensiGambar));

        

        // cek ukuran gambar dan batas ukuran gambar
        if ($sizeFile > 10000000) {
            echo "
            <script>
                alert('Ukuran gambar terlalu besar');
            </script>";
            return false;
        }

        // generate gambar
        $namaFileBaru = uniqid();
        $namaFileBaru .= $ekstensiGambar;
        $target = '../img/kegiatan/';
        // lolos pengecekan
        move_uploaded_file($tmpName, $target.$namaFileBaru);
        return $namaFileBaru;
        }
    ?>
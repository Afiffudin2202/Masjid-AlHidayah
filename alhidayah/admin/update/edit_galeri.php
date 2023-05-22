<?php

include "../config/koneksi.php";
// ambil data di URL
$id = @$_GET["id_galeri"];

$sql = mysqli_query($db, "SELECT * FROM tb_galeri WHERE id_galeri= $id ");
$data = mysqli_fetch_array($sql);

// cek apakah tombol submit di klik

if (isset($_POST["submit"])) {
   
    // cek keberhasilan
    if (($_POST) > 0)   {
        echo "
            <script>
                alert('data berhasil diedit');
                window.location.href = '?page=galeri';
            </script>
        ";
        
    }else{
        echo "
            <script>
                alert('data gagal diedit');
                window.location.href = '?page=galeri';
            </script>
        ";
    }
}

?>


<body>
    <h1 class="text-center mt-3 text-warning-emphasis">Edit Galeri</h1>

    <div class="container w-50 bg-body-tertiary p-5 my-5 rounded-2">
        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="gambarLama" value="<?= $data["gambar_galeri"]?>">

            <div class="mt-3">
                <label for="keterangan">Nama Kegiatan</label>
                <input class="form-control mt-3" type="text" name="keterangan" id="keterangan" required
                    value="<?=$data["keterangan"] ?>">
            </div>
            <div class="mt-3">
                <label for="gambar_galeri">Gambar</label> <br>
                <img src="../img/<?=$data["gambar_galeri"] ?>" width="100px" alt=""><br>
                <input class="form-control mt-3" type="file" name="gambar_galeri" id="gambar_galeri">
            </div>
            <div class="mt-3">
                <button type="submit" name="submit" class="btn btn-primary">Edit</button>
            </div>
        </form>
    </div>

    <?php
 
        $keterangan = htmlspecialchars(@$_POST["keterangan"]);
        $gambarLama = htmlspecialchars(@$_POST["gambarLama"]);

        if (@$_FILES["gambar_galeri"]["error"]===4) {
            $gambar_galeri = $gambarLama;
        }else {
            $gambar_galeri = uploadKegiatan();
        }

        $query = "UPDATE tb_galeri
                    SET
                    keterangan = '$keterangan',
                    gambar_galeri = '$gambar_galeri'
                    WHERE id_galeri = '$id';
                    ";

        mysqli_query($db, $query);

        return mysqli_affected_rows($db);
        function uploadKegiatan(){

        $namaFile = @$_FILES["gambar_galeri"]['name'];
        $sizeFile = @$_FILES["gambar_galeri"]['size'];
        $error = @$_FILES["gambar_galeri"]['error'];
        $tmpName = @$_FILES["gambar_galeri"]['tmp_name'];



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
        $ekstensiGambar = explode('.',$namaFile);
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
        $target = '../img/galeri/';
        // lolos pengecekan
        move_uploaded_file($tmpName, $target.$namaFileBaru);
        return $namaFileBaru;
        }
    ?>
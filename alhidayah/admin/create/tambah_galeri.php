<?php
include "../config/koneksi.php";

// cek apakah tombol submit di klik
if (isset($_POST["submit"])) {
   
    // cek keberhasilan
    if (($_POST) > 0)   {
        echo "
            <script>
                alert('data berhasil ditambahkan');
                window.location.href='?page=galeri';
            </script>
        ";
    }else{
        echo "
            <script>
                alert('data gagal ditambahkan');
                window.location.href = '?page=galeri';
            </script>
        ";
    }
}

?>

<h1 class="text-center mt-3 text-warning-emphasis">Tambah Galeri Mesjid</h1>
<div class="container w-50 bg-body-tertiary p-5 my-5 rounded-2 ">
    <form action="" method="post" enctype="multipart/form-data" >
    
        <div class="mt-3">
            <label  for="keterangan" >Keterangan</label> 
            <input type="text" name="keterangan" id="keterangan" required class="form-control mt-3">
        </div>
        <div class="mt-3">
            <label for="gambar_galeri">Gambar</label>
            <input type="file" name="gambar_galeri" id="gambar_galeri" class="form-control mt-3">
        </div>
        <div class="mt-3">
            <button type="submit" name="submit" class="btn btn-primary">Tambah</button>
        </div>
    
    </form>
</div>

<?php
    $db;
    $keterangan = htmlspecialchars(@$_POST["keterangan"]);
    // upload gambar
    $gambar_galeri = uploadKegiatan();
    if (!$gambar_galeri) {
        return false;
    }

    // query insert data
    $query = "INSERT INTO tb_galeri
                VALUES
                ('','$keterangan','$gambar_galeri')
                ";
    mysqli_query($db,$query);

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

        if (!in_array($ekstensiGambar,$ekstensiGambarValid)) {
            echo "
            <script>
                alert('Silahkan isi form dengan benar');
            </script>";
            return false;
        }

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
<?php
include "../config/koneksi.php";

// cek apakah tombol submit di klik
if (isset($_POST["submit"])) {
   
    // cek keberhasilan
    if (($_POST) > 0)   {
        echo "
            <script>
                alert('data berhasil ditambahkan');
                window.location.href='?page=kegiatan';
            </script>
        ";
    }else{
        echo "
            <script>
                alert('data gagal ditambahkan');
                window.location.href = '?page=kegiatan';
            </script>
        ";
    }
}

?>

<h1 class="text-center mt-3 text-warning-emphasis">Tambah Kegiatan Mesjid</h1>

<div class="container w-50 bg-body-tertiary p-5 my-5 rounded-2 ">
    <form action="" method="post" enctype="multipart/form-data" >
    
        <div class="mt-3">
            <label  for="nama_kegiatan" >Nama Kegiatan</label> 
            <input type="text" name="nama_kegiatan" id="nama_kegiatan" required class="form-control mt-3">
        </div>
        <div class="mt-3">
            <label  for="deskripsi" >Deskripsi Kegiatan</label> 
            <input type="text-area" name="deskripsi" id="deskripsi" required class="form-control mt-3">
            
        </div>
        <div class="mt-3">
            <label for="tgl_kegiatan">Tanggal Kegiatan</label>
            <input type="date" name="tgl_kegiatan" id="tgl_kegiatan" required class="form-control mt-3">
        </div>
        <div class="mt-3">
            <label for="tempat" >Tempat</label>
            <input type="text" name="tempat" id="tempat" required class="form-control mt-3">
    
        </div>
        <div class="mt-3">
            <label for="gambar">Gambar</label>
            <input type="file" name="gambar" id="gambar" class="form-control mt-3">
        </div>
        <div class="mt-3">
            <button type="submit" name="submit" class="btn btn-primary">Tambah</button>
        </div>
    
    </form>
</div>

<?php
    $db;
    $nama_kegiatan = htmlspecialchars(@$_POST["nama_kegiatan"]);
    $deskripsi = htmlspecialchars(@$_POST["deskripsi"]);
    $tgl_kegiatan = htmlspecialchars(@$_POST["tgl_kegiatan"]);
    $tempat = htmlspecialchars(@$_POST["tempat"]);

    // upload gambar
    $gambar = uploadKegiatan();
    if (!$gambar) {
        return false;
    }

    // query insert data
    $query = "INSERT INTO tb_kegiatan
                VALUES
                ('','$nama_kegiatan','$deskripsi','$tgl_kegiatan','$tempat','$gambar')
                ";
    mysqli_query($db,$query);

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
        $target = '../img/kegiatan/';
        // lolos pengecekan
        move_uploaded_file($tmpName, $target.$namaFileBaru);
        return $namaFileBaru;
    }
?>
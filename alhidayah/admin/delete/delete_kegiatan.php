<?php

function delete(){
    include "../config/koneksi.php";
    $id = @$_GET["id_kegiatan"];
     mysqli_query($db, "DELETE FROM tb_kegiatan WHERE id_kegiatan = $id");
     return mysqli_affected_rows($db);
}

if ( delete() > 0) {
    echo "
            <script>
                alert('data berhasil dihapus');
                 window.location.href='?page=kegiatan';
            </script>
        ";
}else {
     echo "
            <script>
                alert('data gagal dihapus');
                 window.location.href='?page=kegiatan';
            </script>
        ";
}
?>
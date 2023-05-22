<?php
function delete(){
    include "../config/koneksi.php";
    $id = @$_GET["id_galeri"];
     mysqli_query($db, "DELETE FROM tb_galeri WHERE id_galeri = $id");
     return mysqli_affected_rows($db);
}

if ( delete() > 0) {
    echo "
            <script>
                alert('data berhasil dihapus');
                 window.location.href='?page=galeri';
            </script>
        ";
}else {
     echo "
            <script>
                alert('data gagal dihapus');
                 window.location.href='?page=galeri';
            </script>
        ";
}
?>
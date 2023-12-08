<?php
include 'konfig.php';
$id = $_GET["id"];

$query = "delete from minuman where ID='$id'";
$result = mysqli_query($koneksi, $query);

if(!$result){
    die("Gagal menghapus data minuman ". mysqli_error($koneksi));
} else {
    echo "<script>
        alert('Berhasil dihapus');
        window.location= 'minuman.php';
    </script>";
}

?>
<?php
include 'konfig.php';

$idtransaksi = $_POST['notransaksi'];
$idminuman = $_POST['id_minuman'];
$harga = $_POST['harga'];
$qty = $_POST['qty'];
$subtotal = $_POST['subtotal'];

if($idminuman == "" || $harga == "" || $qty == "" || $subtotal == ""){
    echo "<script> 
        alert('Lengkapi data');
    </script>";
} else {
    $query = "INSERT INTO detail_transaksi (no_transaksi, ID_minuman, harga, jumlah_beli, subtotal) VALUES ('$idtransaksi','$idminuman','$harga','$qty','$subtotal')";
    mysqli_query($koneksi, $query);
}
?>
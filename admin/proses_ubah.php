<?php
// memanggil file koneksi.php untuk melakukan koneksi database
include 'konfig.php';

// membuat variabel untuk menampung data dari form
$id_buku = $_POST['id'];
$judul   = $_POST['minuman'];
$jumlah_pesanan   = $_POST['jumlah_pesanan'];
$tahun   = $_POST['tahun'];
$harga   = $_POST['harga'];
$stok   = $_POST['stok'];
$gambar = $_FILES['gambar_produk']['name'];
if($judul == "" || $jumlah_pesanan== "" || $tahun == "" || $harga== "" || $stok== "" ){
    echo"<script>
        alert('Data tidak boleh kosong');
        window.location = 'edit_minuman.php?id=$id_minuman';
    </script>";
} else {
    //cek dulu jika ada gambar produk jalankan coding ini
    if ($gambar != "") {
        $ekstensi_diperbolehkan = array('png', 'jpg', 'jpeg'); //ekstensi file gambar yang bisa diupload 
        $x = explode('.', $gambar); //memisahkan nama file dengan ekstensi yang diupload
        $ekstensi = strtolower(end($x));
        $file_tmp = $_FILES['gambar_produk']['tmp_name'];
        $angka_acak     = rand(1, 999);
        $nama_gambar_baru = $angka_acak . '-' . $gambar; //menggabungkan angka acak dengan nama file sebenarnya
        if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
            $uploaded = "C:/xampp/htdocs/php/Drinker/img/";
            move_uploaded_file($file_tmp, $uploaded.$nama_gambar_baru);
            // jalankan query INSERT untuk menambah data ke database pastikan sesuai urutan (id tidak perlu karena dibikin otomatis)
            $query = "UPDATE minuman SET nama='$nama', id_kategori=$kategori, jumlah_pesanan='$jumlah_pesanan', harga='$harga', stok='$stok', gambar='$nama_gambar_baru' WHERE id = $id_minuman";
            $result = mysqli_query($koneksi, $query);
            // periska query apakah ada error
            if (!$result) {
                die("Error: " . mysqli_error($koneksi));
            } else {
                //tampil alert dan akan redirect ke halaman buku berdasarkan id
                echo "<script>alert('Data berhasil diubah.');
                    window.location = 'minuman.php';
                </script>";
            } //memindah file gambar ke folder gambar

        } else {
            //jika file ekstensi tidak jpg dan png maka alert ini yang tampil
            echo "<script>alert('Ekstensi gambar yang boleh hanya jpg atau png.');
            window.location = 'edit_minuman.php?id=$id_minuman';
            </script>";
        }
    } else {
        $query = "UPDATE minuman SET nama='$nama', id_kategori= $kategori, jumlah_pesanan='$jumlah_pesanan', harga='$harga', stok='$stok' WHERE id = $id_minuman";
        $result = mysqli_query($koneksi, $query);
        // periska query apakah ada error
        if (!$result) {
            die("Error: " . mysqli_error($koneksi));
        } else {
            echo "<script>alert('Data berhasil ditambah.');
                window.location = 'minuman.php';
            </script>";
        }
    }
}


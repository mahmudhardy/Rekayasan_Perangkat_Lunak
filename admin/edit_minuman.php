<?php

session_start();
// memanggil file koneksi.php untuk membuat koneksi
include 'konfig.php';
include 'cek.php';

// mengecek apakah di url ada nilai GET id
if (isset($_GET['id'])) {
    // ambil nilai id dari url dan disimpan dalam variabel $id
    $id = ($_GET["id"]);

    // menampilkan data dari database yang mempunyai id=$id
    $query = "SELECT * FROM minuman WHERE id='$id'";
    $result = mysqli_query($koneksi, $query);
    // jika data gagal diambil maka akan tampil error berikut
    if (!$result) {
        die("Error: " . mysqli_error($koneksi));
    }
    // mengambil data dari database
    $data = mysqli_fetch_assoc($result);
    // apabila data tidak ada pada database maka akan dijalankan perintah ini
    if (!count($data)) {
        echo "<script>alert('Data tidak ditemukan pada database');
          window.location='minuman.php';</script>";
    }
} else {
    // apabila tidak ada data GET id pada akan di redirect ke index.php
    echo "<script>alert('Masukkan data id.');
    window.location='minuman.php';</script>";
}
?>

<!doctype html>
<html lang="en">


<head>
    <title>Minuman Coklat</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <!-- VENDOR CSS -->
    <link rel="stylesheet" href="../assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/vendor/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/vendor/linearicons/style.css">
    <!-- MAIN CSS -->
    <link rel="stylesheet" href="../assets/css/main.css">
    <!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
    <link rel="stylesheet" href="assets/css/demo.css">
    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
    <!-- ICONS -->
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" sizes="96x96" href="../assets/img/favicon.png">
</head>

<body>
    <!-- WRAPPER -->
    <div id="wrapper">
       <!-- LEFT SIDEBAR -->
        <div id="sidebar-nav" class="sidebar">
            <div class="sidebar-scroll">
                <nav>
                    <ul class="nav">
						<li><a href="index.php" class=""><i class="lnr lnr-home"></i> <span>Home</span></a></li>
						<li><a href="minuman.php" class="active"><i class="lnr lnr-book"></i> <span>Minuman</span></a></li>
						<li><a href="transaksi.php" class=""><i class="lnr lnr-file-empty"></i> <span>Transaksi</span></a></li>
                        <li><a href="pelanggan.php" class=""><i class="lnr lnr-user"></i> <span>Pelanggan</span></a></li>
                        <li><a href="logout.php" class=""><i class="lnr lnr-exit"></i> <span>Logout</span></a></li>
					</ul>
                </nav>
            </div>
        </div>
        <!-- END LEFT SIDEBAR -->
        <!-- MAIN -->
        <div class="main">
            <!-- MAIN CONTENT -->
            <div class="main-content">
                <div class="container-fluid">
                    <h3 align="center" class="page-title">Edit Minuman</h3>
                    <div class="row">
                        <div class="col-md-12">
                            <!-- TABLE HOVER -->
                            <div class="panel">
                                <!-- cek login -->

                                <div class="panel-heading">
                                    <h3 class="panel-title">Edit data <?php echo $data['nama']; ?></h3>
                                </div>
                                <div class="panel-body">
                                    <form class="form-auth-small" action="proses_ubah.php" method="post" enctype="multipart/form-data">
                                        <input name="id" value="<?php echo $data['id']; ?>" hidden />
                                        <div class="form-group">
                                            <label>Nama</label>
                                            <input type="text" id="nama" class="form-control" name="nama" placeholder="Nama" value="<?php echo $data['nama']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>kategori</label>
                                            <select class="form-control" name="id_kategori">
                                                <option value="0">-- Minuman --</option>
                                                <?php
                                                //Perintah sql untuk menampilkan semua data pada tabel jurusan
                                                $query_kategori = "select * from kategori ORDER BY kategori asc";

                                                $hasil_kategori = mysqli_query($koneksi, $query_kategori);
                                                // $jsArray = "var data = new Array();\n";
                                                // $nomorJudul = 0;
                                                while ($data_kategori = mysqli_fetch_array($hasil_kategori)) {
                                                ?>
                                                    <option value="<?php echo $data_kategori['id']; ?>" <?php if ($data['id_kategori'] == $data_kategori['id']) {
                                                                                                    echo "selected";
                                                                                                } ?>><?php echo $data_kategori['kategori']; ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>jumlah Pesanan</label>
                                            <input type="text" id="jumlah_pesanan" class="form-control" name="tahun" onkeypress="return hanyaAngka(event)" placeholder="jumlah_pesanan" value="<?php echo $data['jumlah_pesanan']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Harga</label>
                                            <input type="text" id="harga" class="form-control" name="harga" onkeypress="return hanyaAngka(event)" placeholder="Harga" value="<?php echo $data['harga']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Stok</label>
                                            <input type="text" id="stok" class="form-control" name="stok" onkeypress="return hanyaAngka(event)" placeholder="Stok" value="<?php echo $data['stok']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Gambar Produk</label>
                                            <img src="../assets/img/<?php echo $data['gambar']; ?>" style="width: 150px; height:150px; float: left; margin: 15px;">

                                            <input type="file" name="gambar_produk" /><br>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-lg btn-block">Ubah</button>
                                    </form>
                                </div>
                            </div>
                            <!-- END TABLE HOVER -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- END MAIN CONTENT -->
        </div>
        <!-- END MAIN -->
    </div>
    <!-- END WRAPPER -->
    <!-- Javascript -->
    <script src="../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="../assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <script src="../assets/scripts/klorofil-common.js"></script>
    <!-- validasi angka -->
    <script>
        function hanyaAngka(evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                alert("Hanya diisi oleh Angka!");
                return false;
            } else {
                return true;
            }
        }
    </script>
</body>

</html>
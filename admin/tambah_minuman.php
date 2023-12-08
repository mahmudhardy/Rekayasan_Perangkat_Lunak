<!doctype html>
<html lang="en">
<?php
session_start();
include 'konfig.php';
include 'cek.php';
?>

<head>
    <title>Drinker</title>
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
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/Coffee_Icon.png">
    <link rel="icon" type="image/png" sizes="96x96" href="../assets/img/Coffee_Icon.png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<!-- BACKGROUND -->
	<style>
		body{
			background-image:url("../assets/img/bgd.png");
			background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            background-attachment: fixed;
            height: 100%;
		}
	</style>

</head>

<body>
        <!-- MAIN -->
        <div class="main">
            <!-- MAIN CONTENT -->
            <div class="main-content">
                <div class="container-fluid">
                    <h3 align="center" class="page-title">Tambah Minuman</h3>
                    <div class="row">
                        <div class="col-md-12">
                            <!-- TABLE HOVER -->
                            <div class="panel">
                                <div class="panel-heading">
                                    <h3 align="center" class="panel-title">Silahkan isi data</h3>
                                </div>
                                <div class="panel-body">
                                    <form class="form-auth-small" method="post" action="proses_tambah.php" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label>Nama</label>
                                            <input type="text" id="nama" class="form-control" name="nama" placeholder="Nama" required="">
                                        </div>
                                        <div class="form-group">
                                            <label>Kategori</label>
                                            <select class="form-control" name="id_kategori">
                                                <option value="0">-- Kategori --</option>
                                                <?php
                                                //Perintah sql untuk menampilkan semua data pada tabel jurusan
                                                $querynama = "select * from kategori ORDER BY kategori asc";

                                                $hasilnama = mysqli_query($koneksi, $querynama);
                                                $jsArray = "var data = new Array();\n";
                                                // $nomornama = 0;
                                                while ($data = mysqli_fetch_array($hasilnama)) {
                                                ?>
                                                    <option value="<?php echo $data['id']; ?>"><?php echo $data['kategori']; ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Jumlah Pesanan</label>
                                            <input type="text" id="jumlah_pesanan" class="form-control" name="jumlah_pesanan" onkeypress="return hanyaAngka(event)" placeholder="Jumlah Pesanan" required="">
                                        </div>
                                        <div class="form-group">
                                            <label>Harga</label>
                                            <input type="text" id="harga" class="form-control" name="harga" onkeypress="return hanyaAngka(event)" placeholder="Harga" required="">
                                        </div>
                                        <div class="form-group">
                                            <label>Stok</label>
                                            <input type="text" id="stok" class="form-control" name="stok" onkeypress="return hanyaAngka(event)" placeholder="Stok" required="">
                                        </div>

                                        <div class="form-group">
                                            <label>Gambar Produk</label>

                                            <input type="file" name="gambar_produk" /><br>
                                        </div>
                                        <button id="simpan" type="submit" class="btn btn-primary btn-lg btn-block">Simpan</button>
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
    <!-- Javascript -->
    <script src="../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="../assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <script src="../assets/scripts/klorofil-common.js"></script>
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
<!doctype html>
<html lang="en">
<?php
session_start();
include 'konfig.php';
include 'cek.php';
function rupiah($nilai)
{
    return number_format($nilai, 0, ',', '.');
}
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
	<!-- BACKGROUND -->
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
                    <h3 align="center" class="page-title">Data Minuman</h3>
                    <div class="row">
                        <div class="col-md-12">
                            <!-- TABLE HOVER -->
                            <div class="panel">
                                <div class="panel-heading">
                                    <div class="col-md-6 col-12" style="margin-left:-15px;  padding-bottom:10px;">
                                        <a class="text-left btn btn-primary" href="tambah_minuman.php">
                                            <h3 class="panel-title"><i class="fa fa-plus-circle"></i> Tambah Minuman</h3>
                                        </a>

                                    </div>
                                    <div class="col-md-6 col-12" style="margin-right: -15px; padding-top:10px;">
                                        <form method="GET" action="minuman.php" class="right">
                                            <input type="text" style="padding: 5px 10px;" name="kata_cari" placeholder="Cari" value="<?php if (isset($_GET['kata_cari'])) {
                                                                                                                                            echo $_GET['kata_cari'];
                                                                                                                                        } ?>" />
                                            <button style="padding: 7px 10px; background-color: #337ab7; color:white; margin-left:-10px;" type="submit"><i class="fa fa-search"></i></button>
                                        </form>

                                    </div>
                                </div>
                                <div class="panel-body">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Harga</th>
                                                <th style="text-align: center;">Gambar</th>
                                                <th style="text-align: center; width: 200px;">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            //jika kita klik cari, maka yang tampil query cari ini
                                            if (isset($_GET['kata_cari'])) {

                                                // menjalankan query untuk menampilkan semua dataa diurutkan berdasarkan id
                                                $page = (isset($_GET['page'])) ? (int) $_GET['page'] : 1;

                                                // Jumlah data per halaman
                                                $limit = 10;

                                                $limitStart = ($page - 1) * $limit;

                                                //menampung variabel kata_cari dari form pencarian
                                                $kata_cari =(isset($_GET['kata_cari']))? $_GET['kata_cari'] : "";

                                                //jika hanya ingin mencari berdasarkan kode_produk, silahkan hapus dari awal OR
                                                //jika ingin mencari 1 ketentuan saja query nya ini : SELECT * FROM produk WHERE kode_produk like '%".$kata_cari."%' 
                                                $result = mysqli_query($koneksi, "SELECT * FROM minuman WHERE nama like '%" . $kata_cari . "%' LIMIT " . $limitStart . "," . $limit);

                                                $no = $limitStart + 1;
                                            } else {

                                                // menjalankan query untuk menampilkan semua dataa diurutkan berdasarkan id
                                                $page = (isset($_GET['page'])) ? (int) $_GET['page'] : 1;

                                                // Jumlah data per halaman
                                                $limit = 10;

                                                $limitStart = ($page - 1) * $limit;

                                                $result = mysqli_query($koneksi, "SELECT * FROM minuman LIMIT " . $limitStart . "," . $limit);

                                                $no = $limitStart + 1;
                                            }
                                            // hasil query disimpan dalam bentuk array
                                            // melakukan looping untuk mencetak data.
                                            while ($row = mysqli_fetch_array($result)) {

                                            ?>

                                                <tr>
                                                    <td><?php echo $no; ?></td>
                                                    <td><?php echo $row['nama']; ?></td>
                                                    <td><?php echo "Rp " . rupiah($row['harga']); ?></td>

                                                    <td style="text-align: center;"><img src="../assets/img/<?php echo $row['gambar']; ?>" style="width: 150px; height:150px;"></td>
                                                    <td style="width: 200px; text-align:center;">
                                                        <a class="btn btn-warning" href="edit_minuman.php?id=<?php echo $row['id']; ?>"><i class="fa fa-edit"></i></a>
                                                        <a class="btn btn-danger" href="proses_hapus.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Anda yakin akan menghapus data?')"><i class="fa fa-trash"></i></a>
                                                    </td>
                                                </tr>

                                            <?php
                                                $no++;
                                            }
                                            ?>
                                        </tbody>
                                    </table>                                
                                </div>
                            </div>
                            <!-- END TABLE HOVER -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- END MAIN CONTENT -->
        </div>
    </div>
    <!-- Javascript -->
    <script src="../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="../assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <script src="../assets/scripts/klorofil-common.js"></script>
</body>

</html>
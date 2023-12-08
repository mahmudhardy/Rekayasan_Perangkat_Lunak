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
						<li><a href="minuman.php" class=""><i class="lnr lnr-book"></i> <span>Minuman</span></a></li>
						<li><a href="transaksi.php" class=""><i class="lnr lnr-file-empty"></i> <span>Transaksi</span></a></li>
                        <li><a href="pelanggan.php" class="active"><i class="lnr lnr-user"></i> <span>Pelanggan</span></a></li>
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
                    <h3 align="center" class="page-title">Laporan Detail Pelanggan</h3>
                    <div class="row">
                        <div class="col-md-12">
                            <!-- TABLE HOVER -->
                            <div class="panel">
                                <div class="panel-heading">
                                <div class="col-md-6 col-12" style="margin-left:-15px;  padding-bottom:10px;">
                                        <a class="text-left btn btn-primary" href="Pelanggan.php">
                                            <h3 class="panel-title"> Kembali</h3>
                                        </a>

                                    </div>
                                </div>
                                <div class="panel-body">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>No Transaksi</th>
                                                <th>Nama</th>
                                                <th>Harga</th>
                                                <th>QTY</th>
                                                <th>Sub Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            // menjalankan query untuk menampilkan semua data diurutkan berdasarkan id
                                            $page = (isset($_GET['page'])) ? (int) $_GET['page'] : 1;

                                            // Jumlah data per halaman
                                            $limit = 10;

                                            $limitStart = ($page - 1) * $limit;

                                            $result = mysqli_query($koneksi, "SELECT transaksi.no_transaksi, minuman.nama, minuman.harga, detail_transaksi.jumlah_beli, detail_transaksi.subtotal from detail_transaksi inner join transaksi on transaksi.no_transaksi = detail_transaksi.no_transaksi inner join minuman on minuman.id = detail_transaksi.ID_minuman WHERE transaksi.no_transaksi = '$_GET[id]' ORDER BY no_transaksi asc LIMIT " . $limitStart . "," . $limit);

                                            $no = $limitStart + 1;

                                            // hasil query disimpan dalam bentuk array
                                            // melakukan looping untuk mencetak data.
                                            while ($row = mysqli_fetch_array($result)) {

                                            ?>

                                                <tr>
                                                    <td><?php echo $no; ?></td>
                                                    <td><?php echo $row['no_transaksi']; ?></td>
                                                    <td><?php echo $row['nama']; ?></td>
                                                    <td><?php echo "Rp " . rupiah($row['harga']); ?></td>
                                                    <td><?php echo $row['jumlah_beli']; ?></td>
                                                    <td><?php echo "Rp " . rupiah($row['subtotal']); ?></td>

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
        <!-- END MAIN -->
    </div>
    <!-- END WRAPPER -->
    <!-- Javascript -->
    <script src="../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="../assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <script src="../assets/scripts/klorofil-common.js"></script>
</body>
</html>
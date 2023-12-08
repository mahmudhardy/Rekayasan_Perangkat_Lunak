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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

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
						<li><a href="transaksi.php" class="active"><i class="lnr lnr-file-empty"></i> <span>Transaksi</span></a></li>
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
					<h3 align="center" class="page-title">Transaksi</h3>

					<div class="row">
						<div class="col-md-12">
							<!-- TABLE HOVER -->
							<div class="panel">
								<!-- cek login -->

								<div class="panel-heading">
									<h3 align="center" class="panel-title">Silahkan isi data</h3>
								</div>
								<div class="bg-transparent" style="margin:15px;">
									<form class="form-auth-small" method="post">
										<?php
										$query = "SELECT max(no_transaksi) as maxKode FROM transaksi";
										$hasil = mysqli_query($koneksi, $query);
										$data = mysqli_fetch_array($hasil);
										$notrans = $data['maxKode'];
										$noUrut = (int) substr($notrans, 3, 3);
										$noUrut++;
										$char = "TRS";
										$noTransaksi = $char . sprintf("%03s", $noUrut);
										?>

										<div class="form-group col-lg-6">
											<label>No Transaski</label>
											<input type="text" class="form-control" name="notransaksi" value="<?php echo $noTransaksi; ?>" readonly>
										</div>
										<div class="form-group col-lg-6">
											<label>Tanggal</label>
											<input type="text" class="form-control" name="tanggal" value="<?php echo date("Y-m-d"); ?>" readonly>
										</div>

										<div class="form-group col-lg-6">
											<label>Nama</label>
											<select class="form-control" name="id_minuman" onchange="changeValue(this.value)">
												<option value="0">-- Pilih --</option>
												<?php
												//Perintah sql untuk menampilkan semua data pada tabel jurusan
												$queryNama = "select * from minuman inner join kategori on minuman.id_kategori = kategori.id ORDER BY nama asc";

												$hasilNama = mysqli_query($koneksi, $queryNama);
												$jsArray = "var dataMinuman = new Array();\n";
												$nomorNama = 0;
												while ($data = mysqli_fetch_array($hasilNama)) {
													$nomorNama++;
													$jsArray .= "dataMinuman['" . $data['id'] . "'] = {kategori:'" . addslashes($data['kategori']) . "',harga:'" . addslashes($data['harga']) . "',id:'" . addslashes($data['id']) . "'};\n";
												?>
													<option value="<?php echo $data['id']; ?>"><?php echo $data['nama']; ?></option>
												<?php
												}
												?>
											</select>
										</div>
										<script type="text/javascript">
											<?php echo $jsArray; ?>

											function changeValue(ID) {
												document.getElementById('kategori').value = dataMinuman[ID].kategori;
												document.getElementById('harga').value = dataMinuman[ID].harga;
											};
										</script>
										<div class="form-group col-lg-6">
											<label>Kategori</label>
											<input type="text" class="form-control" id="kategori" name="kategori" placeholder="kategori" readonly required="">
										</div>
										<div class="form-group col-lg-6">
											<label>Harga</label>
											<input type="text" id="harga" class="form-control" name="harga" onkeyup="sum();" placeholder="harga" readonly  required="">
										</div>

										<!-- Inputan -->
										<div class="form-group col-lg-6">
											<label>QTY</label>
											<input type="text" id="qty" class="form-control" name="qty" placeholder="10" onkeyup="sum();" onkeypress="return hanyaAngka(event);">
										</div>

										<script>
											function sum() {
												var dataQty = document.getElementById('qty').value;
												var dataHarga = document.getElementById('harga').value;
												var result = parseInt(dataQty) * parseInt(dataHarga);
												if (!isNaN(result)) {
													document.getElementById('subtotal').value = result;
												} else {
													document.getElementById('subtotal').value = "";
												}
											}
										</script>

										<div class="form-group col-lg-6">
											<label>Sub-total</label>
											<input type="text" class="form-control" id="subtotal" name="subtotal" placeholder="subtotal" readonly  required="">
										</div>
										<div class="form-group col-lg-12">
											<button id="tambah" type="submit" class="btn btn-dark btn-lg btn-block"><i class="fa fa-plus"></i> Tambah</button>
										</div>
										<div class="panel">
											<table class="table table-hover">
												
												<?php
												$queryData = "SELECT detail_transaksi.ID as id, minuman.nama as dataMinuman, detail_transaksi.jumlah_beli as dataQty, detail_transaksi.subtotal as dataSubtotal from detail_transaksi INNER JOIN minuman on detail_transaksi.ID_minuman = minuman.ID WHERE no_transaksi='$noTransaksi'";
												$resultData = mysqli_query($koneksi, $queryData);
												while ($baris = mysqli_fetch_array($resultData)) {
												?>
													<tbody>
														<tr>
															<td><?php echo $baris['dataMinuman']; ?></td>
															<td><?php echo $baris['dataQty']; ?></td>
															<td><?php echo $baris['dataSubtotal']; ?></td>
															<td style="width: 70px; text-align:center;">
															</td>
														</tr>
													</tbody>
												<?php } ?>
											</table>
										</div>
										<div class="row" style="margin:15px;">
											<div class="form-group col-lg-6 col-md-6">
												<button id="simpan" type="submit" class="btn btn-primary btn-lg btn-block">Simpan</button>
											</div>
											<?php 
											$query = "SELECT sum(subtotal) as subtotal from detail_transaksi where no_transaksi='$noTransaksi'";
											$result = mysqli_query($koneksi, $query);
											while ($row = mysqli_fetch_array($result)){
											?>
											<div class="form-group col-lg-6 col-md-6 text-center">
												<table width="100%">
													<td><button class="left btn btn-light">Total</button></td> 
													<td><input type="text" class="form-control text-center" name="total" placeholder="Total" value="<?php echo $row['subtotal']?>" readonly></td>
												</table>
											</div>
											<?php } ?>
										</div>
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
	<script type="text/javascript">
		$(document).ready(function() {
			$("#tambah").click(function() {
				var data = $('.form-auth-small').serialize();
				$.ajax({
					type: 'POST',
					url: "proses_simpan_beli.php",
					data: data,
					success: function() {;
					}
				});
			});
			$("#simpan").click(function() {
				var data = $('.form-auth-small').serialize();
				$.ajax({
					type: 'POST',
					url: "proses_simpan_data.php",
					data: data,
					success: function() {
						// $('.dataBeli').load("tampil_data.php");
					}
				});
			});
		});
	</script>
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
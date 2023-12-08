<!doctype html>
<html lang="en" class="fullscreen-bg">

<head>
    <title>Drinker</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="assets/vendor/linearicons/style.css">
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="assets/css/main.css">
	<!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
	<link rel="stylesheet" href="assets/css/demo.css">
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<!-- Koneksi -->
	<?php
	include 'admin/konfig.php';
	?>
	<!-- ICONS -->
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/Coffee_Icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="assets/img/Coffee_Icon.png">
	<!-- BACKGROUND-->
	<style>
		body{
			background-image:url("assets/img/bgd.png");
			background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            background-attachment: fixed;
            height: 100%;
		}
	</style>
</head>
<body>
	<!-- cek login -->
	<?php
	if (isset($_GET['pesan'])) {
		if ($_GET['pesan'] == "Gagal") {
			echo "<div style='margin-bottom:-55px' class='alert alert-danger' role='alert'><span class='glyphicon glyphicon-warning-sign'></span>  Login Gagal !! Username dan Password Salah !!</div>";
		}
	}
	?>
	<!-- WRAPPER -->
	<div id="wrapper">
		<div class="vertical-align-wrap">
			<div class="vertical-align-middle">
				<div class="auth-box" align="center" class="tengah">
					<div class="content">
						<div class="header">
							<div class="col-md-12">
								<img src="assets/img/Coffe_go.png" class="ban-img img-fluid">
							</div>
							<p class="lead">Halaman Daftar</p>
						</div>
						<form class="form-auth-small" action="" method="post">
							<div class="form-group">
								<label for="signin-email" class="control-label sr-only">Username</label>
								<input align="center" type="text" class="form-control" name="username" placeholder="Username">
							</div>
							<div class="form-group">
								<label for="signin-password" class="control-label sr-only">Password</label>
								<input align="center" type="password" class="form-control" name="password" placeholder="Password">
							</div>
							<button type="submit" class="btn btn-primary btn-lg btn-block" name="btnDaftar">DAFTAR</button>
							<div class="bottom">
								<span class="helper-text">Sudah Punya Akun, Silahkan <a href="index.php">Login</a></span>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- END WRAPPER -->
</body>
</html>

<?php 	
	include 'koneksi.php';
	if (isset($_POST['btnDaftar'])) {
		
		// menangkap data yang dikirim dari form
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		// menyeleksi data admin dengan username dan password yang sesuai
		$query = mysqli_query($konek,"INSERT INTO admin value ('$username', '$password')");
		
		if ($query) {
			header('location:index.php');
		}
	}
?>
<?php 
session_start();
if (!isset($_SESSION["login"])) {
	header("Location: login.php");
	exit;
}
require 'functionL.php';
// kepangkatan
$get1 = mysqli_query($conn, "SELECT * from kepangkatan");
$kepangkatan = mysqli_num_rows($get1);
// bup
$get2 = mysqli_query($conn, "SELECT * from bup");
$bup = mysqli_num_rows($get2);
// berkala
$get3 = mysqli_query($conn, "SELECT * from berkala");
$berkala = mysqli_num_rows($get3);
// spk
$get4 = mysqli_query($conn, "SELECT * from berkala");
$spk = mysqli_num_rows($get4);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Kepegawaian PSDA</title>
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
		<div class="container">
			<div class="navbar-brand"><img src="img/logo.jpg" style="width: 30px; height: 30px; border-radius: 50%;"><a class="navbar-brand" href="../index.php"><b>Kepegawaian</b></a></div>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav ms-auto">
					<li class="nav-item">
						<a class="nav-link active" aria-current="page" href="kepangkatan/index.php">Kepangkatan</a>
					</li>
					<li class="nav-item">
						<a class="nav-link active" aria-current="page" href="berkala/index.php">Berkala</a>
					</li>
					<li class="nav-item">
						<a class="nav-link active" aria-current="page" href="bup/index.php">BUP</a>
					</li>
					<li class="nav-item">
						<a class="nav-link active" aria-current="page" href="spk/index.php">SPK</a>
					</li>
					<li class="nav-item">
						<a href="logout.php"><button type="button" class="btn btn-danger">Logout</button></a>
					</li>
				</ul>
			</div>
		</div>
	</nav>
	<br>
	<main>
		<div class="container">
			<div class="row">
				<div class="col-sm-4"><div class="card mb-auto">
					<img src="img/logo.jpg" class="card-img-top" alt="psda">
					<div class="card-body">
						<h5 class="card-title">UPTD PSDA</h5>
						<p class="card-text">Kantor Balai Pengelolaan Sumber Daya Air Wilayah Sungai Cimanuk-Cisanggarung</p>
						<br>
						<footer class="blockquote-footer">Kepongpongan, Kec. Talun, Kabupaten Cirebon, <cite title="Source Title">Jawa Barat 45171</cite></footer>
					</div>
				</div></div>
				<div class="col-sm-8">
					<h3><u>Data Kepegawaian</u></h3>
					<div class="row">
						<div class="col-md-6">
							<div class="card border-info mb-3">
								<div class="card-header">Kepangkatan</div>
								<div class="card-body text-dark mb-3 pt-4 pb-4">
									<p class="card-text fs-1 text-info"><i class="bi bi-award-fill"></i><?=$kepangkatan; ?> Data</p>
								</div>
							</div>
							<div class="card border-info">
								<div class="card-header">Berkala</div>
								<div class="card-body text-dark mb-3 pt-4 pb-4">
									<p class="card-text fs-1 text-info"><i class="bi bi-clipboard2-data"></i></i><?=$berkala; ?> Data</p>
								</div>
							</div>

						</div>
						<div class="col-md-6">
							<div class="card border-info mb-3">
								<div class="card-header">BUP</div>
								<div class="card-body text-dark mb-3 pt-4 pb-4">
									<p class="card-text fs-1 text-info"><i class="bi bi-file-earmark-x-fill"></i><?=$bup; ?> Data</p>
								</div>
							</div>
							<div class="card border-info">
								<div class="card-header">SPK</div>
								<div class="card-body text-dark mb-3 pt-4 pb-4">
									<p class="card-text fs-1 text-info"><i class="bi bi-clipboard2-pulse"></i></i><?=$spk; ?> Data</p>
								</div>
							</div>
							<!-- <div class="col-md-12">
								<div class="card border-info">
								<div class="card-header">Total Data</div>
								<div class="card-body text-dark mb-3 pt-4 pb-4">
									<p class="card-text fs-1 text-info"><i class="bi bi-file-earmark-x-fill"></i><?=$bup+$berkala+$kepangkatan+$spk; ?> Data</p>
								</div>
							</div> -->
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 mt-3">
							<div class="card border-info">
								<div class="card-header">Total Data</div>
								<div class="card-body text-dark mb-3 pt-4 pb-4">
									<p class="card-text fs-1 text-info"><i class="bi bi-calculator-fill"></i></i><?=$bup+$berkala+$kepangkatan+$spk; ?> Data</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>
	<!--modal tambah  -->
	<!-- modal ubah -->

	<script src="js/bootstrap.js"></script>
	<script src="js/sweetalert2.all.min.js"></script>
	<script src="js/jquery.min.js"></script>
</body>
</html>
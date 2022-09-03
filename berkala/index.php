<?php 
session_start();
if (!isset($_SESSION["login"])) {
	header("Location: ../login.php");
	exit;
}
require 'functions.php';
// pagination
$jumlahDataPerhalaman = 10;
$jumlahData = count(query("SELECT * FROM berkala"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerhalaman);
$halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
$awalData = ($jumlahDataPerhalaman * $halamanAktif) - $jumlahDataPerhalaman;
// $file = query("SELECT * FROM filem ORDER BY id DESC");
$file = query("SELECT * FROM berkala ORDER BY id DESC LIMIT $awalData, $jumlahDataPerhalaman");
// tombol cari di klik

// modal tambah
// cek apakah tombol submit ditekan atau belum
if (isset($_POST['submit'])) {

	// 
	if (tambah($_POST) > 0) {
		echo "<script>
		alert('berhasil menambahkan file');
		document.location.href = 'index.php';
		</script>";
	}else {
		echo "<script>
		alert('gagal menambahkan file');
		document.location.href = 'index.php';
		</script>";
	}

}

if (isset($_POST['ubah'])) {
	// 
	if (ubah($_POST) > 0) {
		echo "<script>
		alert('berhasil mengubah data');
		document.location.href = 'index.php';
		</script>";
	}else {
		echo "<script>
		alert('gagal mengubah data');

		</script>";
		echo mysqli_error($conn);
	}
}
if (isset($_POST["cari"])) {
	$file = search($_POST["keyword"]);
}
// remake
date_default_timezone_set("Asia/jakarta");
$tgl_sekarang = date('Y-m-d');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Berkala</title>
	<link rel="stylesheet" href="../css/bootstrap.css">
	<link rel="stylesheet" href="../css/style.css">
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
		<div class="container">
			<div class="navbar-brand"><img src="../img/logo.jpg" style="width: 30px; height: 30px; border-radius: 50%;"><a class="navbar-brand" href="../index.php"><b>Kepegawaian</b></a></div>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav ms-auto">
					<li class="nav-item">
						<a class="nav-link active" aria-current="page" href="../kepangkatan/index.php">Kepangkatan</a>
					</li>
					<li class="nav-item">
						<a class="nav-link active" aria-current="page" href="">Berkala</a>
					</li>
					<li class="nav-item">
						<a class="nav-link active" aria-current="page" href="../bup/index.php">BUP</a>
					</li>
					<li class="nav-item">
						<a class="nav-link active" aria-current="page" href="../spk/index.php">SPK</a>
					</li>
					<li class="nav-item">
						<a href="../logout.php"><button type="button" class="btn btn-danger">Logout</button></a>
					</li>
				</ul>
			</div>
		</div>
	</nav>
	<main>
		<section id="jumbotron">
			<div class="jumbotron">
				<h1>Berkala</h1>
			</div>
		</section>
		<br>
		<section id="fitur">
			<div class="container-fluid row">
				<div class="col">
					<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambah" data-bs-whatever="@mdo">Tambah</button>
				</div>
				<div class="col">
					<form action="" method="post">
						<div class="input-group mb-2">
							<input type="text" class="form-control" placeholder="Masukan Keyword Pencarian.." aria-label="Recipient's username" aria-describedby="button-addon2" autofocus autocomplete="off" name="keyword">
							<button class="btn btn-outline-primary" type="cari" id="button-addon2" name="cari">Cari</button>
						</div>
					</form>
				</div>
			</div>
		</section>
		<br>
		<section id="tabel">
			<table class="table table-dark table-striped">
				<thead>
					<tr class="table-dark">
						<th scope="col">No</th>
						<th scope="col">Aksi</th>
						<th scope="col">Nama</th>
						<th scope="col">tmt</th>
						<th scope="col">Tanggal Naik</th>
						<th scope="col">Status</th>
						<th scope="col">Berkas</th>
					</tr>
				</thead>
				<tbody>
					<?php $i = 1; ?>
					<?php foreach ($file as $row) : ?>
						<tr>
							<th scope="row"><?php echo $i; ?></th>
							<td><a href="ubah.php?id=<?= $row['id']; ?>"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
								<path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
								<path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
							</svg></a> |
							<a href="hapus.php?id=<?= $row['id']; ?> &file=<?= $row['file'] ?>" onclick="return confirm('yakin?')"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-square" viewBox="0 0 16 16">
								<path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
								<path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
							</svg></a></td>
							<td><?php echo $row['nama']; ?></td>
							<td><?php echo date('Y-m-d', strtotime($row['tmt'])); ?></td>
							<td><?php echo date('Y-m-d', strtotime($row['naik'])); ?></td>
							<td><?php if ($tgl_sekarang >= $row['naik']) {
								echo "Sudah";
							}else {
								echo "belum";
							} ?></td>
							<td><a href="filem.php?id=<?php echo $row['id'];?>"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-up-right" viewBox="0 0 16 16">
								<path fill-rule="evenodd" d="M8.636 3.5a.5.5 0 0 0-.5-.5H1.5A1.5 1.5 0 0 0 0 4.5v10A1.5 1.5 0 0 0 1.5 16h10a1.5 1.5 0 0 0 1.5-1.5V7.864a.5.5 0 0 0-1 0V14.5a.5.5 0 0 1-.5.5h-10a.5.5 0 0 1-.5-.5v-10a.5.5 0 0 1 .5-.5h6.636a.5.5 0 0 0 .5-.5z"/>
								<path fill-rule="evenodd" d="M16 .5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h3.793L6.146 9.146a.5.5 0 1 0 .708.708L15 1.707V5.5a.5.5 0 0 0 1 0v-5z"/>
							</svg></a></td>
						</tr>
						<?php $i++; ?>
					<?php endforeach; ?>
				</tbody>
			</table>
		</section>
		<!-- pagination -->
		<div class="container-fluid d-flex justify-content-around">
			<nav aria-label="Page navigation example">
				<ul class="pagination">
					<?php if ($halamanAktif > 1) : ?>
						<li class="page-item">
							<a class="page-link" href="?halaman=<?= $halamanAktif - 1; ?>" aria-label="Previous">
								<span aria-hidden="true">&laquo;</span>
							</a>
						</li>
					<?php endif; ?>
					<?php for ($i=1; $i <= $jumlahHalaman; $i++) : ?>
						<?php if ($i == $halamanAktif) : ?>
							<li class="page-item active" aria-current="page"><a class="page-link" href="?halaman=<?= $i; ?>"><?= $i; ?></a></li>
							<?php else : ?>
								<li class="page-item"><a class="page-link" href="?halaman=<?= $i; ?>"><?= $i; ?></a></li>
							<?php endif; ?>

						<?php endfor; ?>
						<?php if ($halamanAktif < $jumlahHalaman) : ?>
							<li class="page-item">
								<a class="page-link" href="?halaman=<?= $halamanAktif + 1; ?>" aria-label="Next">
									<span aria-hidden="true">&raquo;</span>
								</a>
							</li>
						<?php endif; ?>
					</ul>
				</nav>
			</div>
		</div>

	</main>
	<!--modal tambah  -->
	<div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="tambahLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="tambahLabel">Tambah Data</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form action="" method="post" enctype="multipart/form-data">
						<div class="mb-3">
							<label for="recipient-name" class="col-form-label">Nama</label>
							<input type="text" class="form-control" id="recipient-name" name="nama" required="harus di isi">
						</div>
						<div class="mb-3">
							<label for="tanggal" class="col-form-label">tanggal</label>
							<input type="date" class="form-control" id="tanggal" name="tmt">
						</div>
						<div class="mb-3">
							<label for="angkat" class="col-form-label">Naik</label>
							<input type="date" class="form-control" id="angkat" name="naik">
						</div>
						<div class="mb-3">
							<label for="filefile" class="col-form-label">Berkas</label>
							<input type="file" class="form-control" id="filefile" name="file">
						</div>

						<button type="submit" class="btn btn-primary" data-bs-dismiss="modal" name="submit">Tambah</button>

					</form>
				</div>	
			</div>
		</div>
	</div>
	<!-- modal ubah -->
	<div class="modal fade" id="ubah" tabindex="-1" aria-labelledby="ubahLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="ubahLabel">Ubah Data file</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form action="" method="post" enctype="multipart/form-data">
						<input type="hidden" name="id" id="id">
						<input type="hidden" name="fileLama" value="<?= $row['file'] ?>">
						<input type="hidden" name="tmtLama" value="<?= $row['tmt'] ?>">
						<div class="mb-3">
							<label for="nama" class="col-form-label">Nama</label>
							<input type="text" class="form-control" id="nama" name="nama" required="harus di isi">
						</div>
						<div class="mb-3">
							<label for="tanggal" class="col-form-label">tanggal</label>
							<input type="date" class="form-control" id="tanggal" name="tmt" value="<?= $row['tmt'] ?>">
						</div>
						<div class="mb-3">
							<label for="angkat" class="col-form-label">Naik</label>
							<input type="date" class="form-control" id="angkat" name="naik" value="<?= $row['naik'] ?>">
						</div>
						<label for="filefile" class="col-form-label">Berkas</label>
						<a href="filem.php?id=<?php echo $row['id'];?>"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-up-right" viewBox="0 0 16 16">
							<path fill-rule="evenodd" d="M8.636 3.5a.5.5 0 0 0-.5-.5H1.5A1.5 1.5 0 0 0 0 4.5v10A1.5 1.5 0 0 0 1.5 16h10a1.5 1.5 0 0 0 1.5-1.5V7.864a.5.5 0 0 0-1 0V14.5a.5.5 0 0 1-.5.5h-10a.5.5 0 0 1-.5-.5v-10a.5.5 0 0 1 .5-.5h6.636a.5.5 0 0 0 .5-.5z"/>
							<path fill-rule="evenodd" d="M16 .5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h3.793L6.146 9.146a.5.5 0 1 0 .708.708L15 1.707V5.5a.5.5 0 0 0 1 0v-5z"/>
						</svg></a>
						<input type="file" class="form-control" id="filefile" name="file">
					</div>

					<button type="submit" class="btn btn-primary" data-bs-dismiss="modal" name="ubah">Ubah</button>

				</form>
			</div>	
		</div>
	</div>
</div>
<script src="../js/bootstrap.js"></script>
<script src="../js/sweetalert2.all.min.js"></script>
<script src="../js/jquery.min.js"></script>
<script>
	$(document).on("click","#tombolUbah", function () {
		let id = $(this).data('id');
		let nama = $(this).data('nama');
		let tmt = $(this).data('tmt');
		let naik = $(this).data('naik');
		let file = $(this).data('file');

		$('.modal-body #id').val(id);
		$('.modal-body #nama').val(nama);
		$('.modal-body #tanggal').val(tmt);
		$('.modal-body #angkat').val(naik);
		$('.modal-body #filefile').val(file);
	})
</script>
</body>
</html>
<?php 
$conn = mysqli_connect("localhost", "root", "", "kepegawaian");
function query($query){
	global $conn;
	$result = mysqli_query($conn, $query);
	$rows = [];
	while ($row = mysqli_fetch_assoc($result)) {
		$rows[] = $row;
	}
	return $rows;
}

// tambah
function tambah($data){
	global $conn;
	$nama =htmlspecialchars($data['nama']);
	$tmt = htmlspecialchars($data['tmt']);


	// $message = htmlspecialchars($data['file']);
	// upload
	$message = upload();
	if (!$message) {
		return false;
	}

	$query = "INSERT INTO spk VALUES ('','$nama','$tmt','$message')";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}
function upload(){
	$namaFile = $_FILES['file']['name'];
	$ukuranFile = $_FILES['file']['size'];
	$error = $_FILES['file']['error'];
	$tmpName = $_FILES['file']['tmp_name'];
	// cek apakah tidak ada file yang diupload
	// if ($error === 4) {
	// 	echo "<script>
	// 	alert('upload file terlebih dahulu');
	// 	</script>";
	// 	return false;
	// }
	// cek file apakah data file atau bukan
	$ekstensiFileValid = ['pdf','docx','doc','xls','xlsx','xlsb','xlsm','csv','jpg','jpeg','png'];
	$ekstensiFile = explode('.', $namaFile);
	$ekstensiFile = strtolower(end($ekstensiFile));
	if (!in_array($ekstensiFile, $ekstensiFileValid)) {
		echo "<script>
		alert('file tidak diizinkan atau kosong');
		</script>";
	}
	if ($ukuranFile > 1000000000) {
		echo "<script>
		alert('file terlalu besar');
		</script>";
	}
	// generate nama file baru
	$namaFileBaru = uniqid();
	$namaFileBaru .= '.';
	$namaFileBaru .= $ekstensiFile;
	// lolos pengecekan
	move_uploaded_file($tmpName, 'file/' . $namaFileBaru);
	return $namaFileBaru;
}
// hapus
function hapus($id){
	global $conn;
	mysqli_query($conn, "DELETE FROM spk WHERE id = $id");
	unlink('file/'.$_GET['file']);
	return mysqli_affected_rows($conn);
}
// ubah data
function ubah($data){
	global $conn;
	$id = $data['id'];
	$nama =htmlspecialchars($data['nama']);
	$tmt = htmlspecialchars($data['tmt']);
	$messageLama = htmlspecialchars($data['fileLama']);
	// cek apakah user upload file baru?
	if ($_FILES['file']['error'] === 4) {
		$message = $messageLama;
	}else {
		$message = upload();
	}
	

	$query = "UPDATE spk SET 
	nama = '$nama',
	tmt = '$tmt',
	file = '$message'
	WHERE id = $id
	";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}
// cari
function search($keyword){
	$query = "SELECT * FROM spk
	WHERE nama LIKE '%$keyword%' OR 
	tmt LIKE '%$keyword%' OR
	file LIKE '%$keyword%'
	";
	return query($query);
}

?>
<?php 
// koneksi
$conn = mysqli_connect("localhost", "root", "", "kepegawaian");
// regster
function registrasi($data){
	global $conn;
	$username = strtolower(stripcslashes($data['username']));
	$password = mysqli_real_escape_string($conn,$data['password']);
	$password2 = mysqli_real_escape_string($conn,$data['password2']);
// username sudah ada atau belum
	$result=mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");
	if (mysqli_fetch_assoc($result)) {
		echo "<script>
		alert('username sudah terdaftar');
		</script>";
		return false;
	}
	// cek konfirmasi password
	if ($password !== $password2) {
		echo "<script>
		alert('konfirmasi password gagal');
		</script>";
		return false;
	}
	// enkripsi password
	$password = password_hash($password, PASSWORD_DEFAULT);
	mysqli_query($conn, "INSERT INTO user VALUES('', '$username','$password')");
	return mysqli_affected_rows($conn);
	// tambahkan user baru ke database
}

?>
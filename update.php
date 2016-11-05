<!DOCTYPE html>
<html>
<head>
	<title>Update Data Karyawan</title>
</head>
<body>
<?php 
require_once "db.php"; 

$conn = konek_db();

if(! isset($_GET["NIK"]))
	die("tidak ada id karyawan");
//verifikasi data yang ada di database
$id = $_GET["NIK"];
$query = $conn->prepare("select * from karyawan where NIK=?");
$query->bind_param("i", $id);
$result = $query->execute();

if (! $result)
	die("gagal query");

$rows = $query->get_result();
if ($rows->num_rows == 0)
	die("Data Karyawan tidak ditemukan");
if(! isset($_POST["Nama"]) || ! isset($_POST["JenisKelamin"]) || ! isset($_POST["TempatLahir"]) || ! isset($_POST["TanggalLahir"]))
	die("data karyawan tidak lengkap");
$Nama = $_POST["Nama"];
$JenisKelamin = $_POST["JenisKelamin"];
$TempatLahir = $_POST["TempatLahir"];
$TanggalLahir = $_POST["TanggalLahir"];

$produk = $rows->fetch_object();

$query = $conn->prepare("update karyawan set Nama=?, JenisKelamin=?, TempatLahir=?, TanggalLahir=? where NIK=?");
$query->bind_param("ssssi" , $Nama, $JenisKelamin, $TempatLahir, $TanggalLahir, $id);
$result = $query->execute();

if($result)
	echo "<p>Data karyawan berhasil di update</p>";
else
	echo "<p>Gagal Mengupdate Data karyawan</p>";

?>
<a href = "read.php"><input type = "submit" value = "Lihat Karyawan"></a>
</body>
</html>
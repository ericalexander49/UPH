<!DOCTYPE html>
<html>
<head>
	<title>Delete Data Karyawan</title>
</head>
<body>
<?php
require_once "db.php";

$conn = konek_db();

if(! isset($_GET["NIK"]))
	die("tidak ada id karyawan");

$id = $_GET["NIK"];
$query = $conn -> prepare("select * from karyawan where NIK=?");
$query->bind_param("i",$id);
$result = $query->execute();

if(!$result)
	die("gagal query");
$rows = $query->get_result();
if($rows->num_rows==0)
	die("produk tidak ditemukan");
$produk = $rows->fetch_object();

$query = $conn->prepare("delete from karyawan where NIK=?");
$query->bind_param("i",$id);
$result = $query->execute();

if($result)
	echo"<p>Data karyawan berhasil di didelete</p>";
else
	echo"<p>Gagal mendelete data karyawan</p>";
?>
</body>
</html>
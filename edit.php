<!DOCTYPE html>
<html>
<head>
	<title>Edit Data Karyawan</title>
</head>
<body style = "font-family : arial ">
<?php 
require_once "db.php";
// get data yang akan di-edit/update
if (! isset($_GET['NIK']))
	die("Informasi karyawan tidak ditemukan");
$conn = konek_db();


//cari data produk yang akan di update
$id = $_GET["NIK"];
$query = $conn->prepare("select * from karyawan where NIK = ?");
$query->bind_param("i", $id);
$result = $query->execute();

if(! $result)
	die("Gagal query");

$rows = $query->get_result();
if ($rows->num_rows == 0)
	die ("<p>informasi karyawan tidak ditemukan</p>");

$data = $rows->fetch_object();

 ?>
 	<form method="POST" action="update.php?NIK=<?php echo $data->NIK; ?>">
 		<div>
 			<label>NIK</label>
 			<input type="number" name="NIK" value="<?php echo $data->NIK; ?>" style = "margin-left : 90px">
 		</div>
 		<div>
 			<label>Nama</label>
 			<input type="text" name="Nama" value="<?php echo $data->Nama; ?>" style = "margin-left : 74px">
 		</div>
 		<div>
 			<label>Jenis Kelamin</label>
 			<input type="radio" name="JenisKelamin" value="Laki-Laki" checked style = "margin-left : 17px"> Laki-Laki<input type="radio" name="JenisKelamin" value="Perempuan" style = "margin-left : 20px"> Perempuan
 		</div>
 		<div>
 			<label>Tempat Lahir</label>
 			<input type="text" name="TempatLahir" value="<?php echo $data->TempatLahir; ?>" style = "margin-left : 24px">
 		</div>
 		<div>
 			<label>Tanggal Lahir</label>
 			<input type="date" name="TanggalLahir" value="<?php echo $data->TanggalLahir; ?>" style = "margin-left : 20px; width : 168px">
 		</div><br>
 		<div><input type="submit" name="Update" value = "Update"></div><br>
 		
 		</form>
 		<a href = "read.php"><input type = "submit" value = "Lihat Karyawan"></a>
</body>
</html>
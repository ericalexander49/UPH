<!DOCTYPE html>
<html>
<head>
	<title>Daftar Karyawan</title>
	<style>
		body {
			text-align : center;
		}

		table, th , td {
			border : 1px solid black;
			border-collapse : collapse;
			border-spacing : 15px;
			padding : 20px;
			margin : 20px;
		}

		.table {
			margin-left : 280px;
		}
	</style>
</head>
<body style = "font-family : arial">
<?php 
require_once "db.php";

$conn = konek_db();
$query = $conn->prepare("select * from karyawan");
$result = $query->execute();

if(! $result)
	die("Gagal Query");

$rows = $query->get_result();
 ?>
<h1>DAFTAR KARYAWAN</h1>
<div class = "table">
<table>
		<tr>
			<th>NIK</th>
			<th>Nama</th>
			<th>Jenis Kelamin</th>
			<th>Tempat Lahir</th>	
			<th>Tanggal Lahir</th>
			<th>Action</th>
		</tr>
		<?php 
		while ($row = $rows->fetch_array()) {
			$url_edit = "edit.php?NIK=" . $row['NIK'];
			$url_delete = "delete.php?NIK=" . $row['NIK'];



			echo "<tr>";
			echo "<td>" . $row['NIK'] . "</td>";
			echo "<td>" . $row['Nama'] . "</td>";
			echo "<td>" . $row['JenisKelamin'] . "</td>";
			echo "<td>" . $row['TempatLahir'] . "</td>";
			echo "<td>" . $row['TanggalLahir'] . "</td>";
			echo "<td><a href ='" . $url_edit . "'><button>Edit</button></a>";
			echo "<a href='" . $url_delete . "'><button>Delete</button></a></td>";
			echo "</tr>";
		}
		 ?>
</table>
</div>
<a href = "create.html"><input type = "submit" value = "Tambah Karyawan"></a>
</body>
</html>
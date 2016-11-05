<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Menambah Data Karyawan</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
require_once "db.php";

if (isset($_POST["NIK"]) && isset($_POST["Nama"]) && isset($_POST["JenisKelamin"]) && isset($_POST["TempatLahir"]) && isset($_POST["TanggalLahir"])) {
    $NIK  = $_POST["NIK"];
    $Nama = $_POST["Nama"];
    $JenisKelamin = $_POST["JenisKelamin"];
    $TempatLahir = $_POST["TempatLahir"];
    $TanggalLahir = $_POST["TanggalLahir"];

    $conn = konek_db();
    
    $query = $conn->prepare("insert into karyawan(NIK, Nama, JenisKelamin, TempatLahir, TanggalLahir) values(?, ?, ?, ?, ?)");
   
    $query->bind_param("issss", $NIK, $Nama, $JenisKelamin, $TempatLahir, $TanggalLahir);

    $result = $query->execute();

    
    if (! $result)
        die("<p>Proses query gagal.</p>");

    echo "<p>Data karyawan berhasil ditambahkan.</p>";
} else {
    echo "<p>Data karyawan belum diisi!</p>";
}
?>
<a href = "read.php"><input type = "submit" value = "Lihat Karyawan"></a>
</body>
</html>

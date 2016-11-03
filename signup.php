<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Menambah Data User</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
require_once "db.php";

if (isset($_POST["username"]) && isset($_POST["password"])) {
    $username  = $_POST["username"];
    $password = $_POST["password"];

    $conn = konek_db();

    $query = $conn->prepare("insert into user(username, password) values(?, ?)");
  
    $query->bind_param("ss", $username, $password);

    $result = $query->execute();

    
    if (! $result)
        die("<p>Proses query gagal.</p>");

    echo "<p>Data user berhasil ditambahkan.</p>";
} else {
    echo "<p>Data user belum diisi!</p>";
}
?>
</body>
</html>
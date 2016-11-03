<?php 
session_start();
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title>Contoh Session</title>
 </head>
 <body>
 <?php 
 //jika sudah login, dan belum logout , redirect ke content
 if(isset($_SESSION["username"]))
 	header("Location: read.php");
 //jika belum login, dan belum ada kirim username dane password tampilkan form login
if(isset($_POST["username"]) && isset($_POST["password"])) {
	$username = $_POST["username"];
	$password = sha1($_POST["password"]);

	$conn = konek_db();
	$query = $conn->prepare("select * from user where username=? and password=?");
	$query->bind_param("ss",$username,$password);
	$result = $query->execute();
}
	if($result) {
		if($result->num_rows == 1){
		//login user
		$_SESSION["username"] = $username;
		//redirect ke content
		header("Location: read.php");
		//jika username/password salah tampilkan warning
	} else {
		echo "<p>Username/Password salah</p>";
	}
}

  ?>
  <form method="post" action="login.php">
  	<div>
  			<label>Username</label>
  			<input type="text" name="username">
  	</div>
  	<div>
  		<label>Password</label>
  		<input type="password" name="password">
  	</div>
  	<div><input type="submit" value="Login"></div>
  </form>

 </body>
 </html>
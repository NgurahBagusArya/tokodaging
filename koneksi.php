<?php 

$server 	= "localhost";
$username	= "root";
$pass		= "";
$db 		= "mahaputra";
$koneksi = mysqli_connect($server, $username, $pass, $db);

//untuk cek jika koneksi gagal ke database
if(mysqli_connect_errno()) {
	echo "Koneksi gagal : ".mysqli_connect_error();
}
?>
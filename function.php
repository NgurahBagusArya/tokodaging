<?php 
        
$conn = mysqli_connect("localhost", "root", "", "mahaputra");

if (!$conn) {
    die('connect failed' . mysqli_connect_error());
}

function registrasi($data) {
    global $conn;
    $nama = $data['nama'];
    $no_telp = $data['no_telp'];
    $email = $data["email"];
    $password = $data["password"];
    
    
    // enkripsi password
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    
    // tambahkan user baru ke dalam database
    $query = "INSERT INTO pengguna (nama, no_telp, email, password) VALUES ('$nama','$no_telp','$email', '$passwordHash')";
    if (mysqli_query($conn, $query)) {
        return true;
    } else {
        // Handle error here, for example:
        // return mysqli_error($conn);
        return false;
    }
}

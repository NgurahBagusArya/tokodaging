<?php
include_once "config.php";

// Membuat koneksi ke database
$conn = new mysqli('localhost', $username, $password, $db);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Mengeksekusi query SELECT
$result = $conn->query("SELECT * FROM admin");

// Memeriksa apakah query berhasil dieksekusi
if ($result) {
    // Mengambil hasil query dalam bentuk asosiatif
    $row = $result->fetch_assoc();

    // Menutup koneksi
    $conn->close();
} else {
    echo "Gagal menjalankan query: " . $conn->error;
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styledaging.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-light">
        <div class="container-fluid">
            <h5 class="ms-3">Meat Guy</h5>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <select class="form-select" aria-label="Default select example">
                </select>
            </button>

            <!-- navbar -->

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active text-light" aria-current="page" href="daging.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="aboutdaging.php">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="contact.php">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="#">Log Out</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <!-- background -->

    <div class="background">
        <div class="foto">
            <div class="container">
                <div class="text-center">
                    <h2>Suplier Daging Lokal & Import Terbaik</h2>
                </div>
                <h1>We Have Excellent Of Quality Meat</h1>
                <br>
                <div class="container d-flex justify-content-center ">
                    <button type="button" class="btn btn-primary btn-md btn-warning"><a class="nav-link text-dark" href="#">SEE ALL MEAT</a></button>
                </div>
            </div>
        </div>
    </div>

    <!-- Kategori Produk -->

    <h1 class="txtproduk">Kategori Produk</h1>
    <div class="container text-center">
        <?php foreach ($result as $rw) : ?>
            <div class="row">
                <div class="col">
                    <img src="img/ayam.jpg?= $rw['foto']; ?>" style="width:200px;" alt="">
                </div>
                <div class="col">
                    <p class="txt"><?= $rw['nama']; ?></p>
                </div>
                <div class="col">
                    <p>Stock <?= $rw['stok']; ?></p>
                </div>
                <div class="col">
                    <p>Rp. <?= $rw['harga']; ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="container d-flex mt-5">
        <div class="card-wrapper col-3 mx-5">
            <div class="card-1 text-center">



            </div>
        </div>
    </div>

</body>



<br><br><br><br><br><br><br><br><br>
<footer>
    <div class="container text-center">
        <div class="footer row px-4 justify-content-center">
            <div class="col-4">
                <br><br><br>
                <ul>
                    <li>Meat Guy</li>
                    <br>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="daging.php">HOME</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="aboutdaging.php">ABOUT</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="#">CONTACT US</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="#">SIGN IN</a>
                    </li>
                    <br><br><br><br><br>
                </ul>
            </div>
            <div class="col-4">
                <br><br><br>
                <ul>
                    <li>CONTACT US</li>
                    <br>
                    <li>Email:meatguy22@gmail.com</li>
                    <li>0876263232542</li>
                </ul>
            </div>
            <div class="col-4">
                <br><br><br>
                <ul>
                    <li>Social Media</li>
                    <br>
                    <li>Instagram</li>
                    <li>Facebook</li>
                </ul>


            </div>
        </div>
    </div>
    </div>
    <hr>
    <div class="copyrightText d-flex justify-content-between px-1 py-1">
        <a>Copyright © 2022 - 2023 Gadget Store</a>
        <a>Indonesia / Indonesia</a>
    </div>
</footer>
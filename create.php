<?php
//include atau panggil header.php yang ada difolder layouts
include('layouts/header.php');

?>
<body>
    <div class="container">
        <div class="card mt-3">
            <div class="card-header">
                Tambah Gadget
                <a href="index.php" class="btn btn-sm btn-dark float-xl-end">Kembali</a>
            </div>

            <div class="card-body">
                <form action="" method="post" role="form" enctype="multipart/form-data">
                    <div class="mt-2 col">
                        <label>Nama</label>
                        <input type="text" name="nama" required="" class="form-control">
                    </div>
                    <div class="mt-2 col">
                        <label>Stok</label>
                        <input type="text" name="stok" required="" class="form-control">
                    </div>
                    <div class="mt-2 col">
                        <label>Harga</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text">Rp</span>
                            <input type="number" min="0" name="harga" class="form-control">
                        </div>
                    </div>

                    <div class="mt-2 col ">
                        <label>Foto</label>
                        <input type="file" name="foto" required="" class="form-control" />
                    </div>


                    <button type="submit" class="btn btn-primary mt-3" name="submit" value="simpan">Simpan</button>
                </form>

                <?php
                include('koneksi.php');

                //melakukan pengecekan jika button submit diklik maka akan menjalankan perintah simpan dibawah ini
                if (isset($_POST['submit'])) {
                    //menampung data dari inputan
                    $nama = $_POST['nama'];
                    $stok = $_POST['stok'];
                    $harga = $_POST['harga'];

                    $nama_foto1   = $_FILES['foto']['name'];
                    $file_tmp1    = $_FILES['foto']['tmp_name'];
                    //untuk acak nama file jadi sebagai angka unik, agar nama file tidak sama
                    $acak1      = rand(1, 99999);


                    if ($nama_foto1 != "") {
                        //memberi nama baru pada foto yang diupload
                        $nama_unik1     = $acak1 . $nama_foto1;
                        //upload ke folder foto
                        move_uploaded_file($file_tmp1, 'foto/' . $nama_unik1);
                    } else {
                        $nama_unik1 = NULL;
                    }

                    $foto = $nama_unik1;

                    //query untuk menambahkan admin ke database, pastikan urutan nya sama dengan di database
                    $datas = mysqli_query($koneksi, "INSERT into admin (nama,stok,harga,foto)values('$nama','$stok','$harga','$foto')") or die(mysqli_error($koneksi));
                    //id admin tidak dimasukkan, karena sudah menggunakan AUTO_INCREMENT, id akan otomatis

                    //ini untuk menampilkan alert berhasil dan redirect ke halaman index
                    echo "<script>alert('data berhasil disimpan.');window.location='index.php';</script>";
                }
                ?>
            </div>
        </div>
    </div>
<?php
//include atau panggil footer.php yang ada difolder layouts
include('layouts/footer.php');
?>
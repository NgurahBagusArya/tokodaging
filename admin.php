<?php
//include atau panggil header.php yang ada difolder layouts
include('layouts/header.php');
?>
<div class="container">
    <div class="card mt-3">
        <div class="card-header">
            <div class="modal-header">
                <h2 class="modal-title fs-4" id="exampleModalLabel">Meat Guy</h2>
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">Tambah</button>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5 px-3" id="exampleModalLabel">Tambah Data</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="card mt-3">
                                <div class="card-body">
                                    <form action="" method="post" role="form" enctype="multipart/form-data">
                                        <div class="col">
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
                                                <span class="input-group-text">RP</span>
                                                <input type="number" min="0" name="harga" class="form-control">
                                            </div>
                                        </div>

                                        <div class="mt-2 col ">
                                            <label>Foto</label>
                                            <input type="file" name="foto" required="" class="form-control" />
                                        </div>


                                        <button type="submit" class="btn btn-primary mt-3 d-flex justify-content-end" name="submit" value="simpan">Simpan</button>
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
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover table-striped">
                <thead>
                    <tr class="bg-primary text-light">
                        <th>No</th>
                        <th>Foto</th>
                        <th>Nama</th>
                        <th>Stok</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include('koneksi.php');
                    //memanggil file koneksi
                    $datas = mysqli_query($koneksi, "SELECT * FROM admin") or die(mysqli_error($koneksi));


                    //script untuk menampilkan data nama

                    $no = 1; //untuk pengurutan nomor

                    if (mysqli_num_rows($datas) > 0) {

                        //melakukan perulangan
                        while ($row = mysqli_fetch_assoc($datas)) {
                    ?>

                            <tr>
                                <td><?= $no; ?></td>
                                <td class="d-flex justify-content-center">
                                    <a href="foto/<?= $row['foto']; ?>" target="_blank">
                                        <img src="foto/<?= $row['foto']; ?>" style="height: 100px;">
                                    </a>
                                </td>
                                <td><?= $row['nama']; ?></td>
                                <td><?= $row['stok']; ?></td>
                                <td>Rp <?= $row['harga']; ?></td>
                                <td class="justify-content-center">
                                    <a href="edit.php?id=<?= $row['id']; ?>" class="px-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                            <path d="M362.7 19.3L314.3 67.7 444.3 197.7l48.4-48.4c25-25 25-65.5 0-90.5L453.3 19.3c-25-25-65.5-25-90.5 0zm-71 71L58.6 323.5c-10.4 10.4-18 23.3-22.2 37.4L1 481.2C-1.5 489.7 .8 498.8 7 505s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L421.7 220.3 291.7 90.3z" />
                                        </svg>
                                    </a>
                                    <a href="hapus.php?id=<?= $row['id']; ?>" class="px-2" onclick="return confirm('anda yakin ingin hapus data ini?');">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                            <path d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0H284.2c12.1 0 23.2 6.8 28.6 17.7L320 32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64S14.3 32 32 32h96l7.2-14.3zM32 128H416V448c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V128zm96 64c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16z" />
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        <?php $no++;
                        } ?>
                    <?php } else { ?>
                        <tr>
                            <td colspan="7">Data belum ada.</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
//include atau panggil footer.php yang ada difolder layouts
include('layouts/footer.php');
?>
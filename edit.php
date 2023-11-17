<?php
//include atau panggil header.php yang ada folder layouts
include('layouts/header.php');

?>
<div class="container">
	<div class="card mt-3">
		<div class="card-header">
			<div class="modal-header">
				<h2 class="modal-title fs-4" id="exampleModalLabel">Edit</h2>
				<a class="btn btn-primary" href="admin.php" role="button">Kembali</a>
			</div>
		</div>
		<div class="card-body">
			<?php
			include('koneksi.php');

			$id = $_GET['id']; //mengambil id tagihan yang ingin diubah

			//menampilkan tagihan berdasarkan id
			$data = mysqli_query($koneksi, "SELECT * FROM admin where id = '$id'");
			$row = mysqli_fetch_assoc($data);

			?>
			<form action="" method="post" role="form" enctype="multipart/form-data">

				<!-- ini digunakan untuk menampung id yang ingin diubah -->
				<input type="hidden" name="id" required="" value="<?= $row['id']; ?>">

				<div class="col">
					<label>Nama</label>
					<input type="text" name="nama" required="" class="form-control" value="<?= $row['nama']; ?>">
				</div>
				<div class="mt-2 col">
					<label>Stok</label>
					<input type="text" name="stok" required="" class="form-control" value="<?= $row['stok']; ?>">
				</div>
				<div class="mt-2 col">
					<label>Harga</label>
					<div class="input-group mb-3">
						<span class="input-group-text">Rp</span>
						<input type="number" min="0" name="harga" class="form-control" value="<?= $row['harga']; ?>">
					</div>
				</div>

				<div class="mt-2 col">
					<label>Foto Sebelumnya</label>
					<br>
					<img src="foto/<?= $row['foto']; ?>" class="col-3">
					<input type="hidden" name="foto_sebelumnya" value="<?= $row['foto']; ?>" />
				</div>


				<div class="mt-2 col">
					<label>Foto Baru (abaikan jika tidak ingin ganti foto)</label>
					<input type="file" name="foto" class="form-control" />
				</div>


				<button type="submit" class="btn btn-primary mt-3" name="submit" value="simpan">update data</button>
			</form>

			<?php

			//jika klik tombol submit maka akan melakukan perubahan
			if (isset($_POST['submit'])) {
				$id = $_POST['id'];
				$nama = $_POST['nama'];
				$stok = $_POST['stok'];
				$harga = $_POST['harga'];

				$nama_foto1   = $_FILES['foto']['name'];
				$file_tmp1    = $_FILES['foto']['tmp_name'];
				$acak1      = rand(1, 99999);

				//cek jika foto baru tidak ada
				if ($nama_foto1 != "") {
					$nama_unik1     = $acak1 . $nama_foto1;
					move_uploaded_file($file_tmp1, 'foto/' . $nama_unik1);
				} else {
					//maka tetap pakai foto lama
					$nama_unik1 = $_POST['foto_sebelumnya'];
				}

				$foto = $nama_unik1;

				//query mengubah tagihan
				mysqli_query($koneksi, "UPDATE admin set nama='$nama', stok='$stok', harga='$harga', foto='$foto' where id ='$id'") or die(mysqli_error($koneksi));

				//redirect ke halaman index.php
				echo "<script>alert('data berhasil diupdate.');window.location='index.php';</script>";
			}



			?>
		</div>
	</div>
</div>
</div>

<?php
//include atau panggil footer.php yang ada folder layouts
include('layouts/footer.php');
?>
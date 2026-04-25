<?php 

include "koneksi.php";
include "function.php";

if (isset($_POST['submit'])) {
	
	if (tambah($conn, $_POST)) {
		header("Location: index.php?status=sukses");
		exit;
	} else{
		echo "Gagal terkirim";
	}
}


 ?>

<!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
 	<title>Data Buku</title>
 	<link rel="stylesheet" href="style.css">
 </head>
 <body>
 	<div class="left-box">
 		<table>
 			<thead>
 				<tr>
	 				<th>ID</th>
	 				<th>Judul</th>
	 				<th>Penulis</th>
	 				<th>Tahun Terbit</th>
	 				<th>Harga</th>
	 				<th>Stok</th>
 				</tr>
 			</thead>
 			<tbody>
 				<?php 
 				$no = 1;
 				$query = "SELECT * FROM buku";
 				$result = $conn->query($query);

 				if ($result->num_rows > 0) {
	 				while ($row = $result->fetch_assoc()) {
	 					?>
	 					<tr>
	 						<td><?php echo $no++ ?></td>
	 						<td><?php echo $row['judul']; ?></td>
	 						<td><?php echo $row['penulis']; ?></td>
	 						<td><?php echo $row['tahun_terbit']; ?></td>
	 						<td><?php echo number_format($row['harga'], 0, ',', '.'); ?></td>
	 						<td><?php echo $row['stok']; ?></td>
	 					</tr>
	 					<?php
	 				}
 				} else {
 					echo "<tr><td colspan='6' style='text-align:center;'>Tidak ada data.</td></tr>";
 				}
 				?>
 			</tbody>
 		</table>
 	</div>
 	<div class="right-box">
 		<div class="button-style">
                <button type="submit" name="" class="ganti activated">Buku</button>
                <button type="submit" name="" class="ganti">Pelanggan</button>
                <button type="submit" name="" class="ganti">Pesanan</button>
            </div>
 		<?php if(isset($_GET['status']) && $_GET['status'] == 'sukses') echo "<p style='color:green'>Data berhasil disimpan!</p>"; ?>
 		<form action="" method="post" >
 			<input type="text" name="judul" placeholder="Masukan Judul" required><br><br>
 			<input type="text" name="penulis" placeholder="Masukan Penulis" required><br><br>
 			<input type="number" name="tahun_terbit" placeholder="Masukan Tahun Terbit" required><br><br>
 			<input type="number" name="harga" placeholder="Masukan Harga" required><br><br>
 			<input type="number" name="stok" placeholder="Masukan stok" required><br><br>
 			<div class="pilih-barang">
                <input type="radio" name="pilihan[]" value="tambah" class="barang" placeholder="Tambah" checked> Tambah
                <input type="radio" name="pilihan[]" value="ubah" class="barang" placeholder="Ubah"> Ubah
            </div>
 			<div class="button-style">
                <button type="submit" name="submit" class="enter">Simpan Data</button>
                <button type="submit" name="action" value="remove" class="hapus" formnovalidate>Hapus</button>
            </div>
 		</form>
 	</div>
 </body>
 </html>
<?php 

include "koneksi.php";
include "function.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
	
	if (tambah($conn, $_POST)) {
		echo "Berhasil memasukan data!";
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
 	<title>Document</title>
 	<link rel="stylesheet" href="style.css">
 </head>
 <body>
 		<form action="" method="post" >
 			<input type="text" name="judul" placeholder="Masukan Judul"><br><br>
 			<input type="text" name="penulis" placeholder="Masukan Penulis"><br><br>
 			<input type="number" name="tahun_terbit" placeholder="Masukan Tahun Terbit"><br><br>
 			<input type="number" name="harga" placeholder="Masukan Harga"><br><br>
 			<input type="number" name="stok" placeholder="Masukan stoks"><br><br>
 			<button type="submit" name="submit">Enter</button>
 		</form>
 		<table>
 			<thead>
 				<th>ID</th>
 				<th>Judul</th>
 				<th>Penulis</th>
 				<th>Tahun Terbit</th>
 				<th>Harga</th>
 				<th>Stok</th>
 			</thead>
 			<tbody>
 				<td></td>
 			</tbody>
 		</table>
 </body>
 </html>
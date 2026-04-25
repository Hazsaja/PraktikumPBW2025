<?php 


function tambah($conn, $data)
{
	$judul = $data['judul'];
	$penulis = $data['penulis'];
	$tahun_terbit = $data['tahun_terbit'];
	$harga = $data['harga'];
	$stok = $data['stok'];

	$stmt = $conn->prepare(
		"INSERT INTO buku (judul,penulis,tahun_terbit,harga,stok)
		 VALUES (?,?,?,?,?)"
	);

	$stmt->bind_param("ssidi",$judul,$penulis,$tahun_terbit,$harga,$stok);
	
	return $stmt->execute();

}

function hapus($id_buku){

}

function ubah($id_buku){
	
}


 ?>
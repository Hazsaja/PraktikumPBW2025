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

function hapus($conn ,$id_buku){

	$stmt->prepare("DELETE FROM buku WHERE id = ?");
	$stmt->bind_param("i", $id_buku);

	return $stmt->execute();

}

function ubah($conn ,$data){

	$judul = $data['judul'];
	$penulis = $data['penulis'];
	$tahun_terbit = $data['tahun_terbit'];
	$harga = $data['harga'];
	$stok = $data['stok'];
	$id = $data["id"];

	$stmt->prepare("UPDATE buku SET judul = ?, penulis = ?, tahun_terbit = ?, harga = ?, stok = ? WHERE id = ?");
	$stmt->bind_param("ssidii", $judul, $penulis, $tahun_terbit, $harga, $stok, $id);

	return $stmt->execute()
}


 ?>
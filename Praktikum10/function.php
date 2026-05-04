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

	$stmt = $conn->prepare("DELETE FROM buku WHERE id = ?");
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

	$stmt = $conn->prepare("UPDATE buku SET judul = ?, penulis = ?, tahun_terbit = ?, harga = ?, stok = ? WHERE id = ?");
	$stmt->bind_param("ssidii", $judul, $penulis, $tahun_terbit, $harga, $stok, $id);

	return $stmt->execute();
}

function tambah_pelanggan($conn, $data){
	$nama = $data['nama'];
	$alamat = $data['alamat'];
	$email = $data['email'];
	$telp = $data['telepon'];

	$stmt = $conn->prepare(
		"INSERT INTO pelanggan (nama,alamat,email,telepon) 
		VALUES (?,?,?,?)"
	);
	$stmt->bind_param("ssss", $nama, $alamat, $email, $telp);

	return $stmt->execute();

}

function hapus_pelanggan($conn, $id_pelanggan){

	$stmt = $conn->prepare(
		"DELETE FROM pelanggan WHERE id = ?"
	);

	$stmt->bind_param("i", $id_pelanggan);

	return $stmt->execute();
}

function ubah_pelanggan($conn ,$data){

	$nama = $data['nama'];
	$alamat = $data['alamat'];
	$email = $data['email'];
	$telp = $data['telepon'];
	$id = $data["id"];

	$stmt = $conn->prepare("UPDATE pelanggan SET nama = ?, alamat = ?, email = ?, telepon = ? WHERE id = ?");
	$stmt->bind_param("ssssi", $nama, $alamat, $email, $telp, $id);

	return $stmt->execute();
}

function tambah_pesanan($conn, $data){
    $pelanggan_id = $data['pelanggan_id'];
    $tanggal = $data['tanggal'];
    
    $buku_id = $data['buku_id'];
    $jumlah = $data['jumlah'];

    $query_buku = $conn->query("SELECT harga FROM buku WHERE id = '$buku_id'");
    $data_buku = $query_buku->fetch_assoc();
    $harga_satuan = $data_buku['harga'];

    $total_harga = $harga_satuan * $jumlah;

    $stmt1 = $conn->prepare("INSERT INTO pesanan (pelanggan_id, tangga_pesanan, total_harga) VALUES (?, ?, ?)");
    $stmt1->bind_param("isd", $pelanggan_id, $tanggal, $total_harga);
    $stmt1->execute();

    $pesanan_id = $conn->insert_id;

    $stmt2 = $conn->prepare("INSERT INTO detail_pesanan (pesanan_id, buku_id, kuantitas, harga_per_satuan) VALUES (?, ?, ?, ?)");
    $stmt2->bind_param("iiid", $pesanan_id, $buku_id, $jumlah, $harga_satuan);
	$stmt2->execute();

	$stmt_stok = $conn->prepare("UPDATE buku SET stok = stok - ? WHERE id = ?");
    $stmt_stok->bind_param("ii", $jumlah, $buku_id);
    return $stmt_stok->execute();
}

function hapus_pesanan($conn, $id_pesanan){
    
	$stmt_detail_pesanan = $conn->prepare("SELECT buku_id, kuantitas FROM detail_pesanan WHERE pesanan_id = ?");
	$stmt_detail_pesanan->bind_param("i", $id_pesanan);
	$stmt_detail_pesanan->execute();

	$result = $stmt_detail_pesanan->get_result();

	$row = $result->fetch_assoc();
	$buku_id = $row['buku_id'];
	$stok = $row['kuantitas'];

	$stmt_stok = $conn->prepare("UPDATE buku SET stok = stok + ? WHERE id = ?");
	$stmt_stok->bind_param("ii", $stok, $buku_id);
	$stmt_stok->execute();
	
	$stmt = $conn->prepare("DELETE FROM pesanan WHERE id = ?");
    $stmt->bind_param("i", $id_pesanan);
    $stmt->execute();

}

function ubah_pesanan($conn, $data){
    $pelanggan_id = $data['pelanggan_id'];
    $tanggal = $data['tanggal'];
    $id = $data['id'];

    $stmt = $conn->prepare("UPDATE pesanan SET pelanggan_id = ?, tangga_pesanan = ? WHERE id = ?");
    $stmt->bind_param("isi", $pelanggan_id, $tanggal, $id);
    return $stmt->execute();
}
 ?>
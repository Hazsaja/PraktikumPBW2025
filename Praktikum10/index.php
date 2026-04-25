<?php 

include "koneksi.php";
include "function.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    if (isset($_POST['submit'])) {
        $pilihan = $_POST['pilihan'];
        
        if ($pilihan == 'tambah') {
            if (tambah($conn, $_POST)) {
                header("Location: index.php?status=sukses_tambah");
                exit;
            } else {
                echo "<script>alert('Gagal menambah data!');</script>";
            }
        } 
        else if ($pilihan == 'ubah') {
            if (!empty($_POST['id'])) {
                if (ubah($conn, $_POST)) {
                    header("Location: index.php?status=sukses_ubah");
                    exit;
                } else {
                    echo "<script>alert('Gagal mengubah data!');</script>";
                }
            } else {
                echo "<script>alert('Pilih data dari tabel terlebih dahulu untuk diubah!');</script>";
            }
        }
    } 
    else if (isset($_POST['action']) && $_POST['action'] == 'remove') {
        if (!empty($_POST['id'])) {
            if (hapus($conn, $_POST['id'])) {
                header("Location: index.php?status=sukses_hapus");
                exit;
            } else {
                echo "<script>alert('Gagal menghapus data!');</script>";
            }
        } else {
            echo "<script>alert('Pilih data dari tabel terlebih dahulu untuk dihapus!');</script>";
        }
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
                    <th>Aksi</th> </tr>
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
                            <td>
                                <button type="button" class="enter" style="padding: 5px 10px; font-size: 12px;" 
                                onclick="pilihData(
                                    '<?php echo $row['id']; ?>', 
                                    '<?php echo addslashes($row['judul']); ?>', 
                                    '<?php echo addslashes($row['penulis']); ?>', 
                                    '<?php echo $row['tahun_terbit']; ?>', 
                                    '<?php echo $row['harga']; ?>', 
                                    '<?php echo $row['stok']; ?>'
                                )">Pilih</button>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    echo "<tr><td colspan='7' style='text-align:center;'>Tidak ada data.</td></tr>";
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
        
        <?php 
        if(isset($_GET['status'])) {
            if ($_GET['status'] == 'sukses_tambah') echo "<p style='color:green; margin:0;'>Data berhasil ditambahkan!</p>";
            else if ($_GET['status'] == 'sukses_ubah') echo "<p style='color:blue; margin:0;'>Data berhasil diubah!</p>";
            else if ($_GET['status'] == 'sukses_hapus') echo "<p style='color:red; margin:0;'>Data berhasil dihapus!</p>";
        }
        ?>

        <form action="" method="post">
            <input type="hidden" name="id" id="input_id">

            <input type="text" name="judul" id="input_judul" placeholder="Masukan Judul" required><br><br>
            <input type="text" name="penulis" id="input_penulis" placeholder="Masukan Penulis" required><br><br>
            <input type="number" name="tahun_terbit" id="input_tahun" placeholder="Masukan Tahun Terbit" required><br><br>
            <input type="number" name="harga" id="input_harga" placeholder="Masukan Harga" required><br><br>
            <input type="number" name="stok" id="input_stok" placeholder="Masukan stok" required><br><br>
            
            <div class="pilih-barang">
                <input type="radio" name="pilihan" value="tambah" id="radio_tambah" class="barang" checked onchange="kosongkanForm()"> Tambah
                <input type="radio" name="pilihan" value="ubah" id="radio_ubah" class="barang"> Ubah
            </div>
            <div class="button-style">
                <button type="submit" name="submit" class="enter">Simpan Data</button>
                <button type="submit" name="action" value="remove" class="hapus" formnovalidate onclick="return confirm('Anda ingin menghapus data ini?')">Hapus</button>
            </div>
        </form>
    </div>

    <script>
        function pilihData(id, judul, penulis, tahun, harga, stok) {
            document.getElementById('input_id').value = id;
            document.getElementById('input_judul').value = judul;
            document.getElementById('input_penulis').value = penulis;
            document.getElementById('input_tahun').value = tahun;
            document.getElementById('input_harga').value = harga;
            document.getElementById('input_stok').value = stok;

            document.getElementById('radio_ubah').checked = true;
        }

        function kosongkanForm() {
            document.getElementById('input_id').value = "";
            document.getElementById('input_judul').value = "";
            document.getElementById('input_penulis').value = "";
            document.getElementById('input_tahun').value = "";
            document.getElementById('input_harga').value = "";
            document.getElementById('input_stok').value = "";
        }
    </script>
</body>
</html>
<?php 

include "koneksi.php";
include "function.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    if (isset($_POST['submit'])) {
        $pilihan = $_POST['pilihan'];
        
        if ($pilihan == 'tambah') {
            if (tambah_pelanggan($conn, $_POST)) {
                header("Location: index.php?target=pelanggan.php&status=sukses_tambah");
                exit;
            } else {
                echo "<script>alert('Gagal menambah data!');</script>";
            }
        } 
        else if ($pilihan == 'ubah') {
            if (!empty($_POST['id'])) {
                if (ubah_pelanggan($conn, $_POST)) {
                    header("Location: index.php?target=pelanggan.php&status=sukses_ubah");
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
            if (hapus_pelanggan($conn, $_POST['id'])) {
                header("Location: index.php?target=pelanggan.php&status=sukses_hapus");
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

<body>
    <div class="left-box">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Email</th>
                    <th>Telepon</th>
                    <th>Aksi</th> </tr>
            </thead>
            <tbody>
                <?php 
                $no = 1;
                $query = "SELECT * FROM pelanggan";
                $result = $conn->query($query);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo htmlspecialchars($row['nama']); ?></td>
                            <td><?php echo htmlspecialchars($row['alamat']); ?></td>
                            <td><?php echo htmlspecialchars($row['email']); ?></td>
                            <td><?php echo htmlspecialchars($row['telepon']); ?></td>
                            <td>
                                <button type="button" class="enter" style="padding: 5px 10px; font-size: 12px;" 
                                onclick="pilihData(
                                    '<?php echo $row['id']; ?>', 
                                    '<?php echo addslashes($row['nama']); ?>', 
                                    '<?php echo addslashes($row['alamat']); ?>', 
                                    '<?php echo addslashes($row['email']); ?>', 
                                    '<?php echo addslashes($row['telepon']); ?>'
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
       <form action="index.php" method="post">
            <div class="button-style">
                <button type="submit" name="target" value="buku.php" class="ganti">Buku</button>
                <button type="submit" name="target" value="pelanggan.php" class="ganti activated">Pelanggan</button>
                <button type="submit" name="target" value="pesanan.php" class="ganti">Pesanan</button>
            </div>
       </form>
        
        <?php 
        if(isset($_GET['status'])) {
            if ($_GET['status'] == 'sukses_tambah') echo "<p style='color:green; margin:0;'>Data berhasil ditambahkan!</p>";
            else if ($_GET['status'] == 'sukses_ubah') echo "<p style='color:blue; margin:0;'>Data berhasil diubah!</p>";
            else if ($_GET['status'] == 'sukses_hapus') echo "<p style='color:red; margin:0;'>Data berhasil dihapus!</p>";
        }
        ?>

        <form action="" method="post">
            <input type="hidden" name="target" value="pelanggan.php">
            <input type="hidden" name="id" id="input_id">

            <input type="text" name="nama" id="input_nama" placeholder="Masukan Nama" required><br><br>
            <input type="text" name="alamat" id="input_alamat" placeholder="Masukan Alamat" required><br><br>
            <input type="text" name="email" id="input_email" placeholder="Masukan Email" required><br><br>
            <input type="text" name="telepon" id="input_telepon" placeholder="Masukan Telepon" required><br><br>
            
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
        function pilihData(id, nama, alamat, email, telepon) {
            document.getElementById('input_id').value = id;
            document.getElementById('input_nama').value = nama;
            document.getElementById('input_alamat').value = alamat;
            document.getElementById('input_email').value = email;
            document.getElementById('input_telepon').value = telepon;

            document.getElementById('radio_ubah').checked = true;
        }

        function kosongkanForm() {
            document.getElementById('input_id').value = "";
            document.getElementById('input_nama').value = "";
            document.getElementById('input_alamat').value = "";
            document.getElementById('input_email').value = "";
            document.getElementById('input_telepon').value = "";
        }
    </script>
</body>
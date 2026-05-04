<?php 
include "koneksi.php";
include "function.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['submit'])) {
        $pilihan = $_POST['pilihan'];
        
        if ($pilihan == 'tambah') {
            if (tambah_pesanan($conn, $_POST)) {
                header("Location: index.php?target=pesanan.php&status=sukses_tambah");
                exit;
            } else {
                echo "<script>alert('Gagal menambah data pesanan!');</script>";
            }
        } 
        else if ($pilihan == 'ubah') {
            if (!empty($_POST['id'])) {
                if (ubah_pesanan($conn, $_POST)) {
                    header("Location: index.php?target=pesanan.php&status=sukses_ubah");
                    exit;
                } else {
                    echo "<script>alert('Gagal mengubah data pesanan!');</script>";
                }
            } else {
                echo "<script>alert('Pilih pesanan dari tabel terlebih dahulu untuk diubah!');</script>";
            }
        }
    } 
    else if (isset($_POST['action']) && $_POST['action'] == 'remove') {
        if (!empty($_POST['id'])) {
            if (hapus_pesanan($conn, $_POST['id'])) {
                header("Location: index.php?target=pesanan.php&status=sukses_hapus");
                exit;
            } else {
                echo "<script>alert('Gagal menghapus pesanan!');</script>";
            }
        } else {
            echo "<script>alert('Pilih pesanan dari tabel terlebih dahulu untuk dihapus!');</script>";
        }
    }
}
?>

<div class="left-box">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Pelanggan</th>
                <th>Tanggal</th>
                <th>Total Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $no = 1;
            $query = "SELECT pesanan.*, pelanggan.nama AS nama_pelanggan 
                      FROM pesanan 
                      JOIN pelanggan ON pesanan.pelanggan_id = pelanggan.id
                      ORDER BY pesanan.id DESC";
                      
            $result = $conn->query($query);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo htmlspecialchars($row['nama_pelanggan']); ?></td>
                        <td><?php echo htmlspecialchars($row['tangga_pesanan']); ?></td>
                        <td style="font-weight: bold; color: green;">Rp <?php echo number_format($row['total_harga'], 0, ',', '.'); ?></td>
                        <td>
                            <button type="button" class="enter" style="padding: 5px 10px; font-size: 12px;" 
                            onclick="pilihData(
                                '<?php echo $row['id']; ?>', 
                                '<?php echo $row['pelanggan_id']; ?>', 
                                '<?php echo $row['tangga_pesanan']; ?>'
                            )">Pilih</button>
                        </td>
                    </tr>
                    <?php
                }
            } else {
                echo "<tr><td colspan='5' style='text-align:center;'>Tidak ada data pesanan.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<div class="right-box">
    <form action="index.php" method="post">
        <div class="button-style">
            <button type="submit" name="target" value="buku.php" class="ganti">Buku</button>
            <button type="submit" name="target" value="pelanggan.php" class="ganti">Pelanggan</button>
            <button type="submit" name="target" value="pesanan.php" class="ganti activated">Pesanan</button>
        </div>
    </form>

    <?php 
    if(isset($_GET['status'])) {
        if ($_GET['status'] == 'sukses_tambah') echo "<p style='color:green; margin:0;'>Pesanan berhasil ditambahkan!</p>";
        else if ($_GET['status'] == 'sukses_ubah') echo "<p style='color:blue; margin:0;'>Tanggal/Pelanggan pesanan berhasil diubah!</p>";
        else if ($_GET['status'] == 'sukses_hapus') echo "<p style='color:red; margin:0;'>Pesanan berhasil dihapus!</p>";
    }
    ?>

    <form action="" method="post">
        <input type="hidden" name="target" value="pesanan.php">
        <input type="hidden" name="id" id="input_id">

        <label style="font-size: 14px; color: gray;">Pilih Pelanggan:</label>
        <select name="pelanggan_id" id="input_pelanggan_id" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; margin-bottom: 15px;">
            <option value="">Pilih Pelanggan</option>
            <?php 
            $q_pelanggan = $conn->query("SELECT id, nama FROM pelanggan");
            while($p = $q_pelanggan->fetch_assoc()){
                echo "<option value='{$p['id']}'>{$p['nama']}</option>";
            }
            ?>
        </select>
        
        <label style="font-size: 14px; color: gray;">Tanggal Pesanan:</label>
        <input type="date" name="tanggal" id="input_tanggal" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; margin-bottom: 15px;">

        <div id="detail_barang_section">
            <hr style="margin-bottom: 15px; border: 0.5px solid #eee;">
            
            <label style="font-size: 14px; color: gray;">Pilih Buku (1 Jenis):</label>
            <select name="buku_id" id="input_buku_id" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; margin-bottom: 15px;">
                <option value="">Pilih Buku</option>
                <?php 
                $q_buku = $conn->query("SELECT id, judul, harga, stok FROM buku WHERE stok > 0");
                while($b = $q_buku->fetch_assoc()){
                    $harga_rp = number_format($b['harga'], 0, ',', '.');
                    echo "<option value='{$b['id']}'>{$b['judul']} - Rp {$harga_rp} (Sisa: {$b['stok']})</option>";
                }
                ?>
            </select>

            <label style="font-size: 14px; color: gray;">Jumlah Pembelian:</label>
            <input type="number" name="jumlah" id="input_jumlah" min="1" value="1" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; margin-bottom: 15px;">
        </div>
        
        <div class="pilih-barang">
            <input type="radio" name="pilihan" value="tambah" id="radio_tambah" class="barang" checked onchange="kosongkanForm()"> Tambah
            <input type="radio" name="pilihan" value="ubah" id="radio_ubah" class="barang"> Ubah
        </div>
        <div class="button-style">
            <button type="submit" name="submit" class="enter">Simpan Data</button>
            <button type="submit" name="action" value="remove" class="hapus" formnovalidate onclick="return confirm('Anda yakin ingin menghapus pesanan beserta isinya?')">Hapus</button>
        </div>
    </form>
</div>

<script>
    function pilihData(id, pelanggan_id, tanggal) {
        document.getElementById('input_id').value = id;
        document.getElementById('input_pelanggan_id').value = pelanggan_id;
        document.getElementById('input_tanggal').value = tanggal;
        document.getElementById('radio_ubah').checked = true;

        document.getElementById('detail_barang_section').style.display = 'none';
        
        document.getElementById('input_buku_id').required = false;
        document.getElementById('input_jumlah').required = false;
    }

    function kosongkanForm() {
        document.getElementById('input_id').value = "";
        document.getElementById('input_pelanggan_id').value = "";
        document.getElementById('input_tanggal').value = "";

        document.getElementById('detail_barang_section').style.display = 'block';
        
        document.getElementById('input_buku_id').required = true;
        document.getElementById('input_jumlah').required = true;
    }
</script>
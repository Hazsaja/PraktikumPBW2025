<?php
session_start();

const PAJAK = 0.15;

$katalogBarang = [
    'buku'      => 5000,
    'pensil'    => 2000,
    'pulpen'    => 2500
];

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    
    if ($_POST['action'] === 'enter') {
        $namaRaw = htmlspecialchars($_POST['nama'] ?? '');
        $barang = (isset($_POST['barang'])) ? $_POST['barang'] : array();
        $nim = $_POST['nim'];
        $email = $_POST['email'];
        $qty = intval($_POST['quantity'] ?? 0);
        $layanan = $_POST['layanan'];

        $biayaLayanan = ($layanan == "prioritas") ? 5000 : 0;

        $namabarang = [];
        $hargaSatuan = 0;

        if(!empty($barang)){
            foreach($barang as $terpilih){
                if(array_key_exists($terpilih, $katalogBarang)){
                    $namabarang[] = ucfirst($terpilih);
                    $hargaSatuan += $katalogBarang[$terpilih];
                }
            }   
            
            $stringbarang = implode(', ', $namabarang);

            $subtotalBarang = $hargaSatuan * $qty;
            $nilaiPajak = $subtotalBarang * PAJAK;
            $totalItem = $subtotalBarang + $nilaiPajak + $biayaLayanan;

            $_SESSION['cart'][] = [
                'nim'    => $nim,
                'nama'   => $namaRaw,
                'email'  => $email,
                'barang' => $stringbarang,
                'qty'    => $qty,
                'Subtotal'  => $subtotalBarang,
                'layanan'  => $biayaLayanan,
                'pajak'  => $nilaiPajak,
                'total'  => $totalItem
                ];
        }
    } elseif ($_POST['action'] === 'remove') {
        array_pop($_SESSION['cart']); 
    }

    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

$grandTotal = 0;
foreach ($_SESSION['cart'] as $item) {
    $grandTotal += $item['total'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body id="Event">
    
   <div class="header">Sistem Pendaftaran belanja Alat Tulis</div>
    
    
    <section class="under">
        <div class="under-box left">
            <table>
                <tr>
                    <th>NIM</th>
                    <th>Nama Mahasiswa</th>
                    <th>Email</th>
                    <th>Barang</th>
                    <th>Qty</th>
                    <th>subtotal</th>
                    <th>Biaya Layanan</th>
                    <th>Pajak</th>
                    <th>Total Harga</th>
                    <th>Status</th>
                </tr>
                <?php 
                $no = 1;
                foreach($_SESSION['cart'] as $item): 
                    
                ?> 
                <tr>
                    <td><?= $item['nim'] ?></td>
                    <td>
                        <?= ucfirst($item['nama']) ?>
                
                    </td>
                    <td><?= $item['email'] ?></td>
                    <td><?= $item['barang'] ?></td>
                    <td><?= $item['qty'] ?></td>
                    <td>Rp <?= number_format($item['Subtotal'], 0, ',', '.') ?></td>
                    <td>Rp <?= number_format($item['layanan'], 0, ',', '.') ?></td>
                    <td>Rp <?= number_format($item['pajak'], 0, ',', '.') ?></td>
                    <td><strong>Rp <?= number_format($item['total'], 0, ',', '.') ?></strong></td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
        
    <form method="POST" class="under-box right">
            
         <form method="POST" class="under-box right">
            
            <div class="right-nama-harga">
                <input type="text" name="nama" class="nama" placeholder="Nama Mahasiswa" required>
                <input type="number" name="nim" class="nim" placeholder="NIM" required>
                <input type="text" name="email" class="email" placeholder="E-Mail" required>
                <p>Barang Yang akan dipilih</p>
                <div class="pilih-barang">
                    <input type="checkbox" name="barang[]" value="pensil" class="barang" placeholder="Pencil"> Pencil
                    <input type="checkbox" name="barang[]" value="pulpen" class="barang" placeholder="Pulpen"> Pulpen
                    <input type="checkbox" name="barang[]" value="buku" class="barang" placeholder="Buku"> Buku

                </div>
            </div>
            
            <div class="right-quantity-button">
                <input type="number" name="quantity" class="quantity" placeholder="Quantity" required>
                <div class="button-style">
                    <button type="submit" name="action" value="remove" class="removeinput" formnovalidate>Remove</button>
                    <button type="submit" name="action" value="enter" class="enterinput">Enter</button>
                </div>
            </div>
            
            <div class="right-change">
                <select name="layanan">
                    <option value="" disabled selected>Pilih Layanan pengiriman</option>
                    <option value="regular">Regular</option>
                    <option value="prioritas">Prioritas</option>
                </select>
            </div>
            
        </form>
            
        </form>
    </section>
    <script src="script.js"></script>
    <!-- <div id="printmodel" class="model">
        <div class="model-content">
            <span class="close-btn">&times;</span>
            <div class="struk-print">
                <h2>Perhitungan Total Pembelian (Dengan Array)</h2>
                <hr>
                <?php
                // $totalSblmPajakGlobal = 0;
                // $pajakGlobal = 0;
                // $totalBayarGlobal = 0;

                // if (!empty($_SESSION['cart'])) {
                //     foreach ($_SESSION['cart'] as $item) {
                //         $subtotalItem = $item['harga'] * $item['qty'];
                //         $totalSblmPajakGlobal += $subtotalItem;
                //         $pajakGlobal += $item['pajak'];
                //         $totalBayarGlobal += $item['total'];
                        
                //         echo "<p>Nama Barang: " . ucfirst($item['nama']) . "</p>";
                //         echo "<p>Harga Satuan: Rp " . number_format($item['harga'], 0, ',', '.') . "</p>";
                //         echo "<p>Jumlah Beli: " . $item['qty'] . "</p>";
                //         echo "<br>";
                //     }
                // }
                ?>
                <p>Total Harga (Sebelum Pajak): Rp <?= number_format($totalSblmPajakGlobal, 0, ',', '.') ?></p>
                <p>Pajak (10%): Rp <?= number_format($pajakGlobal, 0, ',', '.') ?></p>
                <p><strong>Total Bayar: Rp <?= number_format($totalBayarGlobal, 0, ',', '.') ?></strong></p>
            </div>
            <button class="real-print-btn" onclick="window.print()">Cetak Struk Ini</button>
        </div>
    </div> -->
</body>
</html>
<?php
session_start();

const PAJAK = 0.10;

$katalogBarang = [
    'buku'      => 5000,
    'pensil'    => 2000,
    'penghapus' => 1500,
    'penggaris' => 3000,
    'spidol'    => 7500
];

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    
    if ($_POST['action'] === 'enter') {
        $namaRaw = htmlspecialchars($_POST['namabarang'] ?? '');
        $namaCek = strtolower(trim($namaRaw)); 
        $hargaManual = floatval($_POST['harga'] ?? 0);
        $qty = intval($_POST['quantity'] ?? 0);

        if (!empty($namaRaw) && $qty > 0) {
            $hargaSatuan = 0;
            $sumberHarga = "";

            if (array_key_exists($namaCek, $katalogBarang)) {
                $hargaSatuan = $katalogBarang[$namaCek];
                $sumberHarga = "Katalog";
            } else {
                $hargaSatuan = $hargaManual;
                $sumberHarga = "Manual";
            }

            if ($hargaSatuan > 0) {
                $subtotalBarang = $hargaSatuan * $qty;
                $nilaiPajak = $subtotalBarang * PAJAK;
                $totalSatuItem = $subtotalBarang + $nilaiPajak;

                $_SESSION['cart'][] = [
                    'nama'   => $namaRaw,
                    'harga'  => $hargaSatuan,
                    'sumber' => $sumberHarga,
                    'qty'    => $qty,
                    'pajak'  => $nilaiPajak,
                    'total'  => $totalSatuItem
                ];
            }
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
    
   <div class="header">Sistem Kasir Pintar</div>
    
    <section class="upper">
        <div class="box">
            <input type="text" class="total" value="Rp <?= number_format($grandTotal, 0, ',', '.') ?>" readonly>
            <input type="hidden" id="rawGrandTotal" value="<?= $grandTotal ?>">
        </div>
    </section>
    
    <section class="under">
        <div class="under-box left">
            <table>
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Harga</th>
                    <th>Qty</th>
                    <th>Pajak (10%)</th>
                    <th>Total Item</th>
                </tr>
                <?php 
                $no = 1;
                foreach($_SESSION['cart'] as $item): 
                    $badgeClass = ($item['sumber'] === 'Katalog') ? 'bg-katalog' : 'bg-manual';
                ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td>
                        <?= ucfirst($item['nama']) ?><br>
                        <span class="badge <?= $badgeClass ?>"><?= $item['sumber'] ?></span>
                    </td>
                    <td>Rp <?= number_format($item['harga'], 0, ',', '.') ?></td>
                    <td><?= $item['qty'] ?></td>
                    <td>Rp <?= number_format($item['pajak'], 0, ',', '.') ?></td>
                    <td><strong>Rp <?= number_format($item['total'], 0, ',', '.') ?></strong></td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
        
    <form method="POST" class="under-box right">
            
         <form method="POST" class="under-box right">
            
            <div class="right-nama-harga">
                <input type="text" name="namabarang" class="namabarang" placeholder="Nama Barang (Coba: buku / pensil)" required>
                <input type="number" name="harga" class="harga" placeholder="Harga (Kosongi jika ada di katalog)">
            </div>
            
            <div class="right-quantity-button">
                <input type="number" name="quantity" class="quantity" placeholder="Quantity" required>
                <div class="button-style">
                    <button type="submit" name="action" value="remove" class="removeinput" formnovalidate>Remove</button>
                    <button type="submit" name="action" value="enter" class="enterinput">Enter</button>
                </div>
            </div>
            
            <div class="right-change">
                <input type="number" class="change" id="uangDibayar" placeholder="Uang Dibayar (Lalu tekan Enter)">
                <input type="text" class="change" id="kembalian" placeholder="Kembalian" readonly>
            </div>
            
            <div class="button-style-print">
                <button type="button" class="printinput" id="openbtn">Print</button>
            </div>
            
        </form>
            
        </form>
    </section>
    <script src="script.js"></script>
    <div id="printmodel" class="model">
        <div class="model-content">
            <span class="close-btn">&times;</span>
            <div class="struk-print">
                <h2>Perhitungan Total Pembelian (Dengan Array)</h2>
                <hr>
                <?php
                $totalSblmPajakGlobal = 0;
                $pajakGlobal = 0;
                $totalBayarGlobal = 0;

                if (!empty($_SESSION['cart'])) {
                    foreach ($_SESSION['cart'] as $item) {
                        $subtotalItem = $item['harga'] * $item['qty'];
                        $totalSblmPajakGlobal += $subtotalItem;
                        $pajakGlobal += $item['pajak'];
                        $totalBayarGlobal += $item['total'];
                        
                        echo "<p>Nama Barang: " . ucfirst($item['nama']) . "</p>";
                        echo "<p>Harga Satuan: Rp " . number_format($item['harga'], 0, ',', '.') . "</p>";
                        echo "<p>Jumlah Beli: " . $item['qty'] . "</p>";
                        echo "<br>";
                    }
                }
                ?>
                <p>Total Harga (Sebelum Pajak): Rp <?= number_format($totalSblmPajakGlobal, 0, ',', '.') ?></p>
                <p>Pajak (10%): Rp <?= number_format($pajakGlobal, 0, ',', '.') ?></p>
                <p><strong>Total Bayar: Rp <?= number_format($totalBayarGlobal, 0, ',', '.') ?></strong></p>
            </div>
            <button class="real-print-btn" onclick="window.print()">Cetak Struk Ini</button>
        </div>
    </div>
</body>
</html>
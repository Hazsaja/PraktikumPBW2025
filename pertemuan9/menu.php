<?php 
//file menu.php

$target = "soal1.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['target'])){
        $target = $_POST['target'];
    }
}


?>


<div class="document-grid">
    <form action="" method="post">
        <div class="doc-card">
        <div class="card-header theme-gradient-full">
            <div class="header-content">
                <h2 class="card-title">Cek Jenis Kendaraan</h2>
            </div>
        </div>
        <div class="card-body">
            <p class="card-description">Intinya ini untuk cek jenis kendaraan berdasarkan roda</p>
            <button class="buat-surat-btn" name="target" value="soal1.php" type="submit">Pilih ini</button></a>
        </div>
    </div>
    <div class="doc-card">
        <div class="card-header theme-gradient-full">
            <div class="header-content">
                <h2 class="card-title">Iterasi Genap</h2>
            </div>
        </div>
        <div class="card-body">
            <p class="card-description">Intinya ini untuk Iterasi Genap</p>
            <button class="buat-surat-btn" name="target" value="soal2.php" type="submit">Masuk link</button></a>
        </div>
    </div>
    <div class="doc-card">
        <div class="card-header theme-gradient-full">
            <div class="header-content">
                <h2 class="card-title">Lihat daftar Hewan</h2>
            </div>
        </div>
        <div class="card-body">
            <p class="card-description">Intinya ini untuk melihat daftar Hewan</p>
            <button class="buat-surat-btn" name="target" value="soal3.php" type="submit">Masuk link</button></a>
        </div>
    </div>
    <div class="doc-card">
        <div class="card-header theme-gradient-full">
            <div class="header-content">
                <h2 class="card-title">Memeriksa apakah angka genap dan ganjil</h2>
            </div>
        </div>
        <div class="card-body">
            <p class="card-description">Intinya ini untuk cek angka genap atau ganjil</p>
            <button class="buat-surat-btn" name="target" value="soal4.php" type="submit">Masuk link</button>
        </div>
    </div>
    </form>
</div>    

<div class="document-grid">
    <?php include $target?>
</div>
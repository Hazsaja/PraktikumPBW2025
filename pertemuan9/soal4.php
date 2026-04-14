<?php 

//ternary Operator - Genap atau Ganjil soal4.php

$angka;
$string = "";

if ($_SERVER["REQUEST_METHOD"] == "GET") {

    $angka = $_POST['angka'];

   $hasil = ($angka % 2 == 0) ? 'Genap' : 'Ganjil';
   $string = "Angka yang dimasukan adalah " . $hasil;
}

?>

<div>
    <form action="" method="GET">
        <div>
            Masukan angka berapa saja <input type="number" name="angka"> <br>
            <button type="submit">Check</button>
        </div>
    </form>
    <p><?php echo $string ?></p>
</div>
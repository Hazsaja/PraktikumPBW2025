<?php 

//for loop - bilangan genap soal2.php

$hasil = [];
$string = "";
$iterasi = [];
$batas = [];
if ($_SERVER["REQUEST_METHOD"] == "GET"){
    $iterasi = $_POST['awal'];
    $batas = $_POST['akhir'];


    for($iterasi; $iterasi <= $batas; $iterasi++){
        $hasil[] = ($iterasi % 2 == 0) ? $iterasi : NULL;
    }
    
    $filter = array_filter($hasil);
    $string = implode(", ", $filter);
}


?>

<div>
    <form action="" method="GET">
        Masukan angka awal<input type="number" name="awal">
        <br>
        <br>
        Masukan angka akhir<input type="number" name="akhir">
        <button type="submit">Check</button>
    </form>
    <p><?php echo $string ?></p>
</div>
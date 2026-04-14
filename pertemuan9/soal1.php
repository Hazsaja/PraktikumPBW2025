<?php 


//switch case - Jenis Kendaraan soal1.php
$hasil = "";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $roda = $_POST['roda'];

    $string = "Kendaraan roda " . $roda;
    switch ($roda) {
        case 2:
            $hasil = $string . " diantarannya Sepeda Motor, Sepeda, Sepeda Listrik, dan Skuter";
            break;
        case 3:
            $hasil = $string . " diantarannya Bajaj, Bemo, dan Trike";
            break;
        case 4:
            $hasil = $string . " diantarannya Mobil sedan, Truk Engkel, Mobil Van, dan Mobil Jeep";
            break;
        case 6:
            $hasil = $string . " diantarannya truk Tronton dan Kendaraan Militer 6x6";
            break;
        case 8:
            $hasil = $string . " diantarannya Kendaraan Amfibi 8x8, Truk Militer, dan Truk Heavy Duty";
            break;
        default:
            
            $hasil = $string . "lebih dari 8 diantarannya Truk kontainer, Chakka, Limusin Custom, dan mobil kustom";
            break;
    }

}


?>


<div class="doc-card">
    <form action="" method="get">
        Masukan banyak roda kendaraan
        <input type="number" name='roda'>
        <button type="submit">check</button>
    </form>

    <output><?php echo  $hasil?></output>
</div>
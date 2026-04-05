<?php 
    $nama = $nilai = $predikat = $status = "";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $nama = $_POST["nim_input"];
        $nilai = $_POST["nilai_input"]; 

        if ($nilai <= 49) {
        $predikat = "E";
        $status = "Tidak Lulus";
        } else if($nilai <= 59){
            $predikat = "D";
            $status = "Tidak Lulus";
        } else if($nilai <= 69){
            $predikat = "C";
            $status = "Tidak Lulus";
        } else if($nilai <= 79){
            $predikat = "B";
            $status = "Lulus";
        } else if($nilai <= 100){
            $predikat = "A";
            $status = "Lulus";
        } else{
            $predikat = "Nilai tidak valid!";
            $status = "Tidak Lulus";
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalkulator sederhana</title>
    <link rel="stylesheet" href="style.css">
</head>
<body id="Event">
    
    <div class="header"> Ꮯhꫀᥴk Ɲเᥣᥲเ ℳᥙtᥙ</div>
    <section>
        <div class="box">
            <form action="" method="post">
                <p>Masukan Nama</p>
                <input type="texs" name="nim_input" id="nim" value="<?php echo $nama; ?>">

                <p>Masukan Nilai</p>
                <input type="text" name="nilai_input" id="nilai" value="<?php echo $nilai; ?>">

                <button id="check" type="submit">Periksa</button>
                <button id="Reset" type="reset">Reset</button>
            </form>            
        </div>
        <div class="box right">
            <p>Nama</p>
            <output class="outbox" id="outnim"><?php echo $nama; ?></output>
            <p>Nilai</p>
            <output class="outbox" id="outnilai"><?php echo $nilai; ?></output>
            <p>Predikat</p>
            <output class="outbox" id="outnilai"><?php echo $predikat; ?></output>
            <p>Status</p>
            <output class="outbox" id="outnilai"><?php echo $status; ?></output>
        </div>
    </section>

    <script src="script.js">
    </script>
</body>
</html>
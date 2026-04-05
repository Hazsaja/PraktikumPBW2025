<?php 
    $nama = $npm = $semester = $ukt = $prodi = $diskon = $bayar = "";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $nama = $_POST["nama_input"];
        $npm = $_POST["npm_input"]; 
        $semester = (int)$_POST["semester_input"];
        $ukt = (int)$_POST["ukt_input"];
        $prodi = $_POST["prodi_input"];


        if($ukt >= 5000000 && $semester > 8){
            $diskon = "10%";
            $potongan = $ukt * 0.15;
            $bayar = $ukt - $potongan;
        } elseif($ukt >= 5000000){
            $diskon = "15%";
            $potongan = $ukt * 0.1;
            $bayar = $ukt - $potongan;
        } else{
            $diskon = "0";
            $bayar = $ukt;
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
    
    <div class="header">Kalkᥙlator UKT</div>
    <section>
        <div class="box">
            <form action="" method="post">
                <p>Masukan NPM</p>
                <input type="texs" name="npm_input" id="nim" value="<?php echo $npm; ?>">

                <p>Masukan Nama</p>
                <input type="text" name="nama_input" id="nilai" value="<?php echo $nama; ?>">

                <p>Masukan Prodi</p>
                <input type="text" name="prodi_input" id="nilai" value="<?php echo $prodi; ?>">

                <p>Masukan Semester</p>
                <input type="text" name="semester_input" id="nilai" value="<?php echo $semester; ?>">

                <p>Masukan biaya UKT dalam Rupiah</p>
                <input type="text" name="ukt_input" id="nilai" value="<?php echo ($ukt != "") ? "Rp. ".number_format($ukt, 0, ',', '.'): "";?>">

                <button id="check" type="submit">Periksa</button>
                <button id="Reset" type="reset">Reset</button>
            </form>            
        </div>
        <div class="box right">
            <p>NPM</p>
            <output class="outbox" id="outnim"><?php echo $npm; ?></output>
            <p>Nama</p>
            <output class="outbox" id="outnilai"><?php echo $nama; ?></output>
            <p>Prodi</p>
            <output class="outbox" id="outnilai"><?php echo $prodi; ?></output>
            <p>Semester</p>
            <output class="outbox" id="outnilai"><?php echo $semester; ?></output>
            <p>Biaya UKT</p>
            <output class="outbox" id="outnilai">
                <?php echo ($ukt != "") ? "Rp. ".number_format($ukt, 0, ',', '.'): "";?>
            </output>
            <p>Diskon</p>
            <output class="outbox" id="outnilai">
                <?php echo $diskon; ?>
            </output>
            <p>Yang harus dibayar</p>
            <output class="outbox" id="outnilai">
                <?php echo ($bayar != "") ? "Rp. ".number_format($bayar, 0, ',', '.'): ""; ?>
            </output>
        </div>
    </section>

    <script src="script.js">
    </script>
</body>
</html>
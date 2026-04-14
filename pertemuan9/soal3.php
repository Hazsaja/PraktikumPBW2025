<?php 

//foreach - daftar  soal3.php

$hewan = [];

if($_SERVER["REQUEST_METHOD"] == "GET"){


    $hewan = [
        $_POST['hewan1'],
        $_POST['hewan2'],
        $_POST['hewan3'],
        $_POST['hewan4'],
        $_POST['hewan5']
    ];

}

?>


<div>
    <form action="" method="get">
        hewan 1<input type="text" name="hewan1"> <br>
        hewan 2<input type="text" name="hewan2"><br>
        hewan 3<input type="text" name="hewan3"><br>
        hewan 4<input type="text" name="hewan4"><br>
        hewan 5<input type="text" name="hewan5"><br>
        <br>
        <button type="submit"> Check </button>
    </form>
    
    <?php foreach($hewan as $value): 
        if(!($value == $hewan[array_key_last($hewan)])):
            echo $value.", ";
        else:
            echo $value;
        endif;
    endforeach;?>

</div>
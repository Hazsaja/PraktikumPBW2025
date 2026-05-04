<?php 

$target = "buku.php";

if (isset($_POST['target'])) {
    $target = $_POST['target'];
} elseif (isset($_GET['target'])){
    $target = $_GET['target'];
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Buku</title>
</head>
    <?php include $target ?>
</html>
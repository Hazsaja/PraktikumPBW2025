<?php 

$conn = new mysqli(
	'localhost',
	'root',
	'',
	'praktikum11'
);

if ($conn -> connect_error) {
	die("Gagal: ".$conn -> connect_error);
}

?>

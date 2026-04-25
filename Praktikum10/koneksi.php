<?php 

$conn = new mysqli(
	'localhost',
	'root',
	'',
	'pemrograman_web_contoh'
);

if ($conn -> connect_error) {
	die("Gagal: ".$conn -> connect_error);
}

 ?>
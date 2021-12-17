<?php
$kullanici_ismi="root";
$sifre="";
$host="localhost:3308";
$veritabani="ekitap";

try {
	$baglanti = new PDO("mysql:host=$host;dbname=$veritabani", $kullanici_ismi, $sifre)";
}
catch(PDOException $e) {
	echo $e->getMessage();
}
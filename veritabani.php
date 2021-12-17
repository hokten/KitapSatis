<?php
$kullanici_ismi="root";
$sifre="";
$host="localhost:3308";
$veritabani="ekitap";

try {
	$baglanti = new PDO("mysql:host=$host;dbname=$veritabani", $kullanici_ismi, $sifre);
	$baglanti->exec("SET NAMES 'utf8'; SET CHARSET 'utf8'");
	$baglanti->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}
catch(PDOException $e) {
	echo $e->getMessage();
}
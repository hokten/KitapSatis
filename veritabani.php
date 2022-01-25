<?php
$kullanici_ismi="root";
$sifre="";
$host="localhost:3308";
$veritabani="ekitap";

try {
	$baglanti = new ???("mysql:host=$host;dbname=$veritabani", $kullanici_ismi, $sifre);
	$baglanti->exec("SET NAMES 'utf8'; SET CHARSET 'utf8'");
	$baglanti->setAttribute(???::ATTR_ERRMODE, ???::ERRMODE_EXCEPTION);

}
catch(???Exception $e) {
	echo $e->getMessage();
}

<?php
include "veritabani.php";
?>
<html>
    <head>
        <title>Kitap Silme</title>
    </head>
    <body>
        <?php
        $sql="DELETE FROM `kitaplar` WHERE `id`=:id";
        $sorgu = $baglanti->prepare($sql);
        $sorgu->bindParam(':id', $_GET["id"], PDO::PARAM_INT);
        if($sorgu->execute()) {
            echo "Başarı ile silindi";
        }
        else {
            echo "Hata var";
        }
        ?>
    </body>
</html>
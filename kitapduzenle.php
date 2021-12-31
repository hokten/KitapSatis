<?php
include "veritabani.php";
?>
<html>
    <head>
        <title>Kitap Düzenle</title>
    </head>
    <?php
    if(empty($_POST)):
        $sql = "SELECT * FROM `kitaplar` WHERE `id` = :id";
        $sorgu = $baglanti->prepare($sql);
        $sorgu->bindParam(':id', $_GET["id"], PDO::PARAM_INT);
        $sorgu->execute();
        $kayit = $sorgu->fetch();
    ?>
    <form action="kitapduzenle.php" method="post">
        Kitap Adı : <input type="text" name="kadi" value="<?= $kayit["kitapadi"] ?>" /><br />
        Yazarı  : <input type="text" name="yzr" value="<?= $kayit["yazar"] ?>"/><br />

        Fiyatı : <input type="text" name="fiy" value="<?= $kayit["fiyat"] ?>" /><br />
        ISBN : <input type="text" name="isbn" value="<?= $kayit["isbn"] ?>" /><br />
        <input type="hidden" name="id" value="<?= $kayit["id"] ?>" /><br />
        <input type="submit" value="DÜZENLE" />
    </form>
    <?php
    else:
        $sql = "UPDATE `kitaplar` SET 
        `kitapadi` = :ka, 
        `yazar` = :yz, 
        `fiyat` = :fy,
        `isbn` = :isbn 
         WHERE `id` = :id";
         $sorgu = $baglanti->prepare($sql);
         $sorgu->bindParam(':id', $_POST["id"], PDO::PARAM_STR);
         $sorgu->bindParam(':isbn', $_POST["isbn"], PDO::PARAM_STR);
         $sorgu->bindParam(':yz', $_POST["yzr"], PDO::PARAM_STR);
         $sorgu->bindParam(':kt', $_POST["ktg"], PDO::PARAM_STR);
         $sorgu->bindParam(':fy', $_POST["fiy"], PDO::PARAM_INT);       
        if($sorgu->execute()) {
            echo "Kayıt Düzenlendi. <a href='kitaplistele.php'>Listelemeye geri dön</a>";
        }
        else {
            echo "Hata var.";
        }
    endif
    ?>
</html>
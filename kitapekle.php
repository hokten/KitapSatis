<?php
include "veritabani.php";
?>
<html>
    <head>
        <title>Kitap Ekleme</title>
    </head>
    <?php
    if(empty($_POST)):
    ?>
    <form action="kitapekle.php" method="post">
        Kitap Adı : <input type="text" name="kadi" /><br />
        Yazarı  : <input type="text" name="yzr" /><br />
        Kategorisi : <input type="text" name="ktg" /><br />
        Fiyatı : <input type="text" name="fiy" /><br />
        ISBN : <input type="text" name="isbn" /><br />
        <input type="submit" value="EKLE" />
    </form>
    <?php
    else:
        $sql="INSERT INTO `kitaplar` (`isbn`, `kitapadi`, `yazar`, `kategori`, `fiyat`) VALUES(:isbn, :kadi, :yzr, :ktg, :fiy)";
        $sorgu = $baglanti->prepare($sql);
        $sorgu->bindParam(':isbn', $_POST["isbn"], PDO::PARAM_STR);
        $sorgu->bindParam(':kadi', $_POST["kadi"], PDO::PARAM_STR);
        $sorgu->bindParam(':yzr', $_POST["yzr"], PDO::PARAM_STR);
        $sorgu->bindParam(':ktg', $_POST["ktg"], PDO::PARAM_STR);
        $sorgu->bindParam(':fiy', $_POST["fiy"], PDO::PARAM_INT);
        var_dump($sorgu->execute());
    endif
    ?>
</html>
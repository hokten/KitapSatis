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
        Yazarı : 
        <select name="yzr">
            <?php
            $sql = "SELECT * FROM yazarlar";
            $sorgu = $baglanti->query($sql);
            while($satir = $sorgu->fetch()) {
                $id = $satir["yazar_id"];
                $adsoyad = $satir[ "yazar_ad_soyad"];
                // <option value='1'>Orhan PAMUK</option>
                echo "<option value='$id'>$adsoyad</option>";
            }
            ?>
        </select>
        <br />
        Kategorisi : <br />
        <?php
            $sql = "SELECT * FROM kategoriler";
            $sorgu = $baglanti->query($sql);
            while($satir = $sorgu->fetch()) {
                $id = $satir["kategori_id"];
                $ad = $satir[ "kategori_adi"];
                // <option value='1'>Orhan PAMUK</option>
                echo "<label><input type='checkbox' name='kategori[]' value='$id'/>$ad</label><br/>";
            }
            ?>
        <br />
        Fiyatı : <input type="text" name="fiy" /><br />
        ISBN : <input type="text" name="isbn" /><br />
        <input type="submit" value="EKLE" />
    </form>
    <?php
    else:
        $sql="INSERT INTO `kitaplar` (`isbn`, `kitapadi`, `yazar`, `fiyat`)
         VALUES(:isbn, :kadi, :yzr, :fiy)";
        $sorgu = $baglanti->prepare($sql);
        $sorgu->bindParam(':isbn', $_POST["isbn"], PDO::PARAM_STR);
        $sorgu->bindParam(':kadi', $_POST["kadi"], PDO::PARAM_STR);
        $sorgu->bindParam(':yzr', $_POST["yzr"], PDO::PARAM_INT);
        $sorgu->bindParam(':fiy', $_POST["fiy"], PDO::PARAM_INT);
        $sorgu->execute();
        $en_son_kitap_id = $baglanti->lastInsertId();


        foreach($_POST["kategori"] as $katid) {
            $sql="INSERT INTO `kitap_kategori` (`kitap_id`, `kategori_id`)
         VALUES(:kitid, :katid)";
        $sorgu = $baglanti->prepare($sql);
        $sorgu->bindParam(':kitid', $en_son_kitap_id, PDO::PARAM_INT);
        $sorgu->bindParam(':katid', $katid, PDO::PARAM_INT);
        $sorgu->execute();      
        }



    endif
    ?>
</html>
<?php
include "veritabani.php";
?>
<html>
    <head>
        <title>Kitap Düzenle</title>
        <link rel="stylesheet" type="text/css" href="css/amsify.suggestags.css">

        <script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
  <script type="text/javascript" src="js/jquery.amsify.suggestags.js"></script>
    </head>
    <body>

    


    <?php
    if(empty($_POST)):
        $sql = "SELECT * FROM `kitaplar` WHERE `id` = :id";
        $sorgu = $baglanti->prepare($sql);
        $sorgu->bindParam(':id', $_GET["id"], PDO::PARAM_INT);
        $sorgu->execute();
        $kayit = $sorgu->fetch();
    ?>
    <form action="kitapduzenle.php" method="post">
    <div class="form-group">
			<input type="text" class="form-control" name="color" value=""/>
		</div>

        Kitap Adı : <input type="text" name="kadi" value="<?= $kayit["kitapadi"] ?>" /><br />
        Yazarı  : <input type="text" name="yzr" value="<?= $kayit["yazar"] ?>"/><br />
        Kategori :<br />
        <?php
        $sql = "SELECT * FROM kitap_kategori WHERE  `kitap_id` = :id ";
        $sorgu = $baglanti->prepare($sql);
        $sorgu->bindParam(':id', $_GET["id"], PDO::PARAM_INT);
        $sorgu->execute();
        $kitap_kategoriler = $sorgu->fetchAll();
        $kategoriler=[];
        foreach($kitap_kategoriler as $sat) {
            $kategoriler[]=$sat["kategori_id"];
        }


        $sql = "SELECT * FROM kategoriler";
            $sorgu = $baglanti->query($sql);
            while($satir = $sorgu->fetch()) {
                $id = $satir["kategori_id"];
                $ad = $satir["kategori_adi"];
                $tiklimi="";
                if (in_array($id, $kategoriler)) {
                    $tiklimi="checked";
                }
                echo "<label><input type='checkbox' name='kategori[]' value='$id' $tiklimi/>$ad</label><br/>";
            }
        ?>
        Fiyatı : <input type="text" name="fiy" value="<?= $kayit["fiyat"] ?>" /><br />
        ISBN : <input type="text" name="isbn" value="<?= $kayit["isbn"] ?>" /><br />
        <input type="hidden" name="id" value="<?= $kayit["id"] ?>" /><br />
        <input type="submit" value="DÜZENLE" />
    </form>
    <?php
    else:
        var_dump($_POST);
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
         $sorgu->bindParam(':fy', $_POST["fiy"], PDO::PARAM_INT);       
        if($sorgu->execute()) {
            echo "Kayıt Düzenlendi. <a href='kitaplistele.php'>Listelemeye geri dön</a>";
        }
        else {
            echo "Hata var.";
        }
    endif
    ?>
               <script type="text/javascript">

$('input[name="color"]').amsifySuggestags({
    type : 'amsify',
    suggestions: [
    {'tag': 'Roman', 'value': 1},
    {'tag': 'Hikaye', 'value': 2},
    {'tag': 'Tarih', 'value': 3},
  ]
});

</script>
    </body>
</html>
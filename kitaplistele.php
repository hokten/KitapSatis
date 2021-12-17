<?php
include "veritabani.php";
?>
<html>
    <head>
        <title>Kitap Listele</title>
    </head>
    <body>
        <table border="1">
            <tr>
                <th>Kitap Adı</th>
                <th>Yazar</th>
                <th>Kategori</th>
                <th>Fiyat</th>
                <th>ISBN</th>
                <th>Olaylar</th>
            </tr>
            <?php
            $sql = "SELECT * FROM kitaplar";
            $sorgu = $baglanti->query($sql);
            while($satir = $sorgu->fetch()) {
                echo "<tr>";
                echo "<td>{$satir['kitapadi']}</td>";
                echo "<td>{$satir['yazar']}</td>";
                echo "<td>{$satir['kategori']}</td>";
                echo "<td>{$satir['fiyat']}</td>";
                echo "<td>{$satir['isbn']}</td>";
                echo "<td>";
                echo "<a href='kitapsil.php?id={$satir['id']}'>SİL</a>";
                echo "|";
                echo "<a href='kitapduzenle.php?id={$satir['id']}'>DÜZENLE</a>";
                echo "</td>";
                echo "</tr>";
            }
            ?>
            </table>
    </body>
</html>
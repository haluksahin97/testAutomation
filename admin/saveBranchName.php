<?php
    include_once("../sabitler/standardsAdmin.php");

    $sinif = htmlentities($_GET["sinif"], ENT_QUOTES, "UTF-8");

    $subeadi= htmlentities($_POST["subeadi"], ENT_QUOTES, "UTF-8");

    $sql="insert into subeadi (adi, sinif) values ('$subeadi', '$sinif')";
    mysqli_query(baglanti(),$sql) or die ("Kayıt ekleme sorgusunda hata oluştu");
    header("Location:yeniogrenci.php?sinif=$sinif");
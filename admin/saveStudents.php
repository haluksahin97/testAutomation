<?php

    include_once("../sabitler/standardsAdmin.php");

    function multiexplode ($delimiters,$string) {

        $ready = str_replace($delimiters, $delimiters[0], $string);
        $launch = explode($delimiters[0], $ready);
        return  $launch;
    }
    $url = $_SERVER['HTTP_REFERER'];
    $url = multiexplode(array("?","=","&&"),$url);    
    
    $adi= htmlentities($_POST["adi"], ENT_QUOTES, "UTF-8");
    $soyadi= htmlentities($_POST["soyadi"], ENT_QUOTES, "UTF-8");
    $ogrencino= htmlentities($_POST["ogrencino"], ENT_QUOTES, "UTF-8");
    $sinif= $url[2];
    $subeadi= htmlentities($_GET["subeadi"], ENT_QUOTES, "UTF-8");



    $sql="insert into ogrenciler (adi, soyadi, ogrencino, sinif, subeadi) values ('$adi', '$soyadi', '$ogrencino', '$sinif', '$subeadi')";
    mysqli_query(baglanti(),$sql) or die ("Kayıt ekleme sorgusunda hata oluştu");


    header("Location:yeniogrenci.php?sinif=$sinif&&subeadi=$subeadi");

    
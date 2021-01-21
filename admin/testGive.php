<?php

    include_once("../sabitler/standardsAdmin.php");

    $sinif= htmlentities($_POST["sinif"], ENT_QUOTES, "UTF-8");
    $sube= htmlentities($_POST["sube"], ENT_QUOTES, "UTF-8");
    $test= htmlentities($_POST["test"], ENT_QUOTES, "UTF-8");



    $sql="insert into testver (sinif, sube, test) values ('$sinif', '$sube', '$test')";
    mysqli_query(baglanti(),$sql) or die ("Kayıt ekleme sorgusunda hata oluştu");
    header("Location:testata.php");

    
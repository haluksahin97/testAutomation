<?php
    include_once("../sabitler/standardsAdmin.php");

    $sinif = $_GET['sinif'];

    $testadi= htmlentities($_POST["testadi"], ENT_QUOTES, "UTF-8");
    $sure= htmlentities($_POST["sure"], ENT_QUOTES, "UTF-8");

    $sql="insert into testadi (adi, sinif, sure) values ('$testadi', '$sinif', '$sure')";
    mysqli_query(baglanti(),$sql) or die ("Kayıt ekleme sorgusunda hata oluştu");
    header("Location:yenisoru.php?sinif=$sinif");
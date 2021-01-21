<?php
    include_once("../sabitler/standardsAdmin.php");

    $sinif = $_GET['sinif'];

    $testadi= htmlentities($_POST["testadi"], ENT_QUOTES, "UTF-8");

    $sql="insert into testadi (adi) values ('$testadi')";
    mysqli_query(baglanti(),$sql) or die ("Kayıt ekleme sorgusunda hata oluştu");
    header("Location:yenisoru.php?sinif=$sinif");
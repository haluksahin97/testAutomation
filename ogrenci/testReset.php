<?php 
    include_once("../sabitler/standardsStudents.php");

    $testAd = htmlentities($_GET['test'], ENT_QUOTES, "UTF-8");
    $testAdQuery = $_GET['test'];

    mysqli_query(baglanti(),"delete from soncevaplar where ogrencino='$ogrenciNo' and testadi='$testAd'");

    header("Location:test.php?test=$testAdQuery");
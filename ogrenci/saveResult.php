<?php
    include_once("../sabitler/standardsStudents.php");

    $testAd = htmlentities($_GET['test'], ENT_QUOTES, "UTF-8");
    $testAdQuery = $_GET['test'];
    $sure = "00:00:00";
    if(!empty($_GET['sure']))
        $sure = "00:" . htmlentities($_GET['sure'], ENT_QUOTES, "UTF-8");
    $firstResult = "";
    if(!empty($_GET['result']))
        $Result = htmlentities($_GET['result'], ENT_QUOTES, "UTF-8");

    $sayac = 0;

    $sql = mysqli_query(baglanti(),"Select giris from ilksonuclar where testadi='$testAd' and ogrencino='$ogrenciNo'");

    $row = mysqli_fetch_array($sql);
    
    $ilkSonucKontrol = $row['giris'];
    
    if ($ilkSonucKontrol == 1 || $Result === "first") {
        $hangiCevap = "ilkcevaplar";
        $hangiSonuc = "ilksonuclar";
    }
    else {
        $hangiCevap = "soncevaplar";
        $hangiSonuc = "sonsonuclar";
    }

    $sql = mysqli_query(baglanti(), "Select cevap,soru,secenekler,id,resim from sorular where sinif='$ogrenciSinif' and testadi='$testAd'");

    $dogruSayisi = 0;
    $yanlisSayisi = 0;
    $bosSayisi = 0;

    while($row = mysqli_fetch_array($sql)) {
        $sayac++;
        $cevap = $row['cevap'];
        $secenek = $row['secenekler'];
        $soru = $row['soru'];
        $resim = $row['resim'];
        $soruid = $row['id'];
        $ogrenciCevap = "";
        $cevapDurum = false;
        
        $sql1 = mysqli_query(baglanti(), "Select cevap from $hangiCevap where ogrencino='$ogrenciNo' and soruid='$soruid'");

        while($row1 = mysqli_fetch_array($sql1)) {
            $cevapDurum = true;
            $ogrenciCevap = $row1['cevap'];
        }
        if($cevap == $ogrenciCevap && $cevapDurum) {
            $dogruSayisi++;
        }
        else if(!$cevapDurum) {
            $bosSayisi++;
        }
        else {
            $yanlisSayisi++;
        }
    }
    $netSayisi = $dogruSayisi - ($yanlisSayisi/4);
    
    $sql = mysqli_query(baglanti(),"Select * from $hangiSonuc where ogrencino='$ogrenciNo' and testadi='$testAd'");

    $row = mysqli_fetch_array($sql);

    $sonucKontrol = $row['ogrencino'];

    if (empty($sonucKontrol)) {
        $sql="insert into $hangiSonuc (ogrencino, testadi, dogrusayisi, yanlissayisi, bossayisi, netsayisi, sure) values ('$ogrenciNo', '$testAd', '$dogruSayisi', '$yanlisSayisi', '$bosSayisi', '$netSayisi', '$sure')";
    }
    else {
        $sql="Update $hangiSonuc Set dogrusayisi='$dogruSayisi', yanlissayisi='$yanlisSayisi', bossayisi='$bosSayisi', netsayisi='$netSayisi', sure='$sure' Where ogrencino='$ogrenciNo' and testadi='$testAd'";
    }
    mysqli_query(baglanti(),$sql);

    header("location:testsonuc.php?test=$testAdQuery");

<?php
include_once("../sabitler/standardsStudents.php");
// get the q parameter from URL
$question = htmlentities($_REQUEST["question"], ENT_QUOTES, "UTF-8");
$testName = htmlentities($_REQUEST["testName"], ENT_QUOTES, "UTF-8");
$questionId = htmlentities($_REQUEST["questionId"], ENT_QUOTES, "UTF-8");
$option = htmlentities($_REQUEST["option"], ENT_QUOTES, "UTF-8");
$optionNo = htmlentities($_REQUEST["optionNo"], ENT_QUOTES, "UTF-8") - 1;


$sql = mysqli_query(baglanti(),"Select giris from ilksonuclar where testadi='$testName' and ogrencino='$ogrenciNo'");

$row = mysqli_fetch_array($sql);

$ilkSonucKontrol = $row['giris'];

if ($ilkSonucKontrol == 1) {
    $sql = mysqli_query(baglanti(),"Select ogrencino from ilkcevaplar where soruid='$questionId' and ogrencino='$ogrenciNo'");

    $row = mysqli_fetch_array($sql);

    if(empty($row['ogrencino'])) {
        $sql="insert into ilkcevaplar (ogrencino, soruid, soru, cevapno, cevap ) values ('$ogrenciNo', '$questionId', '$question', '$optionNo', '$option')"; 
    }
    else {
        $sql="Update ilkcevaplar Set cevapNo='$optionNo', cevap='$option' Where soruid='$questionId' and ogrenciNo='$ogrenciNo' ";
    }
 
}
else {
    $sql = mysqli_query(baglanti(),"Select ogrencino from soncevaplar where soruid='$questionId'");
            
    $row = mysqli_fetch_array($sql);
    
    $cevapKontrol = $row['ogrencino'];
    
    if (!empty($cevapKontrol)) {
        $sql="Update soncevaplar Set cevapNo='$optionNo', cevap='$option' Where soruid='$questionId' and ogrencino='$ogrenciNo' ";
    }
    else {
        $sql="insert into soncevaplar (ogrencino, testadi, soruid, soru, cevapno, cevap ) values ('$ogrenciNo', '$testName', '$questionId', '$question', '$optionNo', '$option')";
    }
}
mysqli_query(baglanti(), $sql);
?>
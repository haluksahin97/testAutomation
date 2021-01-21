
<?php

include_once("../sabitler/standardsAdmin.php");

$subeId = $_GET['id'];
$sinif = $_GET['sinif'];

$url = $_SERVER['HTTP_REFERER'];
$url  =  explode('?', $url);

if($url[0] == "http://127.0.0.1/fatihozcan/admin/yeniogrenci.php"){
// if($url[0] == "https://www.haluksahn.com/fatihozcan/admin/yeniogrenci.php"){

$sql = mysqli_query(baglanti(),"Select * from subeadi where id='$subeId'");
$row = mysqli_fetch_array($sql);

$subeAdi = $row['adi'];
    
mysqli_query(baglanti(),"delete from subeadi where id='$subeId'");


$sqlUpdate="Update ogrenciler Set subeadi='YOK' Where subeadi='$subeAdi'";
mysqli_query(baglanti(), $sqlUpdate);
}
header("location:yeniogrenci.php?sinif=$sinif");
?>

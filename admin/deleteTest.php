
<?php

    include_once("../sabitler/standardsAdmin.php");

$testId = $_GET['id'];
$sinif = $_GET['sinif'];

$url = $_SERVER['HTTP_REFERER'];
$url  =  explode('?', $url);
echo $url[0];

// if($url[0] == "http://127.0.0.1/fatihozcan/admin/yenisoru.php"){
if($url[0] == "https://www.haluksahn.com/fatihozcan/admin/yenisoru.php"){

    $sql = mysqli_query(baglanti(),"Select * from testadi where id='$testId'");
    $row = mysqli_fetch_array($sql);

    $testAdi = $row['adi'];
        
    mysqli_query(baglanti(),"delete from testadi where id='$testId'");


    $sqlUpdate="Update sorular Set testadi='YOK' Where testadi='$testAdi'";
    mysqli_query(baglanti(), $sqlUpdate);
}
header("location:yenisoru.php?sinif=$sinif");
?>
  
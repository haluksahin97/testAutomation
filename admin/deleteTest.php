
<?php

    include_once("../sabitler/standardsAdmin.php");

$testId = htmlentities($_GET["id"], ENT_QUOTES, "UTF-8");
$sinif = htmlentities($_GET["sinif"], ENT_QUOTES, "UTF-8");

$url = $_SERVER['HTTP_REFERER'];
$url  =  explode('?', $url);
echo $url[0];

if($url[0] == "http://127.0.0.1/fatihozcan/admin/index.php"){
// if($url[0] == "https://www.haluksahn.com/fatihozcan/admin/index.php"){

    $sql = mysqli_query(baglanti(),"Select * from testadi where id='$testId'");
    $row = mysqli_fetch_array($sql);

    $testAdi = $row['adi'];
        
    mysqli_query(baglanti(),"delete from testadi where id='$testId'");


    $sqlUpdate="Update sorular Set testadi='YOK' Where testadi='$testAdi'";
    mysqli_query(baglanti(), $sqlUpdate);
}
header("location:index.php?sinif=$sinif");
?>
  
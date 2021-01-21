
<?php
    include_once("../sabitler/standardsAdmin.php");

$sinif = $_GET['sinif'];
$subeadi = $_GET['subeadi'];

$url = $_SERVER['HTTP_REFERER'];
$url  =  explode('?', $url);

if($url[0] == "http://127.0.0.1/fatihozcan/admin/ogrenciler.php"){
// if($url[0] == "https://www.haluksahn.com/fatihozcan/admin/ogrenciler.php"){
    $id=$_GET["id"];
    mysqli_query(baglanti(),"delete from ogrenciler where id='$id'");

}
header("location:ogrenciler.php?sinif=$sinif&&subeadi=$subeadi");
?>
  
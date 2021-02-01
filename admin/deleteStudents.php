
<?php
    include_once("../sabitler/standardsAdmin.php");

$sinif = htmlentities($_GET["sinif"], ENT_QUOTES, "UTF-8");
$subeadi = htmlentities($_GET["subeadi"], ENT_QUOTES, "UTF-8");
$subeadiQuery = $_GET["subeadi"];

$url = $_SERVER['HTTP_REFERER'];
$url  =  explode('?', $url);

if($url[0] == "http://127.0.0.1/fatihozcan/admin/ogrenciler.php"){
// if($url[0] == "https://www.haluksahn.com/fatihozcan/admin/ogrenciler.php"){
    $id = htmlentities($_GET["id"], ENT_QUOTES, "UTF-8");
    mysqli_query(baglanti(),"delete from ogrenciler where id='$id'");

}
header("location:ogrenciler.php?sinif=$sinif&&subeadi=$subeadiQuery");
?>
  
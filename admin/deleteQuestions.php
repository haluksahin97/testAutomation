
<?php
    include_once("../sabitler/standardsAdmin.php");

$sinif = $_GET['sinif'];
$testadi = $_GET['testadi'];

$url = $_SERVER['HTTP_REFERER'];
$url  =  explode('?', $url);
echo $url[0];

// if($url[0] == "http://127.0.0.1/fatihozcan/admin/sorular.php"){
if($url[0] == "https://www.haluksahn.com/fatihozcan/admin/sorular.php"){
    $id=$_GET["id"];
        
    mysqli_query(baglanti(),"delete from sorular where id='$id'");

}
header("location:sorular.php?sinif=$sinif&&testadi=$testadi");
?>
  
<?php
include_once("../sabitler/standardsStudents.php");
// get the q parameter from URL
$question = $_REQUEST["question"];
$option = $_REQUEST["option"];
$testadi = $_REQUEST["test"];

$hint = "";


$sql = mysqli_query(baglanti(),"Select * from cevaplar where soru='$question' and testadi='$testadi' and ogrenciNo='$ogrenciNo'");
        
$row = mysqli_fetch_array($sql);

$cevapKontrol = $row['cevap'];

if (!empty($cevapKontrol)) {
    $sql="Update cevaplar Set cevap='$option' Where soru='$question' and testadi='$testadi' and ogrenciNo='$ogrenciNo' ";
}
else {
    $sql="insert into cevaplar (ogrenciNo, testadi, soru, cevap) values ('$ogrenciNo', '$testadi', '$question', '$option')";
}

mysqli_query(baglanti(), $sql);
?>
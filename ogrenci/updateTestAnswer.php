<?php
include_once("../sabitler/standardsStudents.php");
// get the q parameter from URL
$question = $_REQUEST["question"];
$questionId = $_REQUEST["questionId"];
$option = $_REQUEST["option"];
$optionNo = $_REQUEST["optionNo"] - 1;

$hint = "";


$sql = mysqli_query(baglanti(),"Select * from cevaplar where soruid='$questionId'");
        
$row = mysqli_fetch_array($sql);

$cevapKontrol = $row['cevap'];

if (!empty($cevapKontrol)) {
    $sql="Update cevaplar Set cevapNo='$optionNo', cevap='$option' Where soruid='$questionId' and ogrenciNo='$ogrenciNo' ";
}
else {
    $sql="insert into cevaplar (ogrenciNo, testadi, soruid, soru, cevapno, cevap ) values ('$ogrenciNo', '$testadi', '$questionId', '$question', '$optionNo', '$option')";
}

mysqli_query(baglanti(), $sql);
?>
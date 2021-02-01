<?php
    include_once("../sabitler/standardsAdmin.php");

    $id = htmlentities($_GET["id"], ENT_QUOTES, "UTF-8");
    $category = htmlentities($_GET["category"], ENT_QUOTES, "UTF-8");
    $sinif = htmlentities($_GET["sinif"], ENT_QUOTES, "UTF-8");
    $testadi = htmlentities($_GET["testadi"], ENT_QUOTES, "UTF-8");
    $testadiQuery = $_GET["testadi"];

    $content = htmlentities($_POST[$category], ENT_QUOTES, "UTF-8");
    

    $sql="Update sorular Set $category='$content' Where id=$id";
    mysqli_query(baglanti(), $sql);

    header("Location:sorular.php?sinif=$sinif&&testadi=$testadiQuery");
?>
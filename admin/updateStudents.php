<?php
    include_once("../sabitler/standardsAdmin.php");

    $id = htmlentities($_GET["id"], ENT_QUOTES, "UTF-8");
    $category = htmlentities($_GET["category"], ENT_QUOTES, "UTF-8");
    $sinif = htmlentities($_GET["sinif"], ENT_QUOTES, "UTF-8");
    $subeadi = htmlentities($_GET["subeadi"], ENT_QUOTES, "UTF-8");
    $subeadiQuery = $_GET["subeadi"];

    $content = htmlentities($_POST[$category], ENT_QUOTES, "UTF-8");
    

    $sql="Update ogrenciler Set $category='$content' Where id=$id";
    mysqli_query(baglanti(), $sql);

    header("Location:ogrenciler.php?sinif=$sinif&&subeadi=$subeadiQuery");
?>
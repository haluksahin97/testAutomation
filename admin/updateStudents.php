<?php
    include_once("../sabitler/standardsAdmin.php");

    $id = $_GET['id'];
    $category = $_GET['category'];
    $sinif = $_GET['sinif'];
    $subeadi = $_GET['subeadi'];

    $content = htmlentities($_POST[$category], ENT_QUOTES, "UTF-8");
    

    $sql="Update ogrenciler Set $category='$content' Where id=$id";
    mysqli_query(baglanti(), $sql);

    header("Location:ogrenciler.php?sinif=$sinif&&subeadi=$subeadi");
?>
<?php
    include_once("../sabitler/sabit.php");
    include_once("../sabitler/baglanti.php");

    $id = $_GET['id'];
    $category = $_GET['category'];
    $sinif = $_GET['sinif'];

    $content = htmlentities($_POST[$category], ENT_QUOTES, "UTF-8");
    

    $sql="Update sorular Set $category='$content' Where id=$id";
    mysqli_query(baglanti(), $sql);

    header("Location:sorular.php?sinif=$sinif");
?>
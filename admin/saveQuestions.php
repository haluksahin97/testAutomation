<?php

    include_once("../sabitler/standardsAdmin.php");

    function multiexplode ($delimiters,$string) {

        $ready = str_replace($delimiters, $delimiters[0], $string);
        $launch = explode($delimiters[0], $ready);
        return  $launch;
    }
    $url = $_SERVER['HTTP_REFERER'];
    $url = multiexplode(array("?","=","&&"),$url);    
    
    $soru= htmlentities($_POST["soru"], ENT_QUOTES, "UTF-8");
    $resim= htmlentities($_FILES["dosya"]["name"], ENT_QUOTES, "UTF-8");
    $cevap= htmlentities($_POST["cevap"], ENT_QUOTES, "UTF-8");
    $secenek1= htmlentities($_POST["secenek1"], ENT_QUOTES, "UTF-8");
    $secenek2= htmlentities($_POST["secenek2"], ENT_QUOTES, "UTF-8");
    $secenek3= htmlentities($_POST["secenek3"], ENT_QUOTES, "UTF-8");
    $sinif= $url[2];
    $cozum= htmlentities($_POST["cozum"], ENT_QUOTES, "UTF-8");
    $testadi= htmlentities($_GET["testadi"], ENT_QUOTES, "UTF-8");


    //--------------------------------image upload

    if($resim != "") {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["dosya"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["dosya"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
        }
    
        // Check if file already exists
        if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
        }
    
        // Check file size
        if ($_FILES["dosya"]["size"] > 5000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
        }
    
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
        }
    
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
        if (move_uploaded_file($_FILES["dosya"]["tmp_name"], $target_file)) {
            echo "The file ". htmlspecialchars( basename( $_FILES["dosya"]["name"])). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
        }
    }
    else {
        $resim = "BOŞ";
    }
    //--------------------------------image upload End--//


    $sql="insert into sorular (soru, resim, cevap, secenek1, secenek2, secenek3, sinif, cozum, testadi) values ('$soru', '$resim', '$cevap', '$secenek1', '$secenek2', '$secenek3', '$sinif', '$cozum', '$testadi')";
    mysqli_query(baglanti(),$sql) or die ("Kayıt ekleme sorgusunda hata oluştu");
    header("Location:yenisoru.php?sinif=$sinif&&testadi=$testadi");

    
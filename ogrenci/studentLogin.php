<?php
    session_start();
    include_once("../sabitler/sabit.php");
    include_once("../sabitler/baglanti.php");

    $ogrencino= $_POST["ogrencino"];
    $password=$_POST["password"];

    
    $sql = "Select * from ogrenciler Where ogrencino='$ogrencino' and password='$password'";

    $res=mysqli_query(baglanti(),$sql);
    $row=mysqli_fetch_array($res);
    $name= $row["adi"];
    $surname= $row["soyadi"];

    if($name == null)
    {
        $_SESSION['student'] = null;
        
        header("Location:index.php?username=$ogrencino");
    }
    else
    {
        $_SESSION['student'] = $ogrencino;

        header("Location:testler.php");
    
    }
    
?>
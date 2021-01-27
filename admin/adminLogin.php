<?php
    session_start();
    include_once("../sabitler/sabit.php");
    include_once("../sabitler/baglanti.php");

    $username= $_POST["username"];
    $password=$_POST["password"];

    
    $sql = "Select * from admin Where username='$username' and password='$password'";

    $res=mysqli_query(baglanti(),$sql);
    $row=mysqli_fetch_array($res);
    $name= $row["name"];
    $surname= $row["surname"];

    if($name == null)
    {
        $_SESSION['admin'] = null;
        
        header("Location:giris.php?username=$username");
    }
    else
    {
        $_SESSION['admin'] = "success";

        header("Location:index.php");
    
    }
    
?>
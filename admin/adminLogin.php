<?php
    session_start();
    include_once("../sabitler/sabit.php");
    include_once("../sabitler/baglanti.php");

    $username= htmlentities($_POST["username"], ENT_QUOTES, "UTF-8");
    $usernameQuery= $_POST["username"];
    $password=htmlentities($_POST["password"], ENT_QUOTES, "UTF-8");

    
    $sql = "Select * from admin Where username='$username' and password='$password'";

    $res=mysqli_query(baglanti(),$sql);
    $row=mysqli_fetch_array($res);
    $name= $row["name"];
    $surname= $row["surname"];

    if($name == null)
    {
        $_SESSION['admin'] = null;
        
        header("Location:giris.php?username=$usernameQuery");
    }
    else
    {
        $_SESSION['admin'] = "success";

        header("Location:index.php");
    
    }
    
?>
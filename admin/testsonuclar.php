<!DOCTYPE html>
<html lang="tr">
<head>
    <?php include_once("../sabitler/standardsAdmin.php"); ?>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fatih Özcan</title>

    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />

    <link rel="stylesheet" href="../css/style.css?v=7" >

</head>
<body>

    <nav class="navbar sticky-top navbar-expand-lg navbar-dark bd-navbar bg-dark" id="navbarId">
        <div class="container">
            <a class="navbar-brand" href="index.php">Fatih ÖZCAN</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ml-auto">
                    <a class="nav-link pl-4" href="index.php">Yeni Soru</a>
                    <a class="nav-link pl-4" href="sorular.php">Sorular</a>
                    <a class="nav-link pl-4" href="yeniogrenci.php">Yeni Öğrenci</a>
                    <a class="nav-link pl-4" href="ogrenciler.php">Öğrenciler</a>
                    <a class="nav-link pl-4 active" href="testsonuclar.php">Test Sonuçları</a>
                    <a class="nav-link pl-4" href="signOut.php"><i class="fas fa-sign-out-alt"></i></a>
                </div>
            </div>
        </div>
    </nav>

<div id="mySidepanel" class="sidepanel">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
  <a href="testsonuclar.php?sinif=4">4. Sınıf</a>
  <a href="testsonuclar.php?sinif=5">5. Sınıf</a>
  <a href="testsonuclar.php?sinif=6">6. Sınıf</a>
  <a href="testsonuclar.php?sinif=7">7. Sınıf</a>
  <a href="testsonuclar.php?sinif=8">8. Sınıf</a>
</div>
    <script>
    
        var sorularId = [];
    </script>
 
    <?php

        if(!empty($_GET["sinif"])){
            $sinif = $_GET["sinif"];
            if(!empty($_GET["testadi"])) {
                $testadi = $_GET["testadi"];
                if(!empty($_GET["subeadi"])) {
                    $subeadi = $_GET["subeadi"];

                    $ogrenciSayac = 0;
            
                    $ogrenciler = array( 1 => array(
                        "ogrencino" => "",
                        "adi" => "",
                        "soyadi" => "",
                        "dogrusayisi" => "",
                        "yanlissayisi" => "",
                        "bossayisi" => "",
                        "netsayisi" => ""
                    ));
            
                    $sql = mysqli_query(baglanti(),"Select * from ogrenciler where sinif = '$sinif' and subeadi = '$subeadi'");
            
                    while($row = mysqli_fetch_array($sql)){
                        
                        $ogrenciSayac++;

                        $ogrenciNo = $row['ogrencino'];
            
                        $ogrenciler[$ogrenciSayac]["ogrencino"] = $row['ogrencino'];
                        $ogrenciler[$ogrenciSayac]["adi"] = $row['adi'];
                        $ogrenciler[$ogrenciSayac]["soyadi"] = $row['soyadi'];
                        
                        $sql1 = mysqli_query(baglanti(),"Select * from sonuclar where ogrencino = '$ogrenciNo' and testadi = '$testadi'");

                        while($row1 = mysqli_fetch_array($sql1)){
                            $ogrenciler[$ogrenciSayac]["dogrusayisi"] = $row1['dogrusayisi'];
                            $ogrenciler[$ogrenciSayac]["yanlissayisi"] = $row1['yanlissayisi'];
                            $ogrenciler[$ogrenciSayac]["bossayisi"] = $row1['bossayisi'];
                            $ogrenciler[$ogrenciSayac]["netsayisi"] = $row1['netsayisi'];
                        }
                    }
                }
            }
        }

        //print_r($soruSayac);
        // print_r($sorular);
        ?>

    <main role="main">
        <button id="mySidepanelButton" class="openbtn" onclick="openNav()">☰ Sınıflar</button> 

        <div class="container-fluid adminTestResults mb-5">
        
        <?php
            if(!empty($_GET["sinif"])){
                if(!empty($_GET["testadi"])) {
                    if(!empty($_GET["subeadi"])) { // Bilgilerin göründüğü ekran ---------------------
        ?>
                        <div class="header pt-2 mt-4">
                            <div class="row">
                                <div class="col-8">
                                    <h1 class="text-center"><?php echo $sinif . ". Sınıf " . $subeadi . " Şubesi Öğrencileri - " . $testadi . " Testi Sonuçları"  ?></h1>
                                </div>
                                <div class="col-4">
                                    <div class="dropdown">
                                        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown">
                                            Testi Değiş
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                                            
                                        <?php 
                                            if($_GET['testadi'] != "YOK") {
                                        ?>
                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="testsonuclar.php?sinif=<?php echo $_GET['sinif']; ?>&&testadi=YOK&&subeadi=<?php echo $subeadi ?>">Test Adı Olmayanlar</a></li>
                                        <?php
                                            }
                                        ?>


                                            <?php
                                                $sql = mysqli_query(baglanti(),"Select * from testadi where sinif='$sinif'");
                                                    
                                                while($row = mysqli_fetch_array($sql)){
                                                    if($_GET['testadi'] != $row['adi']) {
                                            ?>
                                                        <li role="presentation"><a role="menuitem" tabindex="-1" href="testsonuclar.php?sinif=<?php echo $_GET['sinif']; ?>&&testadi=<?php echo $row['adi']?>&&subeadi=<?php echo $subeadi?>"><?php echo $row['adi']; ?></a></li>
                                                
                                            <?php
                                                    }
                                                }
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <hr width="61px">
                        </div>

                        <div class="container-fluid">
                            <div class="row">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Öğrenci No</th>
                                            <th scope="col">Adı</th>
                                            <th scope="col">Soyadı</th>
                                            <th scope="col">Doğru Sayısı</th>
                                            <th scope="col">Yanlış Sayısı</th>
                                            <th scope="col">Boş Sayısı</th>
                                            <th scope="col">Net Sayısı</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            for ($i = 1; $i <= $ogrenciSayac; $i++) {
                                                ?>
                                                    <tr>
                                                        <th><?php echo $i ?></th>
                                                        <td><?php echo $ogrenciler[$i]["ogrencino"] ?></td>
                                                        <td><?php echo $ogrenciler[$i]["adi"] ?></td>
                                                        <td><?php echo $ogrenciler[$i]["soyadi"] ?></td>
                                                        <td><?php echo $ogrenciler[$i]["dogrusayisi"] ?></td>
                                                        <td><?php echo $ogrenciler[$i]["yanlissayisi"] ?></td>
                                                        <td><?php echo $ogrenciler[$i]["bossayisi"] ?></td>
                                                        <td><?php echo $ogrenciler[$i]["netsayisi"] ?></td>
                                                        <td><a href="testsonuc.php?<?php echo "test=$testadi&&sinif=$sinif&&ogrencino=$ogrenciNo"; ?>" class="btn btn-primary">İncele</a></td>
                                                    </tr>
                                                <?php
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
        <?php
                    }
                    else { // Şube Adı seçme ekranı -----------------------
        ?>
                        <div class="header pt-2 mt-4">
                            <h1 class="text-center">Şube Adı</h1>

                            <hr width="61px">
                        </div>
                        <div class="container">
                            <div class="row d-flex justify-content-center">
                                <div>
        <?php
                            
                                    $sql = mysqli_query(baglanti(),"Select adi from subeadi where sinif='$sinif'");
                            
                                    while($row = mysqli_fetch_array($sql)){
        ?>
                                    <div class="row">
                                        <a href="testsonuclar.php?sinif=<?php echo $_GET["sinif"] ?>&&testadi=<?php echo $_GET['testadi'] ?>&&subeadi=<?php echo $row['adi'] ?>" class="btn btn-primary mt-4 w-100"><?php echo $row['adi'] ?></a>
                                    </div>
        <?php
                                    }
        ?>
                                </div>
                            </div>
                        </div>
        <?php
                    }
                }
                else { // Test Adı seçme ekranı -----------------------
        ?>
                    <div class="header pt-2 mt-4">
                        <h1 class="text-center">Test Adı</h1>
            
                        <hr width="61px">
                    </div>
                    <div class="container">
                        <div class="row d-flex justify-content-center">
                            <div>
                                <div class="row">
                                    <a href="testsonuclar.php?sinif=<?php echo $_GET["sinif"] ?>&&testadi=YOK" class="btn btn-primary mt-4 w-100">Test adı olmayan sorular</a>
                                </div>
        <?php
                        
                                $sql = mysqli_query(baglanti(),"Select * from testadi where sinif='$sinif'");
                        
                                while($row = mysqli_fetch_array($sql)){
        ?>
                                <div class="row">
                                    <a href="testsonuclar.php?sinif=<?php echo $_GET["sinif"] ?>&&testadi=<?php echo $row['adi'] ?>" class="btn btn-primary mt-4 w-100"><?php echo $row['adi'] ?></a>
                                </div>
        <?php
                                }
        ?>
                            </div>
                        </div>
                    </div>
        <?php
                }
            }
            else { //Sınıf seçim ekranı -----------------------
        ?>

            <div class="header pt-2 mt-4">
                <h1 class="text-center">Kaçıncı sınıf</h1>
    
                <hr width="61px">
            </div>
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div>
                        <a href="testsonuclar.php?sinif=4" class="btn btn-dark mt-2 mr-2">4. Sınıf</a>
                        <a href="testsonuclar.php?sinif=5" class="btn btn-dark mt-2 mr-2">5. Sınıf</a>
                        <a href="testsonuclar.php?sinif=6" class="btn btn-dark mt-2 mr-2">6. Sınıf</a>
                        <a href="testsonuclar.php?sinif=7" class="btn btn-dark mt-2 mr-2">7. Sınıf</a>
                        <a href="testsonuclar.php?sinif=8" class="btn btn-dark mt-2 mr-2">8. Sınıf</a>
                    </div>
                </div>
            </div>
        <?php
            }
        ?>
        </div>
    </main>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    
    
    <script>
    //Side panel -------------
        function openNav() {
            document.getElementById("mySidepanel").style.width = "200px";
        }

        function closeNav() {
            document.getElementById("mySidepanel").style.width = "0";
        }
        $('#mySidepanel').on('click', function(e){
            e.stopPropagation();
        });
        $('#mySidepanelButton').on('click', function(e){
            e.stopPropagation();
        });

        $(document).on('click', function(e){
            closeNav();
        });
    </script>

</body>
</html>
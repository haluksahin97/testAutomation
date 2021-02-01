<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once("../sabitler/standardsAdmin.php"); ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fatih Özcan</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />

    <link rel="stylesheet" href="../css/style.css?v=12" >
    
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
                    <a class="nav-link pl-4" href="testsonuclar.php">Test Sonuçları</a>
                    <a class="nav-link pl-4" href="signOut.php"><i class="fas fa-sign-out-alt"></i></a>
                </div>
            </div>
        </div>
    </nav>
    
    <main role="main">
        <?php 
            if(!empty($_GET['test'])) {
                
                $testAd = htmlentities($_GET["test"], ENT_QUOTES, "UTF-8");
                $ogrenciNo = htmlentities($_GET["ogrencino"], ENT_QUOTES, "UTF-8");
                $ogrenciSinif = htmlentities($_GET["sinif"], ENT_QUOTES, "UTF-8");
        ?>
        <div class="container testResult">
            <div class="row">
                <div class="col-12 col-lg-8">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Soru</th>
                                <th scope="col">Doğru Cevap</th>
                                <th scope="col">Öğrencinin Cevabı</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 

                            $sayac = 0;
                            $sql = mysqli_query(baglanti(), "Select cevap,soru,secenekler,id,resim from sorular where sinif='$ogrenciSinif' and testadi='$testAd'");

                            $dogruSayisi = 0;
                            $yanlisSayisi = 0;
                            $bosSayisi = 0;

                            while($row = mysqli_fetch_array($sql)) {
                                $sayac++;
                                $cevap = $row['cevap'];
                                $secenek = $row['secenekler'];
                                $soru = $row['soru'];
                                $resim = $row['resim'];
                                $soruid = $row['id'];
                                $ogrenciCevap = "";
                                $cevapDurum = false;
                                
                                $sql1 = mysqli_query(baglanti(), "Select cevap from ilkcevaplar where ogrenciNo='$ogrenciNo' and soruid='$soruid'");

                                while($row1 = mysqli_fetch_array($sql1)) {
                                    $cevapDurum = true;
                                    $ogrenciCevap = $row1['cevap'];
                                }
                                if($cevap == $ogrenciCevap && $cevapDurum) {
                                    $color = "success";
                                    $dogruSayisi++;
                                }
                                else if(!$cevapDurum) {
                                    $color = "secondary";
                                    $bosSayisi++;
                                }
                                else {
                                    $color = "danger";
                                    $yanlisSayisi++;
                                }
                            ?>
                            <tr class="text-<?php echo $color ?>">
                                <th scope="row"><?php echo $sayac; ?></th>
                                <td><?php if($resim != "BOŞ") { ?><img src="uploads/<?php echo $resim ?>" width="150px" height="150px" > <?php } echo $soru; ?></td>
                                <td><?php echo $cevap; ?></td>
                                <td><?php if($color == "danger") { echo $ogrenciCevap; } ?></td>
                            </tr>
                            
                        <?php
                            }
                            $netSayisi = $dogruSayisi - ($yanlisSayisi/4);
                            
                        ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-12 col-lg-4">
                    <div id="dogruSayisi">Doğru sayısı: <?php echo $dogruSayisi ?></div>
                    <div id="yanlisSayisi">Yanlış sayısı: <?php echo $yanlisSayisi ?></div>
                    <div id="bosSayisi">Boş sayısı: <?php echo $bosSayisi ?></div>
                    <div id="netSayisi">Net sayısı: <?php echo $netSayisi ?></div>
                    <?php 
                    if(!empty($testAd)) {
                        $sql = mysqli_query(baglanti(),"Select * from ilksonuclar where ogrencino='$ogrenciNo' and testadi='$testAd'");
        
                        $row = mysqli_fetch_array($sql);
                        
                        $sonucKontrol = $row['netsayisi'];
                        
                        if (!empty($sonucKontrol)) {
                            $sql="Update ilksonuclar Set dogrusayisi='$dogruSayisi', yanlissayisi='$yanlisSayisi', bossayisi='$bosSayisi', netsayisi='$netSayisi' Where ogrencino='$ogrenciNo' and testadi='$testAd' ";
                        }
                        else {                        
                            $sql="insert into ilksonuclar (ogrencino, testadi, dogrusayisi, yanlissayisi, bossayisi, netsayisi) values ('$ogrenciNo', '$testAd', '$dogruSayisi', '$yanlisSayisi', '$bosSayisi', '$netSayisi')";
                        }
                        mysqli_query(baglanti(),$sql);
                    }
                    ?>
                </div>
                <div class="col-12 col-lg-8">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Soru</th>
                                <th scope="col">Doğru Cevap</th>
                                <th scope="col">Öğrencinin Cevabı</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 

                            $sayac = 0;
                            $sql = mysqli_query(baglanti(), "Select cevap,soru,secenekler,id,resim from sorular where sinif='$ogrenciSinif' and testadi='$testAd'");

                            $dogruSayisi = 0;
                            $yanlisSayisi = 0;
                            $bosSayisi = 0;

                            while($row = mysqli_fetch_array($sql)) {
                                $sayac++;
                                $cevap = $row['cevap'];
                                $secenek = $row['secenekler'];
                                $soru = $row['soru'];
                                $resim = $row['resim'];
                                $soruid = $row['id'];
                                $ogrenciCevap = "";
                                $cevapDurum = false;
                                
                                $sql1 = mysqli_query(baglanti(), "Select cevap from soncevaplar where ogrenciNo='$ogrenciNo' and soruid='$soruid'");

                                while($row1 = mysqli_fetch_array($sql1)) {
                                    $cevapDurum = true;
                                    $ogrenciCevap = $row1['cevap'];
                                }
                                if($cevap == $ogrenciCevap && $cevapDurum) {
                                    $color = "success";
                                    $dogruSayisi++;
                                }
                                else if(!$cevapDurum) {
                                    $color = "secondary";
                                    $bosSayisi++;
                                }
                                else {
                                    $color = "danger";
                                    $yanlisSayisi++;
                                }
                            ?>
                            <tr class="text-<?php echo $color ?>">
                                <th scope="row"><?php echo $sayac; ?></th>
                                <td><?php if($resim != "BOŞ") { ?><img src="uploads/<?php echo $resim ?>" width="150px" height="150px" > <?php } echo $soru; ?></td>
                                <td><?php echo $cevap; ?></td>
                                <td><?php if($color == "danger") { echo $ogrenciCevap; } ?></td>
                            </tr>
                            
                        <?php
                            }
                            $netSayisi = $dogruSayisi - ($yanlisSayisi/4);
                            
                        ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-12 col-lg-4">
                    <div id="dogruSayisi">Doğru sayısı: <?php echo $dogruSayisi ?></div>
                    <div id="yanlisSayisi">Yanlış sayısı: <?php echo $yanlisSayisi ?></div>
                    <div id="bosSayisi">Boş sayısı: <?php echo $bosSayisi ?></div>
                    <div id="netSayisi">Net sayısı: <?php echo $netSayisi ?></div>
                    <?php 
                    if(!empty($testAd)) {
                        $sql = mysqli_query(baglanti(),"Select * from sonsonuclar where ogrencino='$ogrenciNo' and testadi='$testAd'");
        
                        $row = mysqli_fetch_array($sql);
                        
                        $sonucKontrol = $row['netsayisi'];
                        
                        if (!empty($sonucKontrol)) {
                            $sql="Update sonsonuclar Set dogrusayisi='$dogruSayisi', yanlissayisi='$yanlisSayisi', bossayisi='$bosSayisi', netsayisi='$netSayisi' Where ogrencino='$ogrenciNo' and testadi='$testAd' ";
                        }
                        else {                        
                            $sql="insert into sonsonuclar (ogrencino, testadi, dogrusayisi, yanlissayisi, bossayisi, netsayisi) values ('$ogrenciNo', '$testAd', '$dogruSayisi', '$yanlisSayisi', '$bosSayisi', '$netSayisi')";
                        }
                        mysqli_query(baglanti(),$sql);
                    }
                    ?>
                </div>
            </div>
        </div>
        <?php
            }
        ?>
    </main>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    
</body>
</html>
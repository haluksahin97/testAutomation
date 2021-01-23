<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once("../sabitler/standardsStudents.php"); ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fatih Özcan</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />

    <link rel="stylesheet" href="../css/style.css?v=9" >
    
</head>
<body>
    <nav class="navbar sticky-top navbar-expand-lg navbar-dark bd-navbar bg-dark" id="navbarId">
        <div class="container">
        <a class="navbar-brand" href="yenisoru.php">Fatih ÖZCAN</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ml-auto">
                    <a class="nav-link pl-4" href="testler.php">Testler</a>
                    <a class="nav-link pl-4 active" href="testsonuc.php">Sonuclar</a>
                    <a class="nav-link pl-4" href="signOut.php"><i class="fas fa-sign-out-alt"></i></a>
                </div>
            </div>
        </div>
    </nav>
    
    <main role="main">
        <div class="container">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Soru</th>
                                <th scope="col">Doğru Cevap</th>
                                <th scope="col">Sizin Cevabınız</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                        
                            $testAd = $_GET['test'];
                            $sayac = 0;
                            $sql = mysqli_query(baglanti(), "Select cevap,soru,secenekler,id from sorular where sinif='$ogrenciSinif' and testadi='$testAd'");

                            while($row = mysqli_fetch_array($sql)) {
                                $sayac++;
                                $cevap = $row['cevap'];
                                $secenek = $row['secenekler'];
                                $soru = $row['soru'];
                                $soruid = $row['id'];
                                $ogrenciCevap = "";
                                
                                $sql1 = mysqli_query(baglanti(), "Select cevap from cevaplar where ogrenciNo='$ogrenciNo' and soruid='$soruid'");

                                while($row1 = mysqli_fetch_array($sql1)) {
                                
                                    $ogrenciCevap = $row1['cevap'];
                                }
                                if($cevap == $ogrenciCevap) {
                                    $color = "success";
                                }
                                else {
                                    $color = "danger";
                                }
                            ?>
                            <tr class="text-<?php echo $color ?>">
                                <th scope="row"><?php echo $sayac; ?></th>
                                <td><?php echo $soru; ?></td>
                                <td><?php echo $cevap; ?></td>
                                <td><?php echo $ogrenciCevap; ?></td>
                            </tr>
                            
                        <?php
                            }
                        ?>
                        </tbody>
                    </table>
        </div>
    </main>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    
</body>
</html>
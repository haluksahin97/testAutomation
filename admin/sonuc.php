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
                    <a class="nav-link active pl-4" href="ogrenciler.php">Öğrenciler</a>
                    <a class="nav-link pl-4" href="testsonuclar.php">Test Sonuçları</a>
                    <a class="nav-link pl-4" href="signOut.php"><i class="fas fa-sign-out-alt"></i></a>
                </div>
            </div>
        </div>
    </nav>
    
    <main role="main">
        <?php 
            $ogrenciNo = htmlentities($_GET["ogrencino"], ENT_QUOTES, "UTF-8");
            $ogrenciSinif = htmlentities($_GET["sinif"], ENT_QUOTES, "UTF-8");
        ?>
        <div class="header pt-5x mt-5">
            
            <h1 class="text-center"> Çözdüğü Testler</h1>

            <hr width="61px">

        </div>
        <?php
            $sql = mysqli_query(baglanti(),"Select testadi from sonuclar where ogrencino = '$ogrenciNo' ");
                
            while($row = mysqli_fetch_array($sql)){
        ?>
                <div class="w-100 d-flex justify-content-center">
                    <a class="btn btn-danger w-25 mt-3" href="testsonuc.php?test=<?php echo $row['testadi'] ?>&&ogrencino=<?php echo $ogrenciNo ?>&&sinif=<?php echo $ogrenciSinif ?>"><?php echo $row['testadi'] ?> Testi</a>
                </div>
        <?php
            }
        ?>
    </main>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once("../sabitler/standardsStudents.php"); ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fatih Özcan</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />

    <link rel="stylesheet" href="../css/style.css?v=1" >
    
</head>
<body>
    <nav class="navbar sticky-top navbar-expand-lg navbar-dark bd-navbar bg-dark" id="navbarId">
        <div class="container">
        <a class="navbar-brand" href="testler.php">Fatih ÖZCAN</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ml-auto">
                    <a class="nav-link pl-4" href="testler.php">Testler</a>
                    <a class="nav-link pl-4 active" href="sonuclar.php">Sonuclar</a>
                    <a class="nav-link pl-4" href="signOut.php"><i class="fas fa-sign-out-alt"></i></a>
                </div>
            </div>
        </div>
    </nav>
    
    <main role="main">
        <div class="container studentTests">
            <div class="header pt-5x mt-5">
                
                <h4>Merhaba <?php echo $ogrenciAd . " " . $ogrenciSoyad ?></h4>

                
                <h1 class="text-center">Sonuclar</h1>
    
                <hr width="61px">

            </div>
            <?php
                $sql = mysqli_query(baglanti(),"Select testadi from sonuclar where ogrencino = '$ogrenciNo' ");
                    
                while($row = mysqli_fetch_array($sql)){
            ?>
                    <div class="w-100 d-flex justify-content-center">
                        <a class="btn btn-danger w-25 mt-3" href="testsonuc.php?test=<?php echo $row['testadi'] ?>"><?php echo $row['testadi'] ?> Testi</a>
                    </div>
            <?php
                }
            ?>
        </div>
    </main>
</body>
</html>
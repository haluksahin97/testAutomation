<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once("../sabitler/standardsStudents.php"); ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fatih Özcan</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />

    <link rel="stylesheet" href="../css/style.css?v=13" >
    
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
                    <a class="nav-link active pl-4" href="index.php">Ana Sayfa</a>
                    <a class="nav-link pl-4" href="signOut.php"><i class="fas fa-sign-out-alt"></i></a>
                </div>
            </div>
        </div>
    </nav>
    
    <main role="main">
        <div class="container studentIndex">
            <h4 class="mt-3">Merhaba <?php echo $ogrenciAd . " " . $ogrenciSoyad ?></h4>
            <div class="row mt-5 mb-5">
                <div class="col-12 col-lg-6 border-right pb-5">
                    <div class="header mt-5">
            
                        <h2 class="text-center">Sizinle Paylaşılan Testler</h2>
            
                        <hr width="61px">

                    </div>
                    <?php
                        $sql = mysqli_query(baglanti(),"Select DISTINCT testadi from sorular where testadi != 'YOK' and sinif = '$ogrenciSinif' ");
                            
                        while($row = mysqli_fetch_array($sql)){
                    ?>
                            <div class="w-100 d-flex justify-content-center">
                                <a class="btn btn-sm animated-button victoria-two w-50" href="testgiris.php?test=<?php echo $row['testadi'] ?>"><?php echo $row['testadi'] ?> Testi</a>
                            </div>
                    <?php
                        }
                    ?>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="header mt-5">
                        
                        <h2 class="text-center">Test Sonuçlarınız</h2>
            
                        <hr width="61px">

                    </div>
                    <?php
                        $sql = mysqli_query(baglanti(),"Select testadi from ilksonuclar where ogrencino = '$ogrenciNo' ");
                            
                        while($row = mysqli_fetch_array($sql)){
                    ?>
                            <div class="w-100 d-flex justify-content-center">
                                <a class="btn btn-sm animated-button thar-two w-50" href="testsonuc.php?test=<?php echo $row['testadi'] ?>"><?php echo $row['testadi'] ?> Testi</a>
                            </div>
                    <?php
                        }
                    ?>
                </div>
            </div>
        </div>
    </main>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    
</body>
</html>
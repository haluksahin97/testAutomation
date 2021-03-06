<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once("../sabitler/standardsStudents.php"); ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fatih Özcan</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />

    <link rel="stylesheet" href="../css/style.css?v=15" >
    
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
                    <a class="nav-link pl-4" href="index.php">Ana Sayfa</a>
                    <a class="nav-link pl-4" href="signOut.php"><i class="fas fa-sign-out-alt"></i></a>
                </div>
            </div>
        </div>
    </nav>
    
    <main role="main">
        <div id="testIntro">
            <div class="content">
                <?php $testAd = htmlentities($_GET["test"], ENT_QUOTES, "UTF-8"); ?>
                <h2 class="mb-4" id="testIntroHead"><?php echo $testAd; ?> Testine Hoşgeldiniz</h2>
                <hr width="61px">
                <h4 class="mb-4" id="testIntroHead">Testte giriş yaptıktan sonra sonucunuz otomatik olarak kaydedilecektir.</h4>
                <?php 
                    $sql = mysqli_query(baglanti(),"Select sure from testadi where adi = '$testAd' and sinif = '$ogrenciSinif'");
                    $row = mysqli_fetch_array($sql);
                    $sure = $row['sure'];
                ?>
                
                <h4 id="testIntroContent" class="mb-3">Süreniz <b><?php echo $sure ?></b> dakidadır. </h4>
                <h5 id="testIntroContent" class="mb-5">Başarılar 😇</h5>
                <a class="btn btn-sm animated-button sandy-two" id="testIntroButton" href="testReset.php?test=<?php echo $testAd; ?>">Başla</a>
            </div>
        </div>
    </main>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    
</body>
</html>
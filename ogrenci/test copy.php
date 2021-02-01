<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once("../sabitler/standardsStudents.php"); ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fatih Özcan</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />

    <link rel="stylesheet" href="../css/style.css?v=2" >
    
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
                    <a class="nav-link pl-4" href="signOut.php"><i class="fas fa-sign-out-alt"></i></a>
                </div>
            </div>
        </div>
    </nav>
    
    <main role="main">
        <div class="container studentTest">
            <div class="header pt-5x mt-5">
                <h1 class="text-center"><?php echo $_GET['test']; ?> Testi</h1>
    
                <hr width="61px">
            </div>
            <div class="row">
                    <?php
                        $testAd = htmlentities($_GET["test"], ENT_QUOTES, "UTF-8");
                        $sql = mysqli_query(baglanti(),"Select * from sorular where testadi = '$testAd' and sinif = '$ogrenciSinif'");
                        $soruSayac = 0;
                        while($row = mysqli_fetch_array($sql)){
                            $soruSayac++;
                            $soru = $row['soru'];
                            $resim = $row['resim'];
                            $cevap = $row['cevap'];
                            $secenek1 = $row['secenek1'];
                            $secenek2 = $row['secenek2'];
                            $secenek3 = $row['secenek3'];
                            $soru = str_replace("\n", '<br>', $soru);
                            $cevap = str_replace("\n", '<br>', $cevap);
                            $secenek1 = str_replace("\n", '<br>', $secenek1);
                            $secenek2 = str_replace("\n", '<br>', $secenek2);
                            $secenek3 = str_replace("\n", '<br>', $secenek3);

                            $sıklar[0] = array($cevap, $secenek1, $secenek3, $secenek2);
                            $sıklar[1] = array($secenek1, $cevap, $secenek2, $secenek3);
                            $sıklar[2] = array($secenek2, $secenek3, $cevap, $secenek1);
                            $sıklar[3] = array($secenek3, $secenek2, $secenek1, $cevap);
                            $randomSayi = mt_rand(0,3);

                            $sorular[$soruSayac]['soru'] = $soru;
                            $sorular[$soruSayac]['resim'] = $resim;
                            $sorular[$soruSayac]['secenek1'] = $sıklar[$randomSayi][0];
                            $sorular[$soruSayac]['secenek2'] = $sıklar[$randomSayi][1];
                            $sorular[$soruSayac]['secenek3'] = $sıklar[$randomSayi][2];
                            $sorular[$soruSayac]['secenek4'] = $sıklar[$randomSayi][3];
                        }
                        $testBol = ceil($soruSayac/2);
                        for($sayac = 1; $sayac <= $soruSayac; $sayac++) {
                            if($sayac == 1 || $sayac == $testBol + 1) {
                            ?>
                                <div class="col-12 col-lg-6">
                            <?php
                            }
                    ?>
                        <div class="row">
                            <div class="w-100">
                                <div class="testQuestion border rounded p-4 m-2">
                                    <?php if($sorular[$sayac]['resim'] != "BOŞ") {?>
                                        <img class="mb-4" src="../admin/uploads/<?php echo $sorular[$sayac]['resim'] ?>" width="100%" height="300px" alt="soru resmi">
                                    <?php } ?>
                                    <p><?php echo $sayac . "- " . $sorular[$sayac]['soru']; ?></p>
                                    <hr width="50%" >
                                    <div class="w-100 mt-3"><a href=""><?php echo "A) " . $sorular[$sayac]['secenek1']; ?></a></div>
                                    <div class="w-100 mt-3"><a href=""><?php echo "B) " . $sorular[$sayac]['secenek2']; ?></a></div>
                                    <div class="w-100 mt-3"><a href=""><?php echo "C) " . $sorular[$sayac]['secenek3']; ?></a></div>
                                    <div class="w-100 mt-3"><a href=""><?php echo "D) " . $sorular[$sayac]['secenek4']; ?></a></div>
                                </div>
                            </div>
                        </div>
                    <?php
                            if($sayac == $testBol) {
                                ?>
                                </div>
                                <?php
                            }
                        }
                    ?>
                    </div>
            </div>
        </div>
    </main>
</body>
</html>
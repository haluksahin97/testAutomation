<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once("../sabitler/standardsStudents.php"); ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fatih Özcan</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />

    <link rel="stylesheet" href="../css/style.css?v=23" >
    
</head>
<body>
    <?php 
        $testAdQuery = "";
        if(!empty($_GET['test'])) {
            $testAdQuery = $_GET["test"];
        }
    ?>
    <script>
        
        function resultControl(result) {
            xhttp = new XMLHttpRequest();
            xhttp.open("GET", "saveResult.php?test=<?php echo $testAdQuery ?>&&result="+result, true);
            xhttp.send();
            alert("<?php echo $testAdQuery ?> testini son girişinizde tamamlamadan çıkmışsınız sonucunuz hesaplanıyor.")
            window.location.reload();
            
        }
    </script>
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
        <?php 
            if(!empty($_GET['test'])) {
                
                $testAd = htmlentities($_GET["test"], ENT_QUOTES, "UTF-8");
        ?>
        <div class="container testResult">
            <div class="row mb-5">
            <div class="header pt-5x mt-5 w-100">
                <h1 class="text-center"><?php echo $_GET['test']; ?> Testi</h1>
    
                <hr width="61px">
                
                <h2 class="text-center mt-3">İlk Sonucunuz </h2>
            </div>
                <div class="col-12 col-lg-3 pr-2 mt-2 mb-3">
                    <?php                         
                        $sql = mysqli_query(baglanti(),"Select * from ilksonuclar where ogrencino='$ogrenciNo' and testadi='$testAd'");
                        $row = mysqli_fetch_array($sql);
                        $dogruSayisi = $row['dogrusayisi'];
                        $yanlisSayisi = $row['yanlissayisi'];
                        $bosSayisi = $row['bossayisi'];
                        $netSayisi = $row['netsayisi'];
                        $girisSayisi = $row['giris'];
                        if($dogruSayisi === null) {
                            echo "<script>resultControl('first');</script>";
                        }
                    ?>
                    <div class="text-hover trueResult" onclick="resultsClick('success');">
                        <div class="results effectTrue" data-hover="Doğru sayınız: <?php echo $dogruSayisi ?>">Doğru sayınız: <?php echo $dogruSayisi ?></div>
                    </div>
                    <div class="text-hover falseResult" onclick="resultsClick('danger');">
                        <div class="results effectFalse" data-hover="Yanlış sayınız: <?php echo $yanlisSayisi ?>">Yanlış sayınız: <?php echo $yanlisSayisi ?></div>
                    </div>
                    <div class="text-hover nullResult" onclick="resultsClick('secondary');">
                        <div class="results effectNull" data-hover="Boş sayınız: <?php echo $bosSayisi ?>">Boş sayınız: <?php echo $bosSayisi ?></div>
                    </div>
                    <div class="text-hover netResult" onclick="resultsClick('netResult');">
                        <div class="results effectNet" data-hover="Net sayınız: <?php echo $netSayisi ?>">Net sayınız: <?php echo $netSayisi ?></div>
                    </div>
                </div>
                <div class="col-12 col-lg-9 pl-0 table-responsive mb-4">
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

                            $sayac = 0;
                            $sql = mysqli_query(baglanti(), "Select * from sorular where sinif='$ogrenciSinif' and testadi='$testAd'");

                            while($row = mysqli_fetch_array($sql)) {
                                $sayac++;
                                $cevap = $row['cevap'];
                                $secenek = $row['secenekler'];
                                $soru = $row['soru'];
                                $resim = $row['resim'];
                                $soruid = $row['id'];
                                $ogrenciCevap = "";
                                $cevapDurum = false;
                                
                                $sql1 = mysqli_query(baglanti(), "Select cevap,cevapno from ilkcevaplar where ogrencino='$ogrenciNo' and soruid='$soruid'");

                                $ogrenciCevapNoIlk = "";
                                while($row1 = mysqli_fetch_array($sql1)) {
                                    $cevapDurum = true;
                                    $ogrenciCevap = $row1['cevap'];
                                    $ogrenciCevapNoIlk = $row1['cevapno'];
                                }
                                if($cevap == $ogrenciCevap && $cevapDurum) {
                                    $color = "success";
                                }
                                else if(!$cevapDurum) {
                                    $color = "secondary";
                                }
                                else {
                                    $color = "danger";
                                }
                                $filter = "boş";
                                if(!empty($_GET['filter'])) {
                                    $filter = $_GET["filter"];
                                }
                                if($filter == $color || $filter == 'netResult' || $filter == 'boş') {
                        ?>
                                    <tr class="text-<?php echo $color ?>" onclick="questionContent(<?php echo $soruid . ',' . $sayac . ',' . $ogrenciCevapNoIlk ?>)">
                                        <th scope="row"><?php echo $sayac; ?></th>
                                        <td><?php if($resim != "BOŞ") { ?><img src="../admin/uploads/<?php echo $resim ?>" width="150px" height="150px" > <?php } echo $soru; ?></td>
                                        <td><?php echo $cevap; ?></td>
                                        <td><?php if($color == "danger") { echo $ogrenciCevap; } ?></td>
                                    </tr>
                        <?php
                                }
                            }
                        ?>
                        </tbody>
                    </table>
                </div>
                <hr class="w-100">
                <?php 
                    if($girisSayisi > 1) {
                ?>
                <div class="header pt-5x mt-3 w-100">
                    <h2 class="text-center">Son Sonucunuz</h2>
                </div>
                <div class="col-12 col-lg-3 mt-3 pr-0">
                    <?php                         
                        $sql = mysqli_query(baglanti(),"Select * from sonsonuclar where ogrencino='$ogrenciNo' and testadi='$testAd'");
                        $row = mysqli_fetch_array($sql);
                        $dogruSayisi = $row['dogrusayisi'];
                        if($dogruSayisi === null) {
                            echo "<script>resultControl('last');</script>";
                        }
                        $yanlisSayisi = $row['yanlissayisi'];
                        $bosSayisi = $row['bossayisi'];
                        $netSayisi = $row['netsayisi'];
                    ?>
                    <div class="text-hover trueResult" onclick="resultsClick('success');">
                        <div class="results effectTrue" data-hover="Doğru sayınız: <?php echo $dogruSayisi ?>">Doğru sayınız: <?php echo $dogruSayisi ?></div>
                    </div>
                    <div class="text-hover falseResult" onclick="resultsClick('danger');">
                        <div class="results effectFalse" data-hover="Yanlış sayınız: <?php echo $yanlisSayisi ?>">Yanlış sayınız: <?php echo $yanlisSayisi ?></div>
                    </div>
                    <div class="text-hover nullResult" onclick="resultsClick('secondary');">
                        <div class="results effectNull" data-hover="Boş sayınız: <?php echo $bosSayisi ?>">Boş sayınız: <?php echo $bosSayisi ?></div>
                    </div>
                    <div class="text-hover netResult" onclick="resultsClick('netResult');">
                        <div class="results effectNet" data-hover="Net sayınız: <?php echo $netSayisi ?>">Net sayınız: <?php echo $netSayisi ?></div>
                    </div>
                </div>
                <div class="col-12 col-lg-9 mt-5 pl-0 table-responsive">
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

                            $sayac = 0;
                            $sql = mysqli_query(baglanti(), "Select * from sorular where sinif='$ogrenciSinif' and testadi='$testAd'");

                            while($row = mysqli_fetch_array($sql)) {
                                $sayac++;
                                $cevap = $row['cevap'];
                                $secenek = $row['secenekler'];
                                $soru = $row['soru'];
                                $resim = $row['resim'];
                                $soruid = $row['id'];
                                $ogrenciCevap = "";
                                $cevapDurum = false;
                                
                                $sql1 = mysqli_query(baglanti(), "Select cevap,cevapno from soncevaplar where ogrencino='$ogrenciNo' and soruid='$soruid'");

                                $ogrenciCevapNoSon = "";
                                while($row1 = mysqli_fetch_array($sql1)) {
                                    $cevapDurum = true;
                                    $ogrenciCevap = $row1['cevap'];
                                    $ogrenciCevapNoSon = $row1['cevapno'];
                                }
                                if($cevap == $ogrenciCevap && $cevapDurum) {
                                    $color = "success";
                                }
                                else if(!$cevapDurum) {
                                    $color = "secondary";
                                }
                                else {
                                    $color = "danger";
                                }
                                if($filter == $color || $filter == 'netResult' || $filter == 'boş') {
                        ?>
                                    <tr class="text-<?php echo $color ?>" onclick="questionContent(<?php echo $soruid . ',' . $sayac . ',' . $ogrenciCevapNoSon ?>)">
                                        <th scope="row"><?php echo $sayac; ?></th>
                                        <td><?php if($resim != "BOŞ") { ?><img src="../admin/uploads/<?php echo $resim ?>" width="150px" height="150px" > <?php } echo $soru; ?></td>
                                        <td><?php echo $cevap; ?></td>
                                        <td><?php if($color == "danger") { echo $ogrenciCevap; } ?></td>
                                    </tr>
                        <?php
                                }
                            }
                        ?>
                        </tbody>
                    </table>
                </div>
                <?php 
                    }
                ?>
            </div>
        </div>
        <?php
            }
        ?>
        <div class="modal modal-color fade bd-example-modal-lg" id="exampleModalCenter" tabindex="-1" role="dialog"  aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-color modal-dialog-centered modal-lg" role="document">
                <div class="modal-content modal-color">
                    <div class="modal-header modal-color">
                        <h5 class="modal-title modal-color" id="exampleModalLabel">New message</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body modal-color" id="question">
                        
                    </div>
                    <div class="modal-footer" modal-color>
                        <button type="button" class="btn btn-secondary" id="proje_kapat" data-dismiss="modal">Kapat</button>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="modal modal_preloader" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered justify-content-center" role="document">
                <span class="fa fa-spinner fa-spin fa-3x"></span>
            </div>
        </div>
    </main>
    
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    
    <script>
    var filter = "<?php echo $filter ?>";
    $( document ).ready(function() {
        if(filter == "success") {
            $(".trueResult").addClass("resultsShow");
        }
        else if(filter == "danger") {
            $(".falseResult").addClass("resultsShow");
        }
        else if(filter == "secondary") {
            $(".nullResult").addClass("resultsShow");
        }
        else if(filter == "netResult") {
            $(".netResult").addClass("resultsShow");
        }
    });
        function resultsClick(whichResult) {
            window.location.href = "testsonuc.php?test=<?php echo $testAdQuery ?>&&filter="+whichResult;
        }

        function questionContent(soruid, soru, ogrencicevap) {
            $('#question').load("takeQuestion.php?soruid="+soruid+"&&ogrencicevap="+ogrencicevap);  

            $("#exampleModalLabel").html(soru + ". Soru");

            $('.modal_preloader').modal('show');
            setTimeout(function () {
                $('.modal_preloader').modal('hide');
                $('#exampleModalCenter').modal('toggle');
            }, 500);
            
        }
    </script>


</body>
</html>
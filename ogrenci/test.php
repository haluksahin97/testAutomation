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
        <div class="container studentTest">
            <div class="header pt-5x mt-5">
                <h1 class="text-center"><?php echo $_GET['test']; ?> Testi</h1>
    
                <hr width="61px">
            </div>
            <div class="row">
                <div class="col-12 col-lg-8 offset-lg-2">
                    <ul class="m-0 p-0">
                    <?php
                        $testAd = $_GET['test'];
                        $sql = mysqli_query(baglanti(),"Select * from sorular where testadi = '$testAd' and sinif = '$ogrenciSinif'");
                        $soruSayac = 0;
                        while($row = mysqli_fetch_array($sql)){
                            $soruSayac++;
                            $soruid = $row['id'];
                            $soru = $row['soru'];
                            $resim = $row['resim'];
                            $cevap = $row['cevap'];
                            $secenek1 = $row['secenek1'];
                            $secenek2 = $row['secenek2'];
                            $secenek3 = $row['secenek3'];
                            $secenekler = $row['secenekler'];
                            $soru = str_replace("\n", '<br>', $soru);
                            $cevap = str_replace("\n", '<br>', $cevap);
                            $secenek1 = str_replace("\n", '<br>', $secenek1);
                            $secenek2 = str_replace("\n", '<br>', $secenek2);
                            $secenek3 = str_replace("\n", '<br>', $secenek3);

                            $siklar[0] = array($cevap, $secenek1, $secenek3, $secenek2);
                            $siklar[1] = array($secenek1, $cevap, $secenek2, $secenek3);
                            $siklar[2] = array($secenek2, $secenek3, $cevap, $secenek1);
                            $siklar[3] = array($secenek3, $secenek2, $secenek1, $cevap);

                            ?>
                            <li class="m-0 p-0">
                                <div class="testQuestion border rounded p-4 m-2">
                                    <?php if($resim != "BOŞ") {?>
                                        <img class="mb-4" src="../admin/uploads/<?php echo $resim ?>" width="100%" height="300px" alt="soru resmi">
                                    <?php } ?>
                                    <p><?php echo $soruSayac . "- " . $soru; ?></p>
                                    <hr width="50%" >
                                    <ul>
                                        <li><div class="w-100 mt-3"><a class="option" onclick="optionClick(<?php echo $soruSayac; ?>, <?php echo $soruid?>, '1', '<?php echo $siklar[$secenekler][0] ?>')"><?php echo "A) " . $siklar[$secenekler][0]; ?></a></div></li>
                                        <li><div class="w-100 mt-3"><a class="option" onclick="optionClick(<?php echo $soruSayac; ?>, <?php echo $soruid?>, '2', '<?php echo $siklar[$secenekler][1] ?>')"><?php echo "B) " . $siklar[$secenekler][1]; ?></a></div></li>
                                        <li><div class="w-100 mt-3"><a class="option" onclick="optionClick(<?php echo $soruSayac; ?>, <?php echo $soruid?>, '3', '<?php echo $siklar[$secenekler][2] ?>')"><?php echo "C) " . $siklar[$secenekler][2]; ?></a></div></li>
                                        <li><div class="w-100 mt-3"><a class="option" onclick="optionClick(<?php echo $soruSayac; ?>, <?php echo $soruid?>, '4', '<?php echo $siklar[$secenekler][3] ?>')"><?php echo "D) " . $siklar[$secenekler][3]; ?></a></div></li>
                                    </ul>
                                </div>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <div class="timer">
                <h3 id="timerWrite"></h3>
            </div>
            <div class="container d-flex justify-content-end">
                <button class="btn btn-primary mt-4 mb-4" onclick="finishButtonClick()">Testi Bitir</button>
            </div>
        </div>
        <div id="testFinish">
            <div class="content">
                <h2 class="mb-4" id="testFinishHead">Süreniz bitti.</h2>
                
                <h5 id="testFinishContent" class="mb-5">Sonuç sayfasına yönlendiriliyorsunuz. </h5>
            </div>
        </div>
    </main>

    <?php 
        $sql = mysqli_query(baglanti(),"Select sure from testadi where adi = 'efsaneler' and sinif = '4'");
        $row = mysqli_fetch_array($sql);
        $sure = $row['sure'];
    ?>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    

    <script>
        function startTimer(duration, display) {
            var timer = duration, minutes, seconds;
            setInterval(function () {
                minutes = parseInt(timer / 60, 10);
                seconds = parseInt(timer % 60, 10);

                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;

                display.text(minutes + ":" + seconds);

                if (--timer < 0) {
                    $('body').css('overflow', 'hidden');
                    $('#testFinish').css('display', 'block');
                    $('#testFinishHead').html("Süreniz Bitti.");
                    $('#testFinishContent').html("Sonuç sayfasına yönlendiriliyorsunuz...");
                    $('#testFinishButton').css('display', 'none');
                    setTimeout(function() { window.location.href = "testsonuc.php?test=<?php echo $testAd ?>"}, 3000);
                }
            }, 1000);
        }
        
        var time = <?php echo $sure ?>;

        $( document ).ready(function() {
            var fiveMinutes = 60 * time,
            display = $('#timerWrite');
            startTimer(fiveMinutes, display);

            $('#testFinish').css('display', 'none');
        });
        var questions = [];
        var oldquestions = [];
        function optionClick(questionNo, questionId, optionNo, option) {
            if(oldquestions[questionNo] != optionNo) {
                if(questions[questionNo]) {
                    $( "ul li:nth-child("+questionNo+")>div>ul li:nth-child("+oldquestions[questionNo]+")>div>a " ).css("color", "black");
                    $( "ul li:nth-child("+questionNo+")>div>ul li:nth-child("+oldquestions[questionNo]+")>div>a " ).css("font-weight", "400");
                }
                questions[questionNo] = true;
                oldquestions[questionNo] = optionNo;
                $( "ul li:nth-child("+questionNo+")>div>ul li:nth-child("+optionNo+")>div>a " ).css("color", "#ff6a00");
                $( "ul li:nth-child("+questionNo+")>div>ul li:nth-child("+optionNo+")>div>a " ).css("font-weight", "500");
                
                var xhttp;
                xhttp = new XMLHttpRequest();
                xhttp.open("GET", "updateTestAnswer.php?question="+questionNo+"&&questionId="+questionId+"&&optionNo="+optionNo+"&&option="+option, true);
                xhttp.send();
            }
        }

        function finishButtonClick() {
            var kalansure= $('#timerWrite').text();
            $('body').css('overflow', 'hidden');
            $('#testFinish').css('display', 'block');
            $('#testFinishHead').html("Testi Başarıyla Tamamladınız.");
            $('#testFinishContent').html("Sonuç sayfasına yönlendiriliyorsunuz...");
            $('#testFinishButton').css('display', 'none');
            setTimeout(function() { window.location.href = "testsonuc.php?<?php echo "test=$testAd&&sure="?>"+kalansure}, 3000);

        }
        
    </script>
</body>
</html>
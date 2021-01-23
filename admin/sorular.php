<!DOCTYPE html>
<html lang="tr">
<head>
    <?php include_once("../sabitler/standardsAdmin.php"); ?>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fatih Özcan</title>

    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />

    <link rel="stylesheet" href="../css/style.css?v=5" >

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
                    <a class="nav-link pl-4" href="yenisoru.php">Yeni Soru</a>
                    <a class="nav-link active pl-4" href="sorular.php">Sorular</a>
                    <a class="nav-link pl-4" href="yeniogrenci.php">Yeni Öğrenci</a>
                    <a class="nav-link pl-4" href="ogrenciler.php">Öğrenciler</a>
                    <a class="nav-link pl-4" href="testata.php">Test Ata</a>
                    <a class="nav-link pl-4" href="signOut.php"><i class="fas fa-sign-out-alt"></i></a>
                </div>
            </div>
        </div>
    </nav>

<div id="mySidepanel" class="sidepanel">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
  <a href="sorular.php?sinif=4">4. Sınıf</a>
  <a href="sorular.php?sinif=5">5. Sınıf</a>
  <a href="sorular.php?sinif=6">6. Sınıf</a>
  <a href="sorular.php?sinif=7">7. Sınıf</a>
  <a href="sorular.php?sinif=8">8. Sınıf</a>
</div>
    <script>
    
        var sorularId = [];
    </script>
 
    <?php

        if(!empty($_GET["sinif"])){
            $sinif = $_GET["sinif"];
            if(!empty($_GET["testadi"])) {
                $testadi = $_GET["testadi"];

                $soruSayac = 0;
        
                $sorular = array( 1 => array(
                    "id" => "",
                    "soru" => "",
                    "resim" => "",
                    "cevap" => "",
                    "secenek1" => "",
                    "secenek2" => "",
                    "secenek3" => "",
                    "cozum" => ""
                ));
        
                $sql = mysqli_query(baglanti(),"Select * from sorular where sinif = '$sinif' and testadi = '$testadi'");
        
                while($row = mysqli_fetch_array($sql)){
                    
                    $soruSayac++;
        
                    $sorular[$soruSayac]["id"] = $row['id'];
                    $sorular[$soruSayac]["soru"] = $row['soru'];
                    $sorular[$soruSayac]["resim"] = $row['resim'];
                    $sorular[$soruSayac]["cevap"] = $row['cevap'];
                    $sorular[$soruSayac]["secenek1"] = $row['secenek1'];
                    $sorular[$soruSayac]["secenek2"] = $row['secenek2'];
                    $sorular[$soruSayac]["secenek3"] = $row['secenek3'];
                    $sorular[$soruSayac]["sinif"] = $row['sinif'];
                    $sorular[$soruSayac]["cozum"] = $row['cozum'];
                    $sorular[$soruSayac]["testadi"] = $row['testadi'];

                    echo "
                    <script>
            
                        sorularId['$soruSayac'] = '$row[id]';

                    </script>
                    ";
                }
            }
        }

        //print_r($soruSayac);
        // print_r($sorular);
        ?>

    <main role="main">
        <button id="mySidepanelButton" class="openbtn" onclick="openNav()">☰ Sınıflar</button> 

        <div class="container-fluid questionsList mb-5">
        
        <?php
            if(!empty($_GET["sinif"])){
                if(!empty($_GET["testadi"])) { // Bilgilerin göründüğü ekran ---------------------
        ?>
                    <div class="header pt-2 mt-4">
                        <div class="row">
                            <div class="col-8">
                                <h1 class="text-center"><?php echo $sinif ?>. Sınıf Soruları - <?php echo $testadi ?> Testi</h1>
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
                                        <li role="presentation"><a role="menuitem" tabindex="-1" href="sorular.php?sinif=<?php echo $_GET['sinif']; ?>&&testadi=YOK">Test Adı Olmayanlar</a></li>
                                    <?php
                                        }
                                    ?>


                                        <?php
                                            $sql = mysqli_query(baglanti(),"Select * from testadi where sinif='$sinif'");
                                                
                                            while($row = mysqli_fetch_array($sql)){
                                                if($_GET['testadi'] != $row['adi']) {
                                        ?>
                                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="sorular.php?sinif=<?php echo $_GET['sinif']; ?>&&testadi=<?php echo $row['adi']?>"><?php echo $row['adi']; ?></a></li>
                                            
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
                                        <th scope="col">Soru</th>
                                        <th scope="col">Resim</th>
                                        <th scope="col">Cevap</th>
                                        <th scope="col">Seçenek 1</th>
                                        <th scope="col">Seçenek 2</th>
                                        <th scope="col">Seçenek 3</th>
                                        <th scope="col">Sınıf</th>
                                        <th scope="col">Çözüm</th>
                                        <th scope="col">Test Adı</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        for ($i = 1; $i <= $soruSayac; $i++) {
                                            ?>
                                                <tr>
                                                    <th><?php echo $i ?></th>
                                                    <td ondblclick="itemDoubleClick(this,sorularId[<?php echo $i; ?>], 'soru')"><?php echo $sorular[$i]["soru"] ?></td>
                                                    <td ondblclick="itemDoubleClick(this,sorularId[<?php echo $i; ?>], 'resim')"><img src="uploads/<?php echo $sorular[$i]["resim"] ?>" width="100px" height="100px" alt="soru resmi"></td>
                                                    <td ondblclick="itemDoubleClick(this,sorularId[<?php echo $i; ?>], 'cevap')"><?php echo $sorular[$i]["cevap"] ?></td>
                                                    <td ondblclick="itemDoubleClick(this,sorularId[<?php echo $i; ?>], 'secenek1')"><?php echo $sorular[$i]["secenek1"] ?></td>
                                                    <td ondblclick="itemDoubleClick(this,sorularId[<?php echo $i; ?>], 'secenek2')"><?php echo $sorular[$i]["secenek2"] ?></td>
                                                    <td ondblclick="itemDoubleClick(this,sorularId[<?php echo $i; ?>], 'secenek3')"><?php echo $sorular[$i]["secenek3"] ?></td>
                                                    <td ondblclick="itemDoubleClick(this,sorularId[<?php echo $i; ?>], 'sinif')"><?php echo $sorular[$i]["sinif"] ?></td>
                                                    <td ondblclick="itemDoubleClick(this,sorularId[<?php echo $i; ?>], 'cozum')"><?php echo $sorular[$i]["cozum"] ?></td>
                                                    <td ondblclick="itemDoubleClick(this,sorularId[<?php echo $i; ?>], 'testadi')"><?php echo $sorular[$i]["testadi"] ?></td>
                                                    <td><a href="deleteQuestions.php?id=<?php echo $sorular[$i]["id"] ?>&&sinif=<?php echo $sinif ?>&&testadi=<?php echo $_GET['testadi'] ?>" class="btn btn-danger">Sil</a></td>
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
                                    <a href="sorular.php?sinif=<?php echo $_GET["sinif"] ?>&&testadi=YOK" class="btn btn-primary mt-4 w-100">Test adı olmayan sorular</a>
                                </div>
        <?php
                        
                                $sql = mysqli_query(baglanti(),"Select * from testadi where sinif='$sinif'");
                        
                                while($row = mysqli_fetch_array($sql)){
        ?>
                                <div class="row">
                                    <a href="sorular.php?sinif=<?php echo $_GET["sinif"] ?>&&testadi=<?php echo $row['adi'] ?>" class="btn btn-primary mt-4 w-100"><?php echo $row['adi'] ?></a>
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
                        <a href="sorular.php?sinif=4" class="btn btn-dark mt-2 mr-2">4. Sınıf</a>
                        <a href="sorular.php?sinif=5" class="btn btn-dark mt-2 mr-2">5. Sınıf</a>
                        <a href="sorular.php?sinif=6" class="btn btn-dark mt-2 mr-2">6. Sınıf</a>
                        <a href="sorular.php?sinif=7" class="btn btn-dark mt-2 mr-2">7. Sınıf</a>
                        <a href="sorular.php?sinif=8" class="btn btn-dark mt-2 mr-2">8. Sınıf</a>
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

    <script>
        var lastClickItem = "";
        var lastClickItemText = "";
        var lastClickItemId = "";
        function itemDoubleClick(which, id, category) {
            if(lastClickItem != ""){
                lastClickItem.innerHTML = lastClickItemText;
            }
            lastClickItem = which;
            lastClickItemText = which.innerHTML;
            lastClickItemId = id;
            lastClickItemCategory = category;
            if(category == "testadi") {
                which.innerHTML = "<form method='POST' action='updateQuestions.php?category="+category+"&&id="+id+"&&sinif=<?php echo $sinif; ?>&&testadi=<?php echo $_GET['testadi'] ?>' enctype='multipart/form-data'><select class='form-control' name='testadi' onchange='testadiChange()'><?php 
                    
                    ?><option selected disabled>Seçiniz...</option><?php

                    $sql = mysqli_query(baglanti(),"Select * from testadi");
                    $lastClickItemText = "<script>lastClickItemText</script>";
                    while($row = mysqli_fetch_array($sql)){
                        ?><option value='<?php echo $row['adi'] ?>'><?php echo $row['adi'] ?></option><?php
                    }
                ?></select></form>";
            }
            else if(category != "resim") {
                if(category == "soru" || category == "cozum") {
                    which.innerHTML = "<form method='POST' action='updateQuestions.php?category="+category+"&&id="+id+"&&sinif=<?php echo $sinif; ?>&&testadi=<?php echo $_GET['testadi'] ?>' enctype='multipart/form-data'> <textarea id='changeText' class='form-control' rows='3' name='"+category+"'></textarea></form>"
                }
                else {
                    which.innerHTML = "<form method='POST' action='updateQuestions.php?category="+category+"&&id="+id+"&&sinif=<?php echo $sinif; ?>&&testadi=<?php echo $_GET['testadi'] ?>' enctype='multipart/form-data'> <input id='changeText' type='text' class='form-control' name='"+category+"'></form>"
                }
                $("#changeText").focus().val("").val(lastClickItemText);
            }
        }
    </script>
    <script>      

        window.addEventListener("keyup", function(event) {
            if (event.keyCode === 13 && !event.shiftKey) {
                if($('#changeText').val().length > 0 ) {
                    if(lastClickItemCategory == "sinif") {
                        if($('#changeText').val() >= 4 && $('#changeText').val() <= 8) {
                            $('form').submit();
                        }
                        else {
                            $('#changeText').val("");
                            $('#changeText').css("borderColor", "#ff8080");
                            $('#changeText').css("boxShadow", "0 0 0 0.2rem rgb(255 0 0 / 25%)");
                            //sınıf 4 ile 8 arasında olmalı
                        }
                    }
                    else {
                        $('form').submit();
                    }
                }
            
                else {
                    $('#changeText').val("");
                    $('#changeText').css("borderColor", "#ff8080");
                    $('#changeText').css("boxShadow", "0 0 0 0.2rem rgb(255 0 0 / 25%)");
                    //bilgi güncellenirken boş bırakılamaz
                }
            }
            else if(event.keyCode === 27) {
                lastClickItem.innerHTML = lastClickItemText;
            }
        });
        
        $(document).on("keypress", 'form', function(e) {
            if (e.keyCode == 13 && !event.shiftKey) {    
                e.preventDefault();
                return false;
            }
        });
    </script>
    <script>
        function testadiChange(){
            $('form').submit();
        }
    </script>

</body>
</html>


<!DOCTYPE html>
<html lang="tr">
<head>
<?php include_once("../sabitler/standardsAdmin.php"); ?>
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
    
<div id="mySidepanel" class="sidepanel" target="merhaba">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
  <a href="ogrenciler.php?sinif=4">4. Sınıf</a>
  <a href="ogrenciler.php?sinif=5">5. Sınıf</a>
  <a href="ogrenciler.php?sinif=6">6. Sınıf</a>
  <a href="ogrenciler.php?sinif=7">7. Sınıf</a>
  <a href="ogrenciler.php?sinif=8">8. Sınıf</a>
</div>
<script>
    
        var ogrencilerId = [];
    </script>
 
    <?php

        if(!empty($_GET["sinif"])){
            $sinif = $_GET["sinif"];
            if(!empty($_GET["subeadi"])) {
                $subeadi = $_GET["subeadi"];

                $ogrenciSayac = 0;
        
                $ogrenciler = array( 1 => array(
                    "id" => "",
                    "adi" => "",
                    "soyadi" => "",
                    "ogrencino" => ""
                ));
        
                $sql = mysqli_query(baglanti(),"Select * from ogrenciler where sinif = '$sinif' and subeadi = '$subeadi'");
        
                while($row = mysqli_fetch_array($sql)){
                    
                    $ogrenciSayac++;
        
                    $ogrenciler[$ogrenciSayac]["id"] = $row['id'];
                    $ogrenciler[$ogrenciSayac]["adi"] = $row['adi'];
                    $ogrenciler[$ogrenciSayac]["soyadi"] = $row['soyadi'];
                    $ogrenciler[$ogrenciSayac]["ogrencino"] = $row['ogrencino'];
                    $ogrenciler[$ogrenciSayac]["sinif"] = $row['sinif'];
                    $ogrenciler[$ogrenciSayac]["subeadi"] = $row['subeadi'];

                    echo "
                    <script>
            
                        ogrencilerId['$ogrenciSayac'] = '$row[id]';

                    </script>
                    ";
                }
            }
        }

        //print_r($ogrenciSayac);
        // print_r($ogrenciler);
        ?>

    <main role="main">
        
        <button id="mySidepanelButton" class="openbtn" onclick="openNav()">☰ Sınıflar</button> 

        <div class="container Students mb-5">
        <?php
            if(!empty($_GET["sinif"])){
                if(!empty($_GET["subeadi"])) { // Bilgilerin göründüğü ekran ---------------------
        ?>
                    <div class="header pt-2 mt-4">
                        <div class="row">
                            <div class="col-8">
                                <h1 class="text-right"><?php echo $_GET["sinif"] ?>. Sınıf Öğrencileri - <?php echo $_GET["subeadi"] ?> Şubesi</h1>
                            </div>
                            <div class="col-4">
                                <div class="dropdown">
                                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown">
                                        Şubeyi Değiş
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                                        
                                        <?php 
                                            if($_GET['subeadi'] != "YOK") {
                                        ?>
                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="ogrenciler.php?sinif=<?php echo $_GET['sinif']; ?>&&subeadi=YOK">Şube Adı Olmayanlar</a></li>
                                        <?php
                                            }
                                        ?>
                                        

                                        <?php
                                            $sql = mysqli_query(baglanti(),"Select * from subeadi");
                                                
                                            while($row = mysqli_fetch_array($sql)){
                                                if($_GET['subeadi'] != $row['adi']) {
                                        ?>
                                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="ogrenciler.php?sinif=<?php echo $_GET['sinif']; ?>&&subeadi=<?php echo $row['adi']?>"><?php echo $row['adi']; ?></a></li>
                                            
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
                                        <th scope="col">Öğrenci No</th>
                                        <th scope="col">Adı</th>
                                        <th scope="col">Soyadı</th>
                                        <th scope="col">Sınıfı</th>
                                        <th scope="col">Şubesi</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        for ($i = 1; $i <= $ogrenciSayac; $i++) {
                                            ?>
                                                <tr>
                                                    <th><?php echo $i ?></th>
                                                    <td ondblclick="itemDoubleClick(this,ogrencilerId[<?php echo $i; ?>], 'ogrencino')"><?php echo $ogrenciler[$i]["ogrencino"] ?></td>
                                                    <td ondblclick="itemDoubleClick(this,ogrencilerId[<?php echo $i; ?>], 'adi')"><?php echo $ogrenciler[$i]["adi"] ?></td>
                                                    <td ondblclick="itemDoubleClick(this,ogrencilerId[<?php echo $i; ?>], 'soyadi')"><?php echo $ogrenciler[$i]["soyadi"] ?></td>
                                                    <td ondblclick="itemDoubleClick(this,ogrencilerId[<?php echo $i; ?>], 'sinif')"><?php echo $ogrenciler[$i]["sinif"] ?></td>
                                                    <td ondblclick="itemDoubleClick(this,ogrencilerId[<?php echo $i; ?>], 'subeadi')"><?php echo $ogrenciler[$i]["subeadi"] ?></td>
                                                    <td>
                                                        <a href="deleteStudents.php?id=<?php echo $ogrenciler[$i]["id"] ?>&&sinif=<?php echo $sinif ?>&&subeadi=<?php echo $_GET['subeadi'] ?>" class="btn btn-danger">Sil</a>
                                                        <a href="sonuc.php?ogrencino=<?php echo $ogrenciler[$i]["ogrencino"] ?>&&sinif=<?php echo $sinif ?>" class="btn btn-success">Sonuçlar</a>
                                                    </td>
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
                else { // Şube Adı seçme ekranı -----------------------
        ?>
                    <div class="header pt-2 mt-4">
                        <h1 class="text-center">Şube Adı</h1>
            
                        <hr width="61px">
                    </div>
                    <div class="container">
                        <div class="row d-flex justify-content-center">
                            <div>
                                <div class="row">
                                    <a href="ogrenciler.php?sinif=<?php echo $_GET["sinif"] ?>&&subeadi=YOK" class="btn btn-primary mt-4 w-100">Şubesi olmayan öğrenciler</a>
                                </div>
        <?php
                                $sql = mysqli_query(baglanti(),"Select * from subeadi where sinif='$sinif'");
                        
                                while($row = mysqli_fetch_array($sql)){
        ?>
                                <div class="row">
                                    <a href="ogrenciler.php?sinif=<?php echo $_GET["sinif"] ?>&&subeadi=<?php echo $row['adi'] ?>" class="btn btn-primary mt-4 w-100"><?php echo $row['adi'] ?></a>
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
                        <a href="ogrenciler.php?sinif=4" class="btn btn-dark mt-2 mr-2">4. Sınıf</a>
                        <a href="ogrenciler.php?sinif=5" class="btn btn-dark mt-2 mr-2">5. Sınıf</a>
                        <a href="ogrenciler.php?sinif=6" class="btn btn-dark mt-2 mr-2">6. Sınıf</a>
                        <a href="ogrenciler.php?sinif=7" class="btn btn-dark mt-2 mr-2">7. Sınıf</a>
                        <a href="ogrenciler.php?sinif=8" class="btn btn-dark mt-2 mr-2">8. Sınıf</a>
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
            if(category == "subeadi") {
                which.innerHTML = "<form method='POST' action='updateStudents.php?category="+category+"&&id="+id+"&&sinif=<?php echo $sinif; ?>&&subeadi=<?php echo $_GET['subeadi'] ?>' enctype='multipart/form-data'><select class='form-control' name='subeadi' onchange='subeadiChange()'><?php 
                    
                    ?><option selected disabled>Seçiniz...</option><?php

                    $sql = mysqli_query(baglanti(),"Select * from subeadi");
                    $lastClickItemText = "<script>lastClickItemText</script>";
                    while($row = mysqli_fetch_array($sql)){
                        ?><option value='<?php echo $row['adi'] ?>'><?php echo $row['adi'] ?></option><?php
                    }
                ?></select></form>";
            }
            else {
                
                which.innerHTML = "<form method='POST' action='updateStudents.php?category="+category+"&&id="+id+"&&sinif=<?php echo $sinif; ?>&&subeadi=<?php echo $_GET['subeadi'] ?>' enctype='multipart/form-data'> <input id='changeText' type='text' class='form-control' name='"+category+"'></form>"
                
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
        function subeadiChange(){
            $('form').submit();
        }
    </script>
    
</body>
</html>
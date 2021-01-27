
<!DOCTYPE html>
<html lang="tr">
<head>
<?php include_once("../sabitler/standardsAdmin.php"); ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fatih Özcan</title>

    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />

    <link rel="stylesheet" href="../css/style.css?v=6" >

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
                    <a class="nav-link active pl-4" href="yeniogrenci.php">Yeni Öğrenci</a>
                    <a class="nav-link pl-4" href="ogrenciler.php">Öğrenciler</a>
                    <a class="nav-link pl-4" href="testsonuclar.php">Test Sonuçları</a>
                    <a class="nav-link pl-4" href="signOut.php"><i class="fas fa-sign-out-alt"></i></a>
                </div>
          </div>
        </div>
    </nav>
    
<div id="mySidepanel" class="sidepanel">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
  <a href="yeniogrenci.php?sinif=4">4. Sınıf</a>
  <a href="yeniogrenci.php?sinif=5">5. Sınıf</a>
  <a href="yeniogrenci.php?sinif=6">6. Sınıf</a>
  <a href="yeniogrenci.php?sinif=7">7. Sınıf</a>
  <a href="yeniogrenci.php?sinif=8">8. Sınıf</a>
</div>

    <main role="main">
        
        <button id="mySidepanelButton" class="openbtn" onclick="openNav()">☰ Sınıflar</button> 

        <div class="container studentsCreate mb-5">
        <?php
            if(!empty($_GET["sinif"])){
                if(!empty($_GET["subeadi"])) { // Bilgi giriş ekranı -----------------------
        ?>
            <div class="header pt-2 mt-4">
                <div class="row">
                    <div class="col-8">
                        <h1 class="text-center">Öğrenci Kaydet - <?php echo $_GET["sinif"] ?>. Sınıf - <?php echo $_GET["subeadi"] ?> Şubesi</h1>
                    </div>
                    <div class="col-4">
                        <div class="dropdown">
                            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown">
                                Şubeyi Değiş
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                                   
                                <?php
                                    $sql = mysqli_query(baglanti(),"Select * from subeadi");
                                        
                                    while($row = mysqli_fetch_array($sql)){
                                        if($_GET['subeadi'] != $row['adi']) {
                                ?>
                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="yeniogrenci.php?sinif=<?php echo $_GET['sinif']; ?>&&subeadi=<?php echo $row['adi']?>"><?php echo $row['adi']; ?></a></li>
                                    
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
            <form class="mt-5 needs-validation" method="POST" action="saveStudents.php?subeadi=<?php echo $_GET["subeadi"] ?>&&sinif=<?php echo $_GET["sinif"] ?>" enctype="multipart/form-data" novalidate>
                <div class="form-group row">
                    <div class="col-4">
                        <label class="mt-1">Öğrenci No</label>
                    </div>
                    <div class="col-8">
                        <input type="text" class="form-control" placeholder="Öğrenci No" name="ogrencino" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-4">
                        <label class="mt-1">Adı</label>
                    </div>
                    <div class="col-8">
                        <input type="text" class="form-control" placeholder="Adı" name="adi" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-4 d-flex align-items-center">
                        <label>Soyadı</label>
                    </div>
                    <div class="col-8">
                        <input type="text" class="form-control" placeholder="Soyadı" name="soyadi" required>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Kaydet</button>
                    <button type="reset" class="btn btn-secondary">Temizle</button>
                </div>
            </form>
        <?php
        
                }
                else {// Şube adı seçim ekranı -------------------------
                       
        ?>
                    <div class="header pt-2 mt-4">
                        <h1 class="text-center">Şube Adı</h1>
            
                        <hr width="61px">
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-6">
        <?php
                    
                        $sql = mysqli_query(baglanti(),"Select * from subeadi");
                
                        while($row = mysqli_fetch_array($sql)){
        ?>
                        <div class="row">
                            <a href="yeniogrenci.php?sinif=<?php echo $_GET["sinif"] ?>&&subeadi=<?php echo $row['adi'] ?>" class="btn btn-primary mt-4 w-50"><?php echo $row['adi'] ?></a>
                            <span class="subeSil" onclick="subeSil(<?php echo $row['id'] ?>)">X</span>
                        </div>
        <?php
                        }
        ?>
                            </div>
                            <div class="col-6">
                                <form class="mt-5 needs-validation" method="POST" action="saveBranchName.php?sinif=<?php echo $_GET['sinif'] ?>" enctype="multipart/form-data" novalidate>
                                    
                                    <input type="text" class="form-control" placeholder="Yeni Şube Adı" name="subeadi" required>
                                    <button type="submit" class="btn btn-success mt-4">Kaydet</button>

                                </form>
                            </div>
                        </div>
                    </div>
                    
        <?php
                }
            }
            else { // Sınıf seçim ekranı ------------------------
        ?>

            <div class="header pt-2 mt-4">
                <h1 class="text-center">Kaçıncı sınıf</h1>
    
                <hr width="61px">
            </div>
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div>
                        <a href="yeniogrenci.php?sinif=4" class="btn btn-dark mt-2 mr-2">4. Sınıf</a>
                        <a href="yeniogrenci.php?sinif=5" class="btn btn-dark mt-2 mr-2">5. Sınıf</a>
                        <a href="yeniogrenci.php?sinif=6" class="btn btn-dark mt-2 mr-2">6. Sınıf</a>
                        <a href="yeniogrenci.php?sinif=7" class="btn btn-dark mt-2 mr-2">7. Sınıf</a>
                        <a href="yeniogrenci.php?sinif=8" class="btn btn-dark mt-2 mr-2">8. Sınıf</a>
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

    <!-- Validation -->
    <script>
        // Disable form submissions if there are invalid fields
        (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Get the forms we want to add validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
            });
        }, false);
        })();
    </script>
    <script>
        function subeSil(id){
            window.location.href = "deleteBranch.php?id="+id+"&&sinif="+<?php echo $_GET["sinif"] ?>+"";
        }
    </script>
</body>
</html>
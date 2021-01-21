
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
                <a class="navbar-brand" href="yenisoru.php">Fatih ÖZCAN</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav ml-auto">
                        <a class="nav-link pl-4" href="yenisoru.php">Yeni Soru</a>
                        <a class="nav-link pl-4" href="sorular.php">Sorular</a>
                        <a class="nav-link pl-4" href="yeniogrenci.php">Yeni Öğrenci</a>
                        <a class="nav-link pl-4" href="ogrenciler.php">Öğrenciler</a>
                        <a class="nav-link active pl-4" href="testata.php">Test Ata</a>
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

            <div class="container testGive mb-5">
                <div class="header pt-2 mt-4">
                    <h1 class="text-center">Test Ata</h1>
                        
                    <hr width="61px">
                </div>
                <form class="mt-5 needs-validation" method="POST" action="testGive.php" enctype="multipart/form-data" novalidate>

                    <div class="form-group row">
                        <div class="col-4">
                            <label class="mt-1">Sınıf</label>
                        </div>
                        <div class="col-8">
                            <select class="form-control" name="sinif" required>
                                <option value="" disabled selected>Seçiniz...</option>
                                <option value="4">4. Sınıf</option>
                                <option value="5">5. Sınıf</option>
                                <option value="6">6. Sınıf</option>
                                <option value="7">7. Sınıf</option>
                                <option value="8">8. Sınıf</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-4">
                            <label class="mt-1">Şube</label>
                        </div>
                        <div class="col-8">
                            <select class="form-control" name="sube" required>
                                <option value="" disabled selected>Seçiniz...</option>
                                <option value="hepsi">Hepsi</option>
                                
                                <?php
                                    $sql = mysqli_query(baglanti(),"Select * from subeadi");
                                        
                                    while($row = mysqli_fetch_array($sql)){
                                ?>
                                        <option value="<?php echo $row['adi'] ?>"><?php echo $row['adi'] ?></option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-4">
                            <label class="mt-1">Test</label>
                        </div>
                        <div class="col-8">
                            <select class="form-control" name="test" required>
                                <option value="" disabled selected>Seçiniz...</option>                                
                                <?php
                                    $sql = mysqli_query(baglanti(),"Select * from testadi");
                                        
                                    while($row = mysqli_fetch_array($sql)){
                                ?>
                                        <option value="<?php echo $row['adi'] ?>"><?php echo $row['adi'] ?></option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success w-25">Ata</button>
                    </div>
                </form>

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
    </body>
</html>
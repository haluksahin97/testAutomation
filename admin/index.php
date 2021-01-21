<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        session_start();
        
        if(!empty($_SESSION['admin'])) {
            header("location:yenisoru.php");
        }
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fatih Özcan</title>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />

    <link rel="stylesheet" href="../css/style.css?v=5" >

</head>
<body>
    
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="header pt-5x mt-5">
                    <h1 class="text-center">Test Otomasyonu Giriş</h1>
        
                    <hr width="61px">
                </div>
                <form class="mt-5 needs-validation" action="adminLogin.php" method="POST" novalidate>
                    <div class="form-group row">
                        <div class="col-4">
                            <label class="mt-1">Kullanıcı Adınız</label>
                        </div>
                        <div class="col-8">
                            <input type="text" class="form-control" placeholder="Kullanıcı Adı" value="<?php if(!empty($_GET['username'])){ echo $_GET['username'];} ?>" name="username" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-4">
                            <label class="mt-1">Şifreniz</label>
                        </div>
                        <div class="col-8">
                            <input type="password" class="form-control" placeholder="Şifreniz" name="password" required>
                        </div>
                    </div>
                    <?php
                    if(!empty($_GET['username'])) {
                    ?>
                        <div class="form-group row">
                            <div class="col-12">
                                <label class="mt-1 text-danger">Kullanıcı adınız ya da şifreniz hatalı. Kontrol edip tekrar giriniz.</label>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                    <div class="form-group row">
                        <div class="col-8 offset-4">
                            <button type="submit" class="btn btn-dark w-100">Giriş</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    
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
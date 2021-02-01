<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        session_start();
        
        if(!empty($_SESSION['student'])) {
            header("location:index.php");
        }
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fatih Özcan</title>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />

    <link rel="stylesheet" href="../css/style.css?v=15" >

</head>
<body>
    <?php
        $errors = array();
        if(!empty($_GET['error'])) {
            $error = $_GET['error'];
            $errors = unserialize($error);
        }
    ?>
    <div class="container studentLogin">
        <div class="row mt-5">
            <div class="col-lg-6 offset-lg-3 p-5 mt-5 border">
                <div class="mt-5 mb-5">
                    <div class="header">
                        <h1 class="text-center">Öğrenci Kaydı</h1>
            
                        <hr width="61px">
                    </div>
                    <form class="mt-5 needs-validation" action="studentRegister.php" method="POST" oninput='passwordRepeat.setCustomValidity(passwordRepeat.value != password.value ? "Şifreler eşleşmiyor" : "")' novalidate>
                        <?php include_once('errors.php'); ?>
                        <div class="form-group row">
                            <div class="col-4">
                                <label class="mt-1">Öğrenci Numaranız</label>
                            </div>
                            <div class="col-8">
                                <input type="text" class="form-control" placeholder="Öğrenci Numaranız" value="<?php if(!empty($_GET['ogrencino'])){ echo $_GET['ogrencino'];} ?>" name="ogrencino" pattern="\d*" required>
                                <div class="invalid-feedback">Öğrenci numaranız sadece sayı bulundurabilir!</div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-4">
                                <label class="mt-1">Adınız</label>
                            </div>
                            <div class="col-8">
                                <input type="text" class="form-control" placeholder="Adınız" value="<?php if(!empty($_GET['name'])){ echo $_GET['name'];} ?>" name="name" pattern="[a-zA-ZıİğĞüÜşŞöÖçÇ ]+" required>
                                <div class="invalid-feedback">Adınız sadece harf bulundurabilir!</div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-4">
                                <label class="mt-1">Soyadınız</label>
                            </div>
                            <div class="col-8">
                                <input type="text" class="form-control" placeholder="Soyadınız" value="<?php if(!empty($_GET['surname'])){ echo $_GET['surname'];} ?>" name="surname" pattern="[a-zA-ZıİğĞüÜşŞöÖçÇ ]+" required>
                                <div class="invalid-feedback">Soyadınızda sadece harf bulundurabilir!</div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-4">
                                <label class="mt-1">Sınıfınız</label>
                            </div>
                            <div class="col-8">
                                <select class="form-control" name="class" required>
                                    <option value="" disabled selected>Seçiniz...</option>
                                    <option value="4">4. Sınıf</option>
                                    <option value="5">5. Sınıf</option>
                                    <option value="6">6. Sınıf</option>
                                    <option value="7">7. Sınıf</option>
                                    <option value="8">8. Sınıf</option>
                                </select>
                                <div class="invalid-feedback">Sınıfınızı seçiniz!</div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-4">
                                <label class="mt-1">Şifreniz</label>
                            </div>
                            <div class="col-8">
                                <input type="password" class="form-control" placeholder="Şifreniz" name="password" minlength="6" maxlength="6" required>
                                <div class="invalid-feedback">Şifreniz 6 karakter olmalıdır!</div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-4">
                                <label class="mt-1">Şifre Tekrarı</label>
                            </div>
                            <div class="col-8">
                                <input type="password" class="form-control" placeholder="Şifre Tekrarı" name="passwordRepeat" minlength="6" maxlength="6"  required>
                                <div class="invalid-feedback">Şifreleriniz aynı değil! Lütfen kontrol ediniz.</div>
                            </div>
                        </div>
                        <?php
                        if(!empty($_GET['username'])) {
                        ?>
                            <div class="form-group row">
                                <div class="col-12">
                                    <label class="mt-1 text-danger">Öğrenci numaranız ya da şifreniz hatalı. Kontrol edip tekrar giriniz.</label>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                        <div class="form-group row">
                            <div class="col-8 offset-4">
                                <button type="submit" class="btn btn-dark w-100" name="register">Giriş</button>
                            </div>
                        </div>
                    </form>
                    <div class="text-center mt-4">
                        <a href="giris.php">Giriş Yap!</a>
                    </div>
                </div>
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
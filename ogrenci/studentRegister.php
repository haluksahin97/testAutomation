<?php 

session_start();
include_once("../sabitler/sabit.php");
include_once("../sabitler/baglanti.php");

$errors = array(); 

if(isset($_POST['register'])) {
    $studentNo = mysqli_real_escape_string(baglanti(), $_POST['ogrencino']);
    $name = mysqli_real_escape_string(baglanti(), $_POST['name']);
    $surname = mysqli_real_escape_string(baglanti(), $_POST['surname']);
    $class = mysqli_real_escape_string(baglanti(), $_POST['class']);
    $password = mysqli_real_escape_string(baglanti(), $_POST['password']);
    $passwordRepeat = mysqli_real_escape_string(baglanti(), $_POST['passwordRepeat']);
}

if (empty($studentNo)) { array_push($errors, "Öğrenci numarası boş bırakılamaz!"); }
if (strlen($studentNo) > 15 ) { array_push($errors, "Öğrenci numarası çok uzun!"); }
if (empty($name)) { array_push($errors, "Ad boş bırakılamaz!"); }
if (strlen($name) > 50) { array_push($errors, "Adınız çok uzun!"); }
if (empty($surname)) { array_push($errors, "Soyad boş bırakılamaz!"); }
if (strlen($surname) > 50) { array_push($errors, "Soyadınız çok uzun!"); }
if (empty($class)) { array_push($errors, "Sınıf boş bırakılamaz!"); }
if (strlen($class) > 3) { array_push($errors, "Sınıf çok uzun!"); }
if (empty($password)) { array_push($errors, "Şifre boş bırakılamaz!"); }
if (strlen($password) > 6) { array_push($errors, "Şifreniz çok uzun!"); }
if ($password != $passwordRepeat) { array_push($errors, "Şifreleriniz eşleşmiyor!"); }


$sql = mysqli_query(baglanti(),"Select * from ogrenciler Where ogrencino='$studentNo' LIMIT 1");
$row = mysqli_fetch_array($sql);

if($row) {
    array_push($errors, "Öğrenci numarası zaten kayıtlı!");
}

if(count($errors) == 0) {
    $password = md5($password);

    $sql = mysqli_query(baglanti(), "Insert Into ogrenciler (ogrencino, adi, soyadi, sinif, subeadi, password) Values ('$studentNo', '$name', '$surname', '$class', 'YOK', '$password')");

    $_SESSION['student'] = $studentNo;

    header('location: index.php');
}
else {
    $error = serialize($errors);
    header("location: kayitol.php?error=$error&&ogrencino=$studentNo&&name=$name&&surname=$surname&&class=$class");
}


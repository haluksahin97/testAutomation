<?php
session_start();
$_SESSION['student'] = null;
header("location:index.php");
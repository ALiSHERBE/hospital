<?php
require_once "config/connect.php";

$person_id = $_GET['person_id'];
$doctor_id = $_GET['doctor_id'];

$doctor = mysqli_query($connect, "SELECT * FROM `doctors` WHERE doctor_id = '$doctor_id'");
$doctor = mysqli_fetch_assoc($doctor);

$person = mysqli_query($connect, "SELECT * FROM `people` WHERE person_id = '$person_id'");
$person = mysqli_fetch_assoc($person);

$pagetitle = "Редактируем: ".$person['fio'];

$tpl = "pages/edit.tpl.php";
include "layout.php";

mysqli_close($connect);

// см паттерн разделения: https://stackoverflow.com/questions/5183163/using-php-include-to-separate-site-content
// но все же лучше писать на готовых фреймворках, как например Laravel

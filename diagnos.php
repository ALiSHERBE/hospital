<?php
require_once "config/connect.php";

$person_id = $_GET['person_id'];
$doctor_id = $_GET['doctor_id'];
$id_visits = $_GET['id_visits'];

$doctor = mysqli_query($connect, "SELECT * FROM `doctors` WHERE doctor_id = '$doctor_id'");
$doctor = mysqli_fetch_assoc($doctor);

$person = mysqli_query($connect, "SELECT * FROM `people` WHERE person_id = '$person_id'");
$person = mysqli_fetch_assoc($person);

$patient = mysqli_query($connect, "SELECT * FROM `patients` WHERE person_id = '$person_id'");
$patient = mysqli_fetch_assoc($patient);

$visit = mysqli_query($connect, "SELECT * FROM `visits` WHERE id_visits = '$id_visits'");
$visit = mysqli_fetch_assoc($visit);

$tpl = "pages/diagnos.tpl.php";
include "layout.php";

mysqli_close($connect);

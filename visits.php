<?php
require_once "config/connect.php";

$prescription = $_POST['prescription'];
$advice = $_POST['advice'];
$diagnos = $_POST['diagnos'];
$complains = $_POST['complains'];
$next_visit = $_POST['next_visit'];

$person_id = $_POST['person_id'];
$doctor_id = $_POST['doctor_id'];
$id_visits = $_POST['id_visits'];
$healthy = $_POST['healthy'];

if ($healthy == 1 && $id_visits > 0) {
	$query = "DELETE FROM `doctorsvisit` WHERE `doctorsvisit`.`id_visits` = $id_visits";
	$people = mysqli_query($connect, $query);

//	$query = "DELETE FROM `visits` WHERE `visits`.`id_visits` = $id_visits";
//	$people = mysqli_query($connect, $query);
} else {
	$query = "UPDATE `visits` SET `prescription` = '".$prescription."', `advice` = '".$advice."', `diagnos` = '".$diagnos."', `next_visit` = '".$next_visit."', `complains` = '".$complains."' WHERE `visits`.`id_visits` = $id_visits";
	$visit = mysqli_query($connect, $query);
}

$query = "UPDATE `patients` SET `healthy` = '".$healthy."' WHERE `patients`.`person_id` = $person_id";
$patient = mysqli_query($connect, $query);

$pagetitle = "Данные изменены";
$title = "Данные изменены";
$description = "";

$tpl = "pages/info.tpl.php";
include "layout.php";

mysqli_close($connect);

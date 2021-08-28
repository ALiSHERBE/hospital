<?php
require_once "config/connect.php";

$related_hospital = $_POST['related_hospital'];
$inn = $_POST['inn'];
$alive = $_POST['alive'];
$datetime = $_POST['datetime'];
$person_id = $_POST['person_id'];
$doctor_id = $_POST['doctor_id'];
$healthy = $_POST['healthy'];
$id_visits = $_POST['id_visits'];

$query = "INSERT INTO `patients` (`related_hospital`, `inn`, `person_id`, `alive`, `healthy`) 
	VALUES ('".$related_hospital."', '".$inn."', '".$person_id."', '".$alive."', '".$healthy."');";
$patient = mysqli_query($connect, $query);
$patient_id = mysqli_insert_id($connect);

$query = "INSERT INTO `visits` (`prescription`, `advice`, `diagnos`, `next_visit`, `complains`, `date_of_visit`) 
VALUES ('', '', '', '','', '".$datetime."');";
$visit = mysqli_query($connect, $query);
$visit_id = mysqli_insert_id($connect);

$medkart = mysqli_query($connect, "SELECT * FROM `medkarts` WHERE doctor_id = '$doctor_id' and person_id = '$person_id'");
$medkart = mysqli_fetch_assoc($medkart);
$medkart_id = $medkart['medkart_id'];

$query = "INSERT INTO `doctorsvisit` (`id_visits`, `medkart_id`) 
VALUES ('".$visit_id."', '".$medkart_id."');";
$doctorsvisit = mysqli_query($connect, $query);
$doctorsvisit = mysqli_insert_id($connect);

$pagetitle = "Время назначено!";
$title = "Время назначено!";
$description = "";

$tpl = "pages/info.tpl.php";
include "layout.php";

mysqli_close($connect);

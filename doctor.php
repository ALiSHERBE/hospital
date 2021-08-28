<?php
require_once "config/connect.php";

$doctor_id = $_POST['doctor_id'];
$gender = [
	'Ж',
	'М',
];

$doctor = mysqli_query($connect, "SELECT * FROM `doctors` WHERE doctor_id = '$doctor_id'");
$doctor = mysqli_fetch_assoc($doctor);

$pagetitle = "Добро пожаловать ".$doctor['fio'];

$query = "SELECT people.person_id, people.fio, people.passport, people.address, people.gender
 FROM people 
 LEFT JOIN patients ON people.person_id=patients.person_id
 LEFT JOIN medkarts ON people.person_id=medkarts.person_id
 WHERE patients.person_id IS NULL
 AND medkarts.doctor_id = '$doctor_id';";

$patients = mysqli_query($connect, $query);
$patients = mysqli_fetch_all($patients, MYSQLI_ASSOC);

$query = "SELECT medkarts.medkart_id, medkarts.doctor_id, medkarts.person_id, doctorsvisit.*, visits.*, people.fio
 FROM medkarts 
 LEFT JOIN doctorsvisit ON medkarts.medkart_id=doctorsvisit.medkart_id
 LEFT JOIN visits ON doctorsvisit.id_visits=visits.id_visits
 LEFT JOIN people ON medkarts.person_id=people.person_id
 WHERE medkarts.doctor_id = '$doctor_id'
 AND doctorsvisit.medkart_id = medkarts.medkart_id;";

$visits = mysqli_query($connect, $query);
$visits = mysqli_fetch_all($visits, MYSQLI_ASSOC);

$tpl = "pages/doctor.tpl.php";
include "layout.php";

mysqli_close($connect);

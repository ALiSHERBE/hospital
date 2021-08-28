<?php
require_once "config/connect.php";
$pagetitle = "Страница информации";

if (isset($_POST['btn_apply']) || $_GET['person_id']) {
	$show_form = false;
	$person_id = trim($_GET['person_id']);

	// по хорошему надо сделать проверку на sql иньекции
	$passport = $_POST['passport'];
	$person = mysqli_query($connect, "SELECT person_id, fio FROM `people` WHERE `passport` = '$passport'");
	$person = mysqli_fetch_assoc($person);

	if ($person != null){
		$person_id = $person['person_id'];

		$insurance = mysqli_query($connect, "SELECT * FROM `currentinsurance` WHERE `person_id` = '$person_id'");
		$insurance = mysqli_fetch_assoc($insurance);
		if (time() < strtotime($insurance['date_of_beginning'])){
			$title = 'Ошибка';
			$description = 'Ваша страховка еще не вступила в силу';
			$tpl = "pages/info.tpl.php";
			include "layout.php";
			mysqli_close($connect);
			die();
		}
		if (time() > strtotime($insurance['date_of_end'])){
			$title = 'Ошибка';
			$description = 'Ваша страховка просрочена';
			$tpl = "pages/info.tpl.php";
			include "layout.php";
			mysqli_close($connect);
			die();
		}

		$patient_res = mysqli_query($connect, "SELECT person_id, healthy FROM `patients` WHERE `person_id` = '$person_id'");
		$patient = mysqli_fetch_assoc($patient_res);

		if ($patient_res->num_rows == 0) {
			$title = 'Сообщение';
			$description = 'Вашу заявку пока не обработали, пожалуйста, попробуйте проверить позже';
			$tpl = "pages/info.tpl.php";
			include "layout.php";
			mysqli_close($connect);
			die();
		}

		if ($patient['healthy'] == 1){
			$title = $person['fio']." - Вы здоровы!";
			$description = '';
			$link = '/apply.php?person_id='.$person['person_id'];
			$link_text = 'Хотите записаться на новый прием?';
			$tpl = "pages/info.tpl.php";
			include "layout.php";
			mysqli_close($connect);
			die();
		}

		$patient_id = $patient['person_id'];

		// medkarts

		$query = "SELECT people.person_id, people.fio, people.passport, people.address, people.gender, 
			patients.related_hospital, patients.inn, patients.person_id, 
			medkarts.doctor_id, medkarts.disease_id, medkarts.medkart_id, 
			doctorsvisit.id_visits, 
			visits.*,
			doctors.fio as doctor_fio, doctors.cabinet
		 FROM people 
		 LEFT JOIN patients ON people.person_id=patients.person_id
		 LEFT JOIN medkarts ON people.person_id=medkarts.person_id
		 AND medkarts.medkart_id = 
        (
           SELECT MAX(medkart_id) 
           FROM medkarts
           WHERE medkarts.person_id = people.person_id
        )
		 LEFT JOIN doctorsvisit ON medkarts.medkart_id=doctorsvisit.medkart_id
		 LEFT JOIN visits ON doctorsvisit.id_visits=visits.id_visits
		 LEFT JOIN doctors ON medkarts.doctor_id=doctors.doctor_id
		 WHERE patients.person_id = people.person_id
		 AND people.person_id = $person_id;";

		$person = mysqli_query($connect, $query);
		$person = mysqli_fetch_assoc($person);

		$pagetitle = "Добро пожаловать ".$person['fio'];

		$current_date = date("Y-m-d");
	} else {
		$show_form = true;

		$person = mysqli_query($connect, "SELECT * FROM `people` WHERE person_id = '$person_id'");
		$person = mysqli_fetch_assoc($person);

		$insurances = mysqli_fetch_all(
			mysqli_query($connect, "SELECT * FROM `insurances`"),
			MYSQLI_ASSOC
		);

		$professions = mysqli_fetch_all(
			mysqli_query($connect, "SELECT * FROM `doctor_professions`"),
			MYSQLI_ASSOC
		);
	}

	$tpl = "pages/apply.tpl.php";
	include "layout.php";
} else {
	header("HTTP/1.0 404 Not Found");
	$tpl = "pages/404.tpl.php";
	include "layout.php";
}

mysqli_close($connect);
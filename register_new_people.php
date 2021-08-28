<?php
require_once "config/connect.php";
// тут должна быть валидация и защита от SQL иньекций

if (trim($_POST['fio']) == ''){
	$title = 'Ошибка';
	$description = 'Введите Ф.И.О';
	$tpl = "pages/info.tpl.php";
	include "layout.php";
	mysqli_close($connect);
	die();
}

if (trim($_POST['doctor']) == ''){
	$title = 'Ошибка';
	$description = 'Выберите доктора';
	$tpl = "pages/info.tpl.php";
	include "layout.php";
	mysqli_close($connect);
	die();
}

$person_id = $_POST['person_id'];

if ($person_id){
	$query = "UPDATE `people` SET `age` = '".$_POST['age']."', `address` = '".$_POST['address']."', `email` = '".$_POST['email']."' WHERE `people`.`person_id` = $person_id";
	$people = mysqli_query($connect, $query);

	$query = "INSERT INTO `diseases` (`disease_id`, `classification_code`, `name`) 
	VALUES (NULL, '".rand(1, 1000000)."', '".$_POST['complaint']."');";
	$person = mysqli_query($connect, $query);
	$disease_id = mysqli_insert_id($connect);

	$query = "INSERT INTO `medkarts` (`doctor_id`, `disease_id`, `date_of_discharge`, `person_id`) 
	VALUES ('".$_POST['doctor']."', '".$disease_id."', '".date('Y-m-d H:i:s')."', '".$person_id."');";
	$medkart = mysqli_query($connect, $query);
	$medkart_id = mysqli_insert_id($connect);

	$query = "DELETE FROM `patients` WHERE `patients`.`person_id` = $person_id";
	$people = mysqli_query($connect, $query);

	$pagetitle = "Ваша заявка принята!";

	$tpl = "pages/register_new_people.tpl.php";
	include "layout.php";
} else {
	mysqli_begin_transaction($connect);
	try {
		$query = "INSERT INTO `people` (`person_id`, `fio`, `passport`, `age`, `address`, `email`, `gender`) 
		VALUES (NULL, '".$_POST['fio']."', '".$_POST['passport']."', '".$_POST['age']."', '".$_POST['address']."', '".$_POST['email']."', '".$_POST['gender']."');";
		$person = mysqli_query($connect, $query);
		$person_id = mysqli_insert_id($connect);

		$current_date = date('Y-m-d');
		mysqli_query($connect, "INSERT INTO `currentinsurance` (`person_id`, `insurance_id`, `date_of_beginning`, `date_of_end`) 
		VALUES ('".$person_id."', '" . $_POST['insurance'] . "', '" . $current_date . "', '" . date('Y-m-d', strtotime($current_date. ' + 1 years')) . "');");

		$query = "INSERT INTO `diseases` (`disease_id`, `classification_code`, `name`) 
		VALUES (NULL, '".rand(1, 1000000)."', '".$_POST['complaint']."');";
		$person = mysqli_query($connect, $query);
		$disease_id = mysqli_insert_id($connect);

		$query = "INSERT INTO `medkarts` (`doctor_id`, `disease_id`, `date_of_discharge`, `person_id`) 
		VALUES ('".$_POST['doctor']."', '".$disease_id."', '".date('Y-m-d H:i:s')."', '".$person_id."');";
		$medkart = mysqli_query($connect, $query);
		$medkart_id = mysqli_insert_id($connect);

		mysqli_commit($connect);

		$pagetitle = "Ваша заявка принята";

		$tpl = "pages/register_new_people.tpl.php";
		include "layout.php";
	} catch (mysqli_sql_exception $exception) {
		mysqli_rollback($connect);

		throw $exception;
	}
}

mysqli_close($connect);
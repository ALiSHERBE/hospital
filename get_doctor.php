<?php
require_once "config/connect.php";

$id = (int) $_POST['id'];

$person = mysqli_query($connect, "SELECT * FROM `doctors` WHERE `profession_id` = '$id'");
$person = mysqli_fetch_all($person, MYSQLI_ASSOC);

echo json_encode($person);

mysqli_close($connect);

// см паттерн разделения: https://stackoverflow.com/questions/5183163/using-php-include-to-separate-site-content
// но все же лучше писать на готовых фреймворках, как например Laravel

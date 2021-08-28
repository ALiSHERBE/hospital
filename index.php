<?php
require_once "config/connect.php";

$person = mysqli_query($connect, "SELECT * FROM `people`");
$person = mysqli_fetch_all($person);

$pagetitle = "Главная страница";

$tpl = "pages/main.tpl.php";
include "layout.php";

mysqli_close($connect);

// см паттерн разделения: https://stackoverflow.com/questions/5183163/using-php-include-to-separate-site-content
// но все же лучше писать на готовых фреймворках, как например Laravel

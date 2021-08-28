<?php
	/*mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);*/
	$connect = mysqli_connect("localhost","login","pass","db_name");

	if (!$connect) {
		echo mysqli_connect_error();
		die("Error occured");
	}
?>
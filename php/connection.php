<?php
function openConection(): ?PDO
{
	$db_host = 'localhost';
	
	// $db_user = 'root';
	// $db_pass = '';
	// $db_name = "refgoal";

	$db_user   = 'daw2122a2';
	$db_pass = 'c#3rGH8nLwmVQ';
	$db_name = 'daw2122a2';

	try {
		$conn = new PDO("mysql:host=$db_host;dbname=$db_name;charset=UTF8", $db_user, $db_pass);
		// set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
		// $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_BOTH);

		return $conn;
	} catch (PDOException $exception) {
		echo $exception->getMessage();
		die("Connection to database failed!");
	}

	return $conn;
}

<?php
// session_start();
function dbconnection()
{
	$servername = "localhost";
	$username = "root";
	$password = "root";
	$dbname = "DataEntry1";

	$conn = new mysqli($servername, $username, $password, $dbname);

	if ($conn->connect_error) {
		die("Connection Failed due to ->" . $conn->connect_error);
	}
	return $conn;
}

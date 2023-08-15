<?php 
	session_start();

$host = 'localhost';
$user = 'root';
$password = '';
$db = 'DSactivity';


try {

	$con = new PDO("mysql:host=$host; dbname=$db", $user, $password);

} catch (Exception $e) {

	echo "Eshte paraqite nje problem! Ky eshte problemi:<br>".$e;
}


?>
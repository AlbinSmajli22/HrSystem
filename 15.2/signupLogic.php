<?php
	include_once 'config.php';

	if (isset($_POST['submit'])) {
		
		$username = $_POST['username'];
		$fullname = $_POST['fullname'];
		$email = $_POST['email'];
		$temPass = $_POST['password'];
		$password = password_hash($temPass, PASSWORD_DEFAULT);

		$sql = "INSERT INTO users(username,fullname,email,password) VALUES (:username,:fullname,:email,:password)";

		$prep = $con->prepare($sql);

		$prep->bindParam(':username', $username);
		$prep->bindParam(':fullname', $fullname);
		$prep->bindParam(':email', $email);
		$prep->bindParam(':password', $password);

		$prep->execute();

		header('Location: login.php');
	}

?>
<?php 
include_once 'config.php';

if (isset($_POST['update'])) {

	$id = $_POST['id'];
	$username = $_POST["username"];
	$fullname = $_POST["fullname"];
	$email = $_POST['email'];
	$temPass = $_POST['password'];
	$password = password_hash($temPass, PASSWORD_DEFAULT);

	$sql = "UPDATE users SET fullname=:fullname, username=:username, password=:password, email=:email WHERE id=:id";

	$prep = $con->prepare($sql);

	$prep->bindParam(":id", $id);
	$prep->bindParam(":fullname", $fullname);
	$prep->bindParam(":username", $username);
	$prep->bindParam(":email", $email);
	$prep->bindParam(":password", $password);

	$prep->execute();

	header("Location: dashboard.php");
}
?>
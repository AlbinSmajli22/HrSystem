<?php
	require 'config.php';

	if (isset($_POST['submit'])) {
		
		$email = $_POST['email'];
		$password = $_POST['password'];

		$sql = "SELECT email,username,password,fullname FROM users WHERE email=:email";


		$prep = $con->prepare($sql);

		$prep->bindParam(':email', $email);
		$prep->execute();
		$data = $prep->fetch();

		//var_dump($data);die;

		if($data == false){
			include_once 'login.php';
			echo "<p style='color:red;'>User with this email is not registered. Go <a href='signup.php'>here</a> to register!</p>";
		}
		elseif (password_verify($password, $data['password'])) {
			$_SESSION['username'] = $data['username'];
			$_SESSION['fullname'] = $data['fullname'];

			header("Location: dashboard.php");
		}
		else{
			include_once 'login.php';
			echo "<p style='color:red;'>password incorrect</p>";
		}
	}
?>
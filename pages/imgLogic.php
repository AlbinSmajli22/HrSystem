<?php

$currentPass = $newpassword = $confirmpassword="";

$errors =array('file_size'=>'','file_exist'=>'','file_format'=>'','old_pass'=>'','new_pass'=>'', 'confirm_pass'=>'',);


if (isset($_REQUEST['saveimg'])) {
	try {
		$image_file = $_FILES["image"]["name"];
		$type = $_FILES["image"]["type"];
		$size = $_FILES["image"]["size"];
		$temp = $_FILES["image"]["tmp_name"];

		$path = "../userIMG/" . $image_file;

		if (empty($image_file)) {
			$errorMsg = "Please Selcet Image";
			header("Location: myProfile.php");
		} else if ($type == "image/jpg" || $type == "image/png" || $type == "image/jpeg" || $type == "image/gif") {
			if (!file_exists($path)) {
				if ($size < 5000000) {
					move_uploaded_file($temp, "../userIMG/" . $image_file);
					header("Location: myProfile.php");
				} else {

					$errorMsg = "your File is larger than 5MB";
					header("Location: myProfile.php");
				}
			} else {

				$errorMsg = "File alredy exist...Check upload folder";
				header("Location: myProfile.php");
			}
		} else {

			$errorMsg = "Upload jpg, jpeg, png & gif file format...Check file extension";
			header("Location: myProfile.php");
		}
		if (!isset($errorMsg)) {
			$sql = " UPDATE users SET image=:fimage where user_id = $userId";

			$prep = $con->prepare($sql);

			$prep->bindParam(':fimage', $image_file);

			$prep->execute();
			echo '<script>alert("Uploaded successfully")</script>';
			header("Location: myProfile.php");
		}
	} catch (PDOException $e) {
		echo $e->getMessage();
	}
}


if (isset($_POST['savepass'])) {

	if (empty($_POST['password'])) {
		$errors['old_pass']= 'old password missing';
	} else {
		$currentPass = $_POST['password'];
	}
	if (empty($_POST['newpassword'])) {
		$errors['new_pass']= 'new password missing';
	} else {
		$newpassword = $_POST['newpassword'];
		$password = password_hash($newpassword, PASSWORD_DEFAULT);
	}
	if (empty($_POST['confirmpassword'])) {
		$errors['confirm_pass']= 'confirm new password';
	} else {
		$confirmpassword = $_POST['confirmpassword'];
	}

	
	
	

	if (!password_verify($currentPass, $_SESSION['password'])) {

		$errors['old_pass']= 'password do not match the old one';
	} elseif (strcmp($newpassword, $confirmpassword) !== 0) {
		$errors['new_pass']= 'new password must be same as confirm password';
		$errors['confirm_pass']= 'confirm password must be same as new password';
	} else {

		$sql = " UPDATE users SET password=:password where user_id = $userId";

		$prep = $con->prepare($sql);

		$prep->bindParam("password", $password);

		$prep->execute();
		header("Location: myProfile.php");
	}



	if (isset($_POST['saveContact'])) {

		$contact_type=$_POST['contact_type'];
		$details=$_POST['details'];
		$primary_contact=$_POST['primary_contact'];
		$public=$_POST['public'];
		$emergency=$_POST['emergency'];
		$extra_info=$_POST['extra_info'];
		$user_id=$_SESSION['user_id'];


		$sql="INSERT INTO contact ( contact_type, details, primary_contact, public, emergency, extra_info, user_id) VALUES (:contact_type, :details, :primary_contact, :public, :emergency, :extra_info, :user_id) ";

		$prep = $con->prepare($sql);

		$prep->bindParam("contact_type", $contact_type);
		$prep->bindParam("details", $details);
		$prep->bindParam("primary_contact", $primary_contact);
		$prep->bindParam("public", $public);
		$prep->bindParam("emergency", $emergency);
		$prep->bindParam("extra_info", $extra_info);
		$prep->bindParam("user_id", $user_id);

		$prep->execute();
		
	}
}
?>
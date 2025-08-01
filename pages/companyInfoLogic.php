<?php
require_once '../config.php';
session_start();
$userId = $_SESSION['user_id'];
$companyId = $_SESSION['company'];


$sql="SELECT * FROM company WHERE company_id=:company_id";
$prep=$con->prepare($sql);
$prep->bindParam(':company_id',$companyId);
$prep->execute();
$companyInfo=$prep->fetch();

// These come from your database
$selectedCountry = $companyInfo['country'];
$selectedTimezone = $companyInfo['timezone'];

$errors =array('file_size'=>'','file_exist'=>'','file_format'=>'');

if(isset($_POST['saveCompData'])){
    try {
		$image_file = $_FILES["image"]["name"];
		$type = $_FILES["image"]["type"];
		$size = $_FILES["image"]["size"];
		$temp = $_FILES["image"]["tmp_name"];
        $comapny_name=$_POST['companyName'];
        $emp_num=$_POST['maxEmp'];
        $subscribed_until=$_POST['subcribedUntil'];
        $country=$_POST['CompCountry'];
        $timezone=$_POST['timezone'];

		$path = "../userIMG/" . $image_file;

		if (empty($image_file)) {
			$sql = " UPDATE company SET company_name=:company_name, emp_num=:emp_num, subscribed_until=:subscribed_until,
            timezone=:timezone, country=:country, image=:fimage where company_id = :company_id";

			$prep = $con->prepare($sql);

			$prep->bindParam(':fimage', $image_file);
			$prep->bindParam(':company_name', $comapny_name);
			$prep->bindParam(':emp_num', $emp_num);
			$prep->bindParam(':subscribed_until', $subscribed_until);
			$prep->bindParam(':timezone', $timezone);
			$prep->bindParam(':country', $country);
			$prep->bindParam(':company_id', $companyId);

			$prep->execute();
			header("Location: CompanyInfo.php");
		} else if ($type == "image/jpg" || $type == "image/png" || $type == "image/jpeg" || $type == "image/gif") {
			if (!file_exists($path)) {
				if ($size < 5000000) {
					move_uploaded_file($temp, "../companyLogo/" . $image_file);
					header("Location: CompanyInfo.php");
				} else {

					$errorMsg = "your File is larger than 5MB";
					header("Location: CompanyInfo.php");
				}
			} else {

				$errorMsg = "File alredy exist...Check upload folder";
				header("Location: CompanyInfo.php");
			}
		} else {

			$errorMsg = "Upload jpg, jpeg, png & gif file format...Check file extension";
			header("Location: CompanyInfo.php");
		}
		if (!isset($errorMsg)) {
			$sql = " UPDATE company SET company_name=:company_name, emp_num=:emp_num, subscribed_until=:subscribed_until,
            timezone=:timezone, country=:country, image=:fimage where company_id = :company_id";

			$prep = $con->prepare($sql);

			$prep->bindParam(':fimage', $image_file);
			$prep->bindParam(':company_name', $comapny_name);
			$prep->bindParam(':emp_num', $emp_num);
			$prep->bindParam(':subscribed_until', $subscribed_until);
			$prep->bindParam(':timezone', $timezone);
			$prep->bindParam(':country', $country);
			$prep->bindParam(':company_id', $companyId);

			$prep->execute();
			header("Location: CompanyInfo.php");
		}
	} catch (PDOException $e) {
		echo $e->getMessage();
	}
    
}

?>